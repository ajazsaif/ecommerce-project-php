<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Orders List</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Order</li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order</h3>
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
                  <th>User Id</th>
                  <th>Order Id</th>
                  <th>Payment Mode</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                  <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php 
                   
                     $order_info_query        =   "SELECT * FROM `order_details` ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($order_info_query)>0){
                        $row                =   $db_handle->RunQuery($order_info_query);
                        
                         for($i = 0; $i< count($row);$i++){
                        $user_id        =   $row[$i]["user_id"];
                        $order_id       =   $row[$i]["order_id"];
                        $payment_mode   =   $row[$i]["payment_mode"];
                        $total_amount   =   $row[$i]["total_amount"];
                        $date           =   $row[$i]["date"];
                        //view user id from database
                        $fetch_userid   =   "SELECT user_id FROM `users` WHERE id = ".$user_id;
                        $user_row       =   $db_handle->RunQuery($fetch_userid);
                        $payment_details =  $db_handle->RunQuery("SELECT name,city FROM `payment_option` WHERE id = {$payment_mode}");
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo $user_row[0]['user_id'];?></td>
                  <td><?php echo $order_id;?></td>
                  <td><?php echo $payment_details[0]['city'];?></td>
                  <td><?php echo '$'.$total_amount;?></td>
                  <td><?php echo $date;?></td>
                  <td><a href="<?php echo __WEBROOT__;?>/order-detail.php?token=<?php echo $order_id; ?>" class="btn btn-primary">View Order Details</a></td>
                </tr>
                <?php 
                $j++; } } 
                    $db_handle->Close();
                    unset($db_handle);
                    
                    ?>
                    
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