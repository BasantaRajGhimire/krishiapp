<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<div class="row">
    <div id="second-content-section" class="col-md-12">
        <div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of Error Logs</h3>

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
                        <th style="width:10%">Line Number</th>
                        <th style="width:20%">Date Created</th>
                        <th style="width:25%">Url</th>
                        <th style="width:45%">Error Message</th>
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
<script>
    var baseUrl = "<?php echo url('admin/error-log'); ?>";
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
    createErrorLogTable('material-table',resp,['line_number','created_at','action','exception'],'id',1);
}
function createErrorLogTable(domId, response, fields, pk, actions, sn) {
    // var pathUrl =  "{{url('vendor-ticket')}}";
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
                    // row.insertCell(fields.length).innerHTML = ((data[i]['screenshot'] !=null)?"<a target='_blank' href='"+  pathUrl+'/'+data[i]['screenshot'] +"' class='btn btn-xs btn-primary'>Screenshot</a>":"");
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
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>