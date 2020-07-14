
// utility functions

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function showLoader() {
    var gt = gLoader;
    $('#' + gt).show();
}
function hideLoader() {
    var gt = gLoader;
    $('#' + gt).hide();
}

function renderPartialPages(domId) {
    //console.log(domId);
    if (typeof domId != 'undefined') {
        var dom = $('#' + domId);
        var pageParts = $(dom).find('[data-page-part]');
        if ($(pageParts).length) {
            $(pageParts).each(function () {
                var id = $(this).attr('id');
                var url = $(this).attr('data-page-part');
                loadPage(url, id);
            });
        }
    }
}

// function that replaces all src tags to data-oassrc
function replaceAttributes(text, search, value) {
    if (text.indexOf(search) != -1) {
        var val = search + '"" ' + value;
        var res = text.replace(search, val);
        return res;
    }
    return text;

}

function setAttributes(dom, search, value) {
    var targetDoms = $(dom).find("[" + search + "]");
    if ($(targetDoms).length) {
        $(targetDoms).each(function () {
            var attValue = $(this).attr(search);
            $(this).attr(value, attValue);
        });
    }
}

/*
 * load page or pages
 * for single page
 */
function loadPageFull(url, domId) {
    //console.log(domId);
    //var session = '<?php echo session("userid");?>';
    //console.log(url);
    var dom = $('#' + domId);
    //console.log(domId);
    if ($('#' + domId).length == 0) {
        //console.log('Container having id '+domId+' not Found.');
    }
    if (url.length <= 7) {
        //console.log('No valid url Provided.');
    }
    var xhr = $.ajax({
        url: url
    });
    xhr.done(function (data) {
        var rawHtml = data;
        var html = rawHtml;//replaceAttributes(rawHtml, 'src=', 'data-oassrc=');
        $(dom).html('');
        $(dom).html(html);
        $(dom).hide().fadeIn(500);
        //setAttributes(dom, 'data-oassrc', 'src');
        setTitle();
        renderPartialPages(domId);
        //common functionalities should be written into common function
        if(typeof common == 'function'){
            common();
        }
    });
    xhr.fail(function () {
        //console.log('Error on loading page.');
    });
}

//load page with partial url
function loadPage(partUrl, domId) {
    var url = makeUrl(partUrl);
    //console.log(partUrl);
    loadPageFull(url, domId);
}

// function takes response and then creates pagination
function createPagination(resp) {
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
        linkSelect.append("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>" + i + "</a></li>");

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
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>Prev</a></li>");
    } else {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>Prev</a></li>");
    }
    if (activeLink != resp.last_page) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>Next</a></li>");
    } else {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>Next</a></li>");
    }
    if (lAdjuster == 5) {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>1</a></li>");

    }
    if (uAdjuster == 5) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick='page(event," + lp + ")'>" + lp + "</a></li>");
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

// assign value to the form inputs
function assignValues(obj) {
    if (typeof obj == 'object') {
        for (var i in obj) {

            if ($('#' + i).length) {
                if (obj[i] === '-' || obj[i] === '') {
                    if ($('#' + i).is('select')) {
                        $('#' + i).val($("#" + i + " option:first").val());
                    } else {
                        $('#' + i).val('');
                    }
                } else {
                    $('#' + i).val(obj[i]);
                }

            }
        }
    }
}

// empties the options of dropdown
function emptySelection(ids) {
    if (Array.isArray(ids)) {
        for (var i in ids) {
            $('#' + ids[i]).empty();
            $('#' + ids[i]).append('<option value="">Select One..</option>');
        }
    } else {
        $('#' + ids).empty();
        $('#' + ids).append('<option value="">Select One..</option>');
    }
}

// creates the selection with provided data
function createSelection(id, data, selValue, selLabel, value) {
   
    $('#' + id).empty();
    $('#' + id).append('<option value="">Select One...</option>');
    for (var i in data) {
        $('#' + id).append('<option value="' + data[i][selValue] + '">' + data[i][selLabel] + '</option>');
    }
    $('#' + id).val(value || '');
}
function createSelection1(id, data, selValue, selLabel, value) {
   
    $('#' + id).empty();
    for (var i in data) {
        $('#' + id).append('<option value="' + data[i][selValue] + '">' + data[i][selLabel] + '</option>');
    }
    $('#' + id).val(value || '');
}

