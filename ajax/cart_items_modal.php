<?php 
require_once('../includes/top.php');
if(isset($_POST['myData'])){
$data = $_POST['myData'];
$data_cart = json_decode($data,true);
$sumtotal=0;
?>
<table>
        <thead>
            <tr>
                <th class="CartClose">Close Cart</th>
                <th colspan="2">SHOPPING CART</th>
                
            </tr>
        </thead>
        <tbody>
        	<?php
        if($data_cart!=null){
        foreach($data_cart as $value){ 
        $pro_query      =   "select * from `products` where id='".$value['id']."'";
            if($db_handle->numRows($pro_query)>0){
                $pro_row    =   $db_handle->RunQuery($pro_query);
                
                //cart item details
                $slug       =   $pro_row[0]["slug"];
                
                $min_qty    =   $value['quantity'];
                $varient    =   $value["variant"];
                $varinetR = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE id = {$varient}");
                $price      =   $varinetR[0]["price"];
                $varient_name = $varinetR[0]["size"];
            }

            $tprice = $value['quantity'] * $price;
            $pname= $value['pname'];
            $sumtotal = $sumtotal+$tprice;
            ?>
            <tr>
                <td><a href="<?php echo __WEBROOT__; ?>/products/<?php echo $slug;?>"><img src="<?php  echo __WEBROOT__;?>/images/product/<?php echo $value['image'];?>" alt="<?php echo $value['pname'];?>" title="<?php echo $value['pname'];?>" /></a></td>
                <td>
                    <a href="<?php echo __WEBROOT__; ?>/products/<?php echo $slug;?>"><?php echo $value['pname'].' '.$varient_name; ?></a>
                    <b><?php echo $value['quantity']?>*$<?php echo $price;?></b>
                </td>
                <td><a href="javascript:void(0);" onclick="delFunctionCartModal(this,<?php  echo $varient;?>,'<?php  echo $pname;?>')"><i class="fa fa-trash"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right"><b>Subtotal</b></td>
                <td colspan="2">$<?php echo $sumtotal; ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <a class="theme_button color4" href="<?php echo __WEBROOT__; ?>/cart.php">View Cart</a>
                    <a class="theme_button color4" href="<?php echo __WEBROOT__; ?>/login.php">Login</a>
                </td>
            </tr>
        </tfoot>
    <?php } else{ ?>
    	<tfoot>
            <tr>
                <td colspan="3">
                	<h4 class="text-center">
                    Your shopping cart is empty.
                    </h4>
                    <a class="theme_button color4" href="<?php echo __WEBROOT__; ?>">Continue Shopping</a>
                    <!-- <a class="theme_button color4" href="<?php echo __WEBROOT__; ?>/cart.php">View Cart</a>
                    <a class="theme_button color4" href="<?php echo __WEBROOT__; ?>/login.php">Login</a> -->
                </td>
            </tr>
        </tfoot>
    <?php } ?>
    </table>
 <?php } ?>