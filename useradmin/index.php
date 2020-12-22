<?php 
include_once('../includes/top.php');
if(empty($_SESSION['vemail']) || ($_SESSION['plogin'] != 'true')){
    redirect_page_url(__WEBROOT__.'/register.php');
}
if(isset($_SESSION['vemail']) && ($_SESSION['vrole'] == 'user')){
    $user_query     = "SELECT * FROM `users` WHERE email = '".$_SESSION['vemail']."'";
    $db_handle      =  new DBController();
    if($db_handle->numRows($user_query)>0){
      $user_details = $db_handle->RunQuery($user_query);    
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($user_details[0]['name']); ?> | Home</title>
    <?php 
    define('nashahead',TRUE);
    include("./includes/head-meta.php"); 
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <?php 
                            if(empty($user_details[0]['img'])){
                           
                            ?>
                          <img alt="User profile picture" src="<?php echo __WEBROOT__;?>/useradmin/images/img.png" class="profile-user-img img-responsive img-circle">
                            <?php } else { ?>
                             <img alt="User profile picture" src="<?php echo __WEBROOT__;?>/useradmin/images/profile/<?php echo $user_details[0]['img'];?>" class="profile-user-img img-responsive img-circle">
                            <?php }  ?>
                            <h3 class="profile-username text-center"><?php echo ucfirst($user_details[0]['name']); ?></h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                  <b>Name</b> <a class="pull-right"><?php echo ucfirst($user_details[0]['name']); ?></a>
                                </li>
                                <li class="list-group-item">
                                  <b>Email</b> <a class="pull-right"><?php echo $user_details[0]['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                  <b>Phone</b> <a class="pull-right"><?php echo $user_details[0]['phone']; ?></a>
                                </li>
                                <li class="list-group-item">
                                  <b>User Id</b> <a class="pull-right"><?php echo $user_details[0]['user_id']; ?></a>
                                </li>
                            </ul>
                          <a class="btn btn-primary btn-block" href="<?php echo __WEBROOT__;?>/useradmin/profile.php"><b>Edit Profile</b></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
            </div>
        </section>
      </div>
</div>
<?php include("./includes/js-meta.php"); ?>
    <script src="<?php echo __WEBROOT__; ?>/useradmin/js/dashboard2.js"></script>
</body>
</html>
<?php } 
else {  
redirect_page_url(__WEBROOT__.'/index.php');
}
?>

