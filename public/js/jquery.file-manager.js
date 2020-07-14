function l87LoadFiles(inputName, data) {
    var html = '';
    if (typeof data !== 'undefined') {
        if (typeof data === 'string' && data !== '') {
            html = l87LoadFileHelper(inputName, data);
        } else if (data instanceof Array) {
            for (var i in data) {
                html += l87LoadFileHelper(inputName + '[]', data[i]);
            }
        }
    }
    if (html != '') {
        html = $.parseHTML(html);
        $(html).find('i.fa.fa-trash').unbind('click').on('click', function () {
            $(this).parent().parent().remove();
        });
    }
    $('#l87-upload-file-preview-' + inputName).empty().append(html);
}
function l87LoadFileHelper(inputName, data) {
    var html = '<div class="item-selected">' +
            '<a href="javascript:void(0)" class="file-item selected"  data-path="' + data + '" title="">';
    html += getExtHtml(data);
    html += '</a>' +
            '<span class="remove-file float-right"><i class="fa fa-trash"></i>' +
            '</span><input type="hidden" name="' + inputName + '" value="' + data + '"></div>';
    return html;
}

function getExtHtml(filePath) {
    var fileExtension = filePath.replace(/^.*\./, '');
    var html = '';
    switch (fileExtension) {
        case 'png':
        case 'jpeg':
        case 'jpg':
            html += '<div class="icons"><img src="' + baseUrl + '/uploads/' + filePath + '" style="width:30px;height:30px;"></div>';
            break;
        case 'pdf':
            html += '<div class="icons" ><i class="fa fa-file-pdf-o fa-2x"></i></div>';
            break;
        case 'doc':
        case 'docx':
            html += '<div class="icons"><i class="fa fa-file-word-o fa-2x"></i></div>';
            break;
        case 'xlsx':
            html += '<div class="icons"><i class="fa fa-file-excel-o fa-2x"></i></div>';
            break;
        default:
            html += '<div class="icons"><i class="fa fa-file fa-2x"></i></div>';
    }
    return html;
}

function l87ClearFiles(id) {
    $('#l87-upload-file-preview-' + id).empty();
}

