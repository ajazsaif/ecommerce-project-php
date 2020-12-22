<?php 
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 'On'); 
include("./includes/top.php");

// variables unset
session_unset();

session_destroy();

//session_destroy
$baseurl =  __WEBROOT__;

header("location:".$baseurl);

?>