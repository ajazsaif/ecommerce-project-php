<?php $file = basename($_SERVER['PHP_SELF']);   ?>

<header class="main-header">
    <a href="index.php" class="logo">
        <span class="logo-mini">SP</span>
        <span class="logo-lg"><?php echo $page_title;?></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="<?php echo __WEBROOT__;?>/">
                        <i class="fa fa-chrome"></i>
                        <span class="label label-success">Visit Site</span>
                    </a>
                </li>
                
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                         <?php 
                            if(empty($user_details[0]['img'])){
                           
                            ?>
                        <img src="<?php echo __WEBROOT__;?>/useradmin/images/img.png" class="user-image" alt="User Image">
                        <?php } else { ?>
                         <img src="<?php echo __WEBROOT__;?>/useradmin/images/profile/<?php echo $user_details[0]['img'];?>" class="user-image" alt="User Image">
                        <?php } ?>
                        <span class="hidden-xs"><?php echo ucfirst($user_details[0]['name']); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <?php 
                            if(empty($user_details[0]['img'])){
                           
                            ?>
                             <img src="<?php echo __WEBROOT__;?>/useradmin/images/img.png" class="user-image" alt="User Image">
                        <?php } else { ?>
                            <img src="<?php echo __WEBROOT__;?>/useradmin/images/profile/<?php echo $user_details[0]['img']; ?>" class="img-circle" alt="User Image">
                            <?php } ?>
                           
                        </li>
                        
                        <li class="user-footer">
                            <div class="pull-left"><a href="<?php echo __WEBROOT__;?>/useradmin/profile.php" class="btn btn-default btn-flat">Profile</a></div>
                            <div class="pull-right"><a href="<?php echo __WEBROOT__;?>/logout.php" class="btn btn-default btn-flat">Sign out</a></div>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
          </div>
        </nav>
    </header>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <?php 
                    if(empty($user_details[0]['img'])){

                    ?>
                <img src="<?php echo __WEBROOT__;?>/useradmin/images/img.png" class="img-circle" alt="User Image">
                <?php } else { ?>
                 <img src="<?php echo __WEBROOT__;?>/useradmin/images/profile/<?php echo $user_details[0]['img']; ?>" class="img-circle" alt="User Image">
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?php echo ucfirst($user_details[0]['name']); ?></p>
<!--                <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>
<!--
        <form action="" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
-->
        <ul class="sidebar-menu" data-widget="tree">
<!--            <li class="header">MAIN NAVIGATION</li>-->
            <li <?php if($file=='index.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__;?>/useradmin/">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li <?php if($file=='profile.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__;?>/useradmin/profile.php">
                    <i class="fa fa-edit"></i> <span>Edit Profile</span>
                </a>
            </li>
            <li <?php if($file=='history.php' || $file=='order-detail.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__;?>/useradmin/history.php">
                    <i class="fa fa-shopping-cart"></i> <span>Order List</span>
                </a>
            </li>
            <li <?php if($file=='pass.php') { ?>class="active" <?php } else { ?>class="" <?php } ?>>
                <a href="<?php echo __WEBROOT__;?>/useradmin/pass.php">
                    <i class="fa fa-key"></i> <span>Change Password</span>
                </a>
            </li>
            <li>
                <a href="<?php echo __WEBROOT__;?>/logout.php">
                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                </a>
            </li>
      </ul>
    </section>
  </aside>