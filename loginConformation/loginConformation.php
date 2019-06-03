<?php

require 'vendor/autoload.php';
require 'Token.php';
require '../DB/UserDatabase.php';


$config = new \Doctrine\DBAL\Configuration();

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

if(isset($_GET['token'])){

    $token = $_GET['token'];
    $queryBuilder = $conn->createQueryBuilder();
    $queryBuilder
        ->select('fk_event')
        ->from('Participants')
        ->where('token = ?')
        ->setParameter(0,$token);

    $id = $queryBuilder->execute()->fetchAll();

    $queryBuilder3 = $conn->createQueryBuilder();
    $queryBuilder3
        ->select('*')
        ->from('Participants')
        ->where('token = ?')
        ->setParameter(0,$token);

    $werte2 = $queryBuilder3->execute();

    while ($row = $werte2->fetch()){
        $name = $row['last_name'];

    }

    $queryBuilder2 = $conn->createQueryBuilder();
    $queryBuilder2
        ->select('*')
        ->from('events_')
        ->where('pk_id = ?')
        ->setParameter(0,$id[0]['fk_event']);

    $werte = $queryBuilder2->execute();



    while ($row = $werte->fetch()){
        $title = $row['title'];
        $opening_text = $row['opening_text'];
        $second_text = $row['second_text'];
        $date_begin = $row['date_begin'];
        $time_begin = $row['time_begin'];
        $time_end = $row['time_end'];
        $strasse = $row['strasse'];
        $desc = $row['description'];
        $plz = $row['plz'];
        $ort = $row['ort'];
        $GLOBALS['agenda'] = $row['agenda'];

    }

    $view = new \TYPO3Fluid\Fluid\View\TemplateView();
    $view->assignMultiple([
        'title' => $title,
        'openingtext' => $opening_text,
        'second_text' => $second_text,
        'date_begin' => $date_begin,
        'time_begin' => $time_begin,
        'time_end' => $time_end,
        'strasse' => $strasse,
        'name' => $name,
        'desc' => $desc,
        'plz' => $plz,
        'ort' => $ort,
        'ICS' => createICS($queryBuilder2),
        'agenda' => createAgenda($queryBuilder2)
    ]);
    $paths = $view->getTemplatePaths();
    $paths->setTemplatePathAndFilename(__DIR__. '/Resources/Private/Templates/index.html');
    $output = $view->render();
    echo $output;
}else{
    echo "Der Token konnte nicht uebergeben werden";
}

function createICS($queryBuilder)
{
    $statement = $queryBuilder->execute()->fetchAll();
    $kb_start = $statement[0]['date_begin'].'T'.$statement[0]['time_begin'];
    $kb_end = $statement[0]['date_begin'].'T'.$statement[0]['time_end'];
    $kb_current_time = time();
    $kb_title = html_entity_decode($statement[0]['title'], ENT_COMPAT, 'UTF-8');
    $kb_location = preg_replace('/([\,;])/', '\\\$1', $statement[0]['ort'] . ', ' . $statement[0]['plz'] . ', ' . $statement[0]['strasse']);
    $kb_description = html_entity_decode($statement[0]['description'], ENT_COMPAT, 'UTF-8');
    $kb_file_name = 'Outlook_Termin('.$statement[0]['title'].")";

    $kb_ical = fopen($kb_file_name . '.ics', 'w') or die('Datei kann nicht gespeichert werden!');
    $eol = "\r\n";
    $kb_ics_content =
        'BEGIN:VCALENDAR' . $eol .
        'VERSION:2.0' . $eol .
        'CALSCALE:GREGORIAN' . $eol .
        'BEGIN:VEVENT' . $eol .
        'DTSTART:' . $kb_start . $eol .
        'DTEND:' . $kb_end . $eol .
        'LOCATION:' . $kb_location . $eol .
        'DTSTAMP:' . $kb_current_time . $eol .
        'SUMMARY:' . $kb_title . $eol .
        'DESCRIPTION:' . $kb_description . $eol .
        'UID:' . $kb_current_time . '-' . $kb_start . '-' . $kb_end . $eol .
        'END:VEVENT' . $eol .
        'END:VCALENDAR';
    fwrite($kb_ical, $kb_ics_content);
    fclose($kb_ical);

    return $kb_file_name . '.ics';
}

function createAgenda($queryBuilder)
{
    $statement = $queryBuilder->execute()->fetchAll();
    $agenda_filename = 'Agenda('.$statement[0]['title'].")";

    $agenda = fopen($agenda_filename . '.pdf', 'w') or die('Datei kann nicht gespeichert werden!');
    $eol = "\r\n";
    $agenda_content =
        $GLOBALS['agenda'];
    fwrite($agenda, $agenda_content);
    fclose($agenda);

    return $agenda_filename . '.pdf';
}




//echo $titles[0];