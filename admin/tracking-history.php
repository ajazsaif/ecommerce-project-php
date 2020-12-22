<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
if(isset($_POST['del_rec'])){
    $del_id     = $db_handle->escapeString($_POST['del_data']);
    if($db_handle->deleteQuery('ti_tracking_history',"id = $del_id")){
       $msg = true;
        LoadFunction("tracking-history.php?token=".$_GET["token"]);
    }
    else{
        $err_msg = "OOps try again later!";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Tracking History</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tracking History
        <small>List</small><br><br>
           <a class="btn btn-primary" href="<?php echo __WEBROOT__;?>/add-history.php?token=<?php echo $_GET['token']; ?>">Add Tracking History</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tracking History</li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tracking History</h3>
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
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sr No</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Tracking No</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Remarks</th>
                  <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php 
                   
                     $cat_info_query        =   "SELECT * FROM `ti_tracking_history` WHERE track_id = {$_GET['token']} ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($cat_info_query)>0){
                        $row                =   $db_handle->RunQuery($cat_info_query);
                        //$db_handle->Close();
                        //unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $date           =   $row[$i]["date"];
                        $id             =   $row[$i]["id"];
                        $time           =   $row[$i]["time"];
                        $location       =   $row[$i]["location"];
                        $status         =   $row[$i]["status"];
                        $remarks        =   $row[$i]["remarks"];
                        $track_id       =   $row[$i]["track_id"];
                        //fetch tracking no from database
                        $get_trackingid =   "SELECT tracking_id FROM `tracking` WHERE id = ".$track_id;
                        $tracking_result=   $db_handle->RunQuery($get_trackingid);
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo $date;?></td>
                  <td><?php echo $time;?></td>
                  <td><?php echo $tracking_result[0]["tracking_id"];?></td>
                  <td><?php echo $location;?></td>
                  <td><?php echo $status;?></td>
                  <td><?php echo $remarks;?></td>
                  <td>
                      <a href="<?php echo __WEBROOT__;?>/add-history.php?ref=<?php echo $id; ?>" class="btn btn-primary">Edit</a>
                      <form action="<?php echo htmlspecialchars('');?>" method="post">
                        <input type="hidden" name="del_data" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-danger" style="margin-top:5px;" name="del_rec" onclick="return confirm('Are you sure want to delete ?');">Delete</button>
                          </form>
                    </td>
                </tr>
                <?php $j++; } } ?>
                    
                </tbody>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
    
<?php include("./includes/js-meta.php"); ?>
</body>
</html>