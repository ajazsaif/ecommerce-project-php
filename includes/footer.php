<footer class="footer-main-area">
    
    <div class="footer-middle-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="contact-titel">
                        <p>CONTACT INFO</p>
                    </div>
                    <div class="contact-details">
                        <ul>
                            <li><i class="fa fa-map-marker"></i> <?= $contactUs[0]['main_office'] ?></li>
                            <li><a href="tel:<?= $contactUs[0]['phone'] ?>"><i class="fa fa-phone"></i><?= $contactUs[0]['phone'] ?></a></li>
                            <li><a href="mailto:<?= $contactUs[0]['email'] ?>"><i class="fa fa-envelope-o"></i><?= $contactUs[0]['email'] ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 hidden-sm">
                    <div class="contact-titel">
                        <p>Quick Links</p>
                    </div>
                    <div class="contact-details-middle">
                        <ul>
                            <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/about-us">About Us</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/shop.php">Shop</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/privacy-policy">Privacy Policy</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/terms-and-condition">Terms & Conditions</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/shipping-policy">Shipping Policy</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/payments">Payments</a></li>
                            <li><a href="<?php echo __WEBROOT__; ?>/contact-us">Contact Us </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-12 hidden-xs">
                    <div class="contact-titel">
                        <p>Categories</p>
                    </div>
                    <div class="contact-details-middle">
                        <ul>
                            <?php 
                                $catQry = $db_handle->RunQuery("SELECT  id,slug,heading FROM `products` WHERE parent = 0 AND status = 'p'");
                                if($catQry):
                                    foreach($catQry as $catItem):
                            ?>
                            <li><a href="<?php echo __WEBROOT__; ?>/category/<?= $catItem['slug'] ?>"><?= $catItem['heading'] ?></a></li>
                           <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 hidden-sm hidden-xs">
                    <div class="contact-titel">
                        <p>Latest Products</p>
                    </div>
                    <div class="contact-details-middle">
                        <ul>
                            <?php 
                                $catQry = $db_handle->RunQuery("SELECT  id,slug,heading FROM `products` WHERE parent != 0 AND status = 'p'");
                                if($catQry):
                                    foreach($catQry as $catItem):
                            ?>
                            <li><a href="<?php echo __WEBROOT__; ?>/products/<?= $catItem['slug'] ?>"><?= $catItem['heading'] ?></a></li>
                           <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="contact-titel">
                        <p>OPENING TIME</p>
                    </div>
                    <div class="contact-details-middle">
                        <ul>
                            <li> Monday - Friday<span>8:00 - 20:00</span></li>
                            <li> Saturday<span>90:00 - 21:00</span></li>
                            <li> Sunday<span>13:00 - 22:00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer-bottom-titel">
                        <p>Copyright &copy; 2020  Company Name. | All Right Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>