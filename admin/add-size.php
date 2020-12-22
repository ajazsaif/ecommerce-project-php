<?php 
include_once('includes/config.php');
?>
<!DOCTYPE html>
<html>
<head>
     <title><?php echo $page_title;?> | Variant Add</title>
    <?php
    include("./includes/head-meta.php"); 
     $db_handle                  =  new DBController(); 
      $escape_pid                =  $db_handle->escapeString(valid_input($_GET["pid"]));
      $escape_token              =  $db_handle->escapeString(valid_input($_GET["token"]));
    //category info details fetch from database
    if(isset($_GET["token"])){
         $info_query               =   "select * from `ti_attributes` where id = '".$escape_token."'";
        if($db_handle->numRows($info_query)>0){
            $single_row            =   $db_handle->RunQuery($info_query);
            $size                  =    $single_row[0]['size'];
            $min_quantity          =    $single_row[0]['min_quantity'];
            $product_id            =    $single_row[0]['parent'];
            $price                 =    $single_row[0]['price'];
            $strength              =    $single_row[0]['strength'];

            $cat_name                =   "SELECT * FROM `products` where id='".$product_id."' ";
              if($db_handle->numRows($cat_name)>0){
                  $rowc              =   $db_handle->RunQuery($cat_name);
                  $product_name      =   $rowc[0]["heading"];
             }
        }
        else{
           // LoadFunction("404.php");
        }
    }
    else{
         //LoadFunction("404.php");
    }
    
    //edit data operation 
        if(isset($_POST["submit"]) && isset($_GET['token'])){
                $db_handle       =   new DBController();
                $size            =   $db_handle->escapeString(valid_input($_POST["size"]));
                //$min_quantity    =   $db_handle->escapeString(valid_input($_POST["min_quantity"]));
                $price           =   $db_handle->escapeString(valid_input($_POST["price"]));
                //$strength        =   $db_handle->escapeString(valid_input($_POST["strength"]));

                $fields =   array(
                                        "size"=>$size,
                                        //"min_quantity"=>$min_quantity,
                                        "price"=>$price,
                                        //"strength"=>$strength
                                    );
                    if($db_handle->updateQuery("ti_attributes",$fields,"id = '$escape_token'")){
                        $msg    =   true;
                        LoadFunction("size.php?pid=$escape_pid");
                        $db_handle->Close();
                        unset($db_handle);
                    }
                    else{
                        $error_msg  =   "Failed ! pls try again";
                    }  
            } 

      //insert query
            if(isset($_POST["submit"]) && !isset($_GET['token'])){
                $db_handle      =  new DBController();
                $size            =   $db_handle->escapeString(valid_input($_POST["size"]));
                $min_quantity    =   $db_handle->escapeString(valid_input($_POST["min_quantity"]));
                $price           =   $db_handle->escapeString(valid_input($_POST["price"]));
                //$strength        =   $db_handle->escapeString(valid_input($_POST["strength"]));
                
                $size            =  explode(',',$size);
                //$min_quantity    =  explode(',',$min_quantity);
                $price           =  explode(',',$price);
                
                for($i=0;$i<count($size);$i++){

                $fields =   array(
                                        "size"=>$size[$i],
                                        //"min_quantity"=>$min_quantity[$i],
                                        "price"=>$price[$i],
                                        //"strength"=>$strength,
                                        "parent"=>$escape_pid
                                    );
                //echo "<pre>"; print_r($fields); die();
                if($db_handle->insertQuery("ti_attributes",$fields)){
                     //$msg    =   true;
                    //LoadFunction("size.php?parent=$escape_pid");
                    //$db_handle->Close();
                    //unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
              
             }
             $msg    =   true;
             LoadFunction("size.php?pid=$escape_pid");
                  
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
        <?php echo ucfirst($product_name);?>
        <small>Variant Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><?php echo ucfirst($product_name);?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Add <?php echo ucfirst($product_name);?> Variant</h3>
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
              <form action="<?php echo htmlspecialchars('');?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              
              
              <!-- /.form group -->

              <!-- phone mask -->
                <div class="form-group">
                <label>Varient:</label>

                <div>
                  <input type="text" class="form-control" name="size" value="<?php echo $size;?>" placeholder="Enter Dosage">
                  
                </div>
                <!-- /.input group -->
              </div>
                
                <!-- <div class="form-group">
                <label>Min Quantity:</label>

                <div>
                  <input type="text" class="form-control" name="min_quantity" value="<?php echo $min_quantity;?>" placeholder="Enter Min Quantity">
                  
                </div>
                
              </div> -->
                 <div class="form-group">
                <label>Price:</label>

                <div>
                  <input type="text" class="form-control" name="price" value="<?php echo $price;?>" placeholder="Enter Price">
                  
                </div>
                
              </div> 
                <!-- <div class="form-group">
                <label>Unit:</label>

                <div>
                  <input type="text" class="form-control" name="strength" value="<?php echo $strength;?>" placeholder="Enter Unit">
                  
                </div>
                
              </div> -->
              <input type="hidden" name="parent" value="<?php echo $product_id;?>">
              <!-- /.form group -->

              <!-- phone mask -->
                   
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
    
<?php
    define('JS_META',TRUE);
    include("../../includes/js-meta.php"); 
?>
    

</body>
</html>
