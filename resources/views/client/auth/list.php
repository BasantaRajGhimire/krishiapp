<?php
$lang = t_label_bulk(['Code','ID','Name','Nepali','English','ACTIONS','Search','Edit','Delete','SHOW','ENTRIES']);
?>
<div class="box col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo t_message('List of Administrator Type');?></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div id="table" class="box-body">
                        <form id="tableform" >
                        <b><?php echo $lang['SHOW'];?></b><select id="selectentry" onchange="table(event)">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                            <b><?php echo $lang['ENTRIES'];?></b>
                          </form>
                            <div style="float:right">
                      <form id="srch" name="srch" onsubmit="searchClicked(event)" >
                    <input  id="searchfill" placeholder="<?php echo $lang['Search'];?>" type="text" name="search">
                    <button type="submit"  id="searchbtn" name="submit"><i class="fa fa-search"></i></button>
                  </form>
                </div>

                        <div id="showtable" class="box-body">
                            <table id="admtype-table" class="table table-striped table-bordered">
                              <tr>
                                  <th><?php echo $lang['ID'];?></th>
                                  <th><?php echo $lang['Code'];?></th>
                                  <th><?php echo $lang['Name'];?> [<?php echo $lang['English'];?>]</th>
                                  <th><?php echo $lang['Name'];?> [<?php echo $lang['Nepali'];?>]</th>
                                  <th><?php echo $lang['ACTIONS'];?></th>
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
    var url = "admtypes";
    url += "/list-data";
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
    createDataTable('admtype-table',resp,['levelid','code','levelnameen','levelnamenp'],'levelid');
}

function edit(id){
    var url = "admtypes";
    url += "/"+id+'/edit';
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
        assignValues(resp);
        $('#id').val(resp.levelid);
    }).fail(function(reason){
        toast({status: "0", title: "error", text: "Error on Fetching Data"});
    });

}
function delt(id){
    var url = "admtypes";
    url += "/"+id;
    var xhr = deleteData(url);
    xhr.done(function(resp){
        toast(resp);
        table();
    }).fail(function(reason){
        console.log("Fail");
    });
}
table();
</script>