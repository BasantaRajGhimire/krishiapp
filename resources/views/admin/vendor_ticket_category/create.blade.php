<style type="text/css">
	textarea.form-control{
		width:50% !important;
	}
</style>
<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Vendor Ticket Categories</h3>
				</div>
				<form role="form" onsubmit="formSubmit(event)" method="post" id="form" class="oas-form-inline">
				<input type="hidden" value="" name="id" id="id">
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
				<div class="box-body">
					<div class="form-group">
						<label for="name">Category Name</label>
					  	<input type="text" name='name' id='name' class="form-control"  >
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