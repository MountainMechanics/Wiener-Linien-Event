<?php
/**
 * Created by PhpStorm.
 * User: Vjeko Mistrafovic
 * Date: 19.03.2019
 * Time: 14:56
 */
require 'vendor/autoload.php';
require 'Token.php';
//echo "123";

$config = new \Doctrine\DBAL\Configuration();
require "../DB/UserDatabase.php";

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
        $date_end = $row['date_end'];
        $strasse = $row['strasse'];

    }

    $view = new \TYPO3Fluid\Fluid\View\TemplateView();
    $view->assignMultiple([
        'title' => $title,
        'opening_text' => $opening_text,
        'second_text' => $second_text,
        'date_begin' => $date_begin,
        'date_end' => $date_end,
        'plz' => '1140',
        'ort' => 'Wien',
        'strasse' => $strasse,
        'name' => 'Bauer'
    ]);
    $paths = $view->getTemplatePaths();
    $paths->setTemplatePathAndFilename(__DIR__. '/Resources/Private/Templates/index.html');
    $output = $view->render();
    echo $output;
}else{
    echo "Upps. Da ist wohl etwas schiefgelaufen!";
}




//echo $titles[0];