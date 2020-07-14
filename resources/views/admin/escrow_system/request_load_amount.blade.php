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
                <h3 class="box-title">List of Request Load Amount</h3>

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
                	<select id="selectentry" onchange="table1(event)">
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
                        <th>Client Name</th>
                        <th>Post Id</th>
                        <th>Post Description</th>
                        <th>Voucher Id</th>
                        <th>Deposited Amount</th>
                        <th>Deposited Bank</th>
                        <th style="width:15%;">ACTIONS</th>
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
<!-- Edit Modal -->
<div id="paymentSlipModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Payment Details: <span id="subject-user"></span></h4>
                </div>
                <div class="modal-body">
                    <form id="payment-form" role="form" method="post" onsubmit="paymentSlipForm(event)">
                        <input type="hidden" name="ecdid" id="ecdid">
                        <input type="hidden" name="eswid" id="eswid">
                        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="voucher_id"><span class="required">*</span>Voucher Id</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name='voucher_id' id='voucher_id' class="form-control">
                                    <div id="voucher_id-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="amount_deposit"><span class="required">*</span> Deposit Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name='amount_deposit' id='amount_deposit' class="form-control">
                                    <div id="amount_deposit-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="deposit_from"><span class="required">*</span> Deposit From</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="deposit_from" id="deposit_from" />
                                    <div id="deposit_from-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <input id="submit-payment" type="submit" class="btn btn-success" value="Submit">
                        <input type="reset" class="btn btn-success pull-right" value="Reset Form">
                    </form>
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
var baseUrl = "<?php echo url('admin/client-post/request-load-amount'); ?>";
function table1(){
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
    table1();
}

function createTable(resp){
    createDataTableLoadAmount('material-table',resp,['name','post_id','description','voucher_id','amount_deposit','deposit_from'],'id');
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
                // console.log(data[i]);
                var row = t.insertRow(rowCount);


                //row.insertCell().innerHTML[0] = rowCount;
                for (var f in fields) {
                    row.insertCell(f).innerHTML = getText(data[i], fields[f]); //data[i][fields[f]];
                }
                if (actions != 1) {
                    row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"edit('" + data[i]['post_id'] + "','"+ data[i]['id']+"','"+data[i]['voucher_id']+"','"+ data[i]['amount_deposit']+"','"+ data[i]['deposit_from']+"')\" class='btn btn-xs m-1 btn-primary' title='Edit'><i class='fa fa-edit'></i></a><a href='javascript:void(0)' onclick=\"approve('" + data[i]['id'] + "')\" class='btn btn-xs m-1 btn-primary' title='Approve'><i class='fa fa-check'></i></a><a href='javascript:void(0)' onclick=\"reject('" + data[i]['id'] + "')\" class='btn btn-xs m-1 btn-danger' title='Reject'><i class='fa fa-close'></i></a><a target='_blank' href='{{url('/').'/payment-slip'}}/"+data[i]['payment_slip']+"' class='btn btn-xs m-1 btn-info'>File</a>";
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
function edit(ecdid, eswid, voucherId,amount,bank){
    console.log(ecdid);
    $('#payment-form #ecdid').val(ecdid);
    $('#payment-form #eswid').val(eswid);
    $('#payment-form #voucher_id').val(voucherId);
    $('#payment-form #amount_deposit').val(amount);
    $('#payment-form #deposit_from').val(bank);
    $('#paymentSlipModal').modal('show');
    return true;
}
function paymentSlipForm(e){
    e.preventDefault();
    var url = 'edit';
    var data = $('#payment-form').serialize();
    console.log(data);
    var xhr = submitFormAjax(url, data);
    xhr.done(function(resp){
        resetForm('#payment-form');
        $('#paymentSlipModal').modal('hide');
        toast(resp);
        table1();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function approve(ecdid){
    var url = ecdid+'/approve';
    var xhr = ajaxPostObj(url);
    xhr.done(function(resp){
        table1();
        toast(resp);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
function reject(ecdid){
    var url = ecdid+'/reject';
    var xhr = ajaxPostObj(url);
    xhr.done(function(resp){
        table1();
        toast(resp);
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        toast(rsp);
    });
}
table1();

</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>
