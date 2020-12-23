<?php
session_start();
//session_regenerate_id();
error_reporting(0);
define('__WEBROOT__', "http://localhost/ecommerce-project-php");
define('__ROOT__', dirname(dirname(__FILE__)));  
require_once(__ROOT__.'/includes/dbcontroller.php');
require_once(__ROOT__.'/includes/function.php');
$db_handle      =  new DBController();
$page_title = "dillionecom";
?>