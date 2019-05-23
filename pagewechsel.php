<?php
/**
 * Created by PhpStorm.
 * User: Tobias Preissner
 * Date: 07.05.2019
 * Time: 15:45
 */
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["login"]) && $_SESSION["login"]=="true"){
    include 'home.php';
}else{
    include 'index.php';
}