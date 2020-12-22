<?php include_once('includes/config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Privacy Policy</title>
    <?php 
    include("./includes/head-meta.php"); 
    
     $db_handle          =  new DBController();
   
    //run query 
    $cat_info_query     =   "select * from `terms` where id=1";
    if($db_handle->numRows($cat_info_query)>0){
        $row        =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $heading    =   $row[0]["heading"];
        $content    =   $row[0]["content"];
        $seo_title    =   $row[0]["seo_title"];
        $seo_keywords    =   $row[0]["seo_keywords"];
        $seo_description    =   $row[0]["seo_description"];
        
    }
    
    if(isset($_POST['submit'])){
       
    $db_handle              =  new DBController();
    $edit_heading           =  $db_handle->escapeString(valid_input($_POST["heading"]));
    $edit_desc              =  $db_handle->escapeString(valid_input($_POST["content"]));
    $seo_title              =  $db_handle->escapeString(valid_input($_POST["seo_title"]));
    $seo_keywords           =  $db_handle->escapeString(valid_input($_POST["seo_keywords"]));
    $seo_description        =  $db_handle->escapeString(valid_input($_POST["seo_description"]));
    
    $fields = array(
      "heading"=>$edit_heading,
      "content"=>$edit_desc,
      "seo_title"=>$seo_title,
      "seo_keywords"=>$seo_keywords,
      "seo_description"=>$seo_description
    );
    if($db_handle->updateQuery("terms",$fields,"id =1")){
        $msg    =   "Data Has benn Updated...";
        LoadFunction("terms.php");
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
        Privacy Policy Edit
          
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
           <li>Privacy Policy</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
                
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
                  
                  <input type="text" class="form-control" name="heading" value="<?php echo $heading;?>">
                </div>
                <!-- /.input group -->
              </div>
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
                  
                  <input type="text" class="form-control" name="seo_keywords" value="<?php echo $seo_keywords;?>">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Seo Description:</label>

                <div>
                  
                  <input type="text" class="form-control" name="seo_description" value="<?php echo $seo_description;?>">
                </div>
                <!-- /.input group -->
              </div>
                 <!-- <div class="form-group">
                <label>Image:</label>

                <div class="col-md-12">
                  
                  <input type="file" name="img" style="float:left;" id="imgInp">
                    <img src="../img/testimonial/<?php echo $image;?>" style="width:50px;">
                    <img id="blah" src="#" alt="your image" style="width:50px;font-size:0" />
                </div>

              </div>-->
              
               
             
             <div class="form-group">
                <label>Description:</label>
                <div>
                  <textarea name="content" id="editor" class="form-control"><?php echo $content;?></textarea>
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
      <br><br><br><br>
    </section>
    <!-- /.content -->
  </div>
</div>

<?php include("./includes/js-meta.php"); ?>

</body>
</html>
