<?php if(!request()->ajax()):
    include(resource_path().'/views/header.php');
    include(resource_path().'/views/admin/leftmail-aside.php');
 endif; ?>
<div class="row">
    <div id="second-content-section" class="col-md-12">
    	<div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of Client Users</h3>

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
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
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
                     <tr>
                        <th>S.N.</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>District</th>
                        <th>Address</th>
                        <th>Occupation</th>
                        <th>Created Date</th>
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
<script>
    var baseUrl = "<?php echo url('admin/client-users'); ?>";
function table(lp=null){
    var stat = $('#status').val();
    // console.log(stat);
    var url = "list-data";
    var entry = $("#selectentry").val() || '';
    var search = $("#searchfill").val() || '';
    var index = lp || 1;
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
    createDataTableClientUsers('material-table',resp,['name','email','mobile','district_name','address','occupation','created_at'],'id',0,1);
}
function createDataTableClientUsers(domId, response, fields, pk, actions, sn) {
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
                    if(data[i]['status'] == 1){
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"deactivateUser('" + data[i][pk] + "')\" class='btn btn-xs btn-warning' title='Deactivate User'>Deactivate User</i></a>";
                    }else{
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"activateUser('" + data[i][pk] + "')\" class='btn btn-xs btn-warning' title='Activate User'>Activate User</i></a>";
                    }
                }
                if (sn == 1) {
                    row.insertCell(0).innerHTML = rowCount;
                }
                rowCount++;

            }
            createPaginationUser(response);
        } else {
            //console.log('No data provided to crate table.');
        }
    } else {
        //console.log('Dom with id ' + domId + ' not found.');
    }
}
function createPaginationUser(resp) {
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

function deactivateUser(id){
    var url = 'deactivate/'+id;
    var confr = window.confirm("Are you sure you want to deactivate user?");
    if (confr) {
        var xhr = ajaxPostObj(url);
        xhr.done(function(resp){
            toast(resp);
            table();
        }).fail(function(reason){
           var rsp = reason.responseJSON;
           toast(rsp); 
        });
    }
}
function activateUser(id){
    var url = 'activate/'+id;
    var confr = window.confirm("Are you sure you want to activate user?");
    if (confr) {
        var xhr = ajaxPostObj(url);
        xhr.done(function(resp){
            toast(resp);
            table();
        }).fail(function(reason){
           var rsp = reason.responseJSON;
           toast(rsp); 
        });
    }
}
table();

</script>
<?php if(!request()->ajax()):
 include(resource_path().'/views/footer.php');
endif;?>