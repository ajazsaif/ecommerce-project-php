<?php include_once('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Track</title>
    <?php 
    include("./includes/head-meta.php"); 
    
    
    $db_handle          =  new DBController();
   
    //run query 
    if(isset($_GET['token'])){
        
     $escape_token              = $db_handle->escapeString(valid_input($_GET['token']));
    $feature_content_details    = "SELECT * FROM `tracking` WHERE id = '$escape_token'";
    //echo $feature_content_details;
    if($db_handle->numRows($feature_content_details)>0){
    $f_row              =   $db_handle->RunQuery($feature_content_details);
    $ship_name              =  $f_row[0]['ship_name'];
    $recv_name              =  $f_row[0]['recv_name'];
    $ship_phone             =  $f_row[0]['ship_phone'];
    $recv_phone             =  $f_row[0]['recv_phone'];
    $ship_add               =  $f_row[0]['ship_add'];
    $recv_add               =  $f_row[0]['recv_add'];
    $ship_email             =  $f_row[0]['ship_email'];
    $recv_email             =  $f_row[0]['recv_email'];
    $ship_type              =  $f_row[0]['ship_type'];
    $weight                 =  $f_row[0]['weight'];
    $courier                =  $f_row[0]['courier'];
    $packages               =  $f_row[0]['packages'];
    $mode                   =  $f_row[0]['mode'];
    $product                =  $f_row[0]['product'];
    $quantity               =  $f_row[0]['quantity'];
    $payment_mode           =  $f_row[0]['payment_mode'];
    $carrier_name           =  $f_row[0]['carrier_name'];
    $ref_no                 =  $f_row[0]['ref_no'];
    $dep_time               =  $f_row[0]['dep_time'];
    $origin                 =  $f_row[0]['origin'];
    $pick_time              =  $f_row[0]['pickup_time'];
    $pickup_date            =  $f_row[0]['pickup_date'];
    $destination            =  $f_row[0]['destination'];
    $status                 =  $f_row[0]['status'];
    $expected_date          =  $f_row[0]['expected_date'];
    $comments               =  $f_row[0]['comments'];
    $tracking_id            =  $f_row[0]['tracking_id'];
    
   
      
    }
    
}
    
    if(isset($_POST['submit']) && !isset($_GET['token'])){
       
    $db_handle              =  new DBController();
    $tracking_id            =  US.mt_rand(10000,99999);
    $ship_name              =  $db_handle->escapeString(valid_input($_POST["ship_name"]));
    $recv_name              =  $db_handle->escapeString(valid_input($_POST["recv_name"]));
    $ship_phone             =  $db_handle->escapeString(valid_input($_POST["ship_phone"]));
    $recv_phone             =  $db_handle->escapeString(valid_input($_POST["recv_phone"]));
    $ship_add               =  $db_handle->escapeString(valid_input($_POST["ship_add"]));
    $recv_add               =  $db_handle->escapeString(valid_input($_POST["recv_add"]));
    $ship_email             =  $db_handle->escapeString(valid_input($_POST["ship_email"]));
    $recv_email             =  $db_handle->escapeString(valid_input($_POST["recv_email"]));
    $ship_type              =  $db_handle->escapeString(valid_input($_POST["ship_type"]));
    $weight                 =  $db_handle->escapeString(valid_input($_POST["weight"]));
    $courier                =  $db_handle->escapeString(valid_input($_POST["courier"]));
    $packages               =  $db_handle->escapeString(valid_input($_POST["packages"]));
    $mode                   =  $db_handle->escapeString(valid_input($_POST["mode"]));
    $product                =  $db_handle->escapeString(valid_input($_POST["product"]));
    $quantity               =  $db_handle->escapeString(valid_input($_POST["quantity"]));
    $payment_mode           =  $db_handle->escapeString(valid_input($_POST["payment_mode"]));
    $carrier_name           =  $db_handle->escapeString(valid_input($_POST["carrier_name"]));
    $ref_no                 =  $db_handle->escapeString(valid_input($_POST["ref_no"]));
    $dep_time               =  $db_handle->escapeString(valid_input($_POST["dep_time"]));
    $pickup_date            =  $db_handle->escapeString(valid_input($_POST["pickup_date"]));
    $pickup_time            =  $db_handle->escapeString(valid_input($_POST["pickup_time"]));
    $destination            =  $db_handle->escapeString(valid_input($_POST["destination"]));
    $status                 =  $db_handle->escapeString(valid_input($_POST["status"]));
    $expected_date          =  $db_handle->escapeString(valid_input($_POST["expected_date"]));
    $comments               =  $db_handle->escapeString(valid_input($_POST["comments"]));
    $origin                 =  $db_handle->escapeString(valid_input($_POST["origin"]));
    
    $fields = array(
        "tracking_id"=>$tracking_id,
        "ship_name"=>$ship_name,
        "recv_name"=>$recv_name,
        "ship_phone"=>$ship_phone,
        "recv_phone"=>$recv_phone,
        "ship_add"=>$ship_add,
        "recv_add"=>$recv_add,
        "ship_email"=>$ship_email,
        "recv_email"=>$recv_email,
        "ship_type"=>$ship_type,
        "weight"=>$weight,
        "courier"=>$courier,
        "packages"=>$packages,
        "mode"=>$mode,
        "product"=>$product,
        "quantity"=>$quantity,
        "payment_mode"=>$payment_mode,
        "ref_no"=>$ref_no,
        "pickup_time"=>$pickup_time,
        "origin"=>$origin,
        "pickup_date"=>$pickup_date,
        "destination"=>$destination,
        "status"=>$status,
        "expected_date"=>$expected_date,
        "comments"=>$comments,
        "dep_time"=>$dep_time,
        "carrier_name"=>$carrier_name
    );
    if($db_handle->insertQuery("tracking",$fields)){
        $msg    =   true;
        LoadFunction("track-list.php");
        $db_handle->Close();
        unset($db_handle);
    }
    else{
        $error_msg  =   "Failed ! Pls try again ";
    }
        
        
        
    }
//update query
    if(isset($_POST['submit']) && isset($_GET['token'])){
       
    $db_handle              =  new DBController();
    //$tracking_id            =  US.mt_rand(10000,99999);
    $ship_name              =  $db_handle->escapeString(valid_input($_POST["ship_name"]));
    $recv_name              =  $db_handle->escapeString(valid_input($_POST["recv_name"]));
    $ship_phone             =  $db_handle->escapeString(valid_input($_POST["ship_phone"]));
    $recv_phone             =  $db_handle->escapeString(valid_input($_POST["recv_phone"]));
    $ship_add               =  $db_handle->escapeString(valid_input($_POST["ship_add"]));
    $recv_add               =  $db_handle->escapeString(valid_input($_POST["recv_add"]));
    $ship_email             =  $db_handle->escapeString(valid_input($_POST["ship_email"]));
    $recv_email             =  $db_handle->escapeString(valid_input($_POST["recv_email"]));
    $ship_type              =  $db_handle->escapeString(valid_input($_POST["ship_type"]));
    $weight                 =  $db_handle->escapeString(valid_input($_POST["weight"]));
    $courier                =  $db_handle->escapeString(valid_input($_POST["courier"]));
    $packages               =  $db_handle->escapeString(valid_input($_POST["packages"]));
    $mode                   =  $db_handle->escapeString(valid_input($_POST["mode"]));
    $product                =  $db_handle->escapeString(valid_input($_POST["product"]));
    $quantity               =  $db_handle->escapeString(valid_input($_POST["quantity"]));
    $payment_mode           =  $db_handle->escapeString(valid_input($_POST["payment_mode"]));
    $carrier_name           =  $db_handle->escapeString(valid_input($_POST["carrier_name"]));
    $ref_no                 =  $db_handle->escapeString(valid_input($_POST["ref_no"]));
    $dep_time               =  $db_handle->escapeString(valid_input($_POST["dep_time"]));
    $pickup_date            =  $db_handle->escapeString(valid_input($_POST["pickup_date"]));
    $pickup_time            =  $db_handle->escapeString(valid_input($_POST["pickup_time"]));
    $destination            =  $db_handle->escapeString(valid_input($_POST["destination"]));
    $status                 =  $db_handle->escapeString(valid_input($_POST["status"]));
    $expected_date          =  $db_handle->escapeString(valid_input($_POST["expected_date"]));
    $comments               =  $db_handle->escapeString(valid_input($_POST["comments"]));
    $origin                 =  $db_handle->escapeString(valid_input($_POST["origin"]));
    
    $fields = array(
        "ship_name"=>$ship_name,
        "recv_name"=>$recv_name,
        "ship_phone"=>$ship_phone,
        "recv_phone"=>$recv_phone,
        "ship_add"=>$ship_add,
        "recv_add"=>$recv_add,
        "ship_email"=>$ship_email,
        "recv_email"=>$recv_email,
        "ship_type"=>$ship_type,
        "weight"=>$weight,
        "courier"=>$courier,
        "packages"=>$packages,
        "mode"=>$mode,
        "product"=>$product,
        "quantity"=>$quantity,
        "payment_mode"=>$payment_mode,
        "ref_no"=>$ref_no,
        "pickup_time"=>$pickup_time,
        "origin"=>$origin,
        "pickup_date"=>$pickup_date,
        "destination"=>$destination,
        "status"=>$status,
        "expected_date"=>$expected_date,
        "comments"=>$comments,
        "dep_time"=>$dep_time,
        "carrier_name"=>$carrier_name
    );
    if($db_handle->updateQuery("tracking",$fields,"id = '$escape_token'")){
        $msg    =   true;
        LoadFunction("track-list.php");
        $db_handle->Close();
        unset($db_handle);
    }
    else{
        $error_msg  =   "Failed ! Pls try again ";
    }
        
        
        
    }
    
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include("./includes/header.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Track<small>Details</small></h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo __WEBROOT__?>/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Track</li>
                </ol>
            </section>
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
                <form class="track" action="" method="post">
                    <div class="row">
                        <div class="col-md-5">
                            <h2>Shipper Details</h2>
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Shipper Name:</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="ship_name" value="<?php echo $ship_name;?>"/>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Phone Number:</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="ship_phone" value="<?php echo $ship_phone;?>"/>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Address:</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="ship_add" value="<?php echo $ship_add;?>"/>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Email:</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="email" id="" name="ship_email" value="<?php echo $ship_email;?>" />
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                        <h2>Receiver Details</h2>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-12">Receiver Name:</label>
                            <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="recv_name" value="<?php echo $recv_name;?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-12">Phone Number:</label>
                            <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="recv_phone" value="<?php echo $recv_phone;?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-12">Address:</label>
                            <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="recv_add" value="<?php echo $recv_add;?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-12">Email:</label>
                            <input class="col-lg-8 col-md-8 col-sm-12" type="email" id=""  name="recv_email"  value="<?php echo $recv_email;?>"/>
                        </div>
                    </div>
                        <div class="col-md-12">
                            <h2>Shipment Details</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Type of Shipment</label>
                                <select class="col-lg-8 col-md-8 col-sm-12" name="ship_type">
                                     <option value="">-- Select One --</option>
                                    <option value="air freight" <?php if($ship_type == 'air freight'){ echo "selected";}?>>AIR FREIGHT</option>
                                    <option value="land freight" <?php if($ship_type == 'land freight'){ echo "selected";}?>>LAND FREIGHT</option>
                                    <option value="ocean freight" <?php if($ship_type == 'ocean freight'){ echo "selected";}?>>OCEAN FREIGHT</option>
                                    <option value="rail freight" <?php if($ship_type == 'rail freight'){ echo "selected";}?>>RAIL FREIGHT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Weight : </label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="weight" value="<?php echo $weight;?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Courier :</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="courier" value="<?php echo $courier;?>" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Packages :</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="packages"  value="<?php echo $packages;?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Mode :</label>
                                <select class="col-lg-8 col-md-8 col-sm-12" name="mode">
                                    <option value="">--Select One--</option>
                                    <option value="air" <?php if($mode == 'air'){ echo "selected";}?>>AIR</option>
                                    <option value="road" <?php if($mode == 'road'){ echo "selected";}?>>ROAD</option>
                                    <option value="ocean" <?php if($mode == 'ocean'){ echo "selected";}?>>OCEAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Product :</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id=""  name="product" value="<?php echo $product;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Quantity :</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id=""  name="quantity" value="<?php echo $quantity;?>"/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Payment Mode :</label>
                                <select class="col-lg-8 col-md-8 col-sm-12" name="payment_mode">
                                    <option value="">--Select One--</option>
                                    <option value="BIT COIN"  <?php if($payment_mode == 'BIT COIN'){ echo "selected";}?>> BIT COIN </option>
                                  <option value="PAYPAL"  <?php if($payment_mode == 'PAYPAL'){ echo "selected";}?>> PAYPAL </option>
                                  <option value="WIRE TRANSFER"  <?php if($payment_mode == 'WIRE TRANSFER'){ echo "selected";}?>> WIRE TRANSFER </option>
                                  <option value="BANK DEPOSIT"  <?php if($payment_mode == 'BANK DEPOSIT'){ echo "selected";}?>> BANK DEPOSIT </option>
                                  <option value="MONEY GRAM"  <?php if($payment_mode == 'MONEY GRAM'){ echo "selected";}?>> MONEY GRAM </option>
                                  <option value="WESTERN UNION"  <?php if($payment_mode == 'WESTERN UNION'){ echo "selected";}?>> WESTERN UNION </option>
                                </select>
                            </div>
                        </div>
                    </div><div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Carrier Name:</label>
                                <select class="col-lg-8 col-md-8 col-sm-12" name="carrier_name">
                                <option value="">--Select One--</option>
                                <option value="FedEx" <?php if($carrier_name == 'FedEx'){ echo "selected";}?>>FedEx</option>
                              <option value="Ups" <?php if($carrier_name == 'Ups'){ echo "selected";}?>>Ups</option>
                              <option value="TNT" <?php if($carrier_name == 'TNT'){ echo "selected";}?>>TNT</option>
                              <option value="Maritime london" <?php if($carrier_name == 'Maritime london'){ echo "selected";}?>>Maritime london</option>
                              <option value="DHL" <?php if($carrier_name == 'DHL'){ echo "selected";}?>>DHL</option>
                              <option value="i-Parcel" <?php if($carrier_name == 'i-Parcel'){ echo "selected";}?>>i-Parcel</option>
                              <option value="MAERSK" <?php if($carrier_name == 'MAERSK'){ echo "selected";}?>>MAERSK</option>
                              <option value="BREX EXPRESS" <?php if($carrier_name == 'BREX EXPRESS'){ echo "selected";}?>>BREX EXPRESS</option>
                              <option value="BREX PARCEL" <?php if($carrier_name == 'BREX PARCEL'){ echo "selected";}?>>BREX PARCEL</option>
                              <option value="BREX MAIL" <?php if($carrier_name == 'BREX MAIL'){ echo "selected";}?>>BREX MAIL</option>
                              <option value="BREX UNDISCLOSED" <?php if($carrier_name == 'BREX UNDISCLOSED'){ echo "selected";}?>>BREX UNDISCLOSED</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Carrier Reference No.:</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="" name="ref_no"  value="<?php echo $ref_no;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Departure Time:</label>
                                <div class="bootstrap-timepicker timealign">
                                    <div class="col-lg-8 col-md-8 col-sm-12" style="padding:0;">
                                        <input type="text" class="form-control timepicker" name="dep_time"  value="<?php echo $dep_time;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Origin :</label>
                                <div class="col-lg-8 col-md-8 col-sm-12" style="padding:0;">
                                <input type="text" class="form-control" name="origin"  value="<?php echo $origin;?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Pickup Time :</label>
                                <div class="bootstrap-timepicker timealign">
                                    <div class="col-lg-8 col-md-8 col-sm-12" style="padding:0;">
                                        <input type="text" class="form-control timepicker" name="pickup_time">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12" id="">Pickup Date :</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="datepicker" name="pickup_date" value="<?php echo $pickup_date;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Destination :</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" name="destination" value="<?php echo $destination;?>"/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Status :</label>
                                <select class="col-lg-8 col-md-8 col-sm-12" name="status">
                                    <option value="">-- Select One --</option>
                                    <option value="ACTIVE" <?php if($status == 'ACTIVE'){ echo "selected";}?>>ACTIVE</option>
                                    <option value="ON HOLD" <?php if($status == 'ON HOLD'){ echo "selected";}?>>ON HOLD</option>
                                    <option value="IN TRANSIT" <?php if($status == 'IN TRANSIT'){ echo "selected";}?>>IN TRANSIT</option>
                                    <option value="DELIVERED" <?php if($status == 'DELIVERED'){ echo "selected";}?>>DELIVERED</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Expected Delivery Date:</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="expected_date" name="expected_date" value="<?php echo $expected_date;?>"/>
                            </div>
                        </div>
                         
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-lg-4 col-md-4 col-sm-12">Comments</label>
                                <input class="col-lg-8 col-md-8 col-sm-12" type="text" id="comments" name="comments" value="<?php echo $comments;?>"/>
                            </div>
                        </div> 
                    </div>
                    <input type="submit" name="submit" value="UPDATE" class="btn btn-primary">
                </form>
            </section>
        </div>
    </div>
    
<?php include("./includes/js-meta.php"); ?>
   <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
       $('#expected_date').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

</body>
</html>
