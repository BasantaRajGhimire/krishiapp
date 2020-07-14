<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif;
 $badge = App\Admin\Batch::all();
  ?>
 <style type="text/css">
     .required{
        color:red;
     }
     .error{
        color:red;
     }
 </style>
<div class="row">
    <div id="second-content-section" class="col-md-12" >
    	<div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of Service Provider Users</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div id="table" class="box-body">
                <form id="tableform" >
                	<b>SHOW</b>
                	<select id="selectentry" onchange="tableUser()">
	                    <option value="10">10</option>
	                    <option value="20">20</option>
	                    <option value="50">50</option>
	                    <option value="100">100</option>
                	</select>
                    <b>ENTRIES</b>
                </form>
                <div class="col-md-3" style="float:left">
                    <select id="status" class="col-md-8 form-control" onchange="tableUser()">
                        <option value="1">Active Users</option>
                        <option value="4">Deactivated Users</option>
                    </select>
                </div>
                <div style="float:right">
                    <form id="srch" name="srch" onsubmit="searchClicked(event)" >
                    	<input  id="searchfill" placeholder="  search here" type="text" name="search">
                    	<button type="submit"  id="searchbtn" name="submit" style="float:right"><i class="fa fa-search"></i></button>
                  	</form>
                </div>
                <div id="showtable" class="box-body table-responsive">
                    <table id="material-table" class="table table-striped table-bordered table-hover">
                     <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Badge</th>
                        <th>District</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Created Date</th>
                        <th>ACTIONS</th>
                     </tr>
					  
                    </table>
                </div>
                <div id="pagg">
                    <ul class="pagination pagination-sm">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="update-badge-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-badge"></i> Update badge</h4>
            </div>
            <div class="modal-body">
                <form id="approve-form" role="form" onsubmit="updateBadge(event,$('#userid').val())">
                    @csrf
                    <input type="hidden" name="userid" id="userid" />
                    <div class="form-group">
                        <select class="form-control" name="badge" id="badge">
                            @foreach($badge as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                            @endforeach
                            <option value="">No Badge</option>
                        </select>
                    </div>  
                    <div class="model-footer">
                        <button type="submit" class="btn btn-primary">Approve</button>
                        <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="load-amount-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Load Amount: <span id ="subject-user"></span></h4>
            </div>
            <div class="modal-body">
                <form id="load-form" role="form" action="{{url('/admin/load-amount')}}" onsubmit="storeLoadAmount(event)" method="post" id="form" class="">
                    <input type="hidden" value="" name="service_provider_id" id="service_provider_id">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="load_amount"><span class="required">*</span> Load Amount</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name='load_amount' id='load_amount' class="form-control" >
                            <div id="load_amount-err" class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="remarks"><span class="required">*</span> Remarks</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="remarks" id="remarks"></textarea>
                            <div id="remarks-err" class="error"></div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                    <input type="reset" class="btn btn-success pull-right" value="Reset Form">
                </form>
            </div>
        </div>

    </div>
</div>
<script>
    var baseUrl = "<?php echo url('admin/serviceprovider-user'); ?>";
function tableUser(lp=null){
    var stat = $('#status').val();
    var url = "users-data";
    var entry = $("#selectentry").val() || '';
    var search = $("#searchfill").val() || '';
    var index = lp || 1;
    url += "?entry="+entry+"&page="+index+"&search="+search+"&status="+stat;
    var xhr = ajaxGetObj(url);
    xhr.done(function(response){
        createTable(response);
    }).fail(function(){
        console.log("failed");
    });
}

function searchClicked(e){
    e.preventDefault();
    tableUser();
}
function storeLoadAmount(e){   
    e.preventDefault(); 
    var url = $('#load-form').attr('action');
    var data = $('#load-form').serialize();    
    var xhr = submitFormAjax(url, data);
    xhr.done(function (resp) {
      console.log(resp);
      resetForm($('#load-form'));
      $('#load-amount-modal').modal('hide');
      toast(resp);

    }).fail(function (reason) {
        var resp = reason.responseJSON;
        console.log(resp);        
        for(var i in resp){
          $('#'+i+'-err').show();
          $('#'+i+'-err').text('*' +resp[i][0] + '*');
          console.log(resp[i]);
        }       
        $('.error').show();
    });
}
function createTable(resp){
    createDataTableUsers('material-table',resp,['contact_name','company_name','badge','district_name','email','mobile','created_at'],'id',0,1);
}
function createDataTableUsers(domId, response, fields, pk, actions, sn) {
    if ($('#' + domId).length) {
        var t = document.getElementById(domId);
        var dom = $('#' + domId);
        $(dom).find("tr:gt(0)").remove();
        var rowCount = 1;
        var data = response.data;
        if (data.length) {

            for (var i in data) {
                var row = t.insertRow(rowCount);


                //row.insertCell().innerHTML[0] = rowCount;
                for (var f in fields) {
                    if(fields[f] == 'badge'){
                        console.log(data[i]['badge'])
                        if(data[i]['badge'] != null){
                            var html ='<div class="d-flex justify-contents-center mb-4"><div class="ttooltip"><div class="d-flex align-items-baseline">'
                            if(data[i]['badge_id'] == 1){
                                console.log('ok')
                                html += '<div class="ribbon  ribbon--gray"><i class="fas fa-award"></i></div> <b class="pl-2" style="color:#8d8d8d;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">'+ data[i]['badge']+'</b>'
                            }
                            if(data[i]['badge_id'] == 2){
                                html += '<div class="ribbon  ribbon--orange"><i class="fas fa-trophy"></i></div> <b class="pl-2" style="color:#E7711B;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">'+ data[i]['badge']+'</b>'
                            }
                            if(data[i]['badge_id'] == 3){
                                html += '<div class="ribbon  ribbon--purple"><i class="fas fa-crown"></i></div> <b class="pl-2" style="color:#1C91C0;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">'+ data[i]['badge']+'</b>'
                            }
                            if(data[i]['badge_id'] == 4){
                                html += '<div class="ribbon  ribbon--purple"><i class="fas fa-gem"></i></div> <b class="pl-2" style="color:#5C3292;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">'+ data[i]['badge']+'</b>'
                            }
                            html += '</div><div class="arrow" style="left: 45px;"></div></div></div></div></div>'
                        }else{
                            var html = 'No any badge';
                        }
                        row.insertCell(f).innerHTML = html;
                    }else{
                        row.insertCell(f).innerHTML = getText(data[i], fields[f]); //data[i][fields[f]];
                    }
                }
                if (actions != 1) {
                    if(data[i]['status'] == 1){
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"deactivateUser('" + data[i][pk] + "')\" class='btn btn-xs btn-warning' title='Deactivate User'>Deactivate User</i></a><a href='javascript:void(0)' onclick=\"BadgeModal('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-primary' title='Update Badge'>Update Badge</a>";
                    }else{
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"activateUser('" + data[i][pk] + "')\" class='btn btn-xs btn-warning' title='Activate User'>Activate User</i></a>";
                    }
                    // row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"loadAmount('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-primary' title='Load Amount'>Load Amount</a><a href='javascript:void(0)' onclick=\"BadgeModal('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-primary' title='Update Badge'>Update Badge</a>";
                }
                if (sn == 1) {
                    row.insertCell(0).innerHTML = rowCount;
                }
                rowCount++;

            }
            createPaginationUser(response);
        } else {
            //console.log('No data provided to crate table.');
        }
    } else {
        //console.log('Dom with id ' + domId + ' not found.');
    }
}
function createPaginationUser(resp) {
    var cp = resp.current_page;
    var lp = resp.last_page;
    var linkSelect = $("body #pagg ul");
    var activeLink = parseInt(linkSelect.find("li.active").text());
    linkSelect.find("li.active").removeClass("active");
    $("body #pagg ul li").remove();
    $("#pagg ul").attr('data-path', resp.path);
    var lAdjuster = 0;
    var uAdjuster = 0;
    if (cp > 1) {
        lAdjuster = cp > 5 ? 5 : cp - 1;
    }
    if (lp > cp) {
        uAdjuster = (lp - cp) > 5 ? 5 : (lp - cp);

    }
    for (var i = cp - lAdjuster; i <= cp + uAdjuster; i++)
    {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='tableUser(" + i + ")'>" + i + "</a></li>");

    }
    if (activeLink == 0) {

        linkSelect.find("li:eq(1)").addClass("active");

    } else {
        linkSelect.children().find("a:contains(" + resp.current_page + ")").filter(function () {

            return $(this).text() == resp.current_page;
        }).parent().addClass("active");
    }
    var activeLink = parseInt(linkSelect.find("li.active").text());
    if (activeLink != 1) {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='tableUser(" + lp + ")'>Prev</a></li>");
    } else {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='tableUser(" + lp + ")'>Prev</a></li>");
    }
    if (activeLink != resp.last_page) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='tableUser(" + lp + ")'>Next</a></li>");
    } else {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='tableUser(" + lp + ")'>Next</a></li>");
    }
    if (lAdjuster == 5) {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='tableUser(" + lp + ")'>1</a></li>");

    }
    if (uAdjuster == 5) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='tableUser(" + lp + ")'>" + lp + "</a></li>");
    }
    if (resp.from == null && resp.to == null) {
        var info = "<div id='entriesinfo' style='float:left'>No Records Found.</div>"
        $('body #table #entriesinfo').empty();
        $("#table").append(info);
    } else {
        var info = "<div id='entriesinfo' style='float:left'>Showing " + resp.from + " to " + resp.to + " from " + resp.total + " entries.</div>"
        $('body #table #entriesinfo').empty();
        $("#table").append(info);
    }
    return true;
}
function deactivateUser(id){
    var url = 'deactivate/'+id;
    var confr = window.confirm("Are you sure you want to deactivate user?");
    if (confr) {
        var xhr = ajaxPostObj(url);
        xhr.done(function(resp){
            toast(resp);
            tableUser();
        }).fail(function(reason){
           var rsp = reason.responseJSON;
           toast(rsp); 
        });
    }
}
function activateUser(id){
    var url = 'activate/'+id;
    var confr = window.confirm("Are you sure you want to activate user?");
    if (confr) {
        var xhr = ajaxPostObj(url);
        xhr.done(function(resp){
            toast(resp);
            tableUser();
        }).fail(function(reason){
           var rsp = reason.responseJSON;
           toast(rsp); 
        });
    }
}
function BadgeModal(userid){
    $('#userid').val(userid);
    console.log(userid);
    $('#update-badge-modal').modal('show');
}
function updateBadge(e,userid){
    e.preventDefault();
    // console.log(userid);
    var formData = $('#approve-form').serialize();
    // console.log(formData);
   var url = userid+'/update-badge';
    var xhr = submitFormAjax(url, formData);
    xhr.done(function(resp){
        toast(resp);
        $('#update-badge-modal').modal('hide');
        tableUser();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    }); 
}

function loadAmount(id){
    resetForm($('#load-form'));
    $('.error').text('');
    $('#load-amount-modal').modal('show');
    $('#service_provider_id').val(id);
}
function edit(id){
    var url = id+'/edit';
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
        assignValues(resp);
        $('#iid').val(resp.iid);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });

}

function delt(id){
    var url = id;
    var xhr = deleteData(url);
    xhr.done(function(resp){
        toast(resp);
        tableUser();
    }).fail(function(reason){
       var rsp = reason.responseJSON;
       toast(rsp); 
    });
}
tableUser('1');

</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>