<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Product</title>
    <?php 
    include("./includes/head-meta.php");
    $db_handle      =  new DBController(); 
     $escape_pid   =  $db_handle->escapeString(valid_input($_GET["pid"]));
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        $escape_pid   =  $db_handle->escapeString(valid_input($_GET["pid"]));
        //run query 
        $contact_info_query =   "select * from `products` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $heading        =   $row[0]["heading"];
            $price          =   $row[0]["price"];
            $rating         =   $row[0]["rating"];
            $min_qty        =   $row[0]["min_qty"];
            $image          =   $row[0]["image"];
            $img_alt        =   $row[0]["img_alt"];
            $img_title      =   $row[0]["img_title"];
            $description    =   $row[0]["description"];
            $parent         =   $row[0]["parent"];
            $seo_title      =   $row[0]["seo_title"];
            $seo_keywords   =   $row[0]["seo_keywords"];
            $seo_description=   $row[0]["seo_description"];
            $additional_info=   $row[0]["additional_info"];
            $products_tag=      $row[0]["products_tag"];

        }
        else{
           // LoadFunction("404.php");-
        }
    }
    else{
         //LoadFunction("404.php");
    }
   
   //edit data operation 
        if(isset($_POST["heading"]) && isset($_GET['token'])){
                $db_handle      =  new DBController();
                $description    =   $db_handle->escapeString(valid_input($_POST["description"]));
                $heading        =   $db_handle->escapeString(valid_input($_POST["heading"]));
                //$price          =   $db_handle->escapeString(valid_input($_POST["price"]));
                //$rating         =   $db_handle->escapeString(valid_input($_POST["rating"]));
                //$min_qty        =   $db_handle->escapeString(valid_input($_POST["min_qty"]));
                $img_alt        =   $db_handle->escapeString(valid_input($_POST["img_alt"]));
                $img_title      =   $db_handle->escapeString(valid_input($_POST["img_title"]));
                $slug           =   create_slug($heading);
                $seo_title      =   $db_handle->escapeString(valid_input($_POST["seo_title"]));
                $seo_keywords   =   $db_handle->escapeString(valid_input($_POST["seo_keywords"]));
                $seo_description=   $db_handle->escapeString(valid_input($_POST["seo_description"]));
                //$add_products_tag=   $db_handle->escapeString(valid_input($_POST["products_tag"]));
                $add_additional_info=   $db_handle->escapeString(valid_input($_POST["additional_info"]));

            
            if(!empty($_FILES['img']['name'])){
                   $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/product/','360','360'); 
                    
                    $fields =   array(
                                        "description"=>$description,
                                        "heading"=>$heading,
                                        //"price"=>$price,
                                        //"rating"=>$rating,
                                        //"min_qty"=>$min_qty,
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                        "image"=>$upload_img_name,
                                        "slug"=>$slug,
                                        "seo_title"=>$seo_title,
                                        "seo_keywords"=>$seo_keywords,
                                        "seo_description"=>$seo_description,
                                        "additional_info"=> $add_additional_info,
                                        //"products_tag"=> $add_products_tag
                                    );
                if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
                }
                else{
                    
                    if($db_handle->updateQuery("products",$fields,"id = '$escape_token'")){
                    unlink("../images/product/" . $image);
                    $msg    =   true;
                    LoadFunction("product_list.php?token=$escape_pid");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
                } 
                
            } 
            else{
                $fields =   array(
                                        "description"=>$description,
                                        "heading"=>$heading,
                                        //"price"=>$price,
                                        //"rating"=>$rating,
                                        //"min_qty"=>$min_qty,
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                        "slug"=>$slug,
                                        "seo_title"=>$seo_title,
                                        "seo_keywords"=>$seo_keywords,
                                        "seo_description"=>$seo_description,
                                        "additional_info"=> $add_additional_info,
                                        //"products_tag"=> $add_products_tag
                                    );
                    if($db_handle->updateQuery("products",$fields,"id = '$escape_token'")){
                        $msg    =   true;
                        LoadFunction("product_list.php?token=$escape_pid");
                        $db_handle->Close();
                        unset($db_handle);
                    }
                    else{
                        $error_msg  =   "Failed ! pls try again";
                    }
            }
                
                    
                
            }  
            //insert query
            if(isset($_POST["heading"]) && !isset($_GET['token'])){
                $db_handle      =  new DBController();
                $description    =   $db_handle->escapeString(valid_input($_POST["description"]));
                $heading        =   $db_handle->escapeString(valid_input($_POST["heading"]));
                //$price          =   $db_handle->escapeString(valid_input($_POST["price"]));
                //$rating         =   $db_handle->escapeString(valid_input($_POST["rating"]));
                //$min_qty        =   $db_handle->escapeString(valid_input($_POST["min_qty"]));
                $img_alt        =   $db_handle->escapeString(valid_input($_POST["img_alt"]));
                $img_title      =   $db_handle->escapeString(valid_input($_POST["img_title"]));
                $parent         =   $db_handle->escapeString(valid_input($_GET["pid"]));
                $seo_title      =   $db_handle->escapeString(valid_input($_POST["seo_title"]));
                $seo_keywords   =   $db_handle->escapeString(valid_input($_POST["seo_keywords"]));
                $seo_description=   $db_handle->escapeString(valid_input($_POST["seo_description"]));
                //$add_products_tag=   $db_handle->escapeString(valid_input($_POST["products_tag"]));
                $add_additional_info=   $db_handle->escapeString(valid_input($_POST["additional_info"]));
                $slug           =   create_slug($heading);

                if(!empty($_FILES['img']['name'])){
                   $upload_img_name    = cwUpload('img','../images/','',TRUE,'../images/product/','360','360'); 
                    
                    $fields =   array(
                                        "description"=>$description,
                                        "heading"=>$heading,
                                        //"price"=>$price,
                                        //"rating"=>$rating,
                                        //"min_qty"=>$min_qty,
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                        "image"=>$upload_img_name,
                                        "parent"=>$parent,
                                        "slug"=>$slug,
                                        "seo_title"=>$seo_title,
                                        "seo_keywords"=>$seo_keywords,
                                        "seo_description"=>$seo_description,
                                        "additional_info"=> $add_additional_info,
                                        //"products_tag"=> $add_products_tag
                                    );
                if($upload_img_name == false){
                $error_msg  =   "Image Upload Failed try again !";
                }
                else{
                    
                    if($db_handle->insertQuery("products",$fields)){
                    $msg    =   true;
                    $last_id=$db_handle->last_insert_id();
                    LoadFunction("product_list.php?token=$parent");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
                } 
                
            } 
            else{
                $fields =   array(
                                        "description"=>$description,
                                        "heading"=>$heading,
                                        //"price"=>$price,
                                        //"rating"=>$rating,
                                        //"min_qty"=>$min_qty,
                                        "img_alt"=>$img_alt,
                                        "img_title"=>$img_title,
                                        "parent"=>$parent,
                                        "slug"=>$slug,
                                        "seo_title"=>$seo_title,
                                        "seo_keywords"=>$seo_keywords,
                                        "seo_description"=>$seo_description,
                                        "additional_info"=> $add_additional_info,
                                        //"products_tag"=> $add_products_tag
                                    );
                //echo "<pre>"; print_r($fields); die();
                if($db_handle->insertQuery("products",$fields)){
                     $msg    =   true;
                    $last_id=$db_handle->last_insert_id();
                    LoadFunction("product_list.php?token=$parent");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
            }
            }

        if(!isset($_GET['token'])){
        $db_handle      =  new DBController();
        $info_query =   "select * from `products` order by id desc limit 1";
        if($db_handle->numRows($info_query)>0){
            $row    =   $db_handle->RunQuery($info_query);
            $last_id    =   $row[0]["id"];
            $insertid   =   $last_id+1;
            $db_handle->Close();
            unset($db_handle);
        }
       }
    ?>

 <link href="uploader/css/uploadfilemulti.css" rel="stylesheet">
<script src="uploader/js/jquery-1.8.0.min.js"></script>
<script src="uploader/js/jquery.fileuploadmulti.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="get_images(<?php echo $_GET['token']; ?>,'service_images');">
    <div class="wrapper">
        <?php include("./includes/header.php"); ?>
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 >
            <span style="font-size: 15px;"><a href="index.php"> Home </a> > <a href="product_category.php"> Category </a> </span>
      </h1>
      
        <ol class="breadcrumb">
            <li> 
            <button style="margin-left:20px;margin-right: 30px;margin-top:-10px;" class="btn btn-info btn-icon" name="Cancel" id="save" type="button" title='Back' onclick="location.href='product_list.php?token=<?php echo $escape_pid;?>'" ><i class="fa fa-reply"></i></button> 
              <button style="margin-left:20px;margin-right: 30px;margin-top:-10px;" class="btn btn-info btn-icon" name="save" id="save" type="button" onclick="document.form.submit();" title='save & Stay'  >Save</button>
             
            </li></ol> 
    </section>

    <!-- Main content -->
    <section class="content">
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
     <form id="form" enctype="multipart/form-data" name="form" method="post">
      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
            
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pagedata" data-toggle="tab">Product Details</a></li>
             
              <li><a href="#image" data-toggle="tab">Parallax Image</a></li>
              <!-- <li><a href="#variant" data-toggle="tab">Packaging Size</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="pagedata">
              
                  <!-- Post -->
                  <div class="row" style="margin-left: 70px"><br/> 
                        <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Heading</label>
                            <div class="col-md-9">
                                <input class="form-control" id="heading" name="heading" value="<?php echo $heading; ?>" type="text">
                            </div>
                     
                        </div>

                        <!-- <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Rating (In Percentage 1 to 100)</label>
                            <div class="col-md-9">
                                <input class="form-control" id="rating" name="rating" value="<?php echo $rating; ?>" type="text" required>
                            </div>
                     
                        </div> -->
                        
                       <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Seo Title</label>
                            <div class="col-md-9">
                                <input class="form-control" id="seo_title" name="seo_title" value="<?php echo $seo_title; ?>" type="text" placeholder="Seo Title" >
                            </div>
                     
                        </div>
                       <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Seo Keywords</label>
                            <div class="col-md-9">
                                <input class="form-control" id="seo_keywords" name="seo_keywords" value="<?php echo $seo_keywords; ?>" type="text" placeholder="Seo Keywords">
                            </div>
                     
                        </div>
                       <div class="form-group clearfix">
                            <label class="col-md-2 control-label " for="heading">Seo Description</label>
                            <div class="col-md-9">
                                <input class="form-control" id="seo_description" name="seo_description" value="<?php echo $seo_description; ?>" type="text" placeholder="Seo Description">
                            </div>
                        </div>

                        <!-- <div class="form-group clearfix">
                          <label class="col-md-2 control-label " for="editor">Products Tags</label>
                            <div class="col-md-9">
                                <textarea class="form-control" cols="5" rows="5" name="products_tag" id="products_tag" placeholder="Enter Products Tags"><?php echo $products_tag; ?></textarea>
                            </div>
                          
                        </div> -->

                        <div class="form-group clearfix">
                          <label class="col-md-2 control-label " for="editor">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="editor"   value=""><?php echo $description; ?></textarea>
                            </div>
                          
                        </div>

                        <div class="form-group clearfix">
                          <label class="col-md-2 control-label " for="editor">Specification</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="additional_info" id="additional_info"   value=""><?php echo $additional_info; ?></textarea>
                            </div>
                          
                        </div>                 
                      </div>
                      
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->

              <div class="tab-pane" id="image"><br/>
                  <div class="row" style="margin-left: 70px">
                                                <div class="form-group clearfix">  
                                                       
                                                         <label class="col-md-2 control-label " for="heading">Parallax Image</label>
                                                    <div class="col-md-3">
                                                        <input class="form-control" name="img" id="parallax"   type="file">
                                            <br/>   <img id="blah" src="../images/product/<?php echo $image; ?>" alt="" width="220px;" />
                                                    </div>
                                                       
                                                  
                                                </div>
                    <br/>
                     <div class="form-group clearfix">  
                                                       
                                                         <label class="col-md-2 control-label " for="heading">Title</label>
                                                    <div class="col-md-3">
                                                        <input class="form-control" name="img_title"  type="text" value="<?php echo $img_title; ?>">
                                           
                                                    </div>
                                                       
                                                  
                                                </div>
                   <div class="form-group clearfix">  
                                                       
                                                         <label class="col-md-2 control-label " for="heading">Alt Text</label>
                                                    <div class="col-md-3">
                                                        <input class="form-control" name="img_alt" type="text" value="<?php echo $img_alt; ?>">
                                           
                                                    </div>
                                                       
                                                  
                                                </div>
                                              </div>
                                           </div>
                                          <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                      </div>
                                      <!-- /.nav-tabs-custom -->
                                    </div> 
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                 </form>
                                </section>
                                <!-- /.content -->
                              </div>
                           </div>
    
<?php include("./includes/js-meta.php"); ?>
<link href="<?php echo __WEBROOT__; ?>/uploader/css/uploadfilemulti.css" rel="stylesheet">
<script src="<?php echo __WEBROOT__; ?>/uploader/js/jquery-1.8.0.min.js"></script>
<script src="<?php echo __WEBROOT__; ?>/uploader/js/jquery.fileuploadmulti.min.js"></script> 
<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#parallax").change(function(){
    readURL(this);
});</script>
</body>
</html>