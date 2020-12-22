<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> | Subscribers</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscribers
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Subscribers</li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Subscribers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sr No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subscribe Date</th>  
                </tr>
                </thead>
                <tbody>
                <?php 
                     $subscribers    =   "SELECT * FROM `subscribers` ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($subscribers)>0){
                        $row            =   $db_handle->RunQuery($subscribers);
                        $db_handle->Close();
                        unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $name           =   $row[$i]["name"];  
                        $email          =   $row[$i]["email"];
                        $create_date    =   $row[$i]["join_at"];
                      ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo $name;?></td>
                  <td><?php echo $email;?></td>
                  <td><?php echo $create_date;?></td>
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