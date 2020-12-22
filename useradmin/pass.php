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
    <title><?php echo $page_title;?> | Change-Password</title>
    <?php 
    define('nashahead',TRUE);
    include("./includes/head-meta.php"); 
    $session_id = $_SESSION["vid"];
    
    
        if(isset($_POST['submit'])){
            $db_handle      =  new DBController();
            $old_pass       =  $db_handle->escapeString(valid_input($_POST['old_pass']));
            $new_pass       =  $db_handle->escapeString(valid_input($_POST['new_pass']));
            $re_pass        =  $db_handle->escapeString(valid_input($_POST['re_pass']));
            $old_password =  secure_password($old_pass);
            $new_password =  secure_password($new_pass);
            //old password check
            $check_old_pass = "SELECT * FROM `users` WHERE pass = '$old_password' AND id = '$session_id' ";
            $row_count = $db_handle->numRows($check_old_pass);
            //change password script
            if(empty($old_pass) || empty($new_pass) || empty($re_pass)){
                $err_msg = "Please filled all fields !";
            }
            elseif($row_count == 0){
                $err_msg = "Old password does not match !";
            }
            elseif($re_pass!=$new_pass){
                $err_msg = "new password and confirm pass does not macth !";
            }
            else{
                $session_id = $_SESSION["vid"];
                $fields  = array("pass"=>$new_password);
                if($db_handle->updateQuery("users",$fields,"id ='$session_id'")){
                    $msg    =   "Password sucesssfully changed";
                    LoadFunction("pass.php");
                    $db_handle->Close();
                    unset($db_handle);
                }
            }
        }


    
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include("./includes/header.php"); ?>
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password 
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Change Password Details</h3>
                
                <?php 
                    if(isset($msg)){
                        echo "<div class='loading_block'>
                                <div class='loading_block2'>
                                    <div class='loding-center'>
                                    <i class='fa fa-spinner fa-pulse fa-3x fa-fw loading_img'></i>
                                    
                                    </div>
                                </div>
                             </div>";
                      echo "<div class='alert alert-success'style='width:300px;margin:0auto;margin-bottom:10px;background-color: red;color: white;'>
                        <strong>Info!</strong> Your password has been changed.
                      </div>";
                    }
                elseif(isset($err_msg)){
                    echo "<div class='alert alert-danger'style='width:300px;margin:0auto;margin-bottom:10px;background-color: red;color: white;'>
                      <strong>Info!</strong> $err_msg.
                    </div>"; 
                }  ?>
            </div>
              <form action="<?php echo htmlspecialchars('');?>" method="post">
            <div class="box-body">
              
              <div class="form-group">
                <label>Old Password:</label>

                <div>
                  
                  <input type="password" class="form-control" name="old_pass" required="">
                </div>
                <!-- /.input group -->
              </div>
                
                <div class="form-group">
                <label>New Password:</label>

                <div>
                  
                  <input type="password" class="form-control" name="new_pass" required="">
                </div>
                <!-- /.input group -->
              </div>
                <div class="form-group">
                <label>Confirm Password:</label>

                <div>
                  
                  <input type="password" class="form-control" name="re_pass" required="">
                </div>
                <!-- /.input group -->
              </div>
              
             
             
              <!-- /.form group -->
            <div class="form-group">
                

                <div>
                 
                <input type="submit" name="submit" value="UPDATE" class="btn btn-primary">
                </div>
                <!-- /.input group -->
              </div>
            </div>
                  </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
       
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
    </div>
    
<?php include("./includes/js-meta.php"); ?>
    

</body>
</html>
<?php 
$db_handle->close();
unset($db_handle);
} 
else {  
redirect_page_url(__WEBROOT__.'/index.php');
}
?>
