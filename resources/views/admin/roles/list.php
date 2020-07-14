<?php
$lang = t_label_bulk(['Route','Display','ID','Name','ACTIONS','Search','Edit','Delete','SHOW','ENTRIES']);
?>
<div class="box col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo t_message('List of Roles');?></h3>

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
                                  <th><?php echo $lang['Name'];?></th>
                                  <th><?php echo $lang['Display'];?> <?php echo $lang['Name'];?></th>
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
    var url = "roles";
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
    createDataTable('admtype-table',resp,['id','name','display_name'],'id');
}

function edit(id){
    var url = "roles";
    url += "/"+id+'/edit';
    var i;
    var xhr = ajaxGetObj(url);
    xhr.done(function(resp){
        assignValues(resp);
        $('#id').val(resp.id);
        $("input[name='menu[]']").prop("checked",false);
        if(resp.menu.length > 0){
            for(i in resp.menu){
                 $("#menus :checkbox[value="+resp.menu[i]+"]").prop("checked",true);
            }
        }
        $("input[name='permissions[]']").prop("checked",false);
        if(resp.permissions.length > 0){
            for(i in resp.permissions){
                 $("#permissions :checkbox[value="+resp.permissions[i]+"]").prop("checked",true);
            }
        }
    }).fail(function(reason){
        toast({status: "0", title: "error", text: "Error on Fetching Data"});
    });

}
function delt(id){
    var url = "roles";
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