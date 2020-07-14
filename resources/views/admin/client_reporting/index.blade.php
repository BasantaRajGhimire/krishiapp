<?php if (!request()->ajax()) :
    include(resource_path() . '/views/header.php');
    include(resource_path() . '/views/admin/leftmail-aside.php');
endif;
$badge = App\Admin\Batch::all();
?>
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
        color: #d92424cc;
    }

    #detail-modal .latest {
        height: 400px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .Verified {
        background-color: #62d562;

    }

    .Unverified {
        background-color: yellow;
        color: #000;
    }

    .Rejected {
        background-color: red;
    }

    .Inactive {
        background: #777;
    }

    #year,
    #month {
        border: 1px solid rgb(169, 169, 169) !important;
        margin: 0;
    }
</style>
<div class="row">
    <div id="second-content-section" class="col-md-12">
        <div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">Client Reporting</h3>

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
                    <div class="d-flex mt-4 align-items-center">
                        <b>FILTER BY</b>
                        <select id="duration" onchange="changeState(this.value)">
                            <option value="">Select duration Type</option>
                            <option value="year">Yearly</option>
                            <option value="month">Monthly</option>
                            <option value="custom">Custom</option>
                        </select>
                        <div class="d-block pl-2" id="custom" style="display:none">
                            <b class="ml-3"><small>START BY</small></b>
                            <input type="date" name="date_from" class="" id="date_from" />
                            <b class="ml-3"><small>END BY</small></b>
                            <input type="date" name="date_to" class="" id="date_to" oninput="$('#month').val('');$('#year').val('');table(event)" />
                        </div>
                        <select id="year" style="display:none" onchange="clickYear(this.value)">
                            <option value="">Select Year</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                        <select id="month" style="display:none" onchange="$('#custom input').val('');table(event)">
                            <option value="">Select Month</option>
                            @foreach($month as $m)
                            <option value="{{$m->month_num}}">{{$m->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div style="float:right">
                    <form id="srch" name="srch" onsubmit="searchClicked(event)">
                        <input id="searchfill" placeholder="  search here" type="text" name="search">
                        <button type="submit" id="searchbtn" name="submit" style="float:right"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div id="showtable" class="box-body">
                   <div class="table-responsive">
                        <table id="material-table" class="table table-striped table-bordered">
                            <tr>
                                <th>S.N.</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>Pending Post</th>
                                <th>Running For Bid</th>
                                <th>Rejected Post</th>
                                <th>Handover to Bidder</th>
                                <th>Delivered Post</th>
                                {{-- <th>ACTIONS</th> --}}
                            </tr>
    
                        </table>
                   </div>
                </div>
                <div id="pagg">
                    <ul class="pagination pagination-sm">
                    </ul>
                </div>
                <div class="row">
                <form role="form" id="download-form" method="GET" action="{{url('admin/client-report/download')}}">
                    {{ csrf_field() }}
                    <input type="hidden" id="file" name="file" value="" />
                    <button id="download" target="_blank" class="btn btn-primary pull-right" style="display:none;" onclick="clickDownload(event)">Download Excel</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#file').val('');
    $(document).ready(function(){
        $('input').val('');
        $('select').each(function(){
            if(this.id != "selectentry"){
                this.value = '';
            }
        })
    })
    var baseUrl = "<?php echo url('admin/client-report'); ?>";

    function changeState(select){
        $('#year').hide();
        $('#month').hide();
        $('#custom').hide();
        if(select=='month'){
            $('#year').val('');
            $('#'+select).show();
            $('#year').show();
        }else{
            $('#'+select).show()
        }
    }
    function clickYear(value){
        $('#month').val('');
        $('#custom input').val('');
        if($('#duration').val() != 'month'){
            table(event);
        }
    }
    function clickDownload(e){
        e.preventDefault();
        $('#file').val('on');
        // var url = baseUrl+'/download';
        var month = $('#month').val() || '';
        var dateTo = $('#date_to').val() || '';
        var dateFrom = $('#date_from').val() || '';
        var year = $('#year').val() || '';
        // var file = $('#file').val() || '';
        if(dateTo !='' && dateFrom !=''){
            $('#download-form').append('<input type="hidden" name="date_to" value="'+dateTo+'">');
            $('#download-form').append('<input type="hidden" name="date_from" value="'+dateFrom+'">');
        }
        if(month !=''){
            $('#download-form').append('<input type="hidden" name="month" value="'+month+'">');
        }
        if(year != ''){            
            $('#download-form').append('<input type="hidden" name="year" value="'+year+'">');
        }
        $('#download-form').submit();
    }

    function table() {
        var url = "list-data";
        var entry = $("#selectentry").val() || '';
        var month = $('#month').val() || '';
        var dateTo = $('#date_to').val() || '';
        var dateFrom = $('#date_from').val() || '';
        var year = $('#year').val() || '';
        var search = $("#searchfill").val() || '';
        var index = $("body #pagg ul li.active").text() || 1;
        url += "?entry=" + entry + "&page=" + index + "&search=" + search;
        if(dateTo !='' && dateFrom !=''){
            url +='&date_to='+dateTo+'&date_from='+dateFrom;
        }
        if (month != '') {
            url += "&month=" + month;
        }
        if (year != '') {
            url += "&year=" + year;
        }
        var xhr = ajaxGetObj(url);
        xhr.done(function(response) {
            $('#download').hide();
            if(response.data.length != 0){
                $('#download').show();
            }
            createTable(response);
        }).fail(function() {
            console.log("failed");
        });
    }

    function searchClicked(e) {
        e.preventDefault();
        table();
    }

    function createTable(resp) {
        createDataTablRequest('material-table', resp, ['name', 'status', 'pending_post', 'bidding_post', 'rejected_requested_bids', 'handover_post', 'delivered_post'], 'id', 1, 1);
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
                        if(f==1){
                            row.insertCell(f).innerHTML = "<span class='badge "+data[i][fields[f]]+"'>"+ data[i][fields[f]]+"</span>"
                        }else {
                            row.insertCell(f).innerHTML = getText(data[i], fields[f]); //data[i][fields[f]];
                        }
                    }
                    if (actions != 1) {
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"approveModal('" + data[i][pk] + "')\" class='btn btn-xs btn-primary' title='Approve'><i class='fa fa-check'></i></a>&nbsp;&nbsp;<a href='javascript:void(0)' onclick=\"reject('" + data[i][pk] + "')\" class='btn btn-xs btn-danger' title='Reject'><i class='fa fa-close'></i></a>&nbsp;&nbsp;<a href='javascript:void(0)' onclick=\"showDetails('" + data[i][pk] + "')\" class='btn btn-xs btn-danger' title='Reject'>Details</a>";
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
table();
</script>
<?php 
if (!request()->ajax()) :
    include(resource_path() . '/views/footer.php');
endif;
 ?>