<?php
include(resource_path() . '/views/client/header.blade.php');
$baseModel = new App\BaseModel();
// dd();
$p_count = $posts['pendingPost']->count();
$pr_count = $posts['approvedPost']->count();
$r_count = $posts['rejectedPost']->count();;
$a_count = $posts['awardedPost']->count();;
$d_count = $posts['onDeliveryPost']->count();;
?>
<script src="<?php echo asset('assets/plugins/chartjs/Chart.js'); ?>"></script>

<style type="text/css">
	.nav-tabs {
		color: #000;
		display: flex;
		flex-wrap: wrap;
	}


	/* .nav-tabs>li.active>a,
	.nav-tabs>li.active>a:focus,
	.nav-tabs>li.active>a:hover {
		color: #000;
		border-bottom:2px solid green !important;
		background: #37334638 !important;

	} */

	.nav-tabs>li>a{
		border-bottom:2px solid transparent !important;
	}


	.nav-tabs>li>a:focus,
	.nav-tabs>li>a:hover {
		color: #000;
		/* border-bottom:2px solid green !important; */
	}

	.nav-tabs-custom>.nav-tabs>li {
		border: 0px;
	}

	.tab-content div.active {
		color: #000;
	}

	.tab-content {
		min-height: 300px;
	}

	.activity {
		padding: 10px;
		margin: 0px !important;
	}

	/* .service {
		color: #3dbb3d;
	} */
/* 
	.material {
		color: #f75858;
	} */

	.box-title{
		font-weight:600;
	}
	.box-header{
		font-weight:600;
		padding-bottom: 0;
	}
