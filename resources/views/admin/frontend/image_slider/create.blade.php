<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<style type="text/css">
	.required{
        color:red;
    }
	input{
		width:100% !important;
	}
</style>
 <script type="text/javascript">
	 $(document).ready(function(){
		//  tinymce.remove();
		 tinymce.init({selector:'#description'});
	 })
 </script>
 
<div class="index row">
	<div class="box box-primary">
					<div class="box-header with-border">
					<h3 class="box-title">Add Image Slider</h3>
					</div>
				<form role="form" action="{{ url('admin/image-slider') }}" method="post" id="form" class="oas-form-inline" enctype="multipart/form-data">
					{{-- <input type="hidden" value="" name="id" id="id"> --}}
					<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
					<div class="box-body">
						<div class="form-group">
							<label for="title">Title <span class="text-danger">*</span></label>
							<div class="col-md-8">
							<input type="text" name='title' id='title' class="form-control" value="{{ old('title') }}" >
								@if($errors->first('title'))
									<div class="text text-danger col-md-12 mt-2">{{ $errors->first('title')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label for="description">Description <span class="required">*</span></label>

							<div class="col-md-8">
							<textarea rows="10" id="description" class="form-control" name="description">{{ old('description') }}</textarea>
								@if($errors->first('description'))
									<div class="text text-danger col-md-12 mt-2">{{$errors->first('description')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label for="banner_image">Slider Image <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="file" class="form-control" name='banner_image' id='banner_image' />
								@if($errors->first('banner_image'))
									<div class="text text-danger col-md-12 mt-2">{{ $errors->first('banner_image')}}</div>
								@endif
							</div>
						</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" onClick="resetForm()" class="btn btn-info pull-right">Reset</button>
					</div>
					</form>
				</div>
	</div>
</div>
<script>
	// $('button').click(function(e){
	// 	e.preventDefault();
	// 	console.log($('#description').val());

	// })
function formSubmit(e){
    e.preventDefault();
    var url = baseUrl;
    // if( $('#id').val()==""){
		console.log($('#description').val());
        var formData = new FormData($('form')[0]);
		// console.log($('form')[0]);
    // }else{
    //    url += "/"+ $('#id').val();
	// var formData = $("#form").serialize()+'&_method=PUT';
    // }
		var xhr = submitFormAjaxWithFile(url,formData);
		xhr.done(function(resp){
			resetForm($('#form'));
			location.reload();
			toast(resp);
		}).fail(function(reason){
			var rsp = reason.responseJSON;
			toast(rsp);
		});
}
</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>