//(function ($) {
$.fn.manageFileUpload = function (options) {
    var mainId = 'l87-file-uploader';
    var tempListId = 'l87-file-list-temp';
    var listId = 'l87-file-list';
    var currentPage = 1;
    var defaults = {
        listUrl: '',
        uploadUrl: '',
        deleteUrl: '',
        forInput: 'file',
        title: 'Select/Upload File(s)',
        multiFile: false
    };
    var settings = $.extend(defaults, options);
    var instance = this;
    instance.on('click', function () {
        if ($('#' + mainId).length == 0) {
            $('body').append(popUpHtml());
        }
        //syncAlredySelctedFiles();
        $('#' + listId).unbind('click').on('click', '.file-item', function () {
            if (settings.multiFile) {
                $(this).toggleClass('selected');
                $(this).parent().toggleClass('item-selected');
                if ($(this).hasClass('selected')) {
                    addItemToList($(this));
                } else {
                    removeItemFromList($(this));
                }
            } else {
                if ($(this).hasClass('selected')) {
                    $('#' + listId + ' .selected').each(function () {
                        $(this).parent().removeClass('item-selected');
                    });
                    $('#' + listId + ' .selected').removeClass('selected');
                } else {
                    $('#' + listId + ' .selected').each(function () {
                        $(this).parent().removeClass('item-selected');
                    });
                    $('#' + listId + ' .selected').removeClass('selected');
                    $(this).toggleClass('selected');
                    $(this).parent().toggleClass('item-selected');
                }
                updateSelectedList();
            }

        });
        $('#' + mainId).unbind('click').on('click', '#l87-search-button', function () {
            if ($('#l87-search-input').val() == '') {
                return;
            }
            currentPage = 1;
            tableGrid();
        });
        $('#' + mainId).unbind('keypress').on('keypress', '#l87-search-input', function (e) {
            if (e.which == 13) {
                currentPage = 1;
                tableGrid();
            }
        });
        $('#' + mainId).unbind('change').on('change', '#l87-perPage', function (e) {
            currentPage = 1;
            tableGrid();
        });
        $('#selected-files-list').unbind('click').on('click', 'i.fa-trash', function () {
            var div = $(this).parent().parent();
            var id = $(div).find('a').data('id');
            $('#' + listId).find('a[data-id="' + id + '"]').removeClass('selected');
            $('#' + listId).find('a[data-id="' + id + '"]').parent().removeClass('item-selected');
            $(div).remove();
        });
        $('#l87-pagination').unbind('click').on('click', '.page-link', function () {
            if (!$(this).parent().hasClass('active')) {
                $("#" + mainId + ' #l87-pagination .page-item .active').removeClass('active');
                var text = $(this).text();
                if (parseInt(text)) {
                    currentPage = parseInt($(this).text());
                }
                if (text == 'Prev') {
                    if (currentPage == 1) {
                        return;
                    }
                    currentPage = currentPage - 1;
                }
                if (text == 'Next') {
                    var lastPage = parseInt($('#l87-pagination ul li').eq(-2).children().text());
                    if (currentPage == lastPage) {
                        return;
                    }
                    currentPage = currentPage + 1;
                }
                $(this).parent().addClass('active');
                tableGrid();
            }
        });
        $('#l87-insert-files').unbind('click').on('click', function () {
            if (settings.multiFile) {
                instance.parent().next().empty();
                var a = $('#selected-files-list a.file-item').each(function () {
                    var value = $(this).data('path');
                    var name = $(this).find('.file-title').html();
                    var div = $(this).parent().clone();
                    $(div).children().prop('title', name);
                    $(div).find('.file-title').hide();
                    $(div).append('<input type="hidden" name="' + settings.forInput + '[]" value="' + value + '">');
                    $(div).find('i.fa.fa-trash').unbind('click').on('click', function () {
                        $(this).parent().parent().remove();
                    });
                    instance.parent().next().append(div);
                });
            } else {
                var a = $('#selected-files-list a.file-item')[0];
                var value = $(a).data('path');
                var name = $(a).find('.file-title').html();
                var div = $(a).parent().clone();
                $(div).children().prop('title', name);
                $(div).find('.file-title').hide();
                $(div).append('<input type="hidden" name="' + settings.forInput + '" value="' + value + '">');
                $(div).find('i.fa.fa-trash').unbind('click').on('click', function () {
                    $(this).parent().parent().remove();
                });
                instance.parent().next().empty().append(div);
            }
            $('#' + mainId).modal('hide');
        });
        if ($('#l87-da-uploader').dmUploader() != 'undefined') {
            $('#l87-da-uploader').dmUploader('destroy');
        }
        $('#l87-da-uploader').dmUploader({
            url: settings.uploadUrl,
            hookDocument: false,
            multiple: settings.multiFile,
            extraData: {
                _token: $('#_token').val()
            },
            onDragEnter: function () {
                // Happens when dragging something over the DnD area
                this.addClass('active');
            },
            onDragLeave: function () {
                // Happens when dragging something OUT of the DnD area
                this.removeClass('active');
            },
            onNewFile: function (id, file) {
                addFileToList(id, file, tempListId);
            },
            onBeforeUpload: function (id) {
                updateProgress(id, 0);
            },
            onUploadProgress: function (id, percent) {
                updateProgress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                $('#' + id).remove();
                updateUploadSuccessReload(settings.listUrl, settings.listId, settings.forInput);
            },
            onUploadError: function (id, xhr, status, message) {
                uploadFailed(id, message);
            }
        });
        $('#selected-files-list').empty();
        $('#' + mainId).modal('show');
        tableGrid(settings.listUrl, listId, settings.forInput);
    });
    function changeAtts(elm) {
        var icon = $(elm).find('span.remove-file').children();
        $(icon).removeAttr('onclick');
        return elm;
    }

    function syncSelectedFileWithList() {
        if ($('#selected-files-list').find('a[data-id]').length) {
            $('#selected-files-list').find('a[data-id]').each(function () {
                var id = $(this).data('id');
                $('#' + listId).find('a[data-id="' + id + '"]').addClass('selected');
                $('#' + listId).find('a[data-id="' + id + '"]').parent().addClass('item-selected');
            });
        }
    }

    /*function syncAlredySelctedFiles() {
     if ($('#l87-upload-file-preview').find('a[data-id]').length) {
     $('#l87-upload-file-preview').find('a[data-id]').each(function () {
     //var id = $(this).data('id');
     //console.log(this);
     addItemToList($(this));
     });
     syncSelectedFileWithList();
     }
     }*/

    function addItemToList(elm) {
        var id = $(elm).data('id');
        if ($('#selected-files-list').find('a[data-id="' + id + '"]').length) {
            return;
        } else {
            var elm2 = $(elm).parent().clone();
            $('#selected-files-list').append(changeAtts(elm2));
        }
    }

    function removeItemFromList(elm) {
        var id = $(elm).data('id');
        $('#selected-files-list').find('a[data-id="' + id + '"]').parent().remove();
    }

    function updateUploadSuccessReload(listUrl, fileListId, forId) {
        tableGrid(listUrl, fileListId, forId);
    }

    function renderFiles(data) {
        if (data.length) {
            for (var i in data) {
                var html = '<div class="col-md-3 mt-2 list-grid-files"><div>';
                html += '<a href="javascript:void(0)" class="file-item" data-id="' + data[i].id + '" data-path="' + data[i]['file_path'] + '">';
                html += getExtHtml(data[i].file_path);
                html += '<div class="file-title">' + data[i]['name'] + '</div>';
                html += '</a>';
                html += '<span class="remove-file float-right"><i class="fa fa-trash" onclick="removeFile(this,\'' + data[i].id + '\')"></i></span>';
                html += '</div></div>';
                $('#' + listId).append(html);
            }
            syncSelectedFileWithList();
        }
    }

    function updateSelectedList() {
        $('#selected-files-list').empty();
        $('#' + listId + ' .selected').each(function () {
            var elm2 = $(this).parent().clone();
            $('#selected-files-list').append(changeAtts(elm2));
        });
    }
    function tableGrid() {
        var url = settings.listUrl;
        $('#' + listId).empty();
        var entry = $("#l87-perPage").val() || '';
        var search = $("#l87-search-input").val() || '';
        url += "?entry=" + entry + "&page=" + currentPage + "&search=" + search;
        var xhr = ajaxGetObj(url);
        xhr.done(function (response) {
            renderFiles(response.data);
            createPagination(response);
        }).fail(function () {
            console.log("failed");
        });
    }

    function createPagination(resp) {
        var cp = resp.current_page;
        var lp = resp.last_page;
        var linkSelect = $("#" + mainId + " #l87-pagination ul");
        var activeLink = parseInt(linkSelect.find("li.active").text());
        linkSelect.find("li.active").removeClass("active");
        $("#" + mainId + " #l87-pagination ul li").remove();
        $("#" + mainId + " #l87-pagination ul").attr('data-path', resp.path);
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
            linkSelect.append("<li class='page-item' class='page-item'><a class='page-link' class='page-link' href='javascript:void(0)'>" + i + "</a></li>");
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
            linkSelect.prepend("<li class='page-item' class='page-item'><a class='page-link' class='page-link' href='javascript:void(0)'>Prev</a></li>");
        } else {
            linkSelect.prepend("<li class='page-item'><a class='page-link' href='javascript:void(0)'>Prev</a></li>");
        }
        if (activeLink != resp.last_page) {
            linkSelect.append("<li class='page-item'><a class='page-link' href='javascript:void(0)'>Next</a></li>");
        } else {
            linkSelect.append("<li class='page-item'><a class='page-link' href='javascript:void(0)'>Next</a></li>");
        }
        if (lAdjuster == 5) {
            linkSelect.prepend("<li class='page-item'><a class='page-link' href='javascript:void(0)'>1</a></li>");
        }
        if (uAdjuster == 5) {
            linkSelect.append("<li class='page-item'><a class='page-link' href='javascript:void(0)'>" + lp + "</a></li>");
        }
        if (resp.from == null && resp.to == null) {
            var info = "No Records Found."
            $('#l87-item-details').empty();
            $("#l87-item-details").append(info);
        } else {
            var info = "Showing " + resp.from + " to " + resp.to + " of " + resp.total + " entries.</div>";
            $('#l87-item-details').empty();
            $("#l87-item-details").append(info);
        }
        return true;
    }

    function popUpHtml() {
        return `<div class="modal fade" id="${mainId}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">${settings.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="file">File</label>
                    <div class="col-md-9">
                        <div class="col-md-4">
                            <div id="l87-da-uploader" class="dm-uploader text-center">
                                <div class="btn btn-primary">
                                    <span>Browse..</span>
                                    <input title="Click to add Files"  type="file">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="${tempListId}">
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="form-control" id="l87-perPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <input class="form-control" id="l87-search-input" type="text" placeholder="Search..">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button" id="l87-search-button">Search</button>
                            </span>
                        </div>
                    </div>
                </div>
                                                            <hr/>
                <div class="row col-12 uploaded-file-list" id="${listId}">
                </div>
                <hr/>
                <nav><div id="l87-pagination"><ul class="pagination pagination-sm"></ul></div></nav>
                <div id="l87-item-details"></div>
            </div>
            <div class="modal-footer">
                 <div id="selected-files-list"></div>
                <button type="button" class="btn btn-success" id="l87-insert-files">Insert</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>`;
    }
    return this;
}
//}, (jQuery));


