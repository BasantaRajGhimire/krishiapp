<?php
include(resource_path() . '/views/service_provider/header.blade.php');
$baseModel = new App\BaseModel();
$data = (new App\ServiceProvider\User())->getMonthlyWiseWinPost();
// dd($data);
?>
<style type="text/css">
  .nav-tabs {
    color: #000;
  }

  .nav-tabs>li.active>a,
  .nav-tabs>li.active>a:focus,
  .nav-tabs>li.active>a:hover {
    color: #000;
  }

  .nav-tabs-custom>.nav-tabs>li {
    border: 0px;
  }

  .tab-content div.active {
    color: #000;
  }

  .tab-content {
    min-height: 400px;
  }

  .activity {
    padding: 10px;
    margin: 0px !important;
  }

  .service {
    color: #3dbb3d;
  }

  .material {
    color: #f75858;
  }

  .badge-success {
    background-color: #28a745;
  }

  .badge-warning {
    background: #ffc107;
  }

  .badge-info {
    background: #17a2b8;
  }

  .badge-danger {
    background: #dc3545;
  }

  .badge-success,
  .badge-warning,
  .badge-info,
  .badge-danger {
    color: #fff;
  }

  .progress {
    border: 1px solid #ccc;
  }

  .glyphicon {
    margin-right: 5px;
  }

  .rating .glyphicon {
    font-size: 22px;
  }

  .rating-num {
    margin-top: 0px;
    font-size: 54px;
  }

  .progress {
    margin-bottom: 5px;
  }

  .progress-bar {
    text-align: left;
  }

  .rating-desc .col-md-3 {
    padding-right: 0px;
  }

  .bid-rating .sr-only {
    margin-left: 30px;
    overflow: visible;
    clip: auto;
    color: #a23131;
    background: #fff
  }

  .bid-rating .well {
    background: #fff
  }
