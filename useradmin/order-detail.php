<?php 
include_once('../includes/top.php');
if(empty($_SESSION['vemail']) || ($_SESSION['plogin'] != 'true')){
    redirect_page_url(__WEBROOT__.'/register.php');
}
if(isset($_SESSION['vemail']) && ($_SESSION['vrole'] == 'user')){
    $user_query     = "SELECT * FROM `users` WHERE email = '".$_SESSION['vemail']."'";
    $db_handle      =  new DBController();
    if($db_handle->numRows($user_query)>0){
      $user_details = $db_handle->RunQuery($user_query);    
    } 

 $ref=$_REQUEST['token'];
 $ord_query     =   "SELECT * FROM `order_details` WHERE order_id='$ref'";
  if($db_handle->numRows($ord_query)>0){
      $ord            =   $db_handle->RunQuery($ord_query);
      $user_id        =   $ord[0]["user_id"];
      $payment_mode   =   $ord[0]["payment_mode"];
      $total_amount   =   $ord[0]["total_amount"];
      $holder_name    =   $ord[0]["holder_name"];
      $card_number    =   $ord[0]["card_number"];
      $exp_date_mm    =   $ord[0]["exp_date_mm"];
      $exp_date_yy    =   $ord[0]["exp_date_yy"];
      $date           =   $ord[0]["date"];
      //$ship_method    =   $ord[0]["ship_method"];
      $ship_method    =   $ord[0]["ship_method"];
      $ship_charge    =   $ord[0]["ship_charge"];
      $coupon_code_amnt    =   $ord[0]["coupon_code_amnt"];
      $coupon_code_id    =   $ord[0]["coupon_code_id"];
      $payment_details =  $db_handle->RunQuery("SELECT name,city FROM `payment_option` WHERE id = {$payment_mode}");
  }
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Order-detail</title>
    <?php 
    define('nashahead',TRUE);
    include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="history.php">Orders</a></li>
        <li class="active">Order Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $page_title;?>
            <small class="pull-right">Date: <?php echo date('d/m/Y',strtotime($date));?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <?php $cat_info_query     =   "SELECT * FROM `ti_contact_us`";
            if($db_handle->numRows($cat_info_query)>0){
                $row    =   $db_handle->RunQuery($cat_info_query);
                $phone          =   $row[0]["phone"];
                $email          =   $row[0]["email"];
                $main_office    =   $row[0]["main_office"];
                } ?>

            <strong><?php echo $page_title;?></strong><br>
            <?php echo $main_office;?><br>
            Phone: <?php echo $phone;?><br>
            Email: <?php echo $email;?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <strong>Billing Address</strong>
          <address>
            <?php $user_query     =   "SELECT * FROM `user_address` WHERE uid='$user_id' and type='bill'";
            if($db_handle->numRows($user_query)>0){
                $usr    =   $db_handle->RunQuery($user_query);
                $name        =   $usr[0]["fname"];
                $lname       =   $usr[0]["lname"];
                $uaddress    =   $usr[0]["address"];
                $uaddress_alt=   $usr[0]["address_alt"];
                $uphone      =   $usr[0]["phone"];
                $uemail      =   $usr[0]["email"];
                $ucity       =   $usr[0]["city"];
                $ustate      =   $usr[0]["state"];
                $uzipcode    =   $usr[0]["zip_code"];
                $ucountry    =   $usr[0]["country"];
                } ?>
            <?php echo $name;?> &nbsp;<?php echo $lname;?><br>
            Phone: <?php echo $uphone;?><br>
            Email: <?php echo $uemail;?><br>
            Address: <?php echo $uaddress;?><br>
            Address Optional: <?php echo $uaddress_alt;?><br>
            City: <?php echo $ucity;?><br>
            State: <?php echo $ustate;?><br>
            Zipcode: <?php echo $uzipcode;?><br>
             Country: <?php echo $ucountry;?><br>
          </address>
        </div>

        <div class="col-sm-3 invoice-col">
          <strong>Delivery Address</strong>
          <address>
            <?php $user_query     =   "SELECT * FROM `user_address` WHERE uid='$user_id' and type='ship'";
            if($db_handle->numRows($user_query)>0){
                $usr    =   $db_handle->RunQuery($user_query);
                $name        =   $usr[0]["fname"];
                $lname       =   $usr[0]["lname"];
                $uaddress    =   $usr[0]["address"];
                $uaddress_alt=   $usr[0]["address_alt"];
                $uphone      =   $usr[0]["phone"];
                $uemail      =   $usr[0]["email"];
                $ucity       =   $usr[0]["city"];
                $ustate      =   $usr[0]["state"];
                $uzipcode    =   $usr[0]["zip_code"];
                $ucountry    =   $usr[0]["country"];
                } ?>
            <?php echo $name;?> &nbsp;<?php echo $lname;?><br>
            Phone: <?php echo $uphone;?><br>
            Email: <?php echo $uemail;?><br>
            Address: <?php echo $uaddress;?><br>
            Address Optional: <?php echo $uaddress_alt;?><br>
            City: <?php echo $ucity;?><br>
            State: <?php echo $ustate;?><br>
            Zipcode: <?php echo $uzipcode;?><br>
             Country: <?php echo $ucountry;?><br>
          </address>
        </div>

        <div class="col-sm-4 invoice-col">
          <b>Order Description</b><br>
          <b>Order ID:</b> <?php echo $ref;?><br>
          <b>Order Date:</b> <?php echo date('d/m/Y',strtotime($date));?><br>
          <b>Order Amount:</b> $<?php echo $total_amount;?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Image</th>
              <th>Product</th>
              <th>Variant</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                   
                     $order_info_query        =   "SELECT * FROM `order_summary` WHERE order_id='$ref'";
                    if($db_handle->numRows($order_info_query)>0){
                        $row                =   $db_handle->RunQuery($order_info_query);
                         for($i = 0; $i< count($row);$i++){
                        $pro_name        =   $row[$i]["pro_name"];
                        $product_id        =   $row[$i]["product_id"];
                        $price           =   $row[$i]["price"];
                        $variant           =   $row[$i]["variant"];
                        $quantity        =   $row[$i]["quantity"];
                        $total_price     =   $row[$i]["total_price"];
                        $subtotal        =   $subtotal+$total_price;

                    $info_query        =   "SELECT * FROM `products` WHERE id='$product_id'";
                    if($db_handle->numRows($info_query)>0){
                    $ord1            =   $db_handle->RunQuery($info_query);
                    $image           =   $ord1[0]["image"];
                    }
                ?>
            <tr>
              <td><img src="../images/product/<?php echo $image;?>" width="60" height="40"></td>
              <td><?php echo $pro_name;?></td>
              <td><?php echo $variant;?></td>
               <td><?php echo $quantity;?></td>
              <td>$<?php echo $price;?></td>
              <td>$<?php echo $total_price;?></td>
            </tr>
           <?php } }?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <?php echo ucfirst($payment_details[0]['city']);?>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Detail</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$<?php echo $subtotal;?></td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td><?php echo $ship_method; ?> ($<?php echo $ship_charge;?>)</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$<?php echo $total_amount;?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
     <div class="row no-print">
        <div class="col-xs-12">
         <!--  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
         <!--  <button type="button" class="btn btn-success pull-right" onclick="print_view()"><i class="fa fa-print"></i> Print
          </button> -->
          <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="print_view()">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>
  </br></br></br>
    <!-- /.content -->
  </div>
</div>
    
<?php include("./includes/js-meta.php"); ?>
<script>
function print_view() {
    window.print();
}
</script>
</body>
</html>
<?php 
$db_handle->close();
unset($db_handle);
} 
else {  
redirect_page_url(__WEBROOT__.'/index.php');
}
?>