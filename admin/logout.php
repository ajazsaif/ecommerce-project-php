<?php 
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 'On');
session_name('medicare_admin');
session_start();
// variables unset
session_unset();

session_destroy();

//session_destroy
$baseurl = "http://localhost/ecommerce-project-php/admin";

header("location:".$baseurl."/login.php");

?>