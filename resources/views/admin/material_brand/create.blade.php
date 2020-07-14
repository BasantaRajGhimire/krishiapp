<style type="text/css">
	textarea.form-control{
		width:50% !important;
	}
</style>
<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Brand/Manufacturer</h3>
				</div>
				<form role="form" onsubmit="formSubmit(event)" method="post" id="form" class="oas-form-inline">
				<input type="hidden" value="" name="id" id="id">
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
				<div class="box-body">
					<div class="form-group">
						<label for="material_id">Material Name</label>
						<select class="form-control" id="material_id" name="material_id" onchange="getMaterialTypes(this.value,'')">
							<option value="">Select One</option>
							@foreach($material as $v)
							<option value="{{ $v->id }}">{{ $v->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="material_type_id">Material Type</label>
						<select class="form-control" id="material_type_id" name="material_type_id">
							<option value="0">Select One</option> 
						</select>
					</div>
					<div class="form-group">
						<label for="brand_name">Brand Name</label>
					  	<input type="text" name='brand_name' id='brand_name' class="form-control"  >
					</div>
					<div class="form-group">
						<label for="amount">Cost Price</label>
					  	<input type="text" name='amount' id='amount' class="form-control"  >
					</div>
					<div class="form-group">
					  	<label for="brand_description">Description</label>
					  	<textarea class="form-control" name='brand_description' id='brand_description'></textarea>
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
        var formData = $("#form").serialize();
    }else{
       url += "/"+ $('#id').val();
	var formData = $("#form").serialize()+'&_method=PUT';
    }
    var xhr = submitFormAjax(url,formData);
    xhr.done(function(resp){
        resetForm($('#form'));
        table();
        toast(resp);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function getMaterialTypes(materialid, typeid){
	if(materialid==''){
		emptySelection('material_type_id');
		return true;
	}
    var url = materialid+'/get-types';
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
    	//console.log(resp);
    	createSelection('material_type_id', resp, 'id', 'material_type_name', typeid);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });

}
</script>