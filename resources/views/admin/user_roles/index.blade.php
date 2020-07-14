<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<div class="box col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Admin Users & Roles</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div id="table" class="box-body">
                        <form id="tableform" >
                        <b>SHOW</b><select id="selectentry" onchange="table(event)">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                            <b>ENTRIES</b>
                          </form>
                            <div style="float:right">
                      <form id="srch" name="srch" onsubmit="searchClicked(event)" >
                    <input  id="searchfill" placeholder="Search" type="text" name="search">
                    <button type="submit"  id="searchbtn" name="submit"><i class="fa fa-search"></i></button>
                  </form>
                </div>

                        <div id="showtable" class="box-body">
                            <table id="admtype-table" class="table table-striped table-bordered">
                              <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>ACTIONS</th>
                              </tr>
                              
                                </table>
                        </div>
                      <div id="pagg">
                        <ul class="pagination pagination-sm">
                        </ul>
                          </div>
                    </div>
    
<div id="reset-admin-password" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reset Password: <span id ="subject-user"></span></h4>
            </div>
            <div class="modal-body">
                <form role="form" onsubmit="submitFormReset(event)" method="post" id="form" class="">
                    <input type="hidden" value="" name="user-id" id="user-id">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="password">New Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name='password' id='password' class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name='password_confirmation' id='password_confirmation' class="form-control" >
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                    <input type="reset" class="btn btn-success pull-right" value="Reset Form">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="user-perm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick ="resetList()" >
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Assign Menu Access Permission</h4>
            </div>
            <div class="modal-body">
                <div class="tab-content clearfix">
                        <div id="list-box" class="box col-md-12">
                           
                            <form role="form" method="post" id="listform" class="oas-form" onsubmit="SubmitListPermission(event);" >
                                <input type="hidden" id="user_id" name="user_id" />
                                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token();?>"/>
                                <div class="box-body">
                                    <!-- Default unchecked -->
                                    @foreach($menu_parent as $mp)
									<div class="custom-control custom-uncheckbox">
									    <input type="checkbox" class="custom-control-input" id="{{ $mp->menu_id }}" name="permissions[{{ $mp->menu_id }}]">
									    <label class="custom-control-label" for="{{ $mp->menu_id }}">{{ $mp->menu_name }}</label>
									</div>
								@endforeach
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" onClick="resetForm()" class="btn btn-info pull-right">Reset</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>

        </div>
            <!-- /.modal-content -->
    </div>
</div>
<script>
    var baseUrl = "<?php echo url('/'); ?>";
function table(){
    var url = baseUrl +'/admin/users';
    url += "/list-data";
    var entry = $("#selectentry").val() || '';
    var search = $("#searchfill").val() || '';
    var index = $("body #pagg ul li.active").text() || 1;
    url += "?entry="+entry+"&page="+index+"&search="+search;
    var xhr = ajaxGetObj(url);
    xhr.done(function(response){
        createTable(response);
    }).fail(function(){
        console.log("failed");
    });
}

function searchClicked(e){
    e.preventDefault();
    table();
}

function createTable(resp){
    createDataTableAdmUsers('admtype-table',resp,['id','name','email'],'id');
}

function createDataTableAdmUsers(domId,response,fields,pk,actions,sn){
    if($('#'+domId).length){
        var t = document.getElementById(domId);
        var dom = $('#'+domId);
        $(dom).find("tr:gt(0)").remove();
        var rowCount = 1;
        var data = response.data;
        if(data.length){
            
            for(var i in data){
               var row = t.insertRow(rowCount);
                for(var f in fields){
                    row.insertCell(f).innerHTML = getText(data[i],fields[f]); //data[i][fields[f]];
                }
                if(actions!=1 ){
                 row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' title='Edit Role' onclick=\"assignRoles('"+data[i][pk]+"')\" class='btn btn-xs btn-primary'><i class='fa fa-gear'></i></a>&nbsp;&nbsp;<a href='javascript:void(0)' onclick=\"resetPass('"+data[i][pk]+"','"+data[i]['name']+"')\" class='btn btn-xs btn-danger' title='Reset Password'><i class='glyphicon glyphicon-refresh'></i></a>";
                }
                if(sn==1){
                    row.insertCell(0).innerHTML= rowCount; 
                }
                                rowCount++;

            }
            createPagination(response);
        }else{
            console.log('No data provided to crate table.');
        }
    }else{
        console.log('Dom with id '+ domId+' not found.');
    }
}
function SubmitListPermission(e){
    e.preventDefault();
    var url = baseUrl +'/admin'
    url += '/user-roles/manage-permission'
    var formData = $("#listform").serialize();
    var xhr = submitFormAjax(url,formData);
    xhr.done(function(resp){
        resetForm($('#form'));
        //table();
        toast(resp);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function assignRoles(id){
	$('#user_id').val(id);
    $('#user-perm').modal('show');

}

function resetPass(id,user){
    $('#user-id').val(id);
    $('#subject-user').html(user);
    $('#reset-admin-password').modal('show');
}

$('#reset-admin-password').on('hidden.bs.modal', function () {
    $('#user-id').val('');
    $('#subject-user').html('');
    $('#password').val('');
    $('#password_confirmation').val('');
});

function submitFormReset(e){
    e.preventDefault();
    var url = baseUrl + '/auth/reset-admin-pass';
    var formData = $(e.target).serialize();
    var xhr = submitFormAjax(url,formData);
    xhr.done(function(resp){
        $('#reset-admin-password').modal('hide');
        toast(resp);
    }).fail(function(resp){
        toast(resp.responseJSON);
    });
    
}
table();
</script>
</div>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>