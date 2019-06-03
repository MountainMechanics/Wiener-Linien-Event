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
        ->setParameter(":pw", $pw)
        ->setParameter(":user", $username);

    //echo $queryBuilder;
    //
$statement = $queryBuilder->execute()->fetchAll();
    //$user = $statement->fetchAll();

    //print_r($user);

if (($userData = $queryBuilder->execute()->fetchAll())!=null){
    //echo "Success";
    $_SESSION["login"] = "true";
    $_SESSION["username"] = $username;
    $_SESSION["userID"] = $userData[0]["pk_id"];
    //var_dump($userData[0]);

    //echo "Session variables are set.";
    //echo $_SESSION["login"];
    header("Location: home.php");
    //include 'home.php';
}else {

   // include 'index.php';
    header("Location: index.php?invalid=true");
    $_SESSION["login"] = "false";
}





//echo 'Username: '.$username.'<br>';
//echo 'Password: '.$pw.'<br>';