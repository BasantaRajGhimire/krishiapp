<?php 
include(resource_path() . '/views/client/header.blade.php'); 
?>
<style type="text/css">
    .required{
        color:red;
    }
    
    .btn-file {
	  position: relative;
	  overflow: hidden;
	  border:1px solid #000;
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
	span.file{
		font-size: 15px;
		font-weight: 400;
		padding: 5px;
		color:#4D525B;
	}
	.uploadfrm{
		border:1px dotted #BEC0C2;
		padding: 10px;
		margin:10px;
	}
</style>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Open New Ticket</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/client/support-ticket') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="col-md-4 control-label">Category <span class="required">*</span></label>

                        <div class="col-md-6">
                            <select id="category_id" type="category" class="form-control" name="category_id" onchange="getTitle(this.value)">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)

                                <option value="{{ $category->id }}" {{ ($category->id == old('category_id'))?"selected":"unselected" }} >{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title <span class="required">*</span></label>

                        <div class="col-md-6">
                            <select id="title" class="form-control" name="title">
                                <option value="">Select Title</option>
                                @if(old('category_id'))
                                    @foreach($title as $t)
                                        @if($t->category_id == old('category_id'))
                                            <option value="{{$t->id}}" {{old('title') == $t->id ?'selected':''}}>{{$t->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                        <label for="priority" class="col-md-4 control-label">Priority <span class="required">*</span></label>

                        <div class="col-md-6">
                            <select id="priority" type="" class="form-control" name="priority">
                                <option value="">Select Priority</option>
                                <option value="low" {{ (old('priority') == "low")?"selected":"unselected" }}>Low</option>
                                <option value="medium" {{ (old('priority') == "medium")?"selected":"unselected" }}>Medium</option>
                                <option value="high" {{ (old('priority') == "high")?"selected":"unselected" }}>High</option>
                            </select>

                            @if ($errors->has('priority'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message" class="col-md-4 control-label">Message <span class="required">*</span></label>

                        <div class="col-md-6">
                            <textarea rows="10" id="message" class="form-control" name="message">{{old('message')}}</textarea>

                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
	                <div class="form-group{{ $errors->has('screenshot') ? ' has-error' : '' }}">
                        <label for="screenshot" class="col-md-4 control-label">Screenshot</label>
	                	<div class="col-md-6 uploadfrm">
						    <p><span class="col-md-3 pull-left btn btn-file">
				            <i class="fa fa-plus"></i> Upload Image <input  type="file"  name="screenshot" class="btn btn-md" accept=".jpg, .png, .jpeg" onchange="changeRequired(this)">
				            </span>
				            <span class="file col-md-8 col-md-offset-1">If you have any document, please upload here </span></p>
                            
                        </div>
                        @if ($errors->has('screenshot'))
                            <div class="row col-md-10 col-md-offset-4">
                                <span class="row help-block">
                                    <strong>{{ $errors->first('screenshot') }}</strong>
                                </span>
                            </div>
                        @endif
	                </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-ticket"></i> Open Ticket
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>    
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
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
    function getTitle(categoryid){
        console.log(categoryid)
        if(categoryid==''){
            emptySelection('title');
            return true;
        }
        var url = 'support-ticket/'+categoryid+'/get-title';
        var xhr = ajaxGetObj(url);
        xhr.done(function(resp){
            //console.log(resp);
            createSelection('title', resp, 'id', 'name');
        }).fail(function(reason){
            var rsp = reason.responseJSON;
            toast(rsp);
        });

    }
</script>

<?php
    include(resource_path() . '/views/client/footer.blade.php');
?>