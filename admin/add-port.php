<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Faqs Edit</title>
    <?php 
    include("./includes/head-meta.php"); 
    
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `ti_port` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $name           =   $row[0]["name"];
            $icon           =   $row[0]["icon"];
            $content        =   $row[0]["description"];

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
                $db_handle      =  new DBController();
                $add_icon       =   $db_handle->escapeString(valid_input($_POST["icon"]));
                $add_name       =   $db_handle->escapeString(valid_input($_POST["name"]));
                $content_add    =   $db_handle->escapeString(valid_input($_POST["description"]));

                $fields =   array(
                                        "name"=>$add_name,
                                        "icon"=>$add_icon,
                                        "description"=>$content_add
                                    );
                    if($db_handle->updateQuery("ti_port",$fields,"id = '$escape_token'")){
                        $msg    =   true;
                        LoadFunction("portfolio.php");
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
                $add_name       =   $db_handle->escapeString(valid_input($_POST["name"]));
                $add_icon       =   $db_handle->escapeString(valid_input($_POST["icon"]));
                $content_add    =   $db_handle->escapeString(valid_input($_POST["description"]));

                $fields =   array(  "description"=>$content_add,
                                    "icon"=>$add_icon,
                                    "name"=>$add_name
                                    );
                if($db_handle->insertQuery("ti_port",$fields)){
                     $msg    =   true;
                    LoadFunction("portfolio.php");
                    $db_handle->Close();
                    unset($db_handle);
                    }
                else{
                    $error_msg  =   "Failed !";
                }
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
        <?php 
          if(isset($_GET['token'])){
          ?>
        Faqs Edit
          <?php } else { ?>
           Faqs Add
          <?php } ?>
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo __WEBROOT__?>/portfolio.php"><i class="fa fa-quote-left"></i> Faqs</a></li>
           <li><?php echo ucfirst($name);?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
                <?php 
          if(isset($_GET['token'])){
          ?>
              <h3 class="box-title">Faqs Edit Details</h3>
                <?php } else { ?>
                 <h3 class="box-title">Faqs Add Details</h3>
                <?php } ?>
                
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
              
              <div class="form-group">
                <label>Heading:</label>

                <div>
                  
                  <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
                <!-- /.input group -->
              </div>
                  <!-- <div class="form-group">
                <label>Icon Class (Use link <a href="https://fontawesome.com/" target="_blank">Font Awesome</a> for icons ):</label>
                
                <div>
                  <input type="text" class="form-control" name="icon" value="<?php echo $icon;?>">
                </div>

              </div> -->
              <!-- /.form group -->

              <div class="form-group">
                <label>Description:</label>

                <div>
                 
                  <textarea name="description" id="editor" class="form-control"><?php echo $content;?></textarea>
                </div>
                <!-- /.input group -->
              </div>

              <!-- phone mask -->
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
    
<?php include("./includes/js-meta.php"); ?>
    <script type="text/javascript">
    function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
    
    
    </script>

</body>
</html>
