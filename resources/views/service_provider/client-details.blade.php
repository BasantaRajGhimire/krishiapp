@php include(resource_path() . '/views/service_provider/header.blade.php');

$baseModel = new App\BaseModel();
@endphp
<style type="text/css">
	.content {
		background: url("{{url('images/water-mask1.jpg')}}");
		background-color: #fff0;
		background-size: 1304px 700px !important;
		background-repeat: no-repeat;
	}

	/* .table td {
		width: 50%;
		border: 0px;
		background-color: #fff0;
	}

	.table.vendor td {
		width: 25%;
	} */

	.row-header {
		font-size: 20px;
	}

	/*.row{
		background-color: #fff0;
	}*/
</style>
<section class="content">
	<div class="row col-md-12" style="background:#fff0;">
		<div class="box-header">
			<span class="row-header">Client Details</span>
			<span class="row-header pull-right"><a class="btn btn-default btn-lg" target="_blank" href="{{url('service-provider/client-details/').'/'.$data['winid'].'?status=download'}}">PDF <i class="fa fa-download" style="color:#1414e399;"></i></a></span>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table class="table table-hover table-bordered" style="background:#00000012">
					@foreach($data['client_details'] as $k => $c)
					<tr class="row">
						<td class="col-sm-3 col-md-4"><i>{{getName($k)}}</i></td>
						<td class="col-sm-9 col-md-8"><b>{{ $c }}</b></td>
					</tr>
					@endforeach
				</table>
			</div>
			<div class="col-md-6">
				<table class="table table-hover table-bordered" style="background:#00000012">
					<?php
					$dumbArray = array('bid_duration', 'created_at', 'expired_at', 'client_name', 'postid');
					?>
					@foreach($data['post'][0] as $k=>$c)
					@if(in_array($k, $dumbArray) )
					@continue;
					@else
					<tr class="row">
						<td class="col-sm-3 col-md-4"><i>{{ getName($k) }}</i></td>
						<td class="col-sm-9 col-md-8"><b>{{ $c }}</b></td>
					</tr>
					@endif
					@endforeach
				</table>
			</div>
		</div>
	</div>
	<div class="row col-md-12" style="background:#fff0;">
		<div class="box-header">
			<span class="row-header">Vendor Details</span>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table class="table vendor table-hover table-bordered" style="background:#00000012">
					<tr class="row">
						<td class="col-sm-3 col-md-4">
							<i>Name :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->contact_name}}</b>
						</td>
					</tr>
					<tr class="row">
						<td class="col-sm-3 col-md-4">
						<i>	Email :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->email}}</b>
						</td>
					</tr>
					<tr class="row">
						<td class="col-sm-3 col-md-4">
							<i>Phone Number :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->mobile}}</b>
						</td>
					</tr>
					<tr class="row">
						<td class="col-sm-3 col-md-4">
							<i>Company Name :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->company_name}}</b>
						</td>
					</tr>
				</table>
			</div>
	
			<div class="col-md-6">
				<table class="table vendor table-hover table-bordered" style="background:#00000012">
					<tr class="row">
						<td class="col-sm-3 col-md-4">
						<i>	District :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$baseModel->getDistrict(['name'],['id' => $users->district])->district_name}}</b>
						</td>
					</tr>
					<tr class="row">
						<td class="col-sm-3 col-md-4">
							<i>Address :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->address}}</b>
						</td>
					</tr>
					<tr class="row">
						<td class="col-sm-3 col-md-4">
							<i>Vendor Type :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->vendor_type}}</b>
						</td>
					</tr>
					<tr class="row">
						<td class="col-sm-3 col-md-4">
							<i>Rating :-</i>
						</td>
						<td class="col-sm-9 col-md-8">
							<b>{{$users->average_stars}}</b> out of <b>5</b>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>
@php
include(resource_path() . '/views/service_provider/footer.blade.php');
@endphp