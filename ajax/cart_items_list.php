<?php 
require_once('../includes/top.php');
if(isset($_POST['myData'])){
$data = $_POST['myData'];
$data_cart = json_decode($data,true);
$sumtotal=0;
  if($data_cart!=null){ ?>
<div class="row mb40">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Verient</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_cart as $value){ 
                    $pro_query      =   "select * from `products` where id='".$value['id']."'";
                        if($db_handle->numRows($pro_query)>0){
                            $pro_row    =   $db_handle->RunQuery($pro_query);
                            
                            //cart item details
                            $slug       =   $pro_row[0]["slug"];
                            
                            $min_qty    =   $value['quantity'];
                            $varient    =   $value["variant"];
                            $varinetRows = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$pro_row[0]['id']}");
                            $varinetR = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE id = {$varient}");
                            $price      =   $varinetR[0]["price"];
                            $varient_name = $varinetR[0]["size"];
                        }

                        $tprice = $value['quantity'] * $price;
                        $pname= $value['pname'];
                        $sumtotal = $sumtotal+$tprice;
                        ?>
                    <tr>
                        <td><?= $value['pname'] ?></td>
                        <td>
                            <select class="form-control" name="varient" id="varientId<?php echo $varient; ?>">
                                <?php 
                                    if(!empty($varinetRows)):

                                    foreach($varinetRows as $varient_val):
                                ?>
                                    <option value="<?php echo $varient_val['id']; ?>" <?php echo $varient_val['id'] == $varient ? 'selected' : ''; ?>><?php echo $varient_val['size']; ?> ($<?php echo $varient_val['price']; ?>)</option>
                            <?php endforeach; endif; ?>
                            </select>
                        </td>
                        <td>$<?php echo $price; ?></td>
                        <td class="single-product-info">
                            <div class="quantity">
                                <button class="qtyBtn btnMinus" onclick="minusFunction(this,<?php echo $varient;?>,<?php echo 1;?>)" ><span>-</span></button>
                                <input type="text" name="qty"  id="input-quantity" value="<?= $value['quantity'] ?>" min="1" />
                                <button class="qtyBtn btnPlus"  onclick="plusFunction(this,<?php echo $varient;?>)">+</button>
                            </div>
                        </td>
                        <td>$<?php echo $tprice;?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="delFunction(this,<?php  echo $varient;?>,'<?php  echo $pname;?>')"><i class="fa fa-remove"></i></a>
                            <a href="javascript:void(0);" class="fa fa-refresh" onclick="updateCart(this,'<?php echo $varient; ?>','<?php echo $pname; ?>');">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Amont</th>
                    <th colspan="2">$<span id="sumtotal_amnt"><?php echo $sumtotal;?></span></th>
                </tr>
                <tr>
                    <th colspan="5" class="text-right">
                        <select class="form-control" onchange="myfunction(this,<?php echo $sumtotal;?>);">
                             <option value="30@Local Shipping 10 to 15 business days">Local Shipping<br/><small>10 to 15 business days</small></option>
                            <option value="45@USPS/DHL/FedEx First Class Package International 9 to 21 business days">USPS/DHL/FedEx First Class Package International<br/><small>9 to 21 business days</small></option>
                            <option value="50@USPS/FedEx/Others Priority Mail Express Local(USA/CANADA) 3 to 5 business days">USPS/FedEx/Others Priority Mail Express Local(USA/CANADA)<br/><small>3 to 5 business days</small></option>
                            <option value="60@USPS/DHL/FedEx Priority Mail International 6 to 10 business days">USPS/DHL/FedEx Priority Mail International<br/><small>6 to 10 business days</small></option>
                            <option value="70@USPS/FedEx/Others Overnight Express Local Mail(USA/CANADA) 4 to 6 business days">USPS/FedEx/Others Overnight Express Local Mail(USA/CANADA)<br/><small>4 to 6 business days</small></option>
                            <option value="75@USPS/DHL/FedEx Priority Mail Express International 3 to 5 business days">USPS/DHL/FedEx Priority Mail Express International<br/><small>3 to 5 business days</small></option>
                        </select>
                    </th>
                    <th colspan="2">$<span id="shipping_price">30.00</span></th>
                </tr>
                
                <tr>
                    <th colspan="5" class="text-right">Grand Total</th>
                    <th colspan="2">$<span id="total_div"><?= ($sumtotal+30.00) ?></th>
                </tr>
                </tfoot>
            </table>
            <form name="chkout" method="post" id="chkout">
                <input type="hidden" name="chk" value="cart">
                <input type="hidden" name="method" id="method" value="Local Shipping 10 to 15 business days">
                <input type="hidden" name="ship_charge" id="ship_charge" value="30.00">
                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo ($sumtotal+30.00);?>">
            </form>
        </div>
        
        <a href="<?php echo __WEBROOT__; ?>" class="main-btn">Continue Shopping</a>
        <a href="javascript:void(0);" onclick="checkout()" class="main-btn pull-right">Checkout</a>
    </div>
</div>
<?php } else{  ?>
    <a href="<?php echo __WEBROOT__; ?>" class="btn btn-default">Continue Shopping</a>
<?php } } ?>