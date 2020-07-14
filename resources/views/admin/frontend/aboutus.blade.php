
<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<script type="text/javascript">
    tinymce.remove();
    tinymce.init({selector:'textarea'});
</script>
<style type="text/css">
    .required{
        color:red;
    }
</style>
</script>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Add/Edit About us Page</div>
            <div class="panel-body">
                <form id='au-form' class="form-horizontal" role="form" method="POST" action="{{ url('/admin/frontend') }}" onsubmit="formSubmit(event);">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="content" class="col-md-2 control-label">Content <span class="required">*</span></label>

                        <div class="col-md-10">
                            <textarea rows="20" id="content" class="form-control" name="content">{{ isset($data->content)?$data->content:''}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-btn fa-ticket"></i> Save Content
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    


function formSubmit(e){
    e.preventDefault();
    var id = "{{$data->id ?? ''}}";
    var url = $('form').attr('action');
    var formData = $('form').serialize()+'&slug=AU';
    if(id !=''){
        var formData = formData+'&method=PUT';
        var url = url +'/'+id;
    }
    console.log(formData);
    var xhr = submitFormAjax(url, formData);
    xhr.done(function(resp){
        toast(resp);
    }).fail(function(err){
        toast(err.responseJson);
    });
}
</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>