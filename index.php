<?php
$page = 'Home';
include("./includes/top.php");
$about_us   =   "select * from `home`";
        if($db_handle->numRows($about_us)>0){
            $about_row         =   $db_handle->RunQuery($about_us);
            $seo_title         =   $about_row[0]["seo_title"];
            $seo_keywords      =   $about_row[0]["seo_keywords"];
            $seo_description   =   $about_row[0]["seo_description"];
     }
    $slider_query =   "select * from `ti_slider` order by id desc";
    if($db_handle->numRows($slider_query)>0){
        $rows  =  $db_handle->RunQuery($slider_query);
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
     <title><?php echo $seo_title;?></title>
    <meta name="description" content="<?php echo $seo_description;?>" />
    <meta name="keywords" content="<?php echo $seo_keywords;?>" />
    <meta name="author" content="" />
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="MainSlider owl-carousel">
        <?php for($i = 0;$i<count($rows);$i++){ ?>
        <div><img src="<?php echo __WEBROOT__; ?>/images/sliders/<?php echo $rows[$i]['image']; ?>" alt="<?php echo $rows[$i]['img_alt']; ?>" title="<?php echo $rows[$i]['img_title']; ?>" /></div>
        <?php } ?>
    </section>
    
    <section class="popular-collection-area">
        <div class="area-titel">
            <h2>POPULAR CATEGORIES</h2>
        </div>
        <div class="container">
            <div class="section-margin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ProductSlider owl-carousel">
                            <?php 
                                $catQry = $db_handle->RunQuery("SELECT  id,slug,heading,image FROM `products` WHERE parent = 0 AND status = 'p'");
                                if($catQry):
                                    foreach($catQry as $catItem):
                            ?>
                            <div class="popular-left">
                                <a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>"><img src="<?php echo __WEBROOT__; ?>/images/product/<?= $catItem['image'] ?>" alt="" /></a>
                                <div class="pro-action">
                                    <ul>
                                        <li><a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>" title="Shopping Cart"><i class="fa fa-info"></i></a></li>
                                    </ul>
                                </div>
                                <div class="content">
                                    <div class="product-titel">
                                        <a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>"><?= $catItem['heading'] ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="featured-area-two">
        <div class="area-titel">
            <h2>FEATURED PRODUCTS</h2>
        </div>
        <div class="container">
            <div class="section-margin">
                <div class="row">
                    <?php 
                        $proQry = $db_handle->RunQuery("SELECT  id,slug,heading,image FROM `products` WHERE parent != 0 AND status = 'p'");
                        if($proQry):
                            foreach($proQry as $proItem):

                                $varientRws = $db_handle->RunQuery("SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC");
                            //get first varient
    
                            $varientFRow = $db_handle->RunQuery("SELECT id,size,price FROM `ti_attributes` WHERE parent = {$proItem['id']} ORDER BY id ASC LIMIT 0,1");
                    ?>
                    <div class="col-md-3">
                        <div class="popular-left">
                            <a href="<?php echo __WEBROOT__; ?>/products/<?= $proItem['slug'] ?>">
                                <img src="<?php echo __WEBROOT__; ?>//images/product/<?= $proItem['image'] ?>" alt="" /></a>
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
    
    <section class="latestblog-area-two">
        <div class="area-titel">
            <h2>OVERVIEW</h2>
        </div>
        <div class="container">
            <div class="section-margin">
                <div class="row">
                    <div class="col-md-6 col-sm-6 p0">
                        <div class="latestblog-single">
                            <a href="javascript:void(0);" class="blog-img">
                            <img src="<?php echo __WEBROOT__; ?>/images/about.jpg" alt="" title="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 p0">
                        <div class="latestblog-single">
                            <div class="latestblog-content">
                                <div class="blog-post-title">
                                    <h3>What We Do</h3>
                                </div>
                                <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 p0">
                        <div class="latestblog-content">
                            <div class="blog-post-title">
                                <h3>Why Choose Us</h3>
                            </div>
                            <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                        </div>
                    </div>
                    <div class="col-md-6 p0">
                        <div class="latestblog-single">
                            <a class="blog-img" href="#">
                                <img src="<?php echo __WEBROOT__; ?>/images/about.jpg" alt="" title="" />
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="our-client-area">
        <div class="container">
            <div class="col-md-12">
                <div class="area-titel">
                    <h2>OUR CLIENT</h2>
                </div>
                <div class="row">
                    <div class="PaymentSlider owl-carousel">
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/bank-transfer.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/bitcoins.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/cashapp.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/moneygram.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/paypal.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/venmo.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/western-union.jpg" alt="" /></div>
                        <div><img src="<?php echo __WEBROOT__; ?>/images/payment/zelle.jpg" alt="" /></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("./includes/footer.php"); ?>

    
</body>
    <?php include("./includes/js-meta.php"); ?>
</html>