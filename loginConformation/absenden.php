<?php
/**
 * Created by PhpStorm.
 * User: Vjeko Mistrafovic
 * Date: 07.05.2019
 * Time: 16:04
 */
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


if(isset($_GET["teilnahme"])){
    $queryBuilder = $conn->createQueryBuilder();
    $queryBuilder
        ->update('Participants', 'p')
        ->set('p.teilnahme', '?')
        ->where('token = ?')
        ->setParameter(0, $_GET["teilnahme"])
        ->setParameter(1, $_GET["token"])
    ;
    $queryBuilder->execute();
    if(isset($_GET["grund"])){
        $queryBuilder2 = $conn->createQueryBuilder();
        $queryBuilder2
            ->update('Participants', 'p')
            ->set('p.answer', '?')
            ->where('token = ?')
            ->setParameter(0, $_GET["grund"])
            ->setParameter(1, $_GET["token"])
        ;
        $queryBuilder2->execute();
    }
}