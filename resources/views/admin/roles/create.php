<?php
$astrik = (new \App\Role());
$lang = t_label_bulk(['Name','Display','Route','Submit','Reset']);
?>
<div class="box box-primary">
        <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo t_message('Create Roles');?></h3>
        </div>
        <form role="form" onsubmit="formSubmit(event)" method="post" id="form" class="oas-form-inline">
        <input type="hidden" value="" name="id" id="id">
        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token();?>">
        <div class="box-body">
          <div class="form-group">
            <label for="name"><?php echo $lang['Name'];?></label>
            <input type="text" name='name' id='name' class="form-control" >
          </div>
          <div class="form-group">
            <label for="display_name"><?php echo $lang['Display'];?> <?php echo $lang['Name'];?></label>
            <input type="text" name='display_name' id='display_name' class="form-control" >
          </div>

           <div class="form-group">
                      <div class="row">
                              <div class="col-sm-6">
                                        <div class="box box-default box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><?php echo t_message('Permission Items'); ?></h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <ul class="list-group" id="permissions">
                                                    <?php if (count($permissions) > 0): ?>
                                                <?php foreach ($permissions as $pr): ?>
                                                    <li class="list-group-item" ><input type="checkbox"  name="permissions[]" value="<?php echo $pr->id; ?>"> <?php echo $pr->display_name; ?> </li>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                                </ul> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                  </div>
                              <div class="col-sm-6">
                                        <div class="box box-default box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><?php echo t_message('Menu Items'); ?></h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <ul class="list-group" id="menus">
                                                    <?php if (count($routes) > 0): ?>
                                                   
                                                <?php foreach ($routes as $rt): ?>
                                                    <?php //print_r($rt);?>
                                                    <li class="list-group-item" ><input type="checkbox" id="cbox"  name="menu[]" value="<?php echo $rt->id; ?>"> <?php echo $rt->gname!=''?$rt->gname." > ":'';?> <?php echo $rt->{t_field('name')}; ?> </li>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                                </ul> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                   </div>
                               </div>
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
    var url = "roles";
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
        toast(reason.responseJSON);
    });
}
setAstrik(<?php echo json_encode($astrik->getAstrik());?>);
</script>