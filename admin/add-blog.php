<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pills2go | Blog</title>
    <?php 
    include("./includes/head-meta.php"); 
    
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `blog` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $content        =   $row[0]["description"];
            $name           =   $row[0]["name"];
            $image          =   $row[0]["image"];

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
                $content_add    =   $db_handle->escapeString(valid_input($_POST["description"]));
                $add_name       =   $db_handle->escapeString(valid_input($_POST["name"]));
            
            if(!empty($_FILES['img']['name'])){
                   $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/blog/','945','368'); 
                    
                    $fields =   array(
                                        "description"=>$content_add,
                                        "name"=>$add_name,
                                        "image"=>$upload_img_name
                                    );
                if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
                }
                else{
                    
                    if($db_handle->updateQuery("blog",$fields,"id = '$escape_token'")){
                    $msg    =   true;
                    LoadFunction("blog.php");
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
                                        "description"=>$content_add,
                                        "name"=>$add_name
                                    );
                    if($db_handle->updateQuery("blog",$fields,"id = '$escape_token'")){
                        $msg    =   true;
                        LoadFunction("blog.php");
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
                $content_add    =   $db_handle->escapeString(valid_input($_POST["description"]));
                $add_name       =   $db_handle->escapeString(valid_input($_POST["name"]));
                if(!empty($_FILES['img']['name'])){
                   $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/blog/','945','368'); 
                    
                    $fields =   array(
                                        "description"=>$content_add,
                                        "name"=>$add_name,
                                        "image"=>$upload_img_name
                                    );
                if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
                }
                else{
                    
                    if($db_handle->insertQuery("blog",$fields)){
                    $msg    =   true;
                    LoadFunction("blog.php");
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
                                    "description"=>$content_add,
                                    "name"=>$add_name
                                    );
                if($db_handle->insertQuery("blog",$fields)){
                     $msg    =   true;
                    LoadFunction("blog.php");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
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
        Blog Edit
          <?php } else { ?>
           Blog Add
          <?php } ?>
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo __WEBROOT__?>/testi.php"><i class="fa fa-quote-left"></i> Blog</a></li>
           <li><?php echo ucfirst($name);?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
                <?php 
          if(isset($_GET['token'])){
          ?>
              <h3 class="box-title">Blog Edit Details</h3>
                <?php } else { ?>
                 <h3 class="box-title">Blog Add Details</h3>
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
            <div class="box-body">
              
              <div class="form-group">
                <label>Heading:</label>

                <div>
                  
                  <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
                <!-- /.input group -->
              </div>
                  <div class="form-group">
                <label>Image:</label>

                <div class="col-md-12">
                  
                  <input type="file" name="img" style="float:left;" id="imgInp">
                    <img id="blah" src="../images/blog/<?php echo $image;?>" style="width:50px;">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
               
             
             <div class="form-group">
                <label>Description:</label>

                <div>
                 
                  <textarea name="description" id="editor" class="form-control"><?php echo $content;?></textarea>
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
    <script type="text/javascript">
    function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
    
    
    </script>

</body>
</html>
