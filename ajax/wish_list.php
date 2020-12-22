<?php 
require_once('../includes/top.php');
if(isset($_POST['myData'])){
$data = $_POST['myData'];
$data_cart = json_decode($data,true);
$sumtotal=0;
  if($data_cart!=null){ ?>
<table class="table table-bordered wishlist">
    <thead>
        <tr>
            <th>Name</th>
            <th>Veriant</th>
            <th>Price</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach($data_cart as $value){ 
$pro_query      =   "select * from `products` where id='".$value['pid']."'";
    if($db_handle->numRows($pro_query)>0){
        $pro_row    =   $db_handle->RunQuery($pro_query);
        $slug       =   $pro_row[0]["slug"];

        $varinetRows = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$pro_row[0]['id']}");
                $varinetR = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE id = {$value['varient']}");
                $price      =   $varinetR[0]["price"];
                $varient_name = $varinetR[0]["size"];
                //$tprice = $value['quantity'] * $price;
    }
?>
        <tr>
            <td><?php echo $value['pname'];?></td>
            <td><?php echo $varient_name;?></td>
            <td>$<?php echo $price; ?></td>
            <td>
                <a class="main-btn" href="javascript:void(0);" onclick="wishToCartAdd(this,<?php echo $value['pid']; ?>,<?php echo $value['varient']; ?>,'<?php echo $value['pname']; ?>','<?php echo $value['pimage']; ?>','<?php echo __WEBROOT__.'/cart.php'; ?>');" ><i class="fa fa-cart-plus"></i></a>
                <a class="main-btn" href="javascript:void(0);" onclick="WishdelFunction(this,<?php echo $value['pid'];?>,<?php echo $value['varient'];?>,'<?php echo $value['pname'];?>')" ><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else{  ?>
    <a herf="<?= __WEBROOT__ ?>">Empty Wishlist</a>
    <?php } } ?>