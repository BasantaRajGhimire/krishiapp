<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
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
  .latest .value{
    color:#d92424cc;
  }
  #detail-modal .latest{
    height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
  .select2-selection__choice{
    color:#000 !important;
  }
  .error{
    color:darkred;
  }
  .required{
    color:red;
  }
 </style>
<div class="row">
    <div id="second-content-section" class="col-md-12">
        <div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of No Response Payment</h3>

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
                        <th>Post Id</th>
                        <th>Post Description</th>
                        <th>Client Comment</th>
                        <th>Service Provider Comment</th>
                        <th>Payment Phase</th>
                        <th style="width:25%;">ACTIONS</th>
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
<!-- Post Details Modal End -->
<script>

  // $(document).ready(function() {
  // });
var baseUrl = "<?php echo url('admin/client-post/no-response-payment'); ?>";
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
    createDataTableLoadAmount('material-table',resp,['post_id','description','client_comment','serviceprovider_comment','phase'],'id');
}

function createDataTableLoadAmount(domId, response, fields, pk, actions, sn) {
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
                    row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"cancelRequest('" + data[i]['post_id'] + "','"+ data[i]['id']+"','"+ data[i]['espid']+"')\" class='btn btn-xs m-1 btn-primary'>Cancel Request</a><a href='javascript:void(0)' onclick=\"sendRequestAgain('" + data[i]['post_id'] + "','"+ data[i]['id']+"','"+ data[i]['espid']+"')\" class='btn btn-xs m-1 btn-primary'>Send Request Again</a>";
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
function cancelRequest(postid, id, espid){
    // console.log(ecdid);
    var url = 'cancel-request';
    var data = {id: id, post_id:postid,espid:espid};
    var xhr = ajaxPostObj(url, data);
    xhr.done(function(resp){
        toast(resp);
        table();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function sendRequestAgain(postid, id, espid){
    // console.log(ecdid);
    var url = 'send-request-again';
    var data = {id: id, post_id:postid,espid:espid};
    var xhr = ajaxPostObj(url, data);
    xhr.done(function(resp){
        toast(resp);
        table();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function paymentSlipForm(e){
    e.preventDefault();
    var url = 'balance-release';
    var data = new FormData($('form#payment-form')[0]);
    var xhr = submitFormAjaxWithFile(url, data);
    xhr.done(function(resp){
        resetForm('#payment-form');
        $('#paymentSlipModal').modal('hide');
        toast(resp);
        table();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        console.log(rsp);
        toast(rsp);
    });
}
function reject(ecdid){
    var url = ecdid+'/reject';
    var xhr = ajaxPostObj(url);
    xhr.done(function(resp){
        table();
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
