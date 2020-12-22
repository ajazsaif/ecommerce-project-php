<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Slider</title>
    <?php 
    include("./includes/head-meta.php"); 
    
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `ti_slider` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $image          =   $row[0]["image"];
            $fheading       =   $row[0]["fheading"];
            $sheading       =   $row[0]["sheading"];
            $img_alt        =   $row[0]["img_alt"];
            $img_title      =   $row[0]["img_title"];

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
            
             $fhead           =   $db_handle->escapeString(valid_input($_POST["fheading"]));
             $shead           =   $db_handle->escapeString(valid_input($_POST["sheading"]));
             $img_alt         =   $db_handle->escapeString(valid_input($_POST["img_alt"]));
             $img_title       =   $db_handle->escapeString(valid_input($_POST["img_title"]));

            if(!empty($_FILES['img']['name'])){
                   $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/sliders/','1350','500'); 
                    
                    $fields =   array(
                                        "image"=>$upload_img_name,
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                        "fheading"=>$fhead,
                                        "sheading"=>$shead
                                    );
                if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
                }
                 else{
                    
                    if($db_handle->updateQuery("ti_slider",$fields,"id = '$escape_token'")){
                    unlink("../images/sliders/" . $image);
                    $msg    =   true;
                    LoadFunction("sliders.php");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
                } 
                
            } 
            else{
              $fields =   array(
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                         "fheading"=>$fhead,
                                        "sheading"=>$shead
                                    );
              if($db_handle->updateQuery("ti_slider",$fields,"id = '$escape_token'")){
                $msg    =   true;
                LoadFunction("sliders.php");
                $db_handle->Close();
                unset($db_handle);
              }
              else{
                        $error_msg  =   "Failed ! pls try again";
                    }
            }
                    
                
            }  
            //insert query
            if(isset($_POST["submit"]) && !isset($_GET['token'])){
                $db_handle      =  new DBController();
                 $fhead           =   $db_handle->escapeString(valid_input($_POST["fheading"]));
                   $shead            =   $db_handle->escapeString(valid_input($_POST["sheading"]));
                   $img_alt          =   $db_handle->escapeString(valid_input($_POST["img_alt"]));
                   $img_title        =   $db_handle->escapeString(valid_input($_POST["img_title"]));
                if(!empty($_FILES['img']['name'])){
                $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/sliders/','1350','500'); 
                    
                    
                   $fields =   array(
                                        "image"=>$upload_img_name,
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                         "fheading"=>$fhead,
                                        "sheading"=>$shead
                                    );
                if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
                }
                else{
                    
                    if($db_handle->insertQuery("ti_slider",$fields)){
                    $msg    =   true;
                    LoadFunction("sliders.php");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
                } 
                
            } 
            else{
               $error_msg = "Please Upload Image!";
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
        Slider Edit
          <?php } else { ?>
           Slider Add
          <?php } ?>
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo __WEBROOT__?>/sliders.php"><i class="fa fa-sliders"></i> Slider</a></li>
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
                   <!-- <div class="form-group">
                <label>First Heading:</label>

                <div>
                  <input type="text" class="form-control" name="fheading" value="<?php echo $fheading;?>">
                  
                </div>
               
              </div>

               <div class="form-group">
                <label>Second Heading:</label>

                <div>
                  <input type="text" class="form-control" name="sheading" value="<?php echo $sheading;?>">
                  
                </div>
                
              </div> -->

                  <div class="form-group">
                <label>Image alt:</label>

                <div>
                  <input type="text" class="form-control" name="img_alt" value="<?php echo $img_alt;?>">
                  
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Image Title:</label>

                <div>
                  <input type="text" class="form-control" name="img_title" value="<?php echo $img_title;?>">
                  
                </div>
                <!-- /.input group -->
              </div>

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
                     
                    ?> src="../images/sliders/<?php echo $image;?>"  height="250" width="350" <?php } ?>>
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
