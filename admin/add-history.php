<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Tracking History</title>
    <?php 
    include("./includes/head-meta.php"); 

    $db_handle          =  new DBController();
   
     //run query 
    if(isset($_GET["ref"])){
      $cat_info_query     =   "select * from `ti_tracking_history` where id = ".(int)$_GET["ref"];
    if($db_handle->numRows($cat_info_query)>0){
        $row    =   $db_handle->RunQuery($cat_info_query);
        $db_handle->Close();
        unset($db_handle);
        $date           =   $row[0]["date"];
        $time           =   $row[0]["time"];
        $location       =   $row[0]["location"];
        $status         =   $row[0]["status"];
        $remarks        =   $row[0]["remarks"];
        $track_id       =   $row[0]["track_id"];
        
    }  
    }
    
    if(isset($_POST['submit']) && isset($_GET["ref"])){
       
    $db_handle              =  new DBController();
    $date                   =  $db_handle->escapeString(valid_input($_POST["date"]));
    $time                   =  $db_handle->escapeString(valid_input($_POST["time"]));
    $location               =  $db_handle->escapeString(valid_input($_POST["location"]));
    $status                 =  $db_handle->escapeString(valid_input($_POST["status"]));
    $remarks                =  $db_handle->escapeString(valid_input($_POST["remarks"]));
    $tracking_id            =  $db_handle->escapeString(valid_input($_POST["track_id"]));
    
    $fields = array("date"=>$date,"time"=>$time,"location"=>$location,"status"=>$status,"remarks"=>$remarks);
    if($db_handle->updateQuery("ti_tracking_history",$fields,"id =".$_GET['ref'])){
        $msg    =   true;
        LoadFunction("tracking-history.php?token=".$tracking_id);
        $db_handle->Close();
        unset($db_handle);
    }
    else{
        $error_msg  =   "Failed ! Pls try again ";
    }
        
    }
    if(isset($_POST['submit']) && isset($_GET["token"])){
       
    $db_handle              =  new DBController();
    $date                   =  $db_handle->escapeString(valid_input($_POST["date"]));
    $time                   =  $db_handle->escapeString(valid_input($_POST["time"]));
    $location               =  $db_handle->escapeString(valid_input($_POST["location"]));
    $status                 =  $db_handle->escapeString(valid_input($_POST["status"]));
    $remarks                =  $db_handle->escapeString(valid_input($_POST["remarks"]));
    $tracking_id            =  $_GET["token"];
    
    $fields = array("date"=>$date,"time"=>$time,"location"=>$location,"status"=>$status,"remarks"=>$remarks,"track_id"=>$tracking_id);
    if($db_handle->insertQuery("ti_tracking_history",$fields)){
        $msg    =   true;
        LoadFunction("tracking-history.php?token=".$_GET["token"]);
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
        Tracking History
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> Tracking History</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title"> Add Tracking History Details</h3>
                
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
                <label>Date:</label>

                <div>
                  <input type="text" class="form-control" name="date" value="<?php echo $date;?>">
                  
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Time:</label>

                <div>
                 
                   <input type="text" class="form-control" name="time" value="<?php echo $time;?>">
                    <input type="hidden" name="track_id" value="<?php echo $track_id; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
               <div class="form-group">
                <label>Location:</label>

                <div>
                 
                   <input type="text" class="form-control" name="location" value="<?php echo $location;?>">
                </div>
                <!-- /.input group -->
              </div>
                  <div class="form-group">
                <label>Status:</label>

                <div>
                 
                   <select name="status" class="form-control">
                    <option value="">Please Select Status</option>
                       <option value="active" <?php if($status == 'active'){ echo "selected";} ?>>ACTIVE</option>
                       <option value="on hold" <?php if($status == 'on hold'){ echo "selected";} ?>>ON HOLD</option>
                       <option value="in transit" <?php if($status == 'in transit'){ echo "selected";} ?>>IN TRANSIT</option>
                       <option value="delivered" <?php if($status == 'delivered'){ echo "selected";} ?>>DELIVERED</option>
                    
                    </select>
                </div>
                <!-- /.input group -->
              </div>
                <div class="form-group">
                <label>Remarks:</label>

                <div>
                 
                   <input type="text" class="form-control" name="remarks" value="<?php echo $remarks;?>">
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
