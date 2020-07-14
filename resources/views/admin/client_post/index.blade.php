<?php if (!request()->ajax()) :
    include(resource_path() . '/views/header.php');
    include(resource_path() . '/views/admin/leftmail-aside.php');
endif; ?>
<style type="text/css">
    .latest .latest-item {
        padding: 10px;
        margin-left: 10px;
        font-size: 15px;
        border-bottom: 1px solid #1231;
        text-align: left;
    }

    .latest .title {
        font-weight: bold;
        color: #188c18e0;
        letter-spacing: 0.5px;
    }

    .latest .value {
        color: #000;
    }

    #detail-modal .latest {
        height: 400px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .select2-selection__choice {
        color: #000 !important;
    }

    .error {
        color: darkred;
    }
</style>
<div class="row">
    <div id="second-content-section" class="col-md-12">
        <div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of Client Post</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div id="table" class="box-body">
                <form id="tableform">
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
                    <form id="srch" name="srch" onsubmit="searchClicked(event)">
                        <input id="searchfill" placeholder="  search here" type="text" name="search">
                        <button type="submit" id="searchbtn" name="submit" style="float:right"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div id="showtable" class="box-body table-responsive">
                    <table id="material-table" class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>S.N</th>
                            <th>Client Name</th>
                            <th>Phone Number</th>
                            <th>Post Category</th>
                            <th>Address</th>
                            <th>Estimated Cost</th>
                            <th>Bid Duration</th>
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
        </div>
    </div>
</div>
<!-- Post Details Modal -->
<div id="detail-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Post Details
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body latest" style="padding:0px !important;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-top:15px !important;">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="user-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Manually Send Post
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body">
                <form onsubmit="approve(event);" role='form' id="user-form" method="POST">
                    <input type="hidden" name="post_id" id="post_id" />
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="service_provider">Service Providers</label>
                        <select class="js-example-basic-multiple form-control" name="service_provider[]" id="service_provider" multiple="multiple">
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success" style="margin-top:15px !important;">Send For Biding</button>
                        <button type="button" class="btn btn-success pull-right" style="margin-top:15px !important;" onclick="autoSendForBid()">Auto Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Post Details Modal End -->
<script>

  // $(document).ready(function() {
  // });
var baseUrl = "<?php echo url('admin/client-post'); ?>";
function table(){
    var url = "list-data";
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
    createDataTablePost('material-table',resp,['name','mobile','category','address','estimated_cost','duration_days','email'],'id',0,1);
}

function createDataTablePost(domId, response, fields, pk, actions, sn) {
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
                    row.insertCell(fields.length).innerHTML = "<a data-async='fullpage' href=\""+baseUrl+"/edit/"+ data[i][pk] + "\" class='btn btn-xs m-1 btn-primary' title='Edit'><i class='fa fa-edit'></i></a> <a href='javascript:void(0)' onclick=\"getServiceProviderFromPost('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-primary' title='Approve'><i class='fa fa-check'></i></a> <a href='javascript:void(0)' onclick=\"reject('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-danger' title='Reject'><i class='fa fa-close'></i></a><a href='javascript:void(0)' onclick=\"details('" + data[i][pk] + "')\" class='btn btn-xs btn-info m-1'>Details</a>"+
                        ((data[i]['filepath'] != '' )?"<a class='btn btn-xs m-1 btn-info' href="+data[i]['filepath']+" target='_blank' download="+data[i]['originalFilename']+">View File</a>":"");
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
function details(postid){
    $('.latest').empty();
    var url = postid+'/details';
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
        var html = '';
        $('#detail-modal').modal('show');
        for(var i in resp){
            html += '<div class="latest-item col-md-12"><div class="title col-md-4">';
            html += i;
            html +='</div><div class="value col-md-8">';
            html += resp[i] || '-';
            html += '</div></div>';
        }
        $('.latest').html(html);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function autoSendForBid(){
    dataApproveTosend();
}
function approve(e){
    $('.error').text('');
    e.preventDefault();
    if($('#service_provider').val()==null){
      $('.error').text('* Choose items either from supply or services');
      return false;
    }
    dataApproveTosend();

}
function dataApproveTosend(){
    var postid = $('#post_id').val();
    var url = postid+'/approve';
    var data = $('#user-form').serialize();
    var xhr = submitFormAjax(url, data);
    xhr.done(function(resp){
        resetForm('#user-form');
        $('#user-modal').modal('hide');
        table();
        toast(resp);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function getServiceProviderFromPost(postid){
    $('.error').text('');
    resetForm('#user-form');
    $('#post_id').val(postid);
    var url = postid + '/service-providers';
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp) {
        $('#user-modal').modal('show');
        createSelection1('service_provider', resp, 'id', 'contact_name','');
        $('.js-example-basic-multiple').select2();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}

function reject(postid){
    var url = postid+'/reject';
    var xhr = ajaxPostObj(url);
    xhr.done(function(resp){
        toast(resp);
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
