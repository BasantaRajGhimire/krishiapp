<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; 
 ?>
 <style type="text/css">
 .required{
     color:red;
 }
 </style>
<div class="row">
    <div id="second-content-section" class="col-md-12">
        <div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of Requested Quote</h3>

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
                    <select id="selectentry" onchange="table()">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <b>ENTRIES</b>
                </form>
                <div class="col-md-3" style="float:left">
                    <select id="status" class="col-md-8 form-control" onchange="table()">
                        <option value="PENDING">Pending</option>
                        <option value="APPROVED">Replied Mail </option>
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
                     <tr id="heading">
                        <th>S.N.</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th id="date">Created Date</th>
                        <th id="actions">ACTIONS</th>
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
<div id="quote-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Quote to Email: <span id="subject-user"></span></h4>
            </div>
            <div class="modal-body">
                <form id="bid-form" role="form" action="{{url('/admin/request-quote/send-email')}}" onsubmit="sendQoute(event)" method="post" id="form" class="">
                    <input type="hidden" value="" name="id" id="id">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="quote"><span class="required">*</span> Quote</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="quote" id="quote"></textarea>
                                <div id="quote-err" class="error"></div>
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
    var baseUrl = "<?php echo url('admin/request-quote'); ?>";
function table(lp=null){
    var status = $('#status').val();
    console.log(lp)
    var stat = status || 'PENDING';
    if(stat == 'APPROVED'){
        $('#actions').hide();
        $('#heading').append('<th id="replied">Replied Message</th>');
        $('#date').text('Replied Date');
    }else{
        $('#replied').remove();
        $('#date').text('Created Date');
        $('#actions').show();
    }
    var url = "list-data";
    var entry = $("#selectentry").val() || '';
    var search = $("#searchfill").val() || '';
    var index =  lp || 1;
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
    table();
}

function createTable(resp){
    createDataTablRequest('material-table',resp,['user_name','product_name','mobile','email_address','description','created_at'],'id',0,1);
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
                    if(fields[f] == 'created_at'){
                        // console.log(data[i]['updated_at'])
                        row.insertCell(f).innerHTML = data[i]['updated_at'];
                    }else{
                        row.insertCell(f).innerHTML = getText(data[i], fields[f]); //data[i][fields[f]];
                    }
                }
                if (actions != 1) {
                    if(data[i]['status'] == 'PENDING'){
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"ShowQuoteModal('" + data[i][pk] + "')\" class='btn btn-xs m-1 btn-success' title='Send Qoute'>Send Quote</a>";
                    }
                    if(data[i]['status'] == 'APPROVED'){
                        row.insertCell(fields.length).innerHTML = data[i]['replied_message'];
                    }
                }
                if (sn == 1) {
                    row.insertCell(0).innerHTML = rowCount;
                }
                rowCount++;

            }
            createPagination1(response);
        } else {
            //console.log('No data provided to crate table.');
        }
    } else {
        //console.log('Dom with id ' + domId + ' not found.');
    }
}
function createPagination1(resp) {
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
        linkSelect.append("<li><a href='javascript:void(0)' onclick='table(" + i + ")'>" + i + "</a></li>");

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
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='table(" + lp + ")'>Prev</a></li>");
    } else {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='table(" + lp + ")'>Prev</a></li>");
    }
    if (activeLink != resp.last_page) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='table(" + lp + ")'>Next</a></li>");
    } else {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='table(" + lp + ")'>Next</a></li>");
    }
    if (lAdjuster == 5) {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='table(" + lp + ")'>1</a></li>");

    }
    if (uAdjuster == 5) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='table(" + lp + ")'>" + lp + "</a></li>");
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

function ShowQuoteModal(id){
    $('#id').val(id);
    console.log('ok')
    $('#quote-modal').modal('show');
}

function sendQoute(e){
    e.preventDefault();
    var url = $('#quote-modal form').attr('action');
    var formData = $('#quote-modal form').serialize();
    var xhr = submitFormAjax(url, formData);
    xhr.done(function(resp){
        console.log(resp);
        toast(resp);
        resetForm($('#quote-modal form'));
        $('#quote-modal').modal('hide');
        table();
    }).fail(function(reason){
        var rsp = reason.responseJSON;
        console.log(rsp);
        toast(rsp);
    });

}
table();

</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>