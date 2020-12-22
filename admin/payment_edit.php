<?php 
include_once('includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Payment Option</title>
    <?php 
    include("./includes/head-meta.php"); 
    
   //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `payment_option` where id = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $country        =   $row[0]["country"];
            $name           =   $row[0]["name"];
            $city           =   $row[0]["city"];
            $state          =   $row[0]["state"];
            $zip            =   $row[0]["zip"];

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
                $country    =   $db_handle->escapeString(valid_input($_POST["country"]));
                $name       =   $db_handle->escapeString(valid_input($_POST["name"]));
                $city    =   $db_handle->escapeString(valid_input($_POST["city"]));
                $zip       =   $db_handle->escapeString(valid_input($_POST["zip"]));
                $state       =   $db_handle->escapeString(valid_input($_POST["state"]));
            
                $fields =   array(
                                        "name"=>$name,
                                        "city"=>$city,
                                        "state"=>$state,
                                        "country"=>$country,
                                        "zip"=>$zip
                                    );
                    if($db_handle->updateQuery("payment_option",$fields,"id = '$escape_token'")){
                        $msg    =   true;
                        LoadFunction("payment_option.php");
                        $db_handle->Close();
                        unset($db_handle);
                    }
                    else{
                        $error_msg  =   "Failed ! pls try again";
                    }      
                
            }  

            if(isset($_POST["submit"]) && !isset($_GET['token'])){

              LoadFunction("payment_option.php");
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
        Payment Edit
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo __WEBROOT__?>/testi.php"><i class="fa fa-quote-left"></i> Payment Option</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Payment Edit Details</h3>
                
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
                <label><?php echo $city; ?> Address:</label>

                <div>
                  <textarea name="name" class="form-control" id="editor" rows="5"><?php echo $name;?></textarea>
                </div>
                <!-- /.input group -->
              </div>
              
              <div class="form-group">
                <label>Payment Option:</label>

                <div>
                  
                  <input type="text" class="form-control" name="city" value="<?php echo $city;?>">
                </div>
                <!-- /.input group -->
              </div>
 
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
