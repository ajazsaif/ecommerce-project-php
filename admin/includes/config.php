<?php 
error_reporting(0);
session_name('medicare_admin');
session_start();
session_regenerate_id();
define('__WEBROOT__', "http://localhost/dillionecom/admin");
if(empty($_SESSION["admin-email"])){
        header("location:".__WEBROOT__."/login.php");
    
    //redirect_page_url($baseurl."/login.php");
    }
include_once('dbcontroller.php');
include_once('function.php');
$page_title='dillionecom';
?>

