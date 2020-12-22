<?php
require_once('../includes/config.php');
$id=$_REQUEST['id'];
$status=$_REQUEST['status'];
$msg = array();
$type=$_REQUEST['type'];
if($status=='u')
{ $stats='p'; }
if($status=='p')
{ $stats='u'; }

$db_handle   =  new DBController();
$fields =   array(
                    "status"=>$stats
                );
if($db_handle->updateQuery("products",$fields,"id = '$id'")){
    $msg['sucess'] = 'ok';
}
else{
    $msg['sucess'] = 'fail';
}
echo json_encode($msg);
$db_handle->Close();
unset($db_handle); 
?>