// resets the given form 
function resetForm(form) {
    $(form).trigger('reset');
    if ($('#id').length) {
        $('#id').val('');
    }
}

// provides object for submitting forms with ajax
function submitFormAjax(url, data) {
    var fullUrl = makeUrl(url);
    return $.ajax({
        method: "POST",
        url: fullUrl,
        data: data
    });
}

function submitFormAjaxWithFile(url, data){
    var fullUrl = makeUrl(url);
    return $.ajax({
        method: "POST",
        url: fullUrl,
        data: data,        
        cache: false,
        contentType: false,
        processData: false
    });
}
// ajax gets the object fo ajax get request
function ajaxGetObj(url) {
    var fullUrl = makeUrl(url);
    return $.ajax({
        url: fullUrl,
    });
}

function ajaxPostObj(url, data) {
    var fullUrl = makeUrl(url);
    return $.ajax({
        method: "POST",
        url: fullUrl,
        data: data
    });
}
function createDataTable(domId, response, fields, pk, actions, sn) {
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
                    row.insertCell(fields.length).innerHTML = "<a href='javascript:void(0)' onclick=\"edit('" + data[i][pk] + "')\" class='btn btn-xs btn-primary' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>&nbsp;&nbsp;<a href='javascript:void(0)' onclick=\"delt('" + data[i][pk] + "')\" class='btn btn-xs btn-danger' title='Delete'><i class='glyphicon glyphicon-trash'></i></a>";
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
function getText(data, field) {
    var text = '';
    if (typeof field == 'object') {
        if (field.hasOwnProperty('fields') && field.fields.length) {
            var format = field.hasOwnProperty('format') ? field.format : " ";
            for (var i in field.fields) {
                if (i == field.fields.length - 1) {
                    var tempText = data[field.fields[i]];
                } else {
                    var tempText = data[field.fields[i]] + format;
                }
                if (field.hasOwnProperty('surround') && field.surround.field == field.fields[i]) {
                    tempText = field.surround.start + tempText + field.surround.end;
                }
                text += tempText;
            }
            return text.trim() || '';
        }
    } else {
        return data[field] || '';
    }
}

function deleteData(url) {
    var fullUrl = makeUrl(url);
    var confr = window.confirm("Are you sure you want to delete?");
    if (confr) {
        var data = {_method: 'DELETE', _token: $('#_token').val()};
        return submitFormAjax(fullUrl, data);
    }
}

function makeUrl(url) {
    if (url.indexOf('http') > -1) {
        return url;
    } else {
        return (baseUrl + '/' + url);
    }
}

function getSeletedText(id, def = '-') {
    if ($('#' + id).length) {
        var value = $('#' + id + ' option:selected').val();
        var text = $('#' + id + ' option:selected').text();
        if (value == '') {
            return def;
        } else {
            return text;
        }
    }
}


function enableStackedPopups() {
    $('.modal').on('show.bs.modal', function (event) {
        var idx = $('.modal:visible').length;
        $(this).css('z-index', 1040 + (10 * idx));
    });

    $('.modal').on('shown.bs.modal', function (event) {
        var idx = ($('.modal:visible').length) - 1; // raise backdrop after animation.
        $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
        $('.modal-backdrop').not('.stacked').addClass('stacked');
    });
}

function setAstrik(data) {
    if (typeof data != 'undefined' && data.length > 0) {
        for (var i in data) {
            var label = $('#' + data[i]).prev('label');
            var newLabel = $(label).html() + '&nbsp;<span class="required" style="color:red">*</span>';
            $(label).html(newLabel);
        }
    }
}
function parseDate(timestamp) {
    //yyyy-mm-dd H:i:s
    var date = '';
    var time = '';
    if (timestamp.indexOf(' ') > 0) {
        var tarr = timestamp.split(' ');
        date = tarr[0];
        time = tarr[1];
    } else {
        date = tarr;
    }
    var datearr = date.split('-');
    var fpdate = datearr[1] + '/' + datearr[2] + '/' + datearr[0];
    return fpdate;
}

function showReview(postid){
    $('#post-review-box_'+postid).show();
    $('#close-review-box_'+postid).show();
    $('#review-show_'+postid).hide();
}
function hideReview(postid){
    $('#post-review-box_'+postid).hide();
    $('#close-review-box_'+postid).hide();
    $('#review-show_'+postid).show();
}



