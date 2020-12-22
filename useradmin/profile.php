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
    //if user update any profile data
    if(isset($_POST['submit'])){
        $user_name   =   $db_handle->escapeString(valid_input($_POST["name"]));
        $user_phone  =   $db_handle->escapeString(valid_input($_POST["phone"]));
        $date        =   CurrentDate();
        if(empty($_FILES["img"]['name'])){
            $fields  =  array(
                                'name'=>$user_name,
                                'phone'=>$user_phone,
                                'modify_date'=>$date
                            );
            if($db_handle->updateQuery("users",$fields,"email = '".$_SESSION['vemail']."'")){
                $msg    =   true;
                LoadFunction("profile.php");
            }
            else{
                $error_msg  =   "Failed ! Pls try again ";
            }  
        }
        else{
            $upload_img_name = cwUpload('img','images/','',TRUE,'images/profile/','250','250');
            $fields  =  array(
                                'name'=>$user_name,
                                'phone'=>$user_phone,
                                'modify_date'=>$date,
                                'img'=>$upload_img_name
                            );
            if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
            }
            else{
                if($db_handle->updateQuery("users",$fields,"email = '".$_SESSION['vemail']."'")){
                    $msg    =   true;
                    LoadFunction("profile.php");
            }
            else{
                    $error_msg  =   "Failed ! Pls try again ";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($user_details[0]['name']); ?> | Profile</title>
    <?php 
    define('nashahead',TRUE);
    include("./includes/head-meta.php"); 
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include("./includes/header.php"); ?>
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Profile
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/useradmin/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> Edit Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Edit Profile</h3>
                
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
                elseif(isset($error_msg)){
                    echo "<div class='alert alert-danger'style='width:300px;margin:0auto;margin-bottom:10px;background-color: red;color: white;'>
                      <strong>Info!</strong> $error_msg.
                    </div>"; 
                }  ?>
            </div>
              <form action="<?php echo htmlspecialchars('');?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              
              
              <!-- /.form group -->

              <!-- phone mask -->
                <div class="form-group has-success">
                <label>Name:</label>

                <div>
                  <input type="text" class="form-control" name="name" value="<?php echo $user_details[0]['name'];?>" placeholder="Enter Name">
                  
                </div>
                <!-- /.input group -->
              </div>
                <div class="form-group has-success">
                <label>Email:</label>

                <div>
                  <input type="email" class="form-control" value="<?php echo $user_details[0]['email'];?>" readonly>
                  
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group has-success">
                <label>Phone:</label>

                <div>
                  <input type="text" class="form-control" name="phone" value="<?php echo $user_details[0]['phone'];?>" placeholder="Enter Phone Number">
                 
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              
              <!-- /.form group -->

              <!-- IP mask -->
            
              <!-- /.form group -->
            <div class="form-group">
                <label>Upload Profile Image:</label>
                <input type="file" name="img" id="parallax">

                <div><br><br>
                 <div>
                     <?php 
                        if(!empty($user_details[0]['img'])){
                           
                        ?>
                     <img src="<?php echo __WEBROOT__;?>/useradmin/images/profile/<?php echo $user_details[0]['img']; ?>" alt="<?php echo $user_details[0]['img']; ?>" title="<?php echo $user_details[0]['name']; ?>" style="width:100px;height:100px;" id="blah">
                     <?php }  ?>
                    
                </div><br><br>
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
<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#parallax").change(function(){
    readURL(this);
});</script>    

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
