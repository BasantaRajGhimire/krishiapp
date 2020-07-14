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
    $("#mail-list").hover(function () {

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
//        alert('hello');
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
    ///on click help
    $("#help").on('click', function () {
        $(".right-contaner-bell").addClass("disnone");
        $(".right-contaner").addClass("disnone");
        $(".right-contaner-help").toggleClass("disnone");

        //$(".right-contaner").toggleClass( "disnone " ,200, "easeOutSine" );
        // $("#class").toggleClass( "col-lg-9" );
        if ($(".right-contaner-help").hasClass("disnone")) {
            $("#main-body").removeClass("col-lg-9").addClass("col-lg-12");
            $("#help").removeClass("active-header");
        } else {
            $("#main-body").removeClass("col-lg-12").addClass("col-lg-9");
        }

    });
    ///on click New
    $("#new-mail").on('click', function () {
        // $("#second-body-mail").addClass("disnone");
        //$(".right-contaner").addClass("disnone");
        $("#second-body-mail").toggleClass("disnone");

        //$(".right-contaner").toggleClass( "disnone " ,200, "easeOutSine" );
        // $("#class").toggleClass( "col-lg-9" );
        //if($(".right-contaner-help").hasClass("disnone")){
        //   $("#main-body").removeClass("col-lg-9").addClass("col-lg-12");
        // }else{
        //      $("#main-body").removeClass("col-lg-12").addClass("col-lg-9");
        // }

    });
    $('.close-mail').on('click',function(){
        $("#second-body-mail").addClass("disnone");
    });
    ///on check inbox
    $("#check").on('click', function () {
        $("#check-hide-show").toggleClass("disnone");
    });
    ///on click draft
    $("#mail-list").on('click', function () {
        $("#check-hide-show").toggleClass("disnone");
    });

}

)();

//add text editor
 $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
  
  //add calender
  

  
  //menu click 
  $(function (){
      
       $("#junk-mail").on('click', function () {
           $("#inbox-body").addClass("disnone");
           $("#sent-items-body").addClass("disnone");
           $("#drafts-body").addClass("disnone");
           
           $("#junk-mail-body").removeClass("disnone");
           
       });
       $("#inbox").on('click', function () {
           $("#sent-items").removeClass("active");
           $("#junk-mail-body").addClass("disnone");
            $("#sent-items-body").addClass("disnone");
            $("#drafts-body").addClass("disnone");
            
           $("#inbox-body").removeClass("disnone");
           $("#inbox").addClass("active");
           
       });
       $("#sent-items").on('click', function () {
           $("#sent-items").removeClass("active");
           $("#inbox-body").addClass("disnone");
           $("#junk-mail-body").addClass("disnone");
           $("#drafts-body").addClass("disnone");
           
           $("#sent-items-body").removeClass("disnone");
            $("#sent-items").addClass("active");
       });
       $("#drafts").on('click', function () {
           $("#inbox-body").addClass("disnone");
           $("#junk-mail-body").addClass("disnone");
           $("#sent-items-body").addClass("disnone");
           
           $("#drafts-body").removeClass("disnone");
           
       });
  });
  
  //for dragbar 
  var i = 0;
var dragging = false;
   $('#dragbar').mousedown(function(e){
       e.preventDefault();
       
       dragging = true;
       var main = $('#main');
       var ghostbar = $('<div>',
                        {id:'ghostbar',
                         css: {
                                height: main.outerHeight(),
                                top: main.offset().top,
                                left: main.offset().left
                               }
                        }).appendTo('body');
       
        $(document).mousemove(function(e){
          ghostbar.css("left",e.pageX+2);
       });
       
    });

   $(document).mouseup(function(e){
       if (dragging) 
       {
           var percentage = (e.pageX / window.innerWidth) * 100;
           var mainPercentage = 100-percentage;
           
           $('#console').text("side:" + percentage + " main:" + mainPercentage);
           
           $('#sidebar').css("width",percentage + "%");
           $('#main').css("width",mainPercentage + "%");
           $('body').removeClass("sidebar-collapse");
           $("#main").css("float","right");
           $('#ghostbar').remove();
           $(document).unbind('mousemove');
           dragging = false;
       }
    });
          
// for remove main flot:right
 $(".sidebar-toggle").on('click', function () {
     if ($("body").hasClass("sidebar-collapse")) {
            $("#main").css("float","right");
            
        } else {
            $("#main").css("float","none");
        }             

    });