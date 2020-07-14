<?php if (!request()->ajax()):
    include(resource_path() . '/views/header.php');
    include(resource_path() . '/views/admin/leftmail-aside.php');
endif; ?>
<div class="row">
    <div id="second-content-section" class="col-md-12">
        <div class="box col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">List of Processing Tickets</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
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
                </form>
                <div style="float:right">
                    <form id="srch" name="srch" onsubmit="searchClicked(event)">
                        <input id="searchfill" placeholder="  search here" type="text" name="search">
                        <button type="submit" id="searchbtn" name="submit" style="float:right"><i
                                    class="fa fa-search"></i></button>
                    </form>
                </div>
                <div id="showtable" class="box-body table-responsive">
                    <table id="material-table" class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Ticket Id</th>
                            <th>Client</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Screenshot</th>
                            <th>Processed Date</th>
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

<div id="ticket-complete-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ticket Details
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12 form-group">
                    <label for="remarks">Remarks <span style="color: red;">*</span></label>
                    <textarea name="remarks" class="form-control remarks" cols="30" rows="5" autofocus></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-submit"
                        style="margin-top:15px !important;">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="margin-top:15px !important;">Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    var baseUrl = "<?php echo url('admin/serviceprovider-ticket/processing'); ?>";

    function table() {
        var url = "list-data";
        var entry = $("#selectentry").val() || '';
        var search = $("#searchfill").val() || '';
        var index = $("body #pagg ul li.active").text() || 1;
        url += "?entry=" + entry + "&page=" + index + "&search=" + search;
        var xhr = ajaxGetObj(url);
        xhr.done(function (response) {
            createTable(response);
        }).fail(function () {
            console.log("failed");
        });
    }

    function searchClicked(e) {
        e.preventDefault();
        table();
    }

    function createTable(resp) {
        createProcessingTicketTable('material-table', resp, ['ticket_id', 'vendor_name', 'name', 'title','message','screenshot','updated_at'], 'id');
    }

    function createProcessingTicketTable(domId, response, fields, pk, actions, sn) {
        var pathUrl =  "{{url('vendor-ticket')}}";
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
                        if(fields[f] == 'screenshot'){
                            row.insertCell(f).innerHTML = ((data[i]['screenshot'] !=null)?"<a target='_blank' href='"+  pathUrl+'/'+data[i]['screenshot'] +"' class='btn btn-xs btn-default'>Screenshot</a>":"");
                        }else{
                            row.insertCell(f).innerHTML = getText(data[i], fields[f]); //data[i][fields[f]];
                        }
                    }
                    if (actions != 1) {
                        row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' data-id =" + data[i][pk] + " class='btn btn-xs btn-primary btn-complete' >Complete</a>";
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


    function closed(id) {
        var url = id + '?status=Closed&remarks=' + $('#ticket-complete-modal .remarks').val();
        var xhr = ajaxGetObj(url);
        xhr.done(function (resp) {
            $('#ticket-complete-modal').modal('hide');
            toast(resp);
            table();
        }).fail(function (reason) {
            if (reason.responseJSON.errors.remarks) {
                $('#ticket-complete-modal .remarks').focus();
                $('#ticket-complete-modal .remarks').after('<span class="error-msg" style="color: red;">*' + reason.responseJSON.errors.remarks + '</span>');
            } else {
                var rsp = reason.responseJSON;
                toast(rsp);
            }
        });

    }

    $(document).on('click', ".btn-complete", function (e) {
        $('.error-msg').remove();
        var id = $(this).data('id');
        $('#ticket-complete-modal').data('id', id).modal('show');
    });

    $('#ticket-complete-modal .btn-submit').click(function () {
        // handle deletion here
        var id = $('#ticket-complete-modal').data('id');
        closed(id);

    });

    $('#ticket-complete-modal').on('hidden.bs.modal', function (event) {
        $('#ticket-complete-modal .remarks').val('');
    });


    table();

</script>
<?php if (!request()->ajax()):
    include(resource_path() . '/views/footer.php');
endif;?>