<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | User Details</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `user_address` where user_id   = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $fname           =   $row[0]["fname"];
            $lname           =   $row[0]["lname"];
            $email           =   $row[0]["email"];
            $phone           =   $row[0]["phone"];
            $address         =   $row[0]["address"];
            $address_alt     =   $row[0]["address_alt"];
            $city            =   $row[0]["city"];
            $state           =   $row[0]["state"];
            $country         =   $row[0]["country"];
            $zip             =   $row[0]["zip_code"];
        }
        else{
           // LoadFunction("404.php");
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
       User 
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>User Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
            </div>

            <div class="box-body">
              
              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">First Name:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $fname;?>
                  </label>
                <!-- /.input group -->
              </div>
             
             <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Last Name:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $lname;?>
                  </label>
                <!-- /.input group -->
              </div>     
             
             <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Email:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $email;?>
                  </label>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Phone:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $phone;?>
                  </label>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Address:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $address;?>
                  </label>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Alternate Address:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $address_alt;?>
                  </label>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

               <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">City:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $city;?>
                  </label>
                <!-- /.input group -->
              </div>

              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">State:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $state;?>
                  </label>
                <!-- /.input group -->
              </div>

              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Country:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $country;?>
                  </label>
                <!-- /.input group -->
              </div>

               <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Zip Code:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $zip;?>
                  </label>
                <!-- /.input group -->
              </div>

            <div class="form-group">
                

                <div>
                 
                <input type="button" name="submit" value="Back" class="btn btn-primary" onClick="document.location.href='userlist.php'">
                </div>
                <!-- /.input group -->
              </div>
            </div>
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
    

</body>
</html>
