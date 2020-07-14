<?php
$lang = t_label_bulk(['Code','Level','Name','Nepali','English','Local','language','Approved','Disabled','Submit','Reset','Yes','No']);
?>
<div class="box box-primary">
				<div class="box-header with-border">
                                    <h3 class="box-title"><?php echo t_message('Create Admininstration Types');?></h3>
				</div>
				<form role="form" onsubmit="formSubmit(event)" method="post" id="form" class="oas-form-inline">
				<input type="hidden" value="" name="id" id="id">
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
				<div class="box-body">
				  <div class="form-group">
					  <label for="code"><?php echo $lang['Code'];?></label>
					  <input type="text" name='code' id='code' class="form-control" >
					</div>
					<div class="form-group">
					  <label for="levelorder"><?php echo $lang['Level'];?></label>
					  <input type="text" name='levelorder' id='levelorder' class="form-control"  >
					</div>
					<div class="form-group">
					  <label for="levelnameen"><?php echo $lang['Name'];?> [<?php echo $lang['English'];?>]</label>
					  <input type="text" name='levelnameen' id='levelnameen' class="form-control"  >
					</div>
					<div class="form-group">
					  <label for="levelnamenp"><?php echo $lang['Name'];?> [<?php echo $lang['Nepali'];?>]</label>
					  <input type="text" name='levelnamenp' id='levelnamenp' class="form-control" >
					</div>
					<div class="form-group">
					  <label for="levelnamelc"><?php echo $lang['Name'];?> [<?php echo $lang['Local'];?> <?php echo $lang['language'];?>]</label>
					  <input type="text" name='levelnamelc' id='levelnamelc' class="form-control"  >
					</div>
					<div class="form-group">
					  <label for="approved"><?php echo $lang['Approved'];?></label>
					  <select class="form-control" id="approved" name="approved">
                                            <option value="1" selected="selected"><?php echo $lang['Yes'];?></option>
                                            <option value="0" ><?php echo $lang['No'];?></option>
                                          </select>
					</div>
					<div class="form-group">
					  <label for="disabled"><?php echo $lang['Disabled'];?></label>
					  <select class="form-control" id="disabled" name="disabled">                                    
                                  
                                  <option value="1" ><?php echo $lang['Yes'];?></option>
                                  <option value="0" selected="selected" ><?php echo $lang['No'];?></option>
                                                 
                        </select>
					</div>
				  <div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo $lang['Submit'];?></button>
					 <button type="reset" onClick="resetForm()" class="btn btn-info pull-right"><?php echo $lang['Reset']; ?></button>
				  </div>
				</form>
			  </div>
<script>
function formSubmit(e){
    e.preventDefault();
    var url = "admtypes";
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
        toast({status:"1",title:"success",text:"Item created"});
    }).fail(function(){
        toast({status:"0",title:"error",text:"Failed To Create Item"});
    });
}
</script>