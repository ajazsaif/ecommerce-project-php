<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Social Media</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    
    $db_handle          =  new DBController();
   
    //run query 
    $cat_info_query     =   "SELECT * FROM `ti_social_links`";
    if($db_handle->numRows($cat_info_query)>0){
        $row    =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $facebook_link        =   $row[0]["facebook_link"];
        $linkdin_link    =   $row[0]["linkdin_link"];
        $twiter_link     =   $row[0]["twiter_link"];
        $youtube          =   $row[0]["youtube"];
        $google_plus          =   $row[0]["google_plus"];
        $pintrest    =   $row[0]["pintrest"];
        
        
    }
    
    if(isset($_POST['submit'])){
       
    $db_handle              =  new DBController();
    $facebook_link           =  $db_handle->escapeString(valid_input($_POST["facebook_link"]));
    $linkdin_link        =  $db_handle->escapeString(valid_input($_POST["linkdin_link"]));
    $twiter_link             =  $db_handle->escapeString(valid_input($_POST["twiter_link"]));
    $youtube              =  $db_handle->escapeString(valid_input($_POST["youtube"]));
    $google_plus             =  $db_handle->escapeString(valid_input($_POST["google_plus"]));
    $pintrest       =  $db_handle->escapeString(valid_input($_POST["pintrest"]));
    
    $fields = array("facebook_link"=>$facebook_link,"linkdin_link"=>$linkdin_link,"twiter_link"=>$twiter_link,"youtube"=>$youtube,"google_plus"=>$google_plus,"pintrest"=>$pintrest);
    if($db_handle->updateQuery("ti_social_links",$fields,"id =1")){
        $msg    =   true;
        LoadFunction("social.php");
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
        Social Media
        <small>Links</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Social Media</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Social Media Links</h3>
                
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
              
              <div class="form-group">
                <label>Facebook :</label>

                <div>
                  
                  <input type="text" class="form-control" name="facebook_link" value="<?php echo $facebook_link;?>">
                </div>
                <!-- /.input group -->
              </div>
                  <div class="form-group">
                <label>Linkdin :</label>

                <div>
                  
                  <input type="text" class="form-control" name="linkdin_link" value="<?php echo $linkdin_link;?>">
                </div>
                
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
                <div class="form-group">
                <label>Twitter :</label>

                <div>
                  <input type="text" class="form-control" name="twiter_link" value="<?php echo $twiter_link;?>">
                  
                </div>
                <!-- /.input group -->
              </div>
                <!-- <div class="form-group">
                <label>Youtube :</label>

                <div>
                  <input type="text" class="form-control" name="youtube" value="<?php echo $youtube;?>">
                  
                </div>
                
              </div> -->
                <div class="form-group">
                <label>Dribble :</label>

                <div>
                 <input type="text" name="google_plus" class="form-control" value="<?php echo $google_plus;?>">
                  
                </div>
                <!-- /.input group -->
              </div>
                 <div class="form-group">
                <label>Skype :</label>

                <div>
                 <input type="text" name="pintrest" class="form-control" value="<?php echo $pintrest;?>">
                  
                </div>
                
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
