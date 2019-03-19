<?php
namespace WienerLinien;
require_once "../vendor/autoload.php";

class Config
{
    const DBPARAMS = [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => '',
        'dbname' => 'WienerLinienEventTool'
    ];
}