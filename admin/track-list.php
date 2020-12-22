<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
if(isset($_POST['del_rec'])){
    $del_id     = $db_handle->escapeString($_POST['del_data']);
    if($db_handle->deleteQuery('tracking',"id = $del_id")){
       $msg = true;
        LoadFunction("track-list.php");
    }
    else{
        $err_msg = "OOps try again later!";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Tracking </title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tracking
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tracking</li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tracking</h3>
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
                  <th>Tracking No</th>
                  <th>Shiper Name</th>
                  <th>Receiver Name</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Add Tracking History</th>
                  <th>View Tracking History</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php 
                   
                     $cat_info_query        =   "SELECT * FROM `tracking` ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($cat_info_query)>0){
                        $row                =   $db_handle->RunQuery($cat_info_query);
                        $db_handle->Close();
                        unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $tracking_id        =   $row[$i]["tracking_id"];
                        $id                 =   $row[$i]["id"];
                        $ship_name          =   $row[$i]["ship_name"];
                        $recv_name          =   $row[$i]["recv_name"];
                        $date               =   $row[$i]["date"];
                        $status             =   $row[$i]["status"];
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo strtoupper($tracking_id);?></td>
                  <td><?php echo strtoupper($ship_name);?></td>
                  <td><?php echo strtoupper($recv_name);?></td>
                  <td><?php echo $date;?></td>
                  <td><?php echo $status;?></td>
                  <td>
                      <a href="<?php echo __WEBROOT__;?>/track.php?token=<?php echo $id; ?>" class="btn btn-primary">Edit</a>
                      <form action="<?php echo htmlspecialchars('');?>" method="post">
                        <input type="hidden" name="del_data" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-danger" style="margin-top:5px;" name="del_rec" onclick="return confirm('Are you sure want to delete ?');">Delete</button>
                          </form>
                    </td>
                    <td>
                      <a href="<?php echo __WEBROOT__;?>/add-history.php?token=<?php echo $id; ?>" class="btn btn-primary">Add Tracking History</a>
                    </td>
                     <td>
                      <a href="<?php echo __WEBROOT__;?>/tracking-history.php?token=<?php echo $id; ?>" class="btn btn-primary">View Tracking History</a>
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