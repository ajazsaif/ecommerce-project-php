<?php
require_once('../includes/top.php');

    $keyword = strval($_POST['query']);
    $cat_id  = strval($_POST['cat_id']);
    if(!empty($cat_id)){
     $keywords_query = "select heading from products where parent = {$cat_id} and status='p' and heading like '%$keyword%'";
    }else{
     $keywords_query = "select heading from products where status='p' and parent != 0 and heading like '%$keyword%'";   
    }
 
    if($db_handle->numRows($keywords_query)>0){
    $search_row  =   $db_handle->RunQuery($keywords_query); 
    for($i = 0;$i<count($search_row);$i++){ 
      $countryResult[] = $search_row[$i]["heading"];
     }
     echo json_encode($countryResult);
   } 
 ?>