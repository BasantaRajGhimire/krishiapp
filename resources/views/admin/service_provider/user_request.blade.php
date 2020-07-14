<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; 
 $badge = App\Admin\Batch::all();
 ?>
 <style type="text/css">
    .latest .latest-item{
    padding:10px;
    margin-left:10px;
    font-size:15px;
    border-bottom:1px solid #1231;
    text-align: left;
  }
  .latest .title{
    font-weight: bold;
    color: #188c18e0;
    letter-spacing: 0.5px;
  }
  
  #detail-modal .latest{
    height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
 </style>
<div class="row">
    <div id="second-content-section" class="col-md-12">
    	<div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of User Requests</h3>

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
                	<select id="selectentry" onchange="table(event)">
	                    <option value="10">10</option>
	                    <option value="20">20</option>
	                    <option value="50">50</option>
	                    <option value="100">100</option>
                	</select>
                    <b>ENTRIES</b>
                </form>
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
                        <th>District</th>
                        <th>Email</th>
                        <th>Phone Number</th>
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
<div id="badge-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-badge"></i> Select badge</h4>
            </div>
            <div class="modal-body">
                <form id="approve-form" role="form" onsubmit="approve(event,$('#userid').val())">
                    @csrf
                    <input type="hidden" name="userid" id="userid" />
                    <div class="form-group">
                        <select class="form-control" name="badge" id="badge">
                            @foreach($badge as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                            @endforeach
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
<div id="detail-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">User Details
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </h3>
      </div>
      <div class="modal-body latest" style="padding:0px !important;">
        <div class="latest-item col-md-12">
            <div class="title col-md-4">
                Contact Name
            </div>
            <div class="value col-md-8">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="margin-top:15px !important;">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    var baseUrl = "<?php echo url('admin/serviceprovider-user'); ?>";
function table(){
    var url = "request-data";
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
    createDataTablRequest('material-table',resp,['contact_name','company_name','district','email','mobile'],'id',0,1);
}
function createDataTablRequest(domId, response, fields, pk, actions, sn) {
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
                    row.insertCell(f).innerHTML = getText(data[i], fields[f]); //data[i][fields[f]];
                }
                if (actions != 1) {
                    row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"approveModal('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-primary' title='Approve'><i class='fa fa-check'></i></a><a href='javascript:void(0)' onclick=\"reject('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-danger' title='Reject'><i class='fa fa-close'></i></a><a href='javascript:void(0)' onclick=\"showDetails('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-danger' title='Reject'>Details</a>";
                }
                if (sn == 1) {
                    row.insertCell(0).innerHTML = rowCount;
                }
                rowCount++;

            }
            createPagination(response);
        } else {
            //console.log('No data provided to crate table.');
        }
    } else {
        //console.log('Dom with id ' + domId + ' not found.');
    }
}
function approveModal(userid){
    // console.log(userid);
    $('#userid').val(userid);
    $('#badge-modal').modal('show');
}
function approve(e,userid){
    e.preventDefault();
    // console.log(userid);
    var formData = $('#approve-form').serialize();
    // console.log(formData);
   var url = userid+'/approve';
    var xhr = submitFormAjax(url, formData);
    xhr.done(function(resp){
        toast(resp);
        $('#badge-modal').modal('hide');
        table();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    }); 
}
function reject(userid){
    var url = userid+'/reject';
    var xhr = ajaxPostObj(url);
    xhr.done(function(resp){
        toast(resp);
        table();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}

function showDetails(userid){
    $('.latest').empty();
    var url = userid+'/details';
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
        var html = '';
        $('#detail-modal').modal('show');
        for(var i in resp){
            console.log(resp);
            html += '<div class="latest-item col-md-12"><div class="title col-md-4">';
            html += getName(i); 
            html +="</div>";
            html += '<div class="value col-md-8">';           
            if(Array.isArray(resp[i])){
                for(var j in resp[i]){
                    html +="<span>"+resp[i][j]['name']+", </span>";
                }
            }else{
                html += resp[i] || '-';
            }
            html += '</div></div>';
        }
        $('.latest').html(html);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function getName(string){
    var str = string.split("_");
    if(str[1]){
        return str[0][0].toUpperCase() +  
                    str[0].slice(1) +' '+str[1][0].toUpperCase() + str[1].slice(1);
    }else{
        return str[0][0].toUpperCase() +  
                    str[0].slice(1);
    }
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
        table();
    }).fail(function(reason){
       var rsp = reason.responseJSON;
       toast(rsp); 
    });
}
table();

</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>