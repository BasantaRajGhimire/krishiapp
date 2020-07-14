<style type="text/css">
	textarea.form-control{
		width:50% !important;
	}
</style>
<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Ticket Title</h3>
				</div>
				<form role="form" onsubmit="formSubmit(event)" method="post" id="form" class="oas-form-inline">
				<input type="hidden" value="" name="id" id="id">
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
				<div class="box-body">
					<div class="form-group">
						<label for="name">Title Name</label>
					  	<input type="text" name='name' id='name' class="form-control"  >
					</div>
					<div class="form-group">
						<label for="category_id">Ticket Category</label>
						<select class="form-control" id="category_id" name="category_id">
							<option value="">Select One</option>
							@foreach($category as $v)
							<option value="{{ $v->id }}">{{ $v->name }}</option>
							@endforeach
						</select>
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
</script>