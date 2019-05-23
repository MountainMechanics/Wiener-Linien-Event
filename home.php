<?php
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["login"]) && $_SESSION["login"]=="true" && isset($_SESSION["userID"])){
    //  header("Location: editor.php");
    // include 'editor.php';
}else{
    // include 'index.php';
    header("Location: index.php");
}
?>
<?php
require 'vendor/autoload.php';
$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array (
'dbname' => 'WienerLinienEventTool',
'user' => 'root',
'password' => '',
'host' => 'localhost',
'driver' => 'pdo_mysql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

if(isset($_GET['delete'])){

    $qb = $conn->createQueryBuilder();
    $qb= $qb->delete('participants')
        ->where('fk_event = :id')
        ->setParameter('id',$_GET['delete']);
    $deleted = $qb->execute();

    $qb = $conn->createQueryBuilder();
    $qb= $qb->delete('events_')
        ->where('pk_id = :id')
        ->setParameter('id',$_GET['delete']);
    $deleted = $qb->execute();
}
$queryBuilder = $conn->createQueryBuilder();
$queryBuilder
    ->select('*')
    ->from('events_');


$text= <<<FOO

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Übersichtsseite</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="basic.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <img src="images/WL_logo.svg" id="logo">
            <a class="nav-item nav-link active" href="home.php">Übersichtsseite</a>
            <a class="nav-item nav-link " href="editor.php">Editor</a>
        </div>
    </div>
</nav>

<div class="center">
    <a href="editor.php">
        <button class="btn btn-lg btn-success margin"  type='submit'  value="2" role="button">Neues Event erstellen</button>
    </a>
</div>
<div class="container">
FOO;
echo $text;
foreach ($queryBuilder->execute()->fetchAll() as $row) {
    $zusage=0;
    $absage=0;
    $noresponse=0;
    $title=$row['title'];
    $description=$row['description'];
    $id=$row['pk_id'];
    $qbParticip = $conn->createQueryBuilder();
    $qbParticip
        ->select('*')
        ->from('Participants','p')
        ->innerJoin('p','events_','e','p.fk_event=e.pk_id')
        ->where('fk_event = :id')
        ->setParameter('id',$row['pk_id']);
    foreach ($qbParticip->execute()->fetchAll() as $row2){


            if ($row2['teilnahme'] == 1) {
                $zusage = $zusage + 1;
            } else if ($row2['teilnahme'] == 2) {
                $absage = $absage + 1;
            } else {
                $noresponse = $noresponse + 1;
            }

    }
    $temp= <<<BAR
    <div style="display:flex; align-items: flex-end; justify-content: space-between;" class="jumbotron">
     <form style="width:66%;" action="Teilnehmerliste.php" method="get">
            <h1>$title</h1>
            <p  class="lead">$description</p>
            <button class="btn btn-lg btn-primary"  type='submit' name="event" value=$id role="button">Zur Teilnehmerliste</button>
     </form>
     <div style="display:flex; flex-direction: column; align-items: flex-end">
         <p style="">Zusagen: $zusage Absagen: $absage Offen: $noresponse</p>
         <form action="home.php" method="get">
             <button style="float:right;"class="btn btn-lg btn-danger"  type='submit' name="delete" value=$id role="button">Event löschen</button>
         </form>
     </div>
    </div>
BAR;
echo $temp;
}
$end = <<<But
</div>

<script type="text/javascript" src="js/excellentexport/excellentexport.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
But;

echo $end;


