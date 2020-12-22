<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Change Password</title>
    <?php 
    include("./includes/head-meta.php"); 
    $session_id = $_SESSION["admin-email"];
    
    
        if(isset($_POST['submit'])){
            $db_handle      =  new DBController();
            $old_pass       =  $db_handle->escapeString(valid_input($_POST['old_pass']));
            $new_pass       =  $db_handle->escapeString(valid_input($_POST['new_pass']));
            $re_pass        =  $db_handle->escapeString(valid_input($_POST['re_pass']));
            $hashing_pass   =  password_hash($new_pass, PASSWORD_BCRYPT);

            //old password check
            $check_old_pass = "SELECT * FROM `admin_user` WHERE username = '$session_id' ";
            $row_count      = $db_handle->RunQuery($check_old_pass);
            $old_pass_db    = $row_count[0]['pass'];
            //change password script
            if(empty($old_pass) || empty($new_pass) || empty($re_pass)){
                $err_msg = "Please filled all fields !";
            }
            elseif(!password_verify($old_pass, $old_pass_db)){
                $err_msg = "Old password does not match !";
            }
            elseif($re_pass!=$new_pass){
                $err_msg = "new password and confirm pass does not macth !";
            }
            else{
                $session_id = $_SESSION["admin-email"];
                $fields  = array("pass"=>$hashing_pass);
                if($db_handle->updateQuery("admin_user",$fields,"username ='$session_id'")){
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
        <div class="col-md-12">

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
                  
                  <input type="password" class="form-control" name="old_pass">
                </div>
                <!-- /.input group -->
              </div>
                
                <div class="form-group">
                <label>New Password:</label>

                <div>
                  
                  <input type="password" class="form-control" name="new_pass" >
                </div>
                <!-- /.input group -->
              </div>
                <div class="form-group">
                <label>Confirm Password:</label>

                <div>
                  
                  <input type="password" class="form-control" name="re_pass" >
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
