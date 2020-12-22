<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
 ?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Banner</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Banner
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Banners</li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Banners</h3>
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
                  <th>Image</th>
                  <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php 
                   
                     $cat_info_query        =   "SELECT * FROM `banner` ORDER BY id ASC";
                      $j = 1;
                    if($db_handle->numRows($cat_info_query)>0){
                        $row                =   $db_handle->RunQuery($cat_info_query);
                        $db_handle->Close();
                        unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $id             =   $row[$i]["id"];
                        $image          =   $row[$i]["image"];
                        $type          =   $row[$i]["type"];
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><img src="../images/banner/<?php echo $image;?>" height="120" width="320"></td>
                  <td align="center">
                      <form action="<?php echo htmlspecialchars('');?>" method="post">
                      <a href="<?php echo __WEBROOT__;?>/add-banner.php?token=<?php echo $id; ?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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