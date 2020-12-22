<?php 
require_once('../includes/top.php');
if(isset($_POST['myData'])){
$data = $_POST['myData'];
$data_cart = json_decode($data,true);
$sumtotal=0;
  if($data_cart!=null){ ?>
<div class="col-sm-8" >
<h3>Cart Info</h3>
  <div class="table-responsive">
    <table class="table shop_table cart cart-table">
        <thead>
            <tr>
                <th> </th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Price</th>
                
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
                <td><h6><a href="javascript:void(0);" class="fa fa-trash" onclick="delFunction(this,<?php  echo $varient;?>,'<?php  echo $pname;?>')"></a></h6></td>
                <td>
                    <div class="media-left">
                        <a href="<?php echo __WEBROOT__; ?>/products/<?php echo $slug;?>">
                            <img class="media-object cart-product-image" src="<?php  echo __WEBROOT__;?>/images/product/<?php echo $value['image'];?>" alt="<?php echo $value['pname'];?>" title="<?php echo $value['pname'];?>">
                        </a>
                    </div>
                    <div class="media-body">
                        <h6><a href="<?php echo __WEBROOT__; ?>/products/<?php echo $slug;?>"><?php echo $value['pname'].' '.$varient_name; ?></a><br/><small>Price : $<?php echo $price;?></small></h6>
                    </div>
                </td>
                <td><b>$<?php echo $price; ?></b></td>
                <td>
                <select name="varient" id="varientId<?php echo $varient; ?>">
                        <?php 
                            if(!empty($varinetRows)):

                            foreach($varinetRows as $varient_val):
                        ?>
                        <option value="<?php echo $varient_val['id']; ?>" <?php echo $varient_val['id'] == $varient ? 'selected' : ''; ?>><?php echo $varient_val['size']; ?> ($<?php echo $varient_val['price']; ?>)</option>
                    <?php endforeach; endif; ?>
                    </select>
                    <a href="javascript:void(0);" class="fa fa-refresh" onclick="updateCart(this,'<?php echo $varient; ?>','<?php echo $pname; ?>');"></a>
                </td>
                <td><h6>$<?php echo $tprice;?></h6></td>
            </tr>
            <?php } ?>
              </tbody>
            </table>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo __WEBROOT__; ?>/ajax/verify-coupon.php" id="verifyCoupon" method="post" autocomplete="off" onsubmit="return coupon_varify(this);">
                    <input type="hidden" id="sum_amnt" name="sum_amnt" value="<?php echo $sumtotal;?>" />
                    <input type="text" required id="coupon_code" name="coupon_code" placeholder="Coupon Code" />
                    <input type="submit" class="" id="__verifyCoupon" value="Apply Coupon" name="__verifyCoupon" />
                    <div id="coupon_code_err"></div>
                </form>
            </div>
        </div>
        <div class="cart-buttons">
            <a class="theme_button color1" href="<?php echo __WEBROOT__; ?>">Continue Shopping</a>
            <a class="theme_button color1 pull-right" href="javascript:void(0);" onclick="checkout()">Checkout</a>
        </div>
            <form name="chkout" method="post" id="chkout">
                <input type="hidden" name="chk" value="cart">
                <input type="hidden" name="method" id="method" value="Free Shipping 5 - 7 Days">
                <input type="hidden" name="ship_charge" id="ship_charge" value="0.00">
                <input type="hidden" name="coupon_code_amnt" id="coupon_code_amnt" value="0.00">
                <input type="hidden" name="coupon_code_id" id="coupon_code_id" value="0">
                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $sumtotal;?>">
            </form>
            </div>
            <div class="col-md-4" id="shipping_item">
                            <h3>Cart Total</h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><b>Subtotal</b></td>
                                        <td>$<span id="sumtotal_amnt"><?php echo $sumtotal;?></span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Shipping</b></td>
                                        <td>
                                         <label>Free Shipping 5 - 7 Days : <b></b> <input type="radio" name="ShippingMethod" data-price="0.00" onclick="myfunction(this,this.value,<?php echo $sumtotal;?>);" value="Free Shipping 5 - 7 Days" checked /></label>
                                            <label>Express - 24 Hours : <b>$18.99 </b> <input type="radio" name="ShippingMethod" onclick="myfunction(this,this.value,<?php echo $sumtotal;?>);" data-price = "18.99" value="Express - 24 Hours" /></label>
                                            <label>Standard Delivery - 72 Hours : <b>$5.99 </b> <input type="radio" name="ShippingMethod"  onclick="myfunction(this,this.value,<?php echo $sumtotal;?>);" data-price = "5.99" value="Standard Delivery - 72 Hours" /></label>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Grand Subtotal</b></td>
                                        <td>$<sapn id="total_div"><?php echo $sumtotal;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="<?php echo __WEBROOT__; ?>/checkout.php"></a>
                        </div>
               <?php }else{ ?>
             <div class="col-md-12">
               <div id="success" class="alert alert-default alert-dismissible" style="background-color: #eee;">
                    <h4 class="text-center">
                    Your shopping cart is empty.
                    </h4>
               </div>
           </div>
           <div class="col-md-12 text-center">
              <a class="theme_button color1" href="<?php echo __WEBROOT__; ?>/">Continue Shopping</a>
              </br>
            </div>
<?php } } ?>