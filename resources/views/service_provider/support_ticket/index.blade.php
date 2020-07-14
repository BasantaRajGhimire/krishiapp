<?php
include(resource_path() . '/views/service_provider/header.blade.php');
$baseModel = new App\BaseModel();
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

	#example1_wrapper .col-sm-12 {
		min-height: 250px;
	}
</style>
<div class="row activity">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<div class="col-md-10">
			<h2 class="page-header px-3 mb-0">Your Tickets</h2>
	  <!-- Custom Tabs -->
	  <div class="nav-tabs-custom">
	    <div class="tab-content p-0">
	      	<div class="tab-pane active" id="tab_1">
	      		<div class="box">
		            <div class="box-header">
		              <h3 class="box-title"><a class="btn btn-primary" href="{{ url('service-provider/support-ticket/create') }}">Open New Ticket</a></h3>
		            </div>
	            	<!-- /.box-header -->
	            	<div class="box-body">
	              		<table id="example1" class="table table-bordered table-striped">
			                <thead>
				                <tr>
				                  <th>Category</th>
				                  <th>Title</th>
				                  <th>Status</th>
				                  <th>Last Updated</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@foreach($data as $d)
			                		<tr>
			                			<td>{{ $d->name }}</td>
			                			<td><a href="{{ url('service-provider/support-ticket').'/'.$d->id}}">{{ '#'.$d->ticket_id.'-'.$d->title}}</a></td>
			                			<td>
				                			@if ($d->status === 'Open')
		                                        <span class="label label-danger">{{ $d->status }}</span>
											@elseif($d->status == 'Processing')
												<span class="label label-warning">{{ $d->status }}</span>
											@else
												<span class="label label-success">{{ $d->status }}</span>
			                                @endif
                                    	</td>
			                			<td>{{$d->updated_at}}</td>
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
            		<!-- /.box-body -->
          		</div>
	      	</div>
	    </div>
	  </div>
	  <!-- nav-tabs-custom -->
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#example1').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': false,
			'info': true,
			'autoWidth': false
		});
	})
</script>
<?php
if (!request()->ajax()) :
	include(resource_path() . '/views/service_provider/footer.blade.php');
endif;
?>