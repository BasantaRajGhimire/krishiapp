<style type="text/css">
    td{
        text-align:justify;
    }
</style>
<div class="box col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Frequently Asked Questions</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div id="table" class="box-body">
                        <form id="tableform" >
                        <b>SHOW</b><select id="selectentry" onchange="table(event)">
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

                        <div id="showtable" class="box-body">
                            <table id="material-table" class="table table-striped table-bordered">
                             <tr>
                                <th>S.No.</th>
                                <th>Brand Name</th>
                                <th>Brand Logo</th>
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
    createDataTableBrand('material-table',resp,['brand_name','brand_logo'],'id',0,1);
}
function createDataTableBrand(domId, response, fields, pk, actions, sn) {
    var logoUrl = '{{url('/')}}';
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
                    if(f == 1){
                        row.insertCell(f).innerHTML = '<img width="210px" height="100px" class="img-thumbnail" src="'+logoUrl+data[i][fields[f]]+'" />';
                    }else{                        
                    row.insertCell(f).innerHTML = getText(data[i], fields[f]);
                    } //data[i][fields[f]];
                }
                if (actions != 1) {
                    row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"delt('" + data[i][pk] + "')\" class='btn btn-xs btn-danger' title='Delete'><i class='glyphicon glyphicon-trash'></i></a>";
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