</style>
<div class="row activity">
	<h2 class="page-header px-3">Your Activity</h2>
	<div class="col-md-7">
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Post Pending</a></li>
				<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Post Proccessing</a></li>
				<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Post Rejected</a></li>
				<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Post Awarded</a></li>
				<li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Post On Delivery</a></li>
			</ul>
			<div class="tab-content p-0">
				<div class="tab-pane active" id="tab_1">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Post Pending</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Post Category</th>
											<th>Estimated Cost</th>
											<th>Bidding Duration</th>
											<th>Status</th>
											<th>Post at</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($posts['pendingPost'] as $p)
										<tr class="{{$p->category=='M'?'material':'service'}}">
											<td>{{ $p->category=='M'?'Material':'Service' }}</td>
											<td>{{ $p->estimated_cost ?? '-' }}</td>
											<td>{{ $p->duration_days ?? '5' }} days</td>
											<td>Pending</td>
											<td>{{ $p->created_at->format('d M') }}</td>
											<td><a href="{{ url('client/client-post/').'/'. $p->id.'?post_token='.$users->remember_token }}">Details</a></td>
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
				<div class="tab-pane" id="tab_2">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Post In Processing</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example2" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Post Category</th>
											<th>Estimated Cost</th>
											<th>Bidding Duration</th>
											<th>Status</th>
											<th>Post at</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($posts['approvedPost'] as $p)
										<tr class="{{$p->category=='M'?'material':'service'}}">
											<td>{{ $p->category=='M'?'Material':'Service' }}</td>
											<td>{{ $p->estimated_cost ?? '-' }}</td>
											<td>{{ $p->duration_days ?? '5' }} days</td>
											<td>Processing</td>
											<td>{{ $p->created_at->format('d M') }}</td>
											<td><a href="{{ url('client/client-post/').'/'. $p->id.'?post_token='.$users->remember_token }}">Details</a></td>
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
				<div class="tab-pane" id="tab_3">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Post Rejected</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example3" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Post Category</th>
											<th>Estimated Cost</th>
											<th>Bidding Duration</th>
											<th>Status</th>
											<th>Post at</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($posts['rejectedPost'] as $p)
										<tr class="{{$p->category=='M'?'material':'service'}}">
											<td>{{ $p->category=='M'?'Material':'Service' }}</td>
											<td>{{ $p->estimated_cost ?? '-' }}</td>
											<td>{{ $p->duration_days ?? '5' }} days</td>
											<td>Rejected</td>
											<td>{{ $p->created_at->format('d M') }}</td>
											<td><a href="{{ url('client/client-post/').'/'. $p->id.'?post_token='.$users->remember_token }}">Details</a></td>
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
				<div class="tab-pane" id="tab_4">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Post Awarded</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example4" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Post Category</th>
											<th>Estimated Cost</th>
											<th>Bidding Duration</th>
											<th>Status</th>
											<th>Post at</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										@foreach($posts['awardedPost'] as $p)
										<tr class="{{$p->category=='M'?'material':'service'}}">
											<td>{{ $p->category=='M'?'Material':'Service' }}</td>
											<td>{{ $p->estimated_cost ?? '-' }}</td>
											<td>{{ $p->duration_days ?? '5' }} days</td>
											<td>Completed</td>
											<td>{{ $p->created_at->format('d M') }}</td>
											<td><a href="{{ url('client/client-post/').'/'. $p->id.'?post_token='.$users->remember_token }}">Details</a></td>
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
				<div class="tab-pane" id="tab_5">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Post On Delivery</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example5" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Post Category</th>
											<th>Estimated Cost</th>
											<th>Bidding Duration</th>
											<th>Status</th>
											<th>Post at</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										@foreach($posts['onDeliveryPost'] as $p)
										<tr class="{{$p->category=='M'?'material':'service'}}">
											<td>{{ $p->category=='M'?'Material':'Service' }}</td>
											<td>{{ $p->estimated_cost ?? '-' }}</td>
											<td>{{ $p->duration_days ?? '5' }} days</td>
											<td>Completed</td>
											<td>{{ $p->created_at->format('d M') }}</td>
											<td><a href="{{ url('client/client-post/').'/'. $p->id.'?post_token='.$users->remember_token }}">Details</a></td>
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
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- nav-tabs-custom -->
	</div>
	<div class="col-md-5 p-0">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Post Activity</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-8">

							<div class="chart-responsive">
								<canvas id="pieChart" height="150"></canvas>
							</div>
							<!-- ./chart-responsive -->
						</div>
						<!-- /.col -->
						<div class="col-md-4">
							<ul class="chart-legend clearfix">
								<li><i class="fa fa-circle-o text-yellow"></i> Pending</li>
								<li><i class="fa fa-circle-o text-red"></i> Rejected</li>
								<li><i class="fa fa-circle-o text-green"></i> Processing</li>
								<li><i class="fa fa-circle-o text-purple"></i> Awarded</li>
								<li><i class="fa fa-circle-o text-aqua"></i> Delivered</li>
							</ul>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
		</div>
	</div>
	<?php echo view('client.leave_review', ['reviewPost' => $reviewPost, 'users' => $users, 'carbon' => $carbon])->render(); ?>
</div>
<script type="text/javascript" src="{{ asset('assets/plugins/sparkline/jquery.sparkline.js') }}"></script>

<script type="text/javascript">
	var p_count = '{{$p_count}}';
	var pr_count = '{{ $pr_count}}';
	var r_count = '{{ $r_count }}';
	var a_count = '{{ $a_count }}';
	var d_count = '{{ $d_count }}';

	$(function() {
		$('#example1').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': false,
			'info': true,
			'autoWidth': false
		});
		$('#example2').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': false,
			'info': true,
			'autoWidth': false
		});
		$('#example3').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': false,
			'info': true,
			'autoWidth': false
		});
		$('#example4').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': false,
			'info': true,
			'autoWidth': false
		});

		$('#example5').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': false,
			'info': true,
			'autoWidth': false
		});
	})

	//pie chart


	var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
	var pieChart = new Chart(pieChartCanvas);
	var PieData = [{
			value: p_count,
			color: "#ffc107",
			highlight: "#ffc107",
			label: "Pending"
		},
		{
			value: r_count,
			color: "#dc3545",
			highlight: "#dc3545",
			label: "Rejected"
		},
		{
			value: pr_count,
			color: "#28a745",
			highlight: "#28a745",
			label: "Processing"
		},
		{
			value: a_count,
			color: "#6060b6",
			highlight: "#17a2b8",
			label: "Awarded"
		},
		{
			value: d_count,
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
</script>
<?php
if (!request()->ajax()) :
	include(resource_path() . '/views/client/footer.blade.php');
endif;
?>