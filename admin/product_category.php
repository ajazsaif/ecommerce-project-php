<?php 
include_once('includes/config.php');
 $db_handle       =  new DBController();
if(isset($_POST['del_rec'])){
    $del_id     = $db_handle->escapeString($_POST['del_data']);
    if($db_handle->deleteQuery('products',"id = $del_id")){
      $db_handle->deleteQuery('products',"parent = $del_id");
       $msg = true;
        LoadFunction("product_category.php");
    }
    else{
        $err_msg = "OOps try again later!";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Products</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div id="success" class="alert alert-success alert-dismissible" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Category status has been changed.
              </div>
              <!-- <h3 class="box-title">Category</h3> -->
              <!-- <a href="<?php echo __WEBROOT__;?>/category_edit.php" class="btn btn-primary">Add Category</a> -->
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
                  <th>Heading</th>
                  <th>Products</th>
                  <th>Status</th>
                  <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php 
                   
                     $cat_info_query        =   "SELECT * FROM `products` where parent='0' ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($cat_info_query)>0){
                        $row                =   $db_handle->RunQuery($cat_info_query);
                        //$db_handle->Close();
                        //unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $id             =   $row[$i]["id"];
                        $heading        =   $row[$i]["heading"];
                        $status        =   $row[$i]["status"];
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo $heading;?></td>
                  <?php $cat_query        =   "SELECT * FROM `products` where parent='".$id."'";
                    $num=$db_handle->numRows($cat_query);?>
                    <td><?php echo $num;?></td>
                    <td><label class="switch">
                          <input type="checkbox"  onchange="updatestatus('<?php echo $id; ?>','<?php echo $status; ?>');" id="<?php echo $id; ?>" <?php if($status=='p') { echo "checked"; }?>>
                          <span class="toggleswitch round"></span>
                        </label>
                    </td>
                  <td align="center">
                    <form action="<?php echo htmlspecialchars('');?>" method="post">
                      <a href="<?php echo __WEBROOT__;?>/product_list.php?token=<?php echo $id; ?>" class="btn btn-primary"><i class="fa fa-medkit" aria-hidden="true"></i></a>
                        <input type="hidden" name="del_data" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-danger" name="del_rec" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
<script>
    function updatestatus(elm,status) // fetching states 
{
      
  $.ajax({
  url: "ajax/update_status_service.php?id="+elm+"&status="+status,
  
 success:function(data){
  changestatus();
  },
  
  context: document.body
}).done(function() {

}); 
} 

function changestatus() {
    setTimeout(function () {
        $("#success").show();
        setTimeout(function () {
            $("#success").hide();
        }, 5000);
    }, 500);
}


    
</script>
</body>
</html>