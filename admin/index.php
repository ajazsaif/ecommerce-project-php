<?php 
include_once('includes/config.php');
//get total services from data base
$db_handle          =  new DBController();
//$cat_query     =   "select id from `products` where parent='0'";
//$cat_rows       =   $db_handle->numRows($cat_query);
//fetch tital enquiry from database
$enq_query          =   "select id from `enquiry` ";
$eqn_rows           =   $db_handle->numRows($enq_query);

$usr_query          =   "select id from `users`";
$usr_rows           =   $db_handle->numRows($usr_query);

$ord_query          =   "select id from `order_details`";
$ord_rows           =   $db_handle->numRows($ord_query);


//fetch total get quote from database
$product_query        =   "select id from `products` where parent!='0'";
$product_rows         =   $db_handle->numRows($product_query);

//total visitors fetch form data base
$visitior          =   "select id from `visitor_counter`";
$visitior_rows      =  $db_handle->numRows($visitior);

$today = date('Y-m-d');
$year = date('Y');
if(isset($_GET['year'])){
  $year = $_GET['year'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title;?> | Dashboard</title>
    <?php include("./includes/head-meta.php"); ?>
    <style type="text/css">
      .mt20{
        margin-top:20px;
      }
      .bold{
        font-weight:bold;
      }

     /* chart style*/
      #legend ul {
        list-style: none;
      }

      #legend ul li {
        display: inline;
        padding-left: 30px;
        position: relative;
        margin-bottom: 4px;
        border-radius: 5px;
        padding: 2px 8px 2px 28px;
        font-size: 14px;
        cursor: default;
        -webkit-transition: background-color 200ms ease-in-out;
        -moz-transition: background-color 200ms ease-in-out;
        -o-transition: background-color 200ms ease-in-out;
        transition: background-color 200ms ease-in-out;
      }

      #legend li span {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 100%;
        border-radius: 5px;
      }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include("./includes/header.php"); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $ord_rows;?></h3>

                  <p>Total Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="order-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $usr_rows;?></h3>

                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="userlist.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $eqn_rows; ?></h3>

                  <p>Contact Enquiries</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="enquiry.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $product_rows;?></h3>

                  <p>Total Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="product_category.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Monthly Orders</h3>
                  <div id="legend" class="text-center">
                   <ul class="bar-legend"><li><span style="background-color:rgba(210, 214, 222, 1)"></span>Inquires</li><li><span style="background-color:#00a65a"></span>Orders</li>
                   </ul>
                </div>
                  <div class="box-tools pull-right">
                    <form class="form-inline">
                      <div class="form-group">
                        <label>Select Year: </label>
                        <select class="form-control input-sm" id="select_year">
                          <?php
                            for($i=2015; $i<=2065; $i++){
                              $selected = ($i==$year)?'selected':'';
                              echo "
                                <option value='".$i."' ".$selected.">".$i."</option>
                              ";
                            }
                          ?>
                        </select>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                      </p>

                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="barChart" style="height: 230px;"></canvas>
                      </div>
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Status</strong>
                      </p>

                      <!-- <div class="progress-group">
                        <span class="progress-text">Unique Visitors</span>
                        <span class="progress-number"><b><?php echo $visitior_rows;?></b></span>

                        <div class="progress sm">
                          <div class="progress-bar progress-bar-aqua" style="width: <?php echo $visitior_rows;?>%"></div>
                        </div>
                      </div> -->
                      <!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">User Registrations</span>
                        <span class="progress-number"><b><?php echo $usr_rows;?></b></span>

                        <div class="progress sm">
                          <div class="progress-bar progress-bar-red" style="width: <?php echo $usr_rows;?>%"></div>
                        </div>
                      </div>
                      <!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Inquiries</span>
                        <span class="progress-number"><b><?php echo $eqn_rows;?></b></span>

                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: <?php echo $eqn_rows;?>%"></div>
                        </div>
                      </div>
                      <!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Total Products</span>
                        <span class="progress-number"><b><?php echo $product_rows;?></b></span>

                        <div class="progress sm">
                          <div class="progress-bar progress-bar-yellow" style="width: <?php echo $product_rows;?>%"></div>
                        </div>
                      </div>
                      <!-- /.progress-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./box-body -->
                
                <!-- /.box-footer -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
</div>
<?php $and = 'AND YEAR(date) = '.$year;
      $and_inq = 'AND YEAR(created_at) = '.$year;
  $months = array();
  $leaves = array();
  $work_days = array();

  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT * FROM enquiry WHERE MONTH(created_at) = '$m' AND type = 'contact' $and_inq";
    $leave           =   $db_handle->numRows($sql);
    array_push($leaves, $leave);

    $sql = "SELECT * FROM order_details WHERE MONTH(date) = '$m' $and";
    $work_day         =   $db_handle->numRows($sql);
    array_push($work_days, $work_day);

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months    = json_encode($months);
  $leaves    = json_encode($leaves);
  $work_days = json_encode($work_days); 
  ?>    
<?php include("./includes/js-meta.php"); ?>
<!--     <script src="<?php //echo __WEBROOT__; ?>/js/dashboard2.js"></script> -->
 <script>
$(function () {
  // -----------------------
  // - MONTHLY ORDERS AND INQUIRY CHART -
  // -----------------------

  var areaChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Electronics',
        fillColor           : 'rgb(210, 214, 222)',
        strokeColor         : 'rgb(210, 214, 222)',
        pointColor          : 'rgb(210, 214, 222)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgb(220,220,220)',
        data                : <?php echo $leaves; ?>
      },
      {
        label               : 'Digital Goods',
        fillColor           : '#00a65a',
        strokeColor         : '#00a65a',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $work_days; ?>
      }
    ]
  };

  var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  }); 
</script>    
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'index.php?year='+$(this).val();
  });
});
</script>   
</body>
</html>
