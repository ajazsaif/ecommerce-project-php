<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | About</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    
    $db_handle          =  new DBController();
   
    //run query 
    $cat_info_query     =   "select * from `ti_about_us` where 1=1";
    if($db_handle->numRows($cat_info_query)>0){
        $row    =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $heading        =   $row[0]["heading"];
        $image          =   $row[0]["image"];
        $description    =   $row[0]["description"];
        $seo_desc       =   $row[0]["seo_description"];
        $seo_title      =   $row[0]["seo_title"];
        $seo_keywords   =   $row[0]["seo_keywords"];
        
    }
    
    if(isset($_POST['submit'])){
       
    $db_handle              =  new DBController();
    $edit_heading           =  $db_handle->escapeString(valid_input($_POST["heading"]));
    $edit_desc              =  $db_handle->escapeString(valid_input($_POST["description"]));
    $edit_seo_title         =  $db_handle->escapeString(valid_input($_POST["seo_title"]));
    $edit_seo_description   =  $db_handle->escapeString(valid_input($_POST["seo_description"]));
    $edit_seo_keywords      =  $db_handle->escapeString(valid_input($_POST["seo_keywords"]));

    if(!empty($_FILES['img']['name'])){
    $upload_img_name    = cwUpload('img','../','',TRUE,'../images/','400','270'); 
    $fields = array("image"=>$upload_img_name,
                     "heading"=>$edit_heading,
                     "description"=>$edit_desc,
                     "seo_description"=>$edit_seo_description,
                     "seo_keywords"=>$edit_seo_keywords,
                     "seo_title"=>$edit_seo_title);
     }else{ 
      $fields = array("heading"=>$edit_heading,
                      "description"=>$edit_desc,
                      "seo_description"=>$edit_seo_description,
                      "seo_keywords"=>$edit_seo_keywords,
                      "seo_title"=>$edit_seo_title);
     }

    if($db_handle->updateQuery("ti_about_us",$fields,"id =1")){
      if(!empty($_FILES['img']['name'])){
       unlink("../images/" . $image);
       }
        $msg    =   "Data Has benn Updated...";
        LoadFunction("about.php");
        $db_handle->Close();
        unset($db_handle);
    }
    else{
        $error_msg  =   "Failed ! Pls try again ";
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
        About Us 
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>About Us</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">About Us Details</h3>
                
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
              
              <!-- <div class="form-group">
                <label>Heading:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-info"></i>
                  </div>
                  <input type="text" class="form-control" name="heading" value="<?php echo $heading;?>">
                </div>
                
              </div> -->
              <!-- /.form group -->

              <!-- <div class="form-group">
                    <label>Image:</label>
                    <div>
                      <input type="file" name="img" id="parallax">
                    </div>
                 
                  </div>  -->
                  <!-- /.form group -->

              <!-- phone mask -->
                <div class="form-group">
                <label>Seo Title:</label>

                <div>
                  <input type="text" class="form-control" name="seo_title" value="<?php echo $seo_title;?>">
                  
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Seo Keywords:</label>

                <div>
                 
                  <textarea name="seo_keywords" class="form-control"><?php echo $seo_keywords;?></textarea>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
               <div class="form-group">
                <label>Seo Description:</label>

                <div>
                 
                  <textarea name="seo_description" class="form-control"><?php echo $seo_desc;?></textarea>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- IP mask -->
             <div class="form-group">
                <label>Content:</label>

                <div>
                 
                  <textarea name="description" id="editor" class="form-control"><?php echo $description;?></textarea>
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
       
       <!-- <div class="col-md-6"> 
          <img id="blah" src="../images/<?php echo $image;?>"  height="250" width="350">
          </div> -->
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
