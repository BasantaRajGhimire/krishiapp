<style type="text/css">
	textarea.form-control{
		width:50% !important;
	}
</style>
<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Brand Logo</h3>
				</div>
				<form role="form" onsubmit="formSubmit(event)" method="post" id="form" class="oas-form-inline" enctype="multipart/form-data">
				<input type="hidden" value="" name="id" id="id">
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
				<div class="box-body">
					<div class="form-group">
						<label for="brand_name">Brand Name</label>
					  	<input type="text" name='brand_name' id='brand_name' class="form-control"  >
					</div>
					<div class="form-group">
						<label for="brand_logo">Brand Logo <span class="text-danger">*</span></label>
					  	<input type="file" class="form-control" name='brand_logo' id='brand_logo' />
					</div>
				  <div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					 <button type="reset" onClick="resetForm()" class="btn btn-info pull-right">Reset</button>
				  </div>
				</form>
			  </div>
</div>
			  <script>
function formSubmit(e){
    e.preventDefault();
    var url = baseUrl;
    if( $('#id').val()==""){
        var formData = new FormData($('form')[0]);
    }else{
       url += "/"+ $('#id').val();
	var formData = $("#form").serialize()+'&_method=PUT';
    }
    var xhr = submitFormAjaxWithFile(url,formData);
    xhr.done(function(resp){
        resetForm($('#form'));
        table();
        toast(resp);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
</script>