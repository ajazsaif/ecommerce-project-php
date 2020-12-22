<?php include_once('includes/config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Analytics</title>
    <?php 
    include("./includes/head-meta.php"); 
    
     $db_handle          =  new DBController();
   
    //run query 
    $cat_info_query     =   "select * from `analytics` where 1=1";
    if($db_handle->numRows($cat_info_query)>0){
        $row        =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $content    =   $row[0]["content"];
        
    }
    
    if(isset($_POST['submit'])){
       
    $db_handle              =  new DBController();
    $edit_desc              =  $db_handle->escapeString(valid_input($_POST["content"]));
    
    $fields = array("content"=>$edit_desc);
    if($db_handle->updateQuery("analytics",$fields,"id =1")){
        $msg    =   "Data Has benn Updated...";
        LoadFunction("analytics.php");
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
        Analytics Code Edit
          
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
           <li>Analytics Code</li>
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
              
             <!--  <div class="form-group">
                <label>Heading:</label>

                <div>
                  
                  <input type="text" class="form-control" name="heading" value="<?php echo $heading;?>">
                </div>
               
              </div> -->
                 <!-- <div class="form-group">
                <label>Image:</label>

                <div class="col-md-12">
                  
                  <input type="file" name="img" style="float:left;" id="imgInp">
                    <img src="../img/testimonial/<?php echo $image;?>" style="width:50px;">
                    <img id="blah" src="#" alt="your image" style="width:50px;font-size:0" />
                </div>

              </div>-->
              
               
             
             <div class="form-group">
                <label>Analytics Code:</label>
                <div>
                  <textarea name="content" id="" class="form-control" rows="10" cols="5"><?php echo $content;?></textarea>
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
