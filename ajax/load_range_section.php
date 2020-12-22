<?php
require_once('../includes/top.php');

if(isset($_POST['cid'])){
    $cat_id = $_REQUEST['cid'];
    $min    = $_REQUEST['min'];
    $max    = $_REQUEST['max'];
    $min    = ltrim($min, '$');
    $max    = ltrim($max, '$');
    $fea_query =   "select * from `products` where parent='".$cat_id."' and status='p' and price >={$min} and price <= {$max}";
        if($db_handle->numRows($fea_query)>0){
                $total_rows = $db_handle->numRows($fea_query);
                $fea_query.=" Order By price asc";
            $f_row  =   $db_handle->RunQuery($fea_query);    
            for($i = 0;$i<count($f_row);$i++){                         
        ?>   
            <div class="col-md-4">
                <div class="product">
                <div class="item-media">
                    <a href="<?php echo __WEBROOT__; ?>/products/<?php  echo $f_row[$i]['slug']; ?>"><img src="<?php echo __WEBROOT__; ?>/images/product/<?php echo $f_row[$i]['image']; ?>" alt="<?php echo $f_row[$i]['heading']; ?>" title="<?php echo $f_row[$i]['heading']; ?>" /></a>
                    <span class="price main_bg_color">
                        <span class="amount">$<?php echo $f_row[$i]['price']; ?></span>
                    </span>
                    <div class="product-buttons">
                        <a href="javascript:void(0);" class="favorite_button" onclick="mylocationStorageWish(<?php echo $f_row[$i]['id'];?>,'<?php echo $f_row[$i]['image'];?>','<?php echo $f_row[$i]['heading'];?>','<?php echo __WEBROOT__; ?>')"><span class="sr-only">Add to favorite</span></a>
                        <a href="javascript:void(0);" class="add_to_cart" onclick="mylocationStorageDatacart(<?php  echo $f_row[$i]['id']; ?>,<?php  echo $f_row[$i]['min_qty']; ?>,'<?php echo $f_row[$i]['image']; ?>','<?php echo $f_row[$i]['heading']; ?>','<?php echo __WEBROOT__;?>/cart.php')"><span class="sr-only">Add to favorite</span></a>
                    </div>
                </div>
                <div class="item-content">
                    <div class="star-rating"> <span style="width:<?php  echo $f_row[$i]['rating']; ?>%">
                        <strong class="rating">5.0</strong> out of 5
                        </span> </div>
                   <a class="product-name" href="<?php echo __WEBROOT__; ?>/products/<?php echo $f_row[$i]['slug']; ?>"><?php echo $f_row[$i]['heading']; ?></a>
                </div>
            </div>
        </div> 
        <?php } } else{ ?>
          <div class="col-md-12">
               <div id="success" class="alert alert-default alert-dismissible" style="background-color: #eee;">
                    <h4 class="text-center">
                    No Product found.
                    </h4>
               </div>
           </div>
    <?php } } ?>