<?php 
require_once('../includes/top.php');
if(isset($_POST['myData'])){
$data = $_POST['myData'];
$data_cart = json_decode($data,true);
$sumtotal=0;
$tnum=0;
if($data_cart!=null){
foreach($data_cart as $value){ 
$pro_query      =   "select * from `products` where id='".$value['id']."'";
    if($db_handle->numRows($pro_query)>0){
        $pro_row    =   $db_handle->RunQuery($pro_query);
        $price      =   $pro_row[0]["price"];
    }
        $tprice     =   $value['quantity'] * $price;
        $sumtotal   =   $sumtotal+$tprice;
        $tnum++;  } 
?>

    <a href="<?php echo __WEBROOT__; ?>/cart.php">
        <span class="cart-icon-main"> <i class="fa fa-shopping-basket"></i> <small class="cart-notification"><?php echo $tnum;?></small> </span>
        <div class="my-cart">My cart<br>$<?php echo $sumtotal;?></div>
    </a>

     <?php }else{ ?>

      <a href="javascript:void(0);">
        <span class="cart-icon-main"> <i class="fa fa-shopping-basket"></i> <small class="cart-notification">0</small> </span>
        <div class="my-cart">My cart<br>$0.00</div>
    </a>

<?php } } ?>