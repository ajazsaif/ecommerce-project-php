<?php 
include_once('includes/config.php');
 $db_handle              =  new DBController();
if(isset($_POST['del_rec'])){
    $del_id     = $db_handle->escapeString($_POST['del_data']);
    $del_pid     = $db_handle->escapeString($_POST['pid']);
    if($db_handle->deleteQuery('ti_pro_review',"id = $del_id")){
       $msg = true;
        LoadFunction("all-review.php");
    }
    else{
        $err_msg = "OOps try again later!";
    }
}

//update reading status
$update_fields = ['read_status'=> 1];
$db_handle->updateQuery("ti_pro_review",$update_fields,"1=1");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Drugstore | Products | Reviews</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>Product Reviews</small>
        <a href="<?php echo __WEBROOT__;?>/add-review.php" class="btn btn-success">Add Review</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__;?>/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Reviews</li>
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
                Review status has been changed.
              </div>
              <!-- <h3 class="box-title">Products</h3> -->
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
                  <th>Email</th>
                  <!-- <th>Phone</th>
                  <th>Country</th> -->
                  <th>Title</th>
                  <th>Rating</th>
                  <th>Status</th>
                  <th>Message</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                     //$escape_token   =  $db_handle->escapeString(valid_input($_GET["parent"]));
                     $cat_info_query        =   "SELECT * FROM `ti_pro_review` ORDER BY id DESC";
                      $j = 1;
                    if($db_handle->numRows($cat_info_query)>0){
                        $row                =   $db_handle->RunQuery($cat_info_query);
                        //$db_handle->Close();
                        //unset($db_handle);
                         for($i = 0; $i< count($row);$i++){
                        $id            =   $row[$i]["id"];
                        $name          =   $row[$i]["name"];
                        $rating        =   $row[$i]["rating"];
                        $country       =   $row[$i]["country"];
                        $phone         =   $row[$i]["phone"];
                        $email         =   $row[$i]["email"];
                        $title         =   $row[$i]["title"];
                        $message       =   $row[$i]["message"];
                        $status        =   $row[$i]["status"];
                        $create_date   =   $row[$i]["create_date"];
                        $escape_token  =   $row[$i]['product_id'];
                      
                ?>
                <tr>
                <td><?php echo $j;?></td>
                  <td><?php echo $name;?></td>
                  <td><?php echo $email;?></td>
                  <!-- <td><?php echo $phone;?></td>
                  <td><?php echo $country;?></td> -->
                  <td><?php echo $title;?></td>
                  <td><?php echo str_repeat('<i class="fa fa-star"></i>', $rating);?></td>
                  <td><label class="switch">
                          <input type="checkbox"  onchange="updatestatus('<?php echo $id; ?>','<?php echo $status; ?>');" id="<?php echo $id; ?>" <?php if($status== 1) { echo "checked"; }?>>
                          <span class="toggleswitch round"></span>
                        </label>
                    </td>
                    <td><?php echo substr($message,0, 100);?>...</td>
                    <td><?php echo date('j F Y', strtotime($create_date)); ?></td>
                  <td>
                      <form action="<?php echo htmlspecialchars('');?>" method="post">
                      <a href="<?php echo __WEBROOT__;?>/add-review.php?token=<?php echo $id; ?>&pid=<?php echo $escape_token; ?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <input type="hidden" name="del_data" value="<?php echo $id; ?>">
                        <input type="hidden" name="pid" value="<?php echo $escape_token; ?>">
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
  url: "ajax/update_status_service_review.php?id="+elm+"&status="+status,
  
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