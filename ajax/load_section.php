<?php
require_once('../includes/top.php');
if(isset($_POST['id'])){
    $cat_id = $_REQUEST['id'];
?>
    <div class="container">
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <ul class="cat-product">
                    <?php $query = "SELECT P.id AS 'id', P.slug AS 'slug', P.heading AS heading, COUNT(P.id) AS num FROM products AS P INNER JOIN products AS M ON P.id = M.parent GROUP BY M.parent order by num desc";
                    if($db_handle->numRows($query)>0){
                            $pro_row  =   $db_handle->RunQuery($query);   
                        }
                         for($i = 0;$i<count($pro_row);$i++){
                        ?>    
                        <li <?php if($pro_row[$i]['id']==$cat_id){?>class="active"<?php } ?>><a href="#cat_<?php  echo $pro_row[$i]['id']; ?>" class="btn " data-toggle="tab" onclick="load_section(<?php echo $pro_row[$i]['id'];?>)"><?php  echo $pro_row[$i]['heading']; ?></a></li>
                      <?php } ?>  
                    </ul>
                </div>
                <div class="tab-pane active" id="cat_1">
                 <?php $pro_query =   "select * from `products` where parent={$cat_id} and status='p' order by id desc limit 0,16";
                    if($db_handle->numRows($pro_query)>0){ 
                      $prp_row  =   $db_handle->RunQuery($pro_query);
                       for($j = 0;$j<count($prp_row);$j++){ ?>   
                    <div class="col-lg-3">
                        <div class="product">
                            <div class="item-media">
                                <a href="<?php echo __WEBROOT__; ?>/products/<?php echo $prp_row[$j]['slug']; ?>"><img src="<?php echo __WEBROOT__; ?>/images/product/<?php echo $prp_row[$j]['image']; ?>" alt="<?php echo $prp_row[$j]['heading']; ?>" title="<?php echo $prp_row[$j]['heading']; ?>" /></a>
                                <span class="price main_bg_color">
                                    <span class="amount">$<?php echo $prp_row[$j]['price']; ?></span>
                                </span>
                                <div class="product-buttons">
                                    <a href="javascript:void(0);" class="favorite_button" onclick="mylocationStorageWish(<?php echo $prp_row[$j]['id'];?>,'<?php echo $prp_row[$j]['image'];?>','<?php echo $prp_row[$j]['heading'];?>','<?php echo __WEBROOT__; ?>')"><span class="sr-only">Add to favorite</span></a>
                                    <a href="javascript:void(0);" class="add_to_cart" onclick="mylocationStorageDatacart(<?php  echo $prp_row[$j]['id']; ?>,<?php  echo $prp_row[$j]['min_qty']; ?>,'<?php echo $prp_row[$j]['image']; ?>','<?php echo $prp_row[$j]['heading']; ?>','<?php echo __WEBROOT__;?>/cart.php')"><span class="sr-only">Add to favorite</span></a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="star-rating"> <span style="width:<?php echo $prp_row[$j]['rating']; ?>%">
                                    <strong class="rating"></strong> out of 5
                                    </span> </div>
                               <a class="product-name" href="<?php echo __WEBROOT__; ?>/products/<?php echo $prp_row[$j]['slug']; ?>"><?php echo $prp_row[$j]['heading']; ?></a>
                            </div>
                        </div>
                    </div>
                <?php } } ?>  
                </div>
            </div>
        </div>
    <?php } ?>