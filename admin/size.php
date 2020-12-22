<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
if(isset($_POST['del_rec'])){
    $del_id     = $db_handle->escapeString($_POST['del_data']);
    $del_pid     = $db_handle->escapeString($_POST['pid']);
    if($db_handle->deleteQuery('ti_attributes',"id = $del_id")){
       $msg = true;
        LoadFunction("size.php?pid=$del_pid");
    }
    else{
        $err_msg = "OOps try again later!";
    }
}

$escape_token   =  $db_handle->escapeString(valid_input($_GET["pid"]));
   $cat_name        =   "SELECT * FROM `products` where id='".$escape_token."' ";
  if($db_handle->numRows($cat_name)>0){
      $rowc         =   $db_handle->RunQuery($cat_name);
      $product      =   $rowc[0]["heading"];
 }

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Variant List</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>  
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="product_list.php"><?php echo $product;?></a>
        <small>Variant List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><?php echo $product;?> Variant List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $product;?> Variant List</h3>
                 <a href="add-size.php?pid=<?php echo $escape_token; ?>" class="btn btn-primary" style="margin-left:4px;">Add Variant</a>
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
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sr No</th>
                   <th>Product Name</th> 
                  <th>Variant</th>
                  <!-- <th>Min Quantity</th> -->
                   <th>Price</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                      $j                = 1;
                    
                     $vname        =   "SELECT * FROM `ti_attributes` where parent='".$escape_token."' ";
                    if($db_handle->numRows($vname)>0){
                        $row            =   $db_handle->RunQuery($vname);
                         for($i = 0; $i< count($row);$i++){  
                        $product_id     =   $row[$i]["parent"];
                        $id             =   $row[$i]["id"];
                        $size           =   $row[$i]["size"];
                        //$min_quantity   =   $row[$i]["min_quantity"];
                        $price          =   $row[$i]["price"];
                ?>
                <tr>
                <td><?php echo $j;?></td>
                 <td><span style='background-color:#42b099;color:white;padding:5px;'><?php echo ucfirst($product);?></span></td> 
                <td><span style='background-color:#222d32;color:white;padding:5px;'><?php echo $size;?></span></td>
                 
                     <td><span style='background-color:#222d32;color:white;padding:5px;'><?php echo "$".$price;?></span></td> 
                  <td>
                      <a href="<?php echo __WEBROOT__;?>/add-size.php?token=<?php echo $id; ?>&pid=<?php echo $escape_token; ?>" class="btn btn-primary">Edit</a>
                      <form action="<?php echo htmlspecialchars('');?>" method="post" style="display:inline-block;">
                        <input type="hidden" name="del_data" value="<?php echo $id; ?>">
                        <input type="hidden" name="pid" value="<?php echo $escape_token; ?>">
                      <button type="submit" class="btn btn-danger" name="del_rec" onclick="return confirm('Are you sure want to delete ?');">Delete</button>
                          </form>
                    </td>
                </tr>
                <?php 
                    $j++; } } 
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