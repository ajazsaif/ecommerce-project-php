<?php $file = basename($_SERVER['PHP_SELF']);   ?>

<header class="main-header">
    <a href="../index.php" target="_blank" class="logo">
        <span class="logo-mini"><b>S</b>P</span>
        <span class="logo-lg"><b><?php echo $page_title;?></b> Admin</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo __WEBROOT__;?>/images/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $page_title;?> Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo __WEBROOT__;?>/images/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>Admin</p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left"><a href="<?php echo __WEBROOT__; ?>/pass.php" class="btn btn-default btn-flat">Change Password</a></div>
                            <div class="pull-right"><a href="<?php echo __WEBROOT__; ?>/logout.php" class="btn btn-default btn-flat">Sign out</a></div>
                        </li>
                    </ul>
                </li>
            </ul>
          </div>
        </nav>
    </header>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
<!--            <li class="header">MAIN NAVIGATION</li>-->
            <li <?php if($file=='index.php') { ?>class="active" <?php }?>>
                <a href="<?php echo __WEBROOT__; ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li <?php if($file=='order-list.php' || $file=='order-detail.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/order-list.php">
                    <i class=" fa fa-shopping-cart"></i> <span>Manage Orders</span>
                </a>
            </li>
            <li <?php if($file=='userlist.php' || $file=='user_view.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/userlist.php">
                    <i class="fa fa-users"></i> <span>Registered Users </span>
                   
                </a>
            </li>
            <li <?php if($file=='manage_category.php' || $file=='category_edit.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/manage_category.php">
                    <i class="fa fa-shopping-bag"></i> <span>Manage Categories</span>   
                </a>
            </li>
              <li <?php if($file=='product_category.php' || $file=='product_list.php' || $file=='product_edit.php' || $file == 'size.php' || $file == 'add-size.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/product_category.php">
                    <i class="fa fa-shopping-bag"></i> <span>Products</span>   
                </a>
            </li>

            <!-- <li <?php if($file=='promo.php' ||$file == 'add-promo.php') { ?>class="active treeview" <?php } else { ?>class="treeview" <?php } ?>>
               <a href="javascript:void(0);">
                    <i class="fa fa-money"></i> <span>Manage Coupon Codes</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo __WEBROOT__; ?>/promo.php" <?php if($file=='promo.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i>Coupon Codes</a></li>
                    <li><a href="<?php echo __WEBROOT__; ?>/add-promo.php" <?php if($file=='add-promo') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Add Promo</a></li>
                </ul>
            </li> -->

            <li <?php if($file=='all-reviews.php' || $file == 'add-review.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/all-reviews.php">
                    <?php 
                        //get unread reviews
                        $db_handle2    =  new DBController();
                        $rating_unread = "select id from `ti_pro_review` where read_status = 0";
                        $rating_rows   =   $db_handle2->numRows($rating_unread);
                    ?>
                    <i class="fa fa-star"></i> <span>Reviews (<?php echo @$rating_rows; ?>)</span>
                   
                </a>
            </li>
         
             <li <?php if($file=='sliders.php' ||$file == 'add-slider.php') { ?>class="active treeview" <?php } else { ?>class="treeview" <?php } ?>>
               <a href="javascript:void(0);">
                    <i class="fa fa-sliders"></i> <span>Banners</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo __WEBROOT__; ?>/sliders.php" <?php if($file=='sliders.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Banner List</a></li>
                    <li><a href="<?php echo __WEBROOT__; ?>/add-slider.php" <?php if($file=='add-slider.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Add Banner</a></li>
                </ul>
            </li>

            <!-- <li <?php if($file=='banner.php' || $file=='add-banner.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/banner.php">
                    <i class="fa fa-star"></i> <span>Short Banner</span>   
                </a>
            </li> -->

           <!-- <li <?php if($file=='portfolio.php' ||$file == 'add-port.php') { ?>class="active treeview" <?php } else { ?>class="treeview" <?php } ?>>
               <a href="javascript:void(0);">
                    <i class="fa fa-quote-left"></i> <span>Faqs</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo __WEBROOT__; ?>/portfolio.php" <?php if($file=='portfolio.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Faqs List</a></li>
                    <li><a href="<?php echo __WEBROOT__; ?>/add-port.php" <?php if($file=='add-port.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Add Faq</a></li>
                </ul>
            </li> -->

            <!-- <li <?php if($file=='blog.php' ||$file == 'add-blog.php') { ?>class="active treeview" <?php } else { ?>class="treeview" <?php } ?>>
               <a href="javascript:void(0);">
                    <i class="fa fa-newspaper-o"></i> <span>Blog</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo __WEBROOT__; ?>/blog.php" <?php if($file=='blog.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Blog List</a></li>
                    <li><a href="<?php echo __WEBROOT__; ?>/add-blog.php" <?php if($file=='add-blog.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Add Blog</a></li>
                </ul>
            </li> -->
            
            <!-- <li <?php if($file=='track-list.php' ||$file == 'track.php' || $file == 'trackseo.php' || $file == 'track-history.php' || $file  == 'add-history.php' || $file == 'tracking-history.php') { ?>class="active treeview" <?php } else { ?>class="treeview" <?php } ?>>
               <a href="javascript:void(0);">
                    <i class="fa fa-map-marker"></i> <span>Tracking Details</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo __WEBROOT__; ?>/track-list.php" <?php if($file=='track-list.php' || $file == 'tracking-history.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Tracking List</a></li>
                    <li><a href="<?php echo __WEBROOT__; ?>/track.php" <?php if($file=='track.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Add Tracking Details</a></li>
                     <li><a href="<?php echo __WEBROOT__; ?>/trackseo.php" <?php if($file=='trackseo.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Page Seo</a></li>
                </ul>
            </li> -->

            <li <?php if($file=='analytics.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/analytics.php">
                    <i class="fa fa-flag"></i> <span>Analytics Code</span>   
                </a>
            </li>

            <li <?php if($file=='chat_code.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/chat_code.php">
                    <i class="fa fa-tags"></i> <span>Chat Script</span>   
                </a>
            </li>

           <!--  <li <?php if($file=='payment_option.php' || $file=='payment_edit.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/payment_option.php">
                    <i class="fa fa-btc"></i> <span>Payment Option</span>   
                </a>
            </li> -->
            <li <?php if($file=='payment_option.php' || $file=='payment_edit.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/payment_option.php">
                    <i class="fa fa-btc"></i> <span>Payment Option</span>   
                </a>
            </li>
           
            <li <?php if($file=='about.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/about.php">
                    <i class="fa fa-info-circle"></i> <span>About Us</span>
                   
                </a>
            </li>
            <li <?php if($file=='howtoorder.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/howtoorder.php">
                    <i class="fa fa-check"></i> <span>Shipping Policy</span>   
                </a>
            </li>
              <li <?php if($file=='privacy.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/privacy.php">
                    <i class="fa fa-flag"></i> <span>Payment Option Page</span>   
                </a>
            </li>
             <li <?php if($file=='shipping.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/shipping.php">
                    <i class="fa fa-shopping-bag"></i> <span>Terms & Condition Page</span>   
                </a>
            </li>
            <li <?php if($file=='terms.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/terms.php">
                    <i class="fa fa-check"></i> <span>Privacy Policy</span>   
                </a>
            </li>

           

            <li <?php if($file=='contact.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/contact.php">
                    <i class="fa fa-phone"></i> <span>Contact Us</span>
                   
                </a>
            </li>

            <li <?php if($file=='social.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/social.php">
                    <i class="fa fa-facebook"></i> <span>Social Media</span>    
                </a>
            </li>
            
             <li <?php if($file=='home.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/home.php">
                    <i class="fa fa-home"></i> <span>Home Page Seo </span>
                   
                </a>
            </li>

             <li <?php if($file=='testi.php' ||$file == 'add-testi.php') { ?>class="active treeview" <?php } else { ?>class="treeview" <?php } ?>>
               <a href="javascript:void(0);">
                    <i class="fa fa-quote-left"></i> <span>Testimonial</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo __WEBROOT__; ?>/testi.php" <?php if($file=='testi.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Testimonial</a></li>
                    <li><a href="<?php echo __WEBROOT__; ?>/add-testi.php" <?php if($file=='add-testi.php') { ?>style="color:white;" <?php } else { ?> <?php } ?>><i class="fa fa-circle-o"></i> Add Testimonial</a></li>
                </ul>
            </li>

            <!-- <li <?php if($file=='subscriber.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/subscriber.php">
                    <i class="fa fa-newspaper-o"></i> <span>Subscribers</span>
                   
                </a>
            </li> -->

            <li <?php if($file=='enquiry.php' || $file=='enquiry_view.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/enquiry.php">
                    <i class="fa fa-envelope-o"></i> <span>Contact Enquiry </span>
                   
                </a>
            </li>
            <li <?php if($file=='pass.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/pass.php">
                    <i class="fa fa-key"></i> <span>Change Password</span>
                   
                </a>
            </li>
            <li <?php if($file=='logout.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__; ?>/logout.php">
                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                   
                </a>
            </li>
      </ul>
    </section>
  </aside>