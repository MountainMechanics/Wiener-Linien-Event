<?php

if(!isset($_SESSION))
{
    session_start();
}
if(isset($_GET['logout']) && $_GET['logout'] == true){
    $_SESSION['login'] = 'false';
    $_SESSION["username"] = null;
    $_SESSION["userID"] = null;
}
require './vendor/autoload.php';
$username =htmlspecialchars($_POST['username']);
$pw = htmlspecialchars($_POST['pw']);




$config = new \Doctrine\DBAL\Configuration();
require 'DB/UserDatabase.php';

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
//$sql = 'SELECT username FROM Organizer
//          WHERE username=$username AND password_=$pw ';
//$stmt = $conn->query($sql);


    $queryBuilder = $conn->createQueryBuilder();
    $queryBuilder
        ->select('username', 'password_','pk_id')
        ->from('Organizer')
        ->where('username=:user')
        ->andWhere('password_=:pw')
        ->setParameter(":pw", hash('sha256', $pw))
        ->setParameter(":user", $username);


$statement = $queryBuilder->execute()->fetchAll();


if (($userData = $queryBuilder->execute()->fetchAll())!=null){
    //echo "Success";
    $_SESSION["login"] = "true";
    $_SESSION["username"] = $username;
    $_SESSION["userID"] = $userData[0]["pk_id"];
    header("Location: home.php");
}else {

    header("Location: index.php?invalid=true");
    $_SESSION["login"] = "false";
}
