<?php
require_once('../includes/config.php');
$id=$_REQUEST['id'];
$status=$_REQUEST['status'];
$msg = array();
if($status== 0)
{ $stats= 1; }
if($status== 1)
{ $stats= 0; }

$db_handle   =  new DBController();
$fields =   array(
                    "status"=>$stats
                );
if($db_handle->updateQuery("ti_pro_review",$fields,"id = '$id'")){
    $msg['sucess'] = 'ok';
}
else{
    $msg['sucess'] = 'fail';
}
echo json_encode($msg);
$db_handle->Close();
unset($db_handle); 
?>