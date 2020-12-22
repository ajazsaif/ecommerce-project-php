<?php 
$page = 'Cat';
include("./includes/top.php");
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title>Home</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li>Payment Options</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
   <section class="featured-area-two">
        <div class="area-titel">
            <h1>All Products</h1>
        </div>
        <div class="container">
            <div class="section-margin">
                <div class="row">
                    <?php 
                    $proQrys = $db_handle->RunQuery("SELECT id,slug,heading,image FROM `products` WHERE parent != 0 AND status = 'p' ");
                    if($proQrys):
                        foreach($proQrys as $proItem):

                            $varientRws = $db_handle->RunQuery("SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC");
                            //get first varient
    
                            $varientFRow = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC LIMIT 0,1");
                ?>
                    <div class="col-md-3">
                        <div class="popular-left">
                            <a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem['slug'] ?>">
                                <img src="<?php echo __WEBROOT__; ?>/images/product/<?= $proItem['image'] ?>" alt="" /></a>
                            <div class="pro-action">
                                <ul>
                                    <li>
                                        <?php if(!empty($varientFRow)): ?>
                                        <a href="javascript:void(0);" onclick="mylocationStorageDatacart(<?= $proItem['id'] ?>,<?= $varientFRow[0]['id'] ?>,'<?= $proItem['image'] ?>','<?= $proItem['heading'] ?>','<?=  __WEBROOT__ ?>')" title="Shopping Cart"><i class="fa fa-cart-plus"></i></a>
                                        <?php else: ?>
                                    <a href="javascript:void(0);" onclick="alert('You can not add this product in cart');"><i class="fa fa-cart-plus"></i></a>
                                <?php endif; ?>
                                    </li>
                                    <li>
                                         <?php if(!empty($varientFRow)): ?>
                                        <a href="javascript:void(0);" onclick="mylocationStorageWish(<?= $proItem['id'] ?>,<?= $varientFRow[0]['id'] ?>,'<?= $proItem['image'] ?>','<?= $proItem['heading'] ?>','<?=  __WEBROOT__ ?>')" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <?php else: ?>
                                            <a href="javascript:void(0);" onclick="alert('You can not add this product in wish list');" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
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