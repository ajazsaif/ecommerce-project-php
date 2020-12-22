<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Contact</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    
    $db_handle          =  new DBController();
   
    //run query 
    $cat_info_query     =   "SELECT * FROM `ti_contact_us`";
    if($db_handle->numRows($cat_info_query)>0){
        $row    =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $skype          =   $row[0]["skype"];
        $heading        =   $row[0]["heading"];
        $description    =   $row[0]["description"];
        $subheading     =   $row[0]["subheading"];
        $phone          =   $row[0]["phone"];
        $phone1         =   $row[0]["phone1"];
        $email          =   $row[0]["email"];
        $email_one      =   $row[0]["email_one"];
        $office_time    =   $row[0]["office_time"];
        $main_office    =   $row[0]["main_office"];
        $region_office  =   $row[0]["region_office"];
        
        
    }
    
    if(isset($_POST['submit'])){
       
    $db_handle              =  new DBController();
    $edit_skype             =  $db_handle->escapeString(valid_input($_POST["skype"]));
    $edit_heading           =  $db_handle->escapeString(valid_input($_POST["heading"]));
    $edit_subheading        =  $db_handle->escapeString(valid_input($_POST["subheading"]));
    $edit_phone             =  $db_handle->escapeString(valid_input($_POST["phone"]));
    $edit_phone1            =  $db_handle->escapeString(valid_input($_POST["phone1"]));
    $edit_desc              =  $db_handle->escapeString(valid_input($_POST["description"]));
    $edit_email             =  $db_handle->escapeString(valid_input($_POST["email"]));
    $edit_semail            =  $db_handle->escapeString(valid_input($_POST["email_one"]));
    $edit_main_office       =  $db_handle->escapeString(valid_input($_POST["main_office"]));
    $edit_region_office     =  $db_handle->escapeString(valid_input($_POST["region_office"]));
    $edit_office_time       =  $db_handle->escapeString(valid_input($_POST["office_time"]));
    
    $fields = array("heading"=>$edit_heading,"subheading"=>$edit_subheading,"phone"=>$edit_phone,"phone1"=>$edit_phone1,"email"=>$edit_email,"email_one"=>$edit_semail,"main_office"=>$edit_main_office,"region_office"=>$edit_region_office,"description"=>$edit_desc,"office_time"=>$edit_office_time,"skype"=>$edit_skype);
    if($db_handle->updateQuery("ti_contact_us",$fields,"id =1")){
        $msg    =   true;
        LoadFunction("contact.php");
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
        Contact Us 
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Contact Us</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Contact Us Details</h3>
                
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
              
              <!-- <div class="form-group">
                <label>Heading:</label>

                <div>
                  
                  <input type="text" class="form-control" name="heading" value="<?php echo $heading;?>">
                </div>
               
              </div>
                  <div class="form-group">
                <label>Sub Heading:</label>

                <div>
                  
                  <input type="text" class="form-control" name="subheading" value="<?php echo $subheading;?>">
                </div>
          
              </div> -->
              <!-- /.form group -->

              <!-- phone mask -->
                <div class="form-group">
                <label>Phone:</label>

                <div>
                  <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                  
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Alternate Phone:</label>

                <div>
                  <input type="text" class="form-control" name="phone1" value="<?php echo $phone1;?>">
                  
                </div>
                
              </div>
              <div class="form-group">
                <label>Whatsapp:</label>

                <div>
                  <input type="text" class="form-control" name="skype" value="<?php echo $skype;?>">
                  
                </div>
                
              </div>
                <div class="form-group">
                <label>Email:</label>

                <div>
                  <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                  
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Alternate Email:</label>

                <div>
                  <input type="text" class="form-control" name="email_one" value="<?php echo $email_one;?>">
                  
                </div>
               
              </div>
              <!-- <div class="form-group">
                <label>Office Time:</label>

                <div>
                  <input type="text" class="form-control" name="office_time" value="<?php echo $office_time;?>">
                  
                </div>
                
              </div> -->
                <div class="form-group">
                <label>Main Office:</label>

                <div>
                 <textarea name="main_office" class="form-control"><?php echo $main_office;?></textarea>
                  
                </div>
                <!-- /.input group -->
              </div>
                  <!-- <div class="form-group">
                <label>Branch Office:</label>

                <div>
                 <textarea name="region_office" class="form-control"><?php //echo $region_office;?></textarea>
                  
                </div>
              
              </div>  -->
             
              <!-- /.form group -->

             
             <!-- <div class="form-group">
                <label>Description:</label>

                <div>
                 
                  <textarea name="description" id="editor" class="form-control"><?php echo $description;?></textarea>
                </div>
                
              </div> -->
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
