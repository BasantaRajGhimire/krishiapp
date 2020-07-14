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
                <h3 class="box-title">List of Balance Release</h3>

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
                        <th>Vendor</th>
                        <th>Client</th>
                        <th>Payment Phase</th>
                        <th>Request Amount</th>
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
                    <h4 class="modal-title">Upload Payment Details: <span id="subject-user"></span></h4>
                </div>
                <div class="modal-body">
                    <form id="payment-form" role="form" method="post" onsubmit="paymentSlipForm(event)" enctype="multipart/form-data">
                        <input type="hidden" value="" name="post_id" id="post_id">
                        <input type="hidden" value="" name="request_id" id="request_id">
                        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="amount_deposit"><span class="required">*</span> Voucher/Transaction Id</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name='voucher_id' id='voucher_id' class="form-control">
                                    <div id="voucher_id-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="deposit_amount"><span class="required">*</span> Deposit Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name='deposit_amount' id='deposit_amount' class="form-control" onInput="checkInputTotal(this,this.value)">
                                    <div id="deposit_amount-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="deposit_from"><span class="required">*</span> Deposit Bank</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="deposit_from" id="deposit_from" />
                                    <div id="deposit_from-err" class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="payment_slip"><span class="required">*</span> Upload Payment Slip</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="payment_slip" id="payment_slip">
                                    <div id="payment_slip-err" class="error"></div>
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
  var totalAmount = 0;
var baseUrl = "<?php echo url('admin/client-post/approved-requestamount-loaded'); ?>";
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
    createDataTableLoadAmount('material-table',resp,['post_id','description','contact_name','name','phase','total_amount'],'id');
}
function checkInputTotal(t,value){
    if(value == totalAmount){
        $(t).css('border','1px solid green');
    }else{
        $(t).css('border','1px solid red');
    }
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
                    row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"balanceRelease('" + data[i]['post_id'] + "','"+ data[i]['id']+"','"+ data[i]['total_amount']+"')\" class='btn btn-xs btn-primary'>Balance Release</a>";
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
function balanceRelease(postid, id, total){
    // console.log(ecdid);
    totalAmount = total;
    $('#payment-form #post_id').val(postid);
    $('#payment-form #request_id').val(id);
    $('#paymentSlipModal').modal('show');
    return true;
}
function paymentSlipForm(e){
    e.preventDefault();
    var url = 'balance-release';
    if(parseInt($('#deposit_amount').val()) != totalAmount){
        toast({'title':'Error','status':0,'message':'Release Amount not equal to request amount.'})
        return false;
    }
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
