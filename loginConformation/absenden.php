<?php

require 'vendor/autoload.php';
require '../DB/UserDatabase.php';

$config = new \Doctrine\DBAL\Configuration();

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);


if(isset($_GET["teilnahme"])){
    $queryBuilder = $conn->createQueryBuilder();
    $queryBuilder2 = $conn->createQueryBuilder();
    $queryBuilder
        ->update('Participants', 'p')
        ->set('p.teilnahme', '?')
        ->where('token = ?')
        ->setParameter(0, $_GET["teilnahme"])
        ->setParameter(1, $_GET["token"])
    ;
    $queryBuilder2
        ->update('Participants', 'p')
        ->set('p.answer', '?')
        ->where('token = ?')
        ->setParameter(0, "")
        ->setParameter(1, $_GET["token"])
    ;
    $queryBuilder->execute();
    $queryBuilder2->execute();
    if(isset($_GET["grund"])){
        $queryBuilder3 = $conn->createQueryBuilder();
        $queryBuilder3
            ->update('Participants', 'p')
            ->set('p.answer', '?')
            ->where('token = ?')
            ->setParameter(0, $_GET["grund"])
            ->setParameter(1, $_GET["token"])
        ;
        $queryBuilder3->execute();
    }
}