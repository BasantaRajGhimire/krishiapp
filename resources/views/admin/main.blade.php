<?php
if (!request()->ajax()):
    include(resource_path() . '/views/header.php');
    include(resource_path() . '/views/admin/leftmail-aside.php');
endif;
$model = new \App\Admin\AdminUsers();
$clientPostCount = $model->clientPostCount();
$clientRegisteredCount = $model->clientRegisteredCount();
$serviceProviderRegisteredCount = $model->serviceProviderRegisteredCount();
$completedBidPostCount = $model->completedBidPostCount();
$datas = (new App\Admin\ServiceProviderReporting())->graphDelivered();
?>
<style type="text/css">
  .content-header{
    padding: 15px 15px 15px 0px !important;
  }
</style>
<div id="first-body" class="col-md-12 no-padding"  style="background-color: #ecf0f5">
  <section class="content-header">
    <h1>
        Dashboard
        <small>Admin Panel</small>
      </h1>
  </section>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Clients Registered</span>
                  <span class="info-box-number">{{$clientRegisteredCount}} <small>members</small></span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Client Posts</span>
                  <span class="info-box-number">{{$clientPostCount}} <small>post</small></span>
                </div>
              </div>
            </div>
    
             <!--fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
    
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Service Provider</span>
                  <span class="info-box-number">{{$serviceProviderRegisteredCount}} <small>members</small></span>
                </div>
              </div> 
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Completed</span>
                  <span class="info-box-number">{{$completedBidPostCount}} <small>bid</small></span>
                </div>
              </div>
            </div>
          </div>
</div>

<div id="first-body" class="col-md-12 no-padding"  style="background-color: #ecf0f5">
  <section class="content-header">
    <h1>
        Analytics
        <small>Service Provider</small>
      </h1>
  </section>
  <div class="row">
    <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Monthly Bid Delivered Report</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">2019</a></li>
                  <li><a href="#">2020</a></li>
                  <li><a href="#">2021</a></li>
                  <!-- <li class="divider"></li>
                  <li><a href="#">Separated link</a></li> -->
                </ul>
              </div>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-10">
                <p class="text-center">
                  <strong> Posts : 1 Jan, {{date('Y')}} - 30 Dec, {{date('Y')}}</strong>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" style="height: 180px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
    </div>

        <!--fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

  </div>
</div>

<script src="<?php echo asset('assets/plugins/chartjs/Chart.js');?>"></script>

<script type="text/javascript" src="{{ asset('assets/plugins/sparkline/jquery.sparkline.js') }}"></script>
<script>
  //  getMonthlyData();
  var monthCompletedData = <?php echo '["' . implode('", "', $datas['completed']) . '"]' ?>;
  var monthBiddedData = <?php echo '["' . implode('", "', $datas['bidded']) . '"]' ?>;
  var monthTotalData = <?php echo '["' . implode('", "', $datas['total']) . '"]' ?>;
  // console.log(monthCompletedData);
  // var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
 	// var salesChart = new Chart(salesChartCanvas);

    //bar graph for bidding

   var bidChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July","August","Sep","Oct",'Nov','Dec'],
    datasets: [
      {
        label: "Total Post",
        fillColor: "rgb(0, 123, 123)",
        strokeColor: "rgb(110, 214, 222)",
        pointColor: "rgb(110, 214, 222)",
        pointStrokeColor: "#007b7b",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: monthTotalData
      },
      {
        label: "Total bids",
        fillColor: "#9f7612",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: monthBiddedData
      },
      {
        label: "Bid Completed",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: monthCompletedData
      },
      
    ]
  };  

    var barChartCanvas                   = $('#salesChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = bidChartData
    barChartData.datasets[0].fillColor   = '#00a65a'
    barChartData.datasets[0].strokeColor = '#00a65a'
    barChartData.datasets[0].pointColor  = '#00a65a'
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
  </script>
<?php
if (!request()->ajax()):
    include(resource_path() . '/views/footer.php');
endif;
?>
