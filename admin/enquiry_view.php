<?php 
include_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Enquiry</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    //contact info add edit operation and fetch data from database
    if(isset($_GET["token"])){
        $db_handle      =  new DBController();
        $escape_token   =  $db_handle->escapeString(valid_input($_GET["token"]));
        //run query 
        $contact_info_query =   "select * from `enquiry` where id   = '".$escape_token."'";
        if($db_handle->numRows($contact_info_query)>0){
            $row    =   $db_handle->RunQuery($contact_info_query);
            $db_handle->Close();
            unset($db_handle);
            $name            =   $row[0]["name"];
            $lname           =   $row[0]["lname"];
            $email           =   $row[0]["email"];
            $msg             =   $row[0]["msg"];
            $address         =   $row[0]["address"];
            $phone           =   $row[0]["phone"];
            $pincode         =   $row[0]["pincode"];
            $date            =   $row[0]["created_at"];
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
       Enquiry 
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Enquiry View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Enquiry Details</h3>
            </div>

            <div class="box-body">
              
              <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Name:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $name;?> <?php echo $lname;?>
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
                
              </div>

              <!-- <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Pincode:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $pincode;?>
                  </label>
                
              </div> --> 

              <!-- /.form group -->

               <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Message:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo $msg;?>
                  </label>
                <!-- /.input group -->
              </div>

               <div class="form-group col-lg-12">
                <label class="col-md-3 control-label">Date:</label>
                <label class="col-md-3" style="color:#0C91A4">
                    <?php echo date("F j, Y, g:i a",strtotime($date));?>
                  </label>
                <!-- /.input group -->
              </div>

            <div class="form-group">
                

                <div>
                 
                <input type="button" name="submit" value="Back" class="btn btn-primary" onClick="document.location.href='enquiry.php'">
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
