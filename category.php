<?php 
$page = 'Cat';
include("./includes/top.php");
  if(isset($_GET['ref'])){
     $ref=$_GET['ref'];
     $escape_token=$db_handle->escapeString($ref);

     $cat_query =   "select * from `products` where slug='".$escape_token."'";
        if($db_handle->numRows($cat_query)>0){
            $cat_row  =   $db_handle->RunQuery($cat_query);
            $seo_title          =   $cat_row[0]["seo_title"]; 
            $seo_description    =   $cat_row[0]["seo_description"];
            $seo_keywords       =   $cat_row[0]["seo_keywords"];
            $cat_name           =   $cat_row[0]["heading"];
            $cat_desc           =   $cat_row[0]["description"];
            $parent             =   $cat_row[0]["id"];     
        } 
 }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title><?php echo $seo_title;?></title>
    <meta name="description" content="<?php echo $seo_description;?>" />
    <meta name="keywords" content="<?php echo $seo_keywords;?>" />
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li><?= $cat_name ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
   <section class="featured-area-two">
        
        <div class="container">
            <div class="col-md-3">
                <div class="category">
                    <h4>MORE CATEGORY</h4>
                    <div class="category-list">
                        <ul>
                    <?php 
                        $catsQry = $db_handle->RunQuery("SELECT  id,slug,heading FROM `products` WHERE parent = 0 AND id != {$parent} AND status = 'p' LIMIT 0, 10");
                        if($catsQry):
                            foreach($catsQry as $catItem):
                                //get total products
                        $totalPro = $db_handle->numRows("SELECT COUNT(id) FROM `products` WHERE parent = {$catItem['id']} AND status = 'p'");
                    ?>
                            <li><a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>"><i class="fa fa-angle-double-right"></i><?= $catItem['slug'] ?> <span>(<?= $totalPro ?>)</span></a></li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <!-- <div class="price-slider">
                        <h4>PRICE SLIDER</h4>
                        <aside class="widget shop-filter">
                            <div class="info_widget">
                                <div class="price_filter">
                                    <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 3.57143%; width: 91.0714%;"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 3.57143%;"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 94.6429%;"></span>
                                    </div>
                                    <div class="price_slider_amount">
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price">
                                        <input type="submit" value="Filter">  
                                    </div>
                                </div>
                            </div>							
                        </aside>
                    </div> -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    
                    <div class="col-md-12">
                        <h1><?= $cat_name ?></h1>
                        <p><?= html_entity_decode($cat_desc) ?></p>
                    </div>
                </div>
                
                <div class="row">
                    <?php 
                    $proQrys = $db_handle->RunQuery("SELECT  id,slug,heading,image FROM `products` WHERE parent = {$parent} AND status = 'p' ");
                    if($proQrys):
                        foreach($proQrys as $proItem):

                            $varientRws = $db_handle->RunQuery("SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC");
                            //get first varient
                            $varientFRow = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC LIMIT 0,1");
                ?>
                    <div class="col-md-4">
                        <div class="popular-left">
                            <a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem['slug'] ?>"><img src="<?php echo __WEBROOT__; ?>/images/product/<?= $proItem['image'] ?>" alt="" /></a>
                            <div class="pro-action">
                                <ul>
                                    <li>
                                        <?php if(!empty($varientFRow)): ?>
                                        <a href="javascript:void(0);" onclick="mylocationStorageDatacart(<?= $proItem['id'] ?>,<?= $varientFRow[0]['id'] ?>,'<?= $proItem['image'] ?>','<?= $proItem['heading'] ?>','<?=  __WEBROOT__ ?>')" title="Shopping Cart"><i class="fa fa-cart-plus"></i></a>
                                         <?php else: ?>
                                            <a href="javascript:void(0);" onclick="alert('You can not add this product in cart');" title="Shopping Cart"><i class="fa fa-cart-plus"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if(!empty($varientFRow)): ?>
                                        <a href="javascript:void(0);" onclick="mylocationStorageWish(<?= $proItem['id'] ?>,<?= $varientFRow[0]['id'] ?>,'<?= $proItem['image'] ?>','<?= $proItem['heading'] ?>','<?=  __WEBROOT__ ?>')" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                         <?php else: ?>
                                        <a href="javascript:void(0)" onclick="alert('You can not add this product in wish list');"><i class="fa fa-heart"></i></a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="content">
                                <div class="product-titel">
                                    <a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem['slug'] ?>"><?= $proItem['heading'] ?></a>
                                </div>
                                <div class="product-price">
                                    <span>$<?php echo $varientRws[0]['min_price']; ?> - $<?php echo $varientRws[0]['max_price']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("./includes/footer.php"); ?>
    </body>
    <?php include("./includes/js-meta.php"); ?>
</html>