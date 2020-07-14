@php 
function getName($string)
{
    $name = explode('_', $string);
    foreach ($name as $n) {
        $names[] = ucfirst($n);
    }
    $names = implode(' ', $names);
    return $names;
}

$auth = new App\Auth();
$users = $auth->getvendorUser(session('suserid'));

$baseModel = new App\BaseModel();
@endphp
<style type="text/css">
	body{
		background:url("{{url('images/water-mask1.jpg')}}");
		background-repeat: no-repeat !important;
		background-size:cover !important;
	}
	.table td{
		width: 50%;
		border:0px;
		font-size: 13px;
		padding:5px;
	}
	.box-header{

		margin-bottom: 20px;
	}
	.row-header{
		font-size: 16px;
		text-decoration: underline;
	}
	.row{
		margin-top: 30px;
	}
	.col-md-6{
		width:50%;
		float: left;
		margin-bottom: 20px;
	}
	.footer{
		margin-top: 70px !important;
		font-size:12px;
		text-align: center;
	}
	.header{
		text-align: center;
	}
	/*.row{
		background-color: #fff;
	}*/
</style>
<body>
<section class="content">
	<div class="header">
		<img src="{{asset('images/logo.png')}}" width="120px" height="120px" />
		<h4>Ethekka: <a href="">{{url('/')}}</a></h4>
		<p>Downloaded Date: {{Carbon\Carbon::now()->format('d M, Y')}}</p>
	</div>
	<div class="row col-md-12">
		<div class="box-header">
			<span class="row-header">Client Details</span>
		</div>
		<div class="col-md-6">
			<table class="table" style="border-right: 2px solid #9979791a;">
				@foreach($data['client_details'] as $k => $c)
					<tr>
						<td>{{getName($k)}}:-</td>
						<td>{{ $c }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="col-md-6">
			<table class="table">
				<?php 
					$dumbArray = array('bid_duration','created_at','expired_at','client_name','postid');
				?>
				@foreach($data['post'][0] as $k=>$c)
				@if(in_array($k, $dumbArray) )
					@continue;
				@else
				<tr>
					<td>{{ getName($k) }}:-</td>
					<td>{{ $c }}</td>
				</tr>
				@endif
				@endforeach
			</table>
		</div>
		<div class="box-header">
			<span class="row-header">Vendor Details</span>
		</div>
		<div class="col-md-12">
			<table class="table">
				<tr>
					<td>
						Name :- 
					</td>
					<td>
						{{$users->contact_name}}
					</td>
					<td>
						Email :- 
					</td>
					<td>
						{{$users->email}}
					</td>
				</tr>
				<tr>
					<td>
						Phone Number :- 
					</td>
					<td>
						{{$users->mobile}}
					</td>
					<td>
						Company Name :- 
					</td>
					<td>
						{{$users->company_name}}
					</td>
				</tr>
				<tr>
					<td>
						District :- 
					</td>
					<td>
						{{$baseModel->getDistrict(['name'],['id' => $users->district])->district_name}}
					</td>
					<td>
						Address :- 
					</td>
					<td>
						{{$users->address}}
					</td>
				</tr>
				<tr>
					<td>
						Vendor Type :- 
					</td>
					<td>
						{{$users->vendor_type}}
					</td>
					<td>
						Rating :- 
					</td>
					<td>
						<b>{{$users->average_stars}}</b> out of <b>5</b>
					</td>
				</tr>
			</table>
		</div>
	</div>	
	<div class="footer">
		<strong>Copyright &copy; 2019 <a href="<?php echo url('/'); ?>">E-Thekka</a>.</strong> All rights
		reserved.
	</div>
</section>
</body>