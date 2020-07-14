<div class="box col-md-6">
    <div class="box-header with-border">
        <h3 class="box-title">List of Material</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div id="table" class="box-body ">
        <form id="tableform">
            <b>SHOW</b><select id="selectentry" onchange="table(event)">
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

        <div id="showtable" class="box-body table-responsive-sm">
            <table id="material-table" class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Material Name</th>
                    <th>Decription</th>
                    <th>ACTIONS</th>
                </tr>

            </table>
        </div>
        <div id="pagg">
            <ul class="pagination pagination-sm">
            </ul>
        </div>
    </div>

    <script>
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
    createDataTable('material-table',resp,['name','description'],'id');
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