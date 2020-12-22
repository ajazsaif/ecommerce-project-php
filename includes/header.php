<?php $contactUs = $db_handle->RunQuery("SELECT * FROM `ti_contact_us` WHERE id = 1"); ?>
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <ul class="list-inline">
                        <li><a href="mailto:<?= $contactUs[0]['phone'] ?>"><i class="fa fa-envelope-o"></i> <?= $contactUs[0]['phone'] ?></a></li>
                        <li><a href="mailto:<?= $contactUs[0]['email'] ?>"><i class="fa fa-envelope-o"></i> <?= $contactUs[0]['email'] ?></a></li>
                    </ul>
                </div>
                
                <div class="pull-right">
                    <ul class="list-inline">
                        <?php if(empty($_SESSION['vemail'])) { ?>
                        <li class="user-meta"><a href="<?php echo __WEBROOT__; ?>/login.php">Login / Register</a></li>
                        <?php } if(!empty($_SESSION['vemail'])) { ?>
                        <li class="user-meta">
                            <a href="<?php echo __WEBROOT__; ?>/useradmin/"><?= $_SESSION["vname"] ?></a>
                            <ul>
                                <li><a href="<?php echo __WEBROOT__; ?>/useradmin/">Visit Dashboard</a></li>
                                <li><a href="<?php echo __WEBROOT__; ?>/logout.php">Log Out</a></li>
                            </ul>
                        </li>
                         <?php } ?>
                        <li class="mini-cart">
                            <a class="" href="<?php echo __WEBROOT__; ?>/cart.php">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="id-cart-value">0</span>
                            </a>
                        </li>
                        <li class="mini-cart">
                            <a class="" href="<?php echo __WEBROOT__; ?>/wishlist.php">
                                <i class="fa fa-heart"></i>
                                <span id="id-wish-value">0</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12">
                <div class="logo-area">
                    <a href="<?php echo __WEBROOT__; ?>"><img src="<?php echo __WEBROOT__; ?>/images/logo.png" alt="" /></a>
                </div>
            </div>
            <div class="col-md-10 col-sm-12">
                <div class="mobile-menu-area main-menu">
                    <div class="mobile-area">
                        <div class="mobile-menu">
                            <nav id="mobile-nav">
                                <ul>
                                    <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/about-us">About Us</a></li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/shop.php">Shop</a>
                                        <ul>
                                            <?php 
                                                $catQry = $db_handle->RunQuery("SELECT  id,slug,heading FROM `products` WHERE parent = 0 AND status = 'p'");
                                                if($catQry):
                                                    foreach($catQry as $catItem):
                                            ?>
                                            <li><a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>"><?= $catItem['heading'] ?></a></li>
                                           <?php endforeach; endif; ?>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/terms-and-condition">Terms & Conditions</a></li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/shipping-policy">Shipping Policy</a></li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/payments">Payments</a></li>
                                    <li><a href="<?php echo __WEBROOT__; ?>/contact-us">Contact Us </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>