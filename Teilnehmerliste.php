<?php
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["login"]) && $_SESSION["login"]=="true"){
    //  header("Location: editor.php");
    // include 'editor.php';
}else{
    // include 'index.php';
    header("Location: index.php");
}
?>
<?php
require 'vendor/autoload.php';
require 'DB/UserDatabase.php';

$config = new \Doctrine\DBAL\Configuration();

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
$queryBuilder = $conn->createQueryBuilder();

$queryBuilder
    ->select('*')
    ->from('events_')
    ->where('pk_id=?')
    ->setParameter(0,$_GET['event']);

foreach ($queryBuilder->execute()->fetchAll() as $row2){
    $title=$row2['title'];
}

$qbParticip = $conn->createQueryBuilder();
$qbParticip
    ->select('*')
    ->from('Participants')
    ->where('fk_event=?')
    ->setParameter(0,$_GET['event']);


$text= <<<Foo
    
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="basic.css">
    <title>$title</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <img src="images/WL_logo.svg" id="logo">
                <a class="nav-item nav-link" href="home.php">Übersichtsseite</a>
                <a class="nav-item nav-link " href="editor.php">Editor</a>
            </div>
        </div>  
    </nav>
    <div class="container">
    <h1 class="margin">$title</h1>
    <a class="btn btn-lg btn-primary m-1"  type='submit' href="home.php" role="button">Zurück</a>
    
    
    <a class="btn btn-lg btn-primary"  download="somedata.xlsx" href="#" onclick="return ExcellentExport.convert({ anchor: this, filename: '$title', format: 'xlsx'},[{name: 'Sheet Name Here 1', from: {table: 'teilnehmer'}}]);">Excel Export</a>
<table id="teilnehmer">
  <tr>
    <th>Nachname</th>
    <th>Vorname</th>
    <th>Antwort</th>
    <th>Grund</th>
  </tr>

Foo;
echo $text;

foreach ($qbParticip->execute()->fetchAll() as $row) {

        if ($row['teilnahme'] == 1) {
            $antwort = "Nimmt Teil";
        } elseif ($row['teilnahme'] == 2) {
            $antwort = "Absage";
        } else {
            $antwort = "Noch keine Antwort";
        }
        echo "<tr>
            <td>" . $row['last_name'] . "</td> 
            <td>" . $row['first_name'] . "</td>";
        echo "<td>" . $antwort . "</td>
            <td>" . $row['answer'] . "</td>
          </tr>";
}

$text=<<<Boo
</table>
<script type="text/javascript" src="js/excellentexport/excellentexport.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
Boo;
echo $text;
