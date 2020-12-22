<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Home</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    
    $db_handle          =  new DBController();
   
    //run query 
    $cat_info_query     =   "select * from `home` where 1=1";
    if($db_handle->numRows($cat_info_query)>0){
        $row    =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $seo_desc       =   $row[0]["seo_description"];
        $seo_title      =   $row[0]["seo_title"];
        $seo_keywords   =   $row[0]["seo_keywords"];
        
    }
    
    if(isset($_POST['submit'])){
       
    $db_handle              =  new DBController();
    $edit_seo_title         =  $db_handle->escapeString(valid_input($_POST["seo_title"]));
    $edit_seo_description   =  $db_handle->escapeString(valid_input($_POST["seo_description"]));
    $edit_seo_keywords      =  $db_handle->escapeString(valid_input($_POST["seo_keywords"]));
    
    $fields = array("seo_description"=>$edit_seo_description,"seo_keywords"=>$edit_seo_keywords,"seo_title"=>$edit_seo_title);
    if($db_handle->updateQuery("home",$fields,"id =1")){
        $msg    =   true;
        LoadFunction("home.php");
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
        Home Page Seo
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> Home Page Seo</li>
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
              <form action="<?php echo htmlspecialchars('');?>" method="post">
            <div class="box-body">
              
              
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