//functions needed for DM uploader
function addFileToList(id, file, listid) {
    var html = '<div id="' + id + '" class="progress-group"><div class="progress-group-header"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;' + file.name + '</div>' +
            '<div class="progress-group-bars "><div class="progress-bar progress-xs" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>' +
            '<span class="badge ml-auto" onclick="removeFile(this)" style="cursor:pointer;">X</span></div></div>';
    $('#' + listid).append(html);
}
function addFileToListsrv(files, listid) {
    for (var i in files) {
        var item = files[i];
        var html = '<div  id="' + item.id + '" class="row list-group-item">' +
                '<div class="col-md-4"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>' + item.doc_name + '</div>' +
                '<div class="col-md-6"></div><div class="col-md-2"><span class="badge" onclick="removeFile(this,\'' + item.id + '\')" style="cursor:pointer;">X</span></div></div>';
        $('#' + listid).append(html);
    }
}
function updateProgress(id, percent) {
    var p = percent || 0;
    $('#' + id + ' .progress-bar').css({width: p + '%', }).attr('aria-valuenow', p);
    if (percent == 100) {
        $('#' + id + ' .progress-bar').addClass('bg-success');
    }
}

function updateUploadSuccess(id, data, name) {
    $('#' + id + ' span.badge').attr('onclick', 'removeFile(this,\'' + data.id + '\')');
    var elm = $('#' + id).append('<input type="hidden" name="' + name + '" value="' + data.id + '">');
}

function uploadFailed(id, message) {
    $('#' + id + ' .progress-bar').removeClass('bg-success').addClass('bg-danger').attr('title', message);
}

function removeFile(elm, id) {
    if (typeof id != 'undefined') {
        var conf = confirm('Are you sure to delete this file?');
        if (conf) {
            var url = baseUrl + '/file-repo/remove-file?path=' + id;
            var xhr = ajaxGetObj(url);
            xhr.done(function (response) {
                $(elm).parent().parent().remove();
            }).fail(function () {
                console.log('Error on removing file.');
            });
        }
    } else {
        $(elm).parent().parent().remove();
    }
}