</style>
<div class="row m-0 activity">
  <h2 class="page-header px-3">Your Activity</h2>
  <div class="col-md-8">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <div class="tab-content p-0">
        <div class="tab-pane active" id="tab_1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bid Statement</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Post Category</th>
                      <th>Description</th>
                      <th>Bid Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $p_count = 0;$w_count = 0;$we_count = 0; $wc_count =0; @endphp
                    @foreach($posts as $p)
                    <tr>
                      @php
                      if($p->bid_status==1):
                      $p_count++;
                      elseif($p->bid_status==3):
                      $w_count++;
                      elseif($p->bid_status==2):
                      $we_count++;
                      else:
                      $wc_count++;
                      endif
                      @endphp
                      <td>{{ $p->category=='M'?'Material':'Service' }}</td>
                      <td>{{ substr($p->description, 0, 70) }}</td>
                      <td>{{ $p->bid_amount }}</td>
                      <td>{!! $p->bid_status==1?'<span class="badge badge-warning">Processing</span>':($p->bid_status==3?'<span class="badge badge-success">Won</span>':($p->bid_status==2?'<span class="badge badge-danger">Expire</span>':'<span class="badge badge-info">Delivered</span>')) !!}</td>
                      <td>{{ $carbon->parse($p->updated_at)->format('d M') }}</td>
                      <td><a target="_blank" href="{{ url('service-provider/post/').'/'. $p->post_id }}">Details</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                  <!-- <tfoot>
  			                <tr>
  			                  <th>Rendering engine</th>
  			                  <th>Browser</th>
  			                  <th>Platform(s)</th>
  			                  <th>Engine version</th>
  			                  <th>CSS grade</th>
  			                </tr>
  			                </tfoot> -->
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.tab-pane -->
        <!-- /.tab-pane -->
        <!-- /.tab-pane -->
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>

  <div class="col-md-4">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Bid Activity</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-7">

              <div class="chart-responsive">
                <canvas id="pieChart" height="150"></canvas>
              </div>
              <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-5">
              <ul class="chart-legend clearfix">
                <li><i class="fa fa-circle-o text-yellow"></i> Processing</li>
                <li><i class="fa fa-circle-o text-green"></i> Won</li>
                <li><i class="fa fa-circle-o text-red"></i> Won & Expire</li>
                <li><i class="fa fa-circle-o text-aqua"></i> Delivered</li>
              </ul>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
    </div>
    <div class="col-md-12 bid-rating">
      <div class="well well-sm p-0 box box-default">
        <div class="box-header with-border">
          <h3 class="box-title mt-0Z">Bid Rating</h3>
        </div>
        <div class="box-body row m-0">
          <div class="col-xs-12 col-md-6 text-center">
            <h1 class="rating-num">{{$users->average_stars}}</h1>
            <div class="rating">
              <p class="stars starrr Delivered text-center" data-rating="{{round($users->average_stars)}}"></p>
            </div>
            <div>
              <span class="glyphicon glyphicon-user"></span><a href="{{ url('service-provider/post/reviews') }}"><u>{{$users->total_reviews}} Reviews</u></a>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 p-1">
            <div class="row rating-desc m-0">
              <div class="col-md-12 p-0">
                <div class="row m-0">
                  <div class="col-xs-2 col-md-4 p-1 text-right">
                    <span class="glyphicon glyphicon-star Delivered"></span>5
                  </div>
                  <div class="col-xs-8 col-md-8 p-1">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{$ratings->total >0 ?($ratings->five * 100)/$ratings->total : 0 }}%">
                        <span class="sr-only">{{$ratings->total >0 ?round(($ratings->five * 100)/$ratings->total) : 0}}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end 5 -->
              <div class="col-md-12 p-0">
                <div class="row m-0">
                  <div class="col-xs-2 p-1 col-md-4 text-right">
                    <span class="glyphicon glyphicon-star Delivered"></span>4
                  </div>
                  <div class="col-xs-8 p-1 col-md-8">
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{$ratings->total >0 ?($ratings->four * 100)/$ratings->total:0}}%">
                        <span class="sr-only">{{$ratings->total >0 ?round(($ratings->four * 100)/$ratings->total) : 0 }}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end 4 -->
              <div class="col-md-12 p-0">
                <div class="row m-0">
                  <div class="col-xs-2 p-1 col-md-4 text-right">
                    <span class="glyphicon glyphicon-star Delivered"></span>3
                  </div>
                  <div class="col-xs-8 p-1 col-md-8">
                    <div class="progress">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{$ratings->total >0 ?($ratings->three * 100)/$ratings->total :0}}%">
                        <span class="sr-only">{{$ratings->total >0 ?round(($ratings->three * 100)/$ratings->total) : 0}}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end 3 -->
              <div class="col-md-12 p-0">
                <div class="row m-0">
                  <div class="col-xs-2 p-1 col-md-4 text-right">
                    <span class="glyphicon glyphicon-star Delivered"></span>2
                  </div>
                  <div class="col-xs-8 p-1 col-md-8">
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{$ratings->total >0 ?($ratings->two * 100)/$ratings->total : 0}}%">
                        <span class="sr-only">{{$ratings->total >0 ?round(($ratings->two * 100)/$ratings->total) : 0}}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end 2 -->
              <div class="col-md-12 p-0">
                <div class="row m-0">
                  <div class="col-xs-2 p-1 col-md-4 text-right">
                    <span class="glyphicon glyphicon-star Delivered"></span>1
                  </div>
                  <div class="col-xs-8 p-1 col-md-8">
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: {{$ratings->total >0 ?($ratings->one * 100)/$ratings->total : 0}}%">
                        <span class="sr-only">{{$ratings->total >0 ?round(($ratings->one * 100)/$ratings->total) : 0}}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end 1 -->
            </div>
            <!-- end row -->
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<div class="row activity">
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
              <strong>Bid Won & Delivered: 1 Jan, {{date('Y')}} - 30 Dec, {{date('Y')}}</strong>
            </p>

            <div class="chart">
              <!-- Sales Chart Canvas -->
              <canvas id="lineChart" style="height: 180px;"></canvas>
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
<script type="text/javascript" src="{{ asset('assets/plugins/sparkline/jquery.sparkline.js') }}"></script>
<script type="text/javascript">
  var p_count = '{{$p_count}}' || 20;
  var w_count = '{{ $w_count}}' || 30;
  var we_count = '{{ $we_count }}' || 40;
  var wc_count = '{{ $wc_count }}' || 50;

  function getMonthlyData() {
    var url = "<?php echo url('/service-provider'); ?>";
    url += '/get-monthly-bid-graph';
    var xhr = ajaxGetObj(url);
    xhr.done(function(response) {
      console.log(response);
    }).fail(function(reason) {

    });
  }
  $(function() {
    $('#example1').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': false,
      'info': true,
      'autoWidth': false
    });

    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [{
        value: p_count,
        color: "#ffc107",
        highlight: "#ffc107",
        label: "Bid Processing"
      },
      {
        value: w_count,
        color: "#28a745",
        highlight: "#28a745",
        label: "Bid Won"
      },
      {
        value: we_count,
        color: "#dc3545",
        highlight: "#dc3545",
        label: "Won but Expire"
      },
      {
        value: wc_count,
        color: "#17a2b8",
        highlight: "#17a2b8",
        label: "Delivered"
      },
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 1,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: false,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
      //String - A tooltip template
      tooltipTemplate: "<%=value %> <%=label%> Post"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);


    getMonthlyData();
    var monthData = <?php echo '["' . implode('", "', $data) . '"]' ?>;


  //bar graph for bidding
    var bidChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "Sep", "Oct", 'Nov', 'Dec'],
      datasets: [
        // {
        //   label: "Electronics",
        //   fillColor: "rgb(210, 214, 222)",
        //   strokeColor: "rgb(210, 214, 222)",
        //   pointColor: "rgb(210, 214, 222)",
        //   pointStrokeColor: "#c1c7d1",
        //   pointHighlightFill: "#fff",
        //   pointHighlightStroke: "rgb(220,220,220)",
        //   data: [65, 59, 80, 81, 56, 55, 40]
        // },
        {
          label: "Bid Won & Delivered",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: monthData
        }
      ]
    };

    var barChartCanvas                   = $('#lineChart').get(0).getContext('2d')
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
  });
</script>
<?php
if (!request()->ajax()) :
  include(resource_path() . '/views/service_provider/footer.blade.php');
endif;
?>