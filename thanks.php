<?php 
require_once('includes/top.php');
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title>Home</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li>Thanks</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section class="thanks">
        <div class="container">
            <?php 
            if(isset($_GET['ord']) && !empty($_GET['ord'])):

                $order_id = $db_handle->escapeString($_GET['ord']);
                $qry = "SELECT 
                order_details.*, 
                payment_option.name, 
                payment_option.city 
              FROM 
                `order_details` 
                LEFT JOIN payment_option ON payment_option.id = order_details.payment_mode 
              WHERE 
                order_details.order_id = '$order_id'";
            if($db_handle->numRows($qry) > 0):

                $orderData = $db_handle->RunQuery($qry);
                //get order summary
                $orderSummary = $db_handle->RunQuery("SELECT order_summary.*,products.heading,products.image,ti_attributes.size
                FROM `order_summary`
                LEFT JOIN products
                ON products.id = order_summary.product_id
                LEFT JOIN ti_attributes
                ON ti_attributes.id = order_summary.varient_id
                WHERE order_id = '$order_id'");
                //get user address
                $userAdd = $db_handle->RunQuery("SELECT * FROM `user_address` WHERE uid = {$orderData[0]['user_id']}");
        ?>
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color:green">Thanks For Ordering</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                    <ul>
                        <li>
                            <b>Order Id :</b>
                            <?php echo $orderData[0]['order_id']; ?>
                        </li>
                        <li>
                            <b>Order Date :</b>
                            <?php echo date('d-m-Y',strtotime($orderData[0]['date'])); ?>
                        </li>
                        <li>
                            <b>Total Amount :</b>
                            $<?php echo $orderData[0]['total_amount']; ?>
                        </li>
                        <li>
                            <b>Payment Method :</b>
                            <?php echo $orderData[0]['city']; ?>
                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Veriant</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            if(!empty($orderSummary)):
                                $subtotal = 0;
                                foreach($orderSummary as $order_val):

                                    $sumtotal += $order_val['price'];
                                    $tprice = ($order_val['quantity']*$order_val['price']);
                        ?>
                                <tr>
                                    <td><?php echo $order_val['heading']; ?> </td>
                                    <td><?php echo $order_val['size']; ?></td>
                                    <td><?php echo $order_val['quantity']; ?> * $<?php echo $order_val['price']; ?></td>
                                    <td><?php echo $order_val['quantity']; ?></td>
                                    <td>$<?php echo $tprice; ?></td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; endif; ?>
    </section>
    <?php include("./includes/footer.php"); ?>
</body>
    <?php include("./includes/js-meta.php"); ?>
</html>