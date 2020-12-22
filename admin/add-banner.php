<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Banner</title>
    <?php 
    include("./includes/head-meta.php"); 
    
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `banner` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $image          =   $row[0]["image"];
            $type           =   $row[0]["type"];

        }
        else{
           // LoadFunction("404.php");
        }
    }
    else{
         //LoadFunction("404.php");
    }
   
   //edit data operation 
if(isset($_POST["submit"]) && isset($_GET['token'])){
        $db_handle      =  new DBController();
            
        if(!empty($_FILES['img']['name'])){

              $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/banner/','338','184');

                    $fields =   array("image"=>$upload_img_name);
                    if($upload_img_name == false){
                        $error_msg  =   "Image Upload Failed try again !";
                    }
                    else{
                      
                        if($db_handle->updateQuery("banner",$fields,"id = '$escape_token'")){
                        unlink("../images/banner/" . $image);
                        $msg    =   true;
                        LoadFunction("banner.php");
                        $db_handle->Close();
                        unset($db_handle);
                        }
                        else{
                            $error_msg  =   "Failed !";
                        }
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
        <?php 
          if(isset($_GET['token'])){
          ?>
        Banner Edit
          <?php } else { ?>
           Slider Add
          <?php } ?>
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo __WEBROOT__?>/sliders.php"><i class="fa fa-sliders"></i> Banner</a></li>
           <li><?php echo ucfirst($name);?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger" style="float:left;">
            <div class="box-header">
                <?php 
          if(isset($_GET['token'])){
          ?>
              <h3 class="box-title">Slider Edit Details</h3>
                <?php } else { ?>
                 <h3 class="box-title">Slider Add Details</h3>
                <?php } ?>
                
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
                  <div class="col-md-6">
                    <div class="box-body">
                      <div class="form-group">
                    <label>Image:</label>

                    <div>

                      <input type="file" name="img" id="parallax">
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
                  </div>
                  <div class="col-md-6"> 
                    <img id="blah" <?php 
                      if(isset($_GET['token'])){
                     
                    ?> src="../images/banner/<?php echo $image;?>"  height="250" width="350" <?php } ?>>
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
