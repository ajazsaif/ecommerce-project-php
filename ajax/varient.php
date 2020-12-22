<?php
require_once('../includes/top.php');
if(isset($_GET['id']))
{
    $vid = $db_handle->escapeString($_GET['id']);
    $keywords_query = "SELECT id,price,size FROM ti_attributes WHERE id = {$vid}";
    if($db_handle->numRows($keywords_query)>0){
        $search_row  =   $db_handle->RunQuery($keywords_query);
        echo json_encode($search_row[0]);
        die();
    } 
}
 ?>