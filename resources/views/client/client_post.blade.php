<?php
if (!request()->ajax()) :
	include(resource_path() . '/views/client/header.blade.php');
endif;
?>
<style type="text/css">
	/* .content {
		padding: 0px !important;
		margin: 0px !important;
		margin: 0px -25px 25px -10px !important;
	} */

	span.required {
		color: red;
	}

	.error {
		font-size: 11px;
		color: red;
		padding: 5px 10px 0px 20px;
		float: right;
		text-align: center;
		width: 50%;
	}

	label {
		font-size: 18px;
	}

	.btn-file {
		position: relative;
		overflow: hidden;
		border: 1px solid #000;
	}

	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}

	span.file {
		font-size: 15px;
		font-weight: 400;
		padding: 5px;
		color: #4D525B;
	}

	.uploadfrm {
		border: 1px dotted #BEC0C2;
		padding: 10px;
		margin: 10px;
	}

	.form-control {
		font-size: 16px;
		height: 46px;
		padding: 0 16px;
	}

	.container-fluid {
		margin: -10px -30px -10px -30px;
	}

	/* form, option{
		font-family: 'Courier';
	} */
	textarea {
		min-height: 150px;
		padding: 10px 15px !important;
	}
</style>

<div class="container-fluid" style="background-image: radial-gradient(circle at top left, rgba(40, 40, 40, 0.79) 0%, rgba(40, 40, 40, 0.86) 100%), url(https://images.unsplash.com/photo-1522520157969-1252ee3ec476?ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80);
    background-repeat: no-repeat;
    background-position: center;
	background-size: cover;">
	<div class="container-fluid p-0 post-bg" style="height: 300px;">
		<div class="row m-0 mt-5 pt-3">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class=" px-2 mx-5 px-sm-5 mx-sm-5 px-md-5 mx-md-4">
					<div class=" px-4 py-1 " style="background-image: radial-gradient(circle at top left, rgba(40, 40, 40, 0.79) 0%, rgba(40, 40, 40, 0.86) 100%);">
						<h3 class="" style="color:#fff;font-weight: bold; font-size:32px;">Post here what you want</h3>
						<p style="color:#fff; font-size: 15px;">{{config('constants.messages.client-post-paragraph')}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content client-post" >
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" style="margin-top: -100px; background-color:#fff;padding:15px;border-radius: 10px">
				@if (\Session::has('success'))
				<div class="alert alert-success">
					<ul style="text-decoration:none">
						<li class="text-center">{!! \Session::get('success') !!}</li>
					</ul>
				</div>
				@endif
				@if (\Session::has('msg'))
				<div class="alert alert-danger">
					<ul style="text-decoration:none">
						<li class="text-center">{!! \Session::get('msg') !!}</li>
					</ul>
				</div>
				@endif
				<form action="{{ url('/client/post') }}" method="post" id="register-form" enctype="multipart/form-data" style="margin-top: 20px;">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
					<div class="col-md-12">
						<div class="form-group">
							<label for="category"><span class="required">*</span> What you prefer?</label>
							<select class="form-control" name="category" id="category" onchange="showDiv(this.value)">
								<option value="M">Material</option>
								<option value="S">Service</option>
							</select>
							<div id="category-err" class="error">{{ session('errors') ? session('errors')->first('category') : '' }}</div>
						</div>
						<div class="material">
							<div class="form-group">
								<label for="material_id"><span class="required mayberequired">*</span> Which Material?</label>
								<select class="form-control" name="material_id" id="material_id" onchange="getMaterialTypes(this.value)">
									<option value="">Select One</option>
									@foreach($material as $m)
									<option value="{{$m->id}}">{{ $m->name }}</option>
									@endforeach
								</select>
								<div id="material_id-err" class="error">{{ session('errors') ? session('errors')->first('material_id') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="material_type_id">Which Type?</label>
								<select class="form-control" name="material_type_id" id="material_type_id" onchange="getBrand(this.value)">
									<option value="">Select One</option>
								</select>
							</div>
							<div class="form-group">
								<label for="brand_id"><span class="required mayberequired">*</span> Which Brand?</label>
								<select class="form-control" name="brand_id" id="brand_id" onchange="">
								</select>
								<div id="brand_id-err" class="error">{{ session('errors') ? session('errors')->first('brand_id') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="quantity"><span class="required mayberequired">*</span> Quantity</label>
								<input type="number" class="form-control" name="quantity" id="quantity" oninput="checkNumber(event, this.value);" />
								<div id="quantity-err" class="error">{{ session('errors') ? session('errors')->first('quantity') : '' }}</div>
							</div>
						</div>
						<div class="service" style="display: none;">
							<div class="form-group">
								<label for="service_type_id"><span class="required mayberequired">*</span> Which Service
									Type?</label>
								<select class="form-control" name="service_type_id" id="service_type_id" onchange="getServices(this.value)">
									<option value="">Select One</option>
									@foreach($serviceType as $m)
									<option value="{{$m->id}}">{{ $m->service_type_name }}</option>
									@endforeach
								</select>
								<div id="service_type_id-err" class="error">{{ session('errors') ? session('errors')->first('service_type_id') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="service_id"><span class="required mayberequired">*</span> Which Service?</label>
								<select class="form-control" name="service_id" id="service_id" onchange="">
								</select>
								<div id="service_id-err" class="error">{{ session('errors') ? session('errors')->first('service_id') : '' }}</div>
							</div>
						</div>
						<div id="structural-service-fields" style="display: none;">
							<div class="form-group">
								<label for="land_area"><span class="required mayberequired">*</span> Land Area</label>
								<input type="number" name="land_area" class="form-control" placeholder="Enter Land Area">
								<div id="land_area_err" class="error">{{ session('errors') ? session('errors')->first('land_area') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="no_of_storey"><span class="required mayberequired">*</span> No. of Storey</label>
								<select class="form-control" name="no_of_storey" id="no_of_storey">
									<option value="">Select One</option>
									@for($i = 1; $i<=15; $i++) <option value="{{ $i }}">{{ $i }}</option>
										@endfor
								</select>
								<div id="no_of_storey_err" class="error">{{ session('errors') ? session('errors')->first('no_of_storey') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="floor_space"><span class="required mayberequired">*</span> Floor Space</label>
								<input type="number" name="floor_space" class="form-control" placeholder="Enter Floor Space">
								<div id="floor_space_err" class="error">{{ session('errors') ? session('errors')->first('floor_space') : '' }}</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row m-0 uploadfrm">
								<p><span class="col-md-3 pull-left btn btn-file">
										<i class="fa fa-plus"></i> Upload File <input type="file" name="doc" class="btn btn-md" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .pdf" onchange="changeRequired(this)">
									</span>
									<span class="file col-md-8 col-md-offset-1">If you have any document, please upload here </span></p>
							</div>
						</div>
						<div style="display:flow-root"><button id="first" type="button" class="btn btn-info pull-right">Next</button></div>
						<div id="first-button-click" style="display: none;">							
							<div class="form-group">
								<label for="description"><span class="required">*</span> About your Requirement</label>
								<textarea class="form-control" name="description" id="description" placeholder="Describe your requirement....."></textarea>
								<div id="description-err" class="error">{{ session('errors') ? session('errors')->first('description') : '' }}</div>
							</div>
						</div>
						<div style="display:flow-root"><button id="second" type="button" class="btn btn-info pull-right" style="display: none;">Next</button></div>
						<fieldset id="others" style="display: none;">
							<legend>Others</legend>
							<div class="form-group">
								<label for="estimated_cost">Estimated Cost</label>
								<input type="number" class="form-control" name="estimated_cost" id="estimated_cost" oninput="checkNumber(event,this.value);" />
								<div id="estimated_cost-err" class="error">{{ session('errors') ? session('errors')->first('estimated_cost') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="district"><span class="required mayberequired">*</span> District</label>
								<select class="form-control" name="district" id="district">
									<option value="1">Kathmandu</option>
									<option value="2">Lalitpur</option>
									<option value="3">Bhaktapur</option>
								</select>
								<div id="district-err" class="error">{{ session('errors') ? session('errors')->first('district') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="address"><span class="required mayberequired">*</span> Full Address</label>
								<input type="text" class="form-control" placeholder="Address" name="address" id="address">
								<div id="email-err" class="error">{{ session('errors') ? session('errors')->first('address') : '' }}</div>
							</div>
							<div class="form-group">
								<label for="duration">No. of bidding days</label>
								<input type="number" class="form-control" placeholder="Number Of Days" name="duration_days" id="duration_days" oninput="checkNumber(event,this.value);">
								<div id="email-err" class="error"></div>
							</div>
						</fieldset>
					</div>
					<div class="px-4"  style="display:flow-root">
						<button id="post" type="submit" class="btn btn-primary pull-right" style="display: none;" onclick="checkValidate(event);">Post</button>
					</div>
				</form>
			</div>
		</div>
		<!-- /.form-box -->
	</section>
</div>

<script>
	function checkValidate(e) {
		e.preventDefault();
		var arr = ['estimated_cost', 'quantity', 'duration_days'];
		console.log(arr);
		$.each(arr, function(index, value) {
			var val = $('#' + value).val();
			console.log(val);
			if (val != '') {
				if (isNaN(val)) {
					console.log('not ok')
					$('#' + value).css('border', '1px solid red')
					return false;
				}
			}
		});
		$('#register-form').submit();
	}

	function checkNumber(e, val) {
		console.log(Number.isInteger(val))
		if (isNaN(val)) {
			$('#' + e.target.id).css('border', '1px solid red')
		} else {
			$('#' + e.target.id).css('border', '1px solid green')
		}
	}
	$(function() {
		if ($('#category').val() == 'S') {
			$('.material').hide();
			$('.service').show();
		}
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah')
					.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#first').click(function(e) {
		e.preventDefault();
		$('#first-button-click').show();
		$('#second').show();
		$(this).hide()
	});
	$('#second').click(function(e) {
		e.preventDefault();
		$('#others').show();
		$('#post').show();
		$(this).hide()
	});
	var gLoader = "loader-animation";
	var mainContainer = "main-body";
	$(document).ajaxStart(function() {
		$('#' + gLoader).show();
	});
	$(document).ajaxStop(function() {
		hideLoader();
	});
	var baseUrl = "<?php echo url('/client'); ?>";

	function showDiv(value) {
		if (value == 'S') {
			$('.material').hide();
			$('.service').show();
			$('label[for="description"]').html('<span class="required">*</span> About your Requirement');
		} else {
			$('label[for="description"]').text('About your Requirement');
			$('.service').hide();
			$('.material').show();
		}
	}

	function getMaterialTypes(materialid, typeid) {
		$('#brand_id').empty();
		$('#material_type_id').empty();
		if (materialid == '') {
			emptySelection('material_type_id');
			return true;
		}
		var url = 'get-material-types/' + materialid;
		var xhr = ajaxGetObj(url);
		xhr.done(function(resp) {
			if (resp.length > 0) {
				createSelection('material_type_id', resp, 'id', 'material_type_name', typeid);
			} else {
				getBrand('');
			}
		}).fail(function(reason) {
			var rsp = reason.responseJSON;
			console.log(rsp);
			//toast(rsp);
		});

	}

	function getBrand(typeid, brandid) {
		var materialid = $('#materialid').val();
		if (typeid == '') {
			var url = 'get-brand?materialid=' + materialid;
			var xhr = ajaxGetObj(url);
			xhr.done(function(resp) {
				//console.log(resp);
				createSelection('brand_id', resp, 'id', 'brand_name', typeid);
			}).fail(function(reason) {
				var rsp = reason.responseJSON;
				console.log(rsp);
				//toast(rsp);
			});
		} else {
			var url = 'get-brand?typeid=' + typeid;
			var xhr = ajaxGetObj(url);
			xhr.done(function(resp) {
				//console.log(resp);
				createSelection('brand_id', resp, 'id', 'brand_name', typeid);
			}).fail(function(reason) {
				var rsp = reason.responseJSON;
				console.log(rsp);
				//toast(rsp);
			});
		}

	}

	function getServices(servicetypeid) {
		$('#service_id').empty();
		// if(materialid==''){
		//   emptySelection('material_type_id');
		//   return true;
		// }
		var url = 'get-services/' + servicetypeid;
		var xhr = ajaxGetObj(url);
		xhr.done(function(resp) {
			createSelection('service_id', resp, 'id', 'name');
		}).fail(function(reason) {
			var rsp = reason.responseJSON;
			console.log(rsp);
			//toast(rsp);
		});
	}

	function changeRequired(elem) {
		if ($(elem).val()) {
			$('span.file').text(elem.files[0].name);
			$('span.mayberequired').hide();
			$('span.mayberequired').closest('.form-group').find('.error').hide();
		} else {
			$('span.mayberequired').show();
		}
	}

	$(document).on('change', "#service_id, #service_type_id, #category", function() {
		let val_service = $('#service_id:visible').val();
		if (val_service == 2) {
			$('#structural-service-fields').prop('disabled', false);
			$('#structural-service-fields').show();
		} else {
			$('#structural-service-fields').prop('disabled', true);
			$('#structural-service-fields').hide();
		}
	});

	//}
	//$('[data-mask]').inputmask();
</script>
<?php
if (!request()->ajax()) :
	include(resource_path() . '/views/client/footer.blade.php');
endif;
?>