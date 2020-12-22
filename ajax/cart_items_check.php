<?php 
require_once('../includes/top.php');
if(isset($_POST['myData'])){
$data = $_POST['myData'];
$data_cart = json_decode($data,true);
$sumtotal=0;
  if($data_cart!=null){ ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data_cart as $value){ 
        $pro_query      =   "select * from `products` where id='".$value['id']."'";
            if($db_handle->numRows($pro_query)>0){
                $pro_row    =   $db_handle->RunQuery($pro_query);
                //$price      =   $pro_row[0]["price"];
                $slug       =   $pro_row[0]["slug"];
                //get varient details
                $varientR = $db_handle->RunQuery("SELECT * FROM `ti_attributes` WHERE id = {$value['variant']}");
                $price      =   $varientR[0]["price"];
            }
        $tprice = $value['quantity'] * $price;
        $sumtotal = $sumtotal+$tprice; ?>
        <tr>
            <td>
                <?php echo $value['pname'];?>
                <b> - <?= $varientR[0]['size'] ?></b>
                <p>(<?php echo $value['quantity'];?>*$<?php echo $price;?>)</p>
            </td>
            <td>$<?= $tprice ?></td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <th class="text-right">Total Amount</th>
        <th>$<?php echo $sumtotal;?></th>
    </tr>
    <tr>
        <th class="text-right">Shipping(<?php echo $_SESSION['omethod']; ?>)</th>
        <th>$<?php echo $_SESSION['ship_charge']; ?></th>
    </tr>
    <tr>
        <th class="text-right">Payable Amount</th>
        <th>$<?php echo $_SESSION['tamount'];?></th>
    </tr>
    </tfoot>
</table>
<?php } }?>