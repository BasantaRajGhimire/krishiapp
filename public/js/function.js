/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

///onclick 
(function () {
    $(".treeview").hover(function () {

        $(".plus").css({display: "inline"});
    }, function () {

        $(".plus").css({display: "none"});
    });

    //on hover edit
    $(".mail-list").hover(function () {

        $("#edit").css({display: "inline"});
    }, function () {

        $("#edit").css({display: "none"});
    });
    //for menu active-top 
    $('#top-static-menu ul li a').click(function () {
        $('li a').removeClass("active-header");
        $(this).addClass("active-header");
    });
    //for menu active-sidebar 
    $('.treeview-menu li a').click(function () {
        $('.treeview-menu li a').removeClass("active-sidebar");
        $(this).addClass("active-sidebar");
    });
    //on click menu bell
    $("#bell").on('click', function () {
        $(".right-contaner").addClass("disnone");
        $(".right-contaner-bell").toggleClass("disnone");
        $(".right-contaner-help").addClass("disnone");
        //$(".right-contaner-bell").toggleClass( "disnone " ,200, "easeOutSine" );
        // $("#class").toggleClass( "col-lg-9" );
        if ($(".right-contaner-bell").hasClass("disnone")) {
            $("#main-body").removeClass("col-lg-9").addClass("col-lg-12");
            $("#bell").removeClass("active-header");
        } else {
            $("#main-body").removeClass("col-lg-12").addClass("col-lg-9");
        }


    });
    //on click th
    $("#test").on('click', function () {

        $(".right-contaner-bell").addClass("disnone");
        $(".right-contaner-help").addClass("disnone");
        $(".right-contaner").toggleClass("disnone");
        //$(".right-contaner").toggleClass( "disnone " ,200, "easeOutSine" );
        // $("#class").toggleClass( "col-lg-9" );
        if ($(".right-contaner").hasClass("disnone")) {
            $("#main-body").removeClass("col-lg-9").addClass("col-lg-12");
            $("#test").removeClass("active-header");
        } else {
            $("#main-body").removeClass("col-lg-12").addClass("col-lg-9");
        }

    });

    // document ready here

})();
//for dragbar 
var i = 0;
var dragging = false;
$('#dragbar').mousedown(function (e) {
    e.preventDefault();
    dragging = true;
    var main = $('#main');
    var ghostbar = $('<div>',
            {id: 'ghostbar',
                css: {
                    height: main.outerHeight(),
                    top: main.offset().top,
                    left: main.offset().left
                }
            }).appendTo('body');
    $(document).mousemove(function (e) {
        ghostbar.css("left", e.pageX + 2);
    });
});
$(document).mouseup(function (e) {
    if (dragging)
    {
        var percentage = (e.pageX / window.innerWidth) * 100;
        var mainPercentage = 100 - percentage;
        $('#console').text("side:" + percentage + " main:" + mainPercentage);
        $('#sidebar').css("width", percentage + "%");
        $('#main').css("width", mainPercentage + "%");
        $('body').removeClass("sidebar-collapse");
        $("#main").css("float", "right");
        $('#ghostbar').remove();
        $(document).unbind('mousemove');
        dragging = false;
    }
});
// for remove main flot:right
$(".sidebar-toggle").on('click', function () {
    if ($("body").hasClass("sidebar-collapse")) {
        $("#main").css("float", "right");
    } else {
        $("#main").css("float", "none");
    }

});
//make the navigation active & open
(function ($) {

    //for making the adminlte leftmenu active seeing the current url
    var currentUrl = document.location.href;
    //var a = $('ul.sidebar-menu').find('a[href*="'+currentUrl+'"]:first');
    $('ul.sidebar-menu').find('a').each(function () {
        var href = $(this).attr('href');
        if (currentUrl.indexOf(href) !== -1) {
            $(this).parents('li.treeview').addClass('active');
            $(this).addClass('active-sidebar');
            return false;
        }
    });
    //end of making adminlte leftmentu active functionality
}(jQuery));
//function responsible for loadig animation on ajax requst/response events
(function ($) {
    //start ajax animations & other Operations
    var gt = gLoader;
    $(document).ajaxStart(function () {
        showLoader();
    });
    //stop ajax animations & other operations
    $(document).ajaxStop(function () {
        hideLoader();
    });
    
    //stop ajax animation always
    $.ajaxSetup({
       always:function(){
           hideLoader();
       } 
    });
    
    //adding history to the history api for popping it later
    $(document).ajaxSuccess(function (e, jqxhr, options) {
        var requestUrl = options.url;
        if (requestUrl !== window.location.href) {
            $('section.sidebar ul.sidebar-menu a[data-async="fullpage"]').each(function () {
                var url = $(this).attr('href');
                if (url == requestUrl) {
                    var stateObj = {
                        url: requestUrl
                    }
                    var title = $(this).text();
                    window.history.pushState(stateObj, title, requestUrl);
                }
            });
        }
    });
}(jQuery));
(function ($) {
    var mc = mainContainer;
    $("body").on("click", "a[data-async='linkpage']", function (e) {
        e.preventDefault();
        var fullUrl = $(this).attr('href');
        var index = fullUrl.split('#')[1];
        console.log(index);
        loadPage(fullUrl, mc);
    });
}(jQuery));
//for bindig links to laod async
(function ($) {
    var mc = mainContainer;
    $("body").on("click", "a[data-async='fullpage']", function (e) {
        e.preventDefault();
        var fullUrl = $(this).attr('href');
        //console.log(fullUrl);
        loadPage(fullUrl, mc);
    });
}(jQuery));

(function ($) {
    //var mc = 'student-enroll';
    $("body").on("click", "a[data-async='tabpage']", function (e) {
        e.preventDefault();
        //console.log($(this));
        $('a.nav-link').removeClass('show active');
        $('#myTabContent div').removeClass('show active');
        $('#myTabContent div ').html('');
        var fullUrl = $(this).attr('href');
        //console.log(fullUrl);
        var mc =$(this).attr('aria-controls');
        $(this).addClass('show active');
        $('#myTabContent #'+mc).addClass('show active');
        loadPage(fullUrl, mc);
    });
}(jQuery));
//this function must run on every page load 
(function ($) {
    var mc = mainContainer;
    renderPartialPages(mc);
    enableStackedPopups();
}(jQuery));

$(document).ready(function () {
    //menu plus minus
    //function adsearch(){
    $('.treeview a').on('click', function () {
        if ($(this).children().hasClass('fa-plus')) {
            $(this).children('i.fa-plus').removeClass('fa-plus').addClass('fa-minus');
        } else {
            $(this).children('i.fa-minus').removeClass('fa-minus').addClass('fa-plus');
        }
    });
    
    
    
    //advanced search
    //$//('.advanced-serch').on('click',function(){
   
    //)
});
 function adsearch() {
     //alert('fdas');
        $('.advanced-serch').toggleClass('active');
        if($('.advanced-serch').hasClass('active')){
             $('.adv-search ').addClass('active');
              $('.advanced-serch i').removeClass('fa-angle-double-down').addClass('fa-angle-double-up');
        }
        else {
            $('.advanced-serch i').removeClass('fa-angle-double-up').addClass('fa-angle-double-down');
            $('.adv-search ').removeClass('active');
        }
    }
    
    function autocomplete(id,source,value){
    var ac = $( "#"+id ).autocomplete({
      source: source,
      minLength:0,
      select:function(e,ui){
          populateDataDarta(ui.item.value,value);
          $('#mail_patra_sankhya').focus();
      }
    });
    ac.focus(function(){
        $(this).autocomplete('search',this.value);
    });
    }

    function callPagination(resp,path) {

    var cp = resp.current_page;
    var lp = resp.last_page;
    var linkSelect = $("body #pagings ul");
    var activeLink = parseInt(linkSelect.find("li.active").text());
    linkSelect.find("li.active").removeClass("active");

    $("body #pagings ul li").remove();
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
        linkSelect.append("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"')\">" + i + "</a></li>");

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
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"' )\">Prev</a></li>");
    } else {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"')\">Prev</a></li>");
    }
    if (activeLink != resp.last_page) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"')\">Next</a></li>");
    } else {
        linkSelect.append("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"' )\">Next</a></li>");
    }
    if (lAdjuster == 5) {
        linkSelect.prepend("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"')\">1</a></li>");

    }
    if (uAdjuster == 5) {
        linkSelect.append("<li><a href='javascript:void(0)' onclick=\"pages(event," + lp + ",'" + path.toString() +"')\">" + lp + "</a></li>");
    }
    if (resp.from == null && resp.to == null) {
        var info = "<div id='entriesinfo' style='float:left'>No Records Found.</div>"
        $('body #table #entriesinfo').empty();
        $("#tables").append(info);
    } else {
        var info = "<div id='entriesinfo' style='float:left'>Showing " + resp.from + " to " + resp.to + " from " + resp.total + " entries.</div>"
        $('body #table #entriesinfo').empty();
        $("#tables").append(info);
    }
    return true;
}

function pages(e, last,path) {
        e.preventDefault();
        var entry = $("#selectentry").val();
        var page = e.target.text;
        var index = $("body #pagings ul li.active").text();
        if (page === "Prev") {

            if (index == "1") {
                return true;
            } else {
                index--;

                page = index;
            }
        }
        if (page === "Next") {
            if (index == last) {
                return true;
            } else {
                index++;

                page = index;
            }
        }
        if(path=="search-criteria"){
             $.ajax({

    method:'post',
    url:baseUrl+"/"+path+"?entry="+entry+"&page="+page+"&search="+$("#searchfill").val()+"&snameEn="+$("#snameEn").val()+"&snameNp="+$("#snameNp").val()+"&stypes="+$("#stypes").val()+"&sdistrict="+$("#sdistrict").val(),
    success:function(response){
        // createTable(response);
       createTables(response);


    },
    fail:function(){
        alert("failed");
    }
});

        }else{
       $.ajax({

    method:'get',
    url:baseUrl+"/"+path+"/list-data?entry="+entry+"&page="+page+"&search="+$("#searchfill").val(),
    success:function(response){
        // createTable(response);
       createTables(response);


    },
    fail:function(){
        alert("failed");
    }
});
   }
   }
// review and ratings 


    (function(e){
        var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

  $('#new-review').autosize({append: "\n"});

  var reviewBox = $('#post-review-box');
  var newReview = $('#new-review');
  var openReviewBtn = $('#open-review-box');
  var closeReviewBtn = $('#close-review-box');
  var ratingsField = $('.ratings-hidden');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
      {
        $('#new-review').trigger('autosize.resize');
        newReview.focus();
      });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
      {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
    closeReviewBtn.hide();
    
  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
  $('p.starrr').children('span.glyphicon').on('mouseover', function(e){
        e.stopPropagation();
        // alert('ok');
  });
  $('p.starrr').children('span.glyphicon').on('click', function(e){
        e.stopPropagation();
        // alert('ok');
  });
});

