<?php
require_once('../includes/top.php');
//pre($_REQUEST);
if(isset($_POST['coupon_code']))
{
    $vid 		= $db_handle->escapeString($_POST['coupon_code']);
    $sum_amnt 	= $db_handle->escapeString($_POST['sum_amnt']);
    $ship_charge= $db_handle->escapeString($_POST['ship_charge']);
    $total_amnt = ($sum_amnt+$ship_charge);
    $keywords_query = "SELECT * FROM ti_coupon WHERE coupon_code = '$vid'";
    if($db_handle->numRows($keywords_query)>0){
        $search_row  =   $db_handle->RunQuery($keywords_query);
        //pre($search_row);
        echo json_encode([
        	'status'=>true,
        	'coupon_code_id'=>$search_row[0]['id'],
        	'coupon_price'=>$search_row[0]['coupon_price'],
        	'final_amnt'=>($total_amnt-$search_row[0]['coupon_price']),
        	'sum_amnt'=>$sum_amnt,
        	'ship_charge'=>$ship_charge
        ]);
        die();
    }

    echo json_encode([
        	'status'=>false,
        	'coupon_code_id'=>0,
        	'coupon_price'=>0.00,
        	'final_amnt'=>$total_amnt,
        	'sum_amnt'=>$sum_amnt,
        	'ship_charge'=>$ship_charge
        ]);
        die();
}
 ?>