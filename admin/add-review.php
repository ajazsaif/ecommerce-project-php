<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Drugstore | Product | Add Review</title>
    <?php 
    include("./includes/head-meta.php");
    $db_handle      =  new DBController(); 
     $escape_pid   =  $db_handle->escapeString(valid_input($_GET["pid"]));
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        $escape_pid   =  $db_handle->escapeString(valid_input($_GET["pid"]));
        //run query 
        $contact_info_query =   "select * from `ti_pro_review` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $id            =   $row[0]["id"];
            $name          =   $row[0]["name"];
            $rating        =   $row[0]["rating"];
            //$country       =   $row[0]["country"];
            //$phone         =   $row[0]["phone"];
            $email         =   $row[0]["email"];
            $title         =   $row[0]["title"];
            $message       =   $row[0]["message"];
            $status        =   $row[0]["status"];
            $create_date   =   $row[0]["create_date"];
        }
        else{
           // LoadFunction("404.php");
        }
    }
    else{
         //LoadFunction("404.php");
    }
   
   //edit data operation 
        if(isset($_POST["name"]) && isset($_GET['token'])){
                $db_handle =  new DBController();
                $r_name    =   $db_handle->escapeString(valid_input($_POST["name"]));
                //$r_phone   =   $db_handle->escapeString(valid_input($_POST["phone"]));
                $r_title   =   $db_handle->escapeString(valid_input($_POST["title"]));
                //$r_country =   $db_handle->escapeString(valid_input($_POST["country"]));
                $r_msg     =   $db_handle->escapeString(valid_input($_POST["message"]));
                $r_rating  =   $db_handle->escapeString(valid_input($_POST["rating"]));
                $r_email   =   $db_handle->escapeString(valid_input($_POST["email"]));
                $r_status  =   $db_handle->escapeString(valid_input($_POST["status"]));
                    $fields =   array(
                                        "name"=>$r_name,
                                        //"phone"=>$r_phone,
                                        "title"=>$r_title,
                                        //"country"=>$r_country,
                                        "message"=>$r_msg,
                                        "rating"=>$r_rating,
                                        "email"=>$r_email,
                                        "status"=>$r_status
                                    );
                    
                    if($db_handle->updateQuery("ti_pro_review",$fields,"id = '$escape_token'")){
                        $msg    =   true;
                        LoadFunction("all-reviews.php");
                        $db_handle->Close();
                        unset($db_handle);
                    }
                    else{
                        $error_msg  =   "Failed !";
                    }
                
            } 
            //insert query
            if(isset($_POST["name"]) && !isset($_GET['token'])){
                $r_name    =   $db_handle->escapeString(valid_input($_POST["name"]));
                //$r_phone   =   $db_handle->escapeString(valid_input($_POST["phone"]));
                $r_title   =   $db_handle->escapeString(valid_input($_POST["title"]));
                //$r_country =   $db_handle->escapeString(valid_input($_POST["country"]));
                $r_msg     =   $db_handle->escapeString(valid_input($_POST["message"]));
                $r_rating  =   $db_handle->escapeString(valid_input($_POST["rating"]));
                $r_email   =   $db_handle->escapeString(valid_input($_POST["email"]));
                $r_status  =   $db_handle->escapeString(valid_input($_POST["status"]));
                $pro_id    =   $db_handle->escapeString(valid_input($_GET["pid"]));
                    $fields =   array(
                                        "name"=>$r_name,
                                        //"product_id"=>$pro_id,
                                        //"phone"=>$r_phone,
                                        "title"=>$r_title,
                                        "country"=>$r_country,
                                        "message"=>$r_msg,
                                        "rating"=>$r_rating,
                                        "email"=>$r_email,
                                        "status"=>$r_status
                                    );
                    
                    if($db_handle->insertQuery("ti_pro_review",$fields)){
                        $msg    =   true;
                        $last_id=$db_handle->last_insert_id();
                        LoadFunction("all-reviews.php");
                        $db_handle->Close();
                        unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
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
        <h1 >
            <span style="font-size: 15px;"><a href="index.php"> Home </a> > <a href="all-reviews.php"> Reviews List</a> </span>
      </h1>
        <ol class="breadcrumb">
            <li> 
            <button style="margin-left:20px;margin-right: 30px;margin-top:-10px;" class="btn btn-info btn-icon" name="Cancel" id="save" type="button" title='Back' onclick="location.href='all-reviews.php'" ><i class="fa fa-reply"></i></button> 
              <button style="margin-left:20px;margin-right: 30px;margin-top:-10px;" class="btn btn-info btn-icon" name="save" id="save" type="button" onclick="document.form.submit();" title='save & Stay'  >Save</button>
            </li></ol> 
    </section>
    <!-- Main content -->
    <section class="content">
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
        }  
        ?>
     <form id="form" name="form" method="post">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pagedata" data-toggle="tab">Review Details</a></li>
                <!-- <li><a href="#slide" data-toggle="tab">Image Slides</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="pagedata">
              
                  <!-- Post -->
                  <div class="row" style="margin-left: 70px"><br/> 
                        <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Name</label>
                            <div class="col-md-9">
                                <input class="form-control" id="heading" required="required" name="name" value="<?php echo $name; ?>" type="text">
                            </div>
                        </div>
                        

                        <!-- <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Phone</label>
                            <div class="col-md-9">
                                <input class="form-control" required id="min_qty" name="phone" value="<?php echo $phone; ?>" type="text">
                            </div>
                        </div> -->
                        
                        <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Email</label>
                            <div class="col-md-9">
                                <input class="form-control" required id="seo_title" name="email" value="<?php echo $email; ?>" type="email" placeholder="email" >
                            </div>
                     
                        </div>
                       <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Review Title</label>
                            <div class="col-md-9">
                                <input class="form-control" required id="seo_keywords" name="title" value="<?php echo $title; ?>" type="text" placeholder="Review Title">
                            </div>
                     
                        </div>
                       <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Rating</label>
                            <div class="col-md-9">
                                <select class="form-control" id="rating" name="rating" required>
                                    <?php
                                    $rating_name = ['Poor','Fair','Good','Excellent','Wow']; 
                                    for($i = 0; $i< 5; $i++){ ?>
                                    <option value="<?php echo ($i+1); ?>" <?php if($rating == ($i+1)){ echo "selected='selected'"; }?> ><?php echo $rating_name[$i]; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Status</label>
                            <div class="col-md-9">
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" <?php if($status == 1){ echo "selected='selected'"; }?>>Approved</option>
                                    <option value="0" <?php if($status == 0){ echo "selected='selected'"; }?> >Unapproved</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                          <label class="col-md-2 control-label " for="editor">Message</label>
                            <div class="col-md-9">
                                <textarea rows="10" cols="10" class="form-control" name="message" ><?php echo $message; ?></textarea>
                            </div>
                          
                        </div>                 
                      </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->
                 <!-- <div class="tab-pane" id="slide"><br/>
                  <div class="row" style="margin-left: 70px">
                    <div class="form-group clearfix"> 
                    <div id="mulitplefileuploader">Upload</div>

                     <div id="status"></div>
                      <div id="service_images" ></div> </div></div></div> -->
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div> 
        <!-- /.col -->
      </div>
      <!-- /.row -->
     </form>
    </section>
    <!-- /.content -->
  </div>
    </div>
    
<?php include("./includes/js-meta.php"); ?>
</body>
</html>
