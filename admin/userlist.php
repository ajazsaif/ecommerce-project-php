<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Users List</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Manage Users</li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Users</h3>
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
                  <th>Name</th>
                  <th>User Id</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Join Date</th>
                  <th>Details</th>  
                </tr>
                </thead>
                <tbody>
                <?php 
                   
                     $cat_info_query    =   "SELECT * FROM `users` ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($cat_info_query)>0){
                        $row            =   $db_handle->RunQuery($cat_info_query);
                        $db_handle->Close();
                        unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $name           =   $row[$i]["name"];
                        $id             =   $row[$i]["id"];
                        $phone          =   $row[$i]["phone"];
                        $user_id        =   $row[$i]["user_id"];
                        $email          =   $row[$i]["email"];
                        $create_date    =   $row[$i]["create_date"];
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo ucfirst($name);?></td>
                  <td><?php echo $user_id;?></td>
                  <td><?php echo $email;?></td>
                  <td><?php echo $phone;?></td>
                  <td><?php echo $create_date;?></td>
                  <td align="center">
                      <a href="<?php echo __WEBROOT__;?>/user_view.php?token=<?php echo $user_id; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
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