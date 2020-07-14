$(document).ready(function () {
  $('.secondpage').hide(),
    $('.thirdpage').hide(),
    $('#secondviewhide').hide(),
    $('#finish').hide(),
    $('#gobacktofirstview').hide(),
    $('#gobacktosecondview').hide(),

    //initialize tag editor for multiple users only
    $('#multiowner_name').tagEditor({
      forceLowercase: false,
      placeholder: 'Owner/s (use , to seperate)',
      // autocomplete: {
      //   delay: 0, // show suggestions immediately
      //   position: {
      //     collision: 'flip'
      //   }, // automatic menu position up/down
      // },
      delimiter: ','
    }), //but hide it at first as it depends on company type single or partnership
    // $('#multiowner').hide();
  //on scroll nav bar will shrink
  $(window).scroll(function () {
      // checks if window is scrolled more than 50px
      if ($(this).scrollTop() > 50) {
        $('.navbar').css('height', '70px');
      } else {
        $('.navbar').css('height', '80px');
      }
    }),

    //to top 
    $(window).scroll(function () {
      if ($(this).scrollTop() > 200) {
        $('#totop').fadeIn();
      } else {
        $('#totop').fadeOut();
      }
    }),

    $('#totop').click(function () {
      $("html, body").animate({
        scrollTop: 0
      }, 500);
      return false;
    }),
    $('.owl-carousel').owlCarousel({
      loop: true,
      nav: true,
      navText: ['<i class="fa fa-angle-left fa-2x text-white"></i>', '<i class="fa fa-angle-right fa-2x text-white"></i>'],
      dots: true,
      items: 1,
      autoplay: true,
      autoplayHoverPause: true,
    }), $('.count').each(function () {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
          $(this).text(Math.ceil(now));
        }
      });
    })
});

var placeholder = '';
function registerHideVendor(value, e) {
  // e.preventDefault();
  var contractor = ["productsold", "itemsold", "multiowner"];
  var consulting = ["companyclass", "multiowner","productsold"];
  var wholeseller = ["machineandtools", "multiowner"];
  var manufacturer = [ "machineandtools","multiowner"];
  var tool = ["companyclass", "companytype", "productsold", "multiowner"];
  $(".form-group").removeClass('hide').addClass('show');
  if(value == 10001 || value == 10002){
    console.log(value);
    console.log('ok');
    $('#productsold').show();
    $('#machineandtools').hide();
  }else{
    console.log('sorry');
    console.log(value);
    $('#machineandtools').show();
    $('#productsold').hide();
  }
  // if (value == 3) {
  //   placeholder = 'Contracting Services';
  //   for (var i in contractor) {
  //     $("#" + contractor[i]).removeClass('show').addClass('hide');
  //   }
  // } else if (value == 4) {
  //   placeholder = 'Consulting Services';
  //   for (var i in consulting) {
  //     $("#" + consulting[i]).removeClass('show').addClass('hide');
  //   }
  // } else if (value == 10002) {
  //   placeholder = 'Products';
  //   for (var i in wholeseller) {
  //     $("#" + wholeseller[i]).removeClass('show').addClass('hide');
  //   }
  // } else if (value == 10001) {
    
  //   $('#products').attr('placeholder','Item Solds');
  //   for (var i in manufacturer) {
  //     $('#' + manufacturer[i]).removeClass('show').addClass('hide');
  //   }
  // } else if (value == 5) {
  //   $('#services').attr('placeholder','Machine & Tools');
  //   for (var i in tool) {
  //     $("#" + tool[i]).removeClass('show').addClass('hide');
  //   }
  // } else {
  //   return false;
  // }
}

function companiestype(value) {
  $('#singleowner').removeClass('show').addClass('hide');
  // e.preventDefault();
  if (value == 1) {
    $('#multiowner').removeClass('show').addClass('hide');
    $('#singleowner').removeClass('hide').addClass('show');
  } else if (value == 2) {
    $('#singleowner').removeClass('show').addClass('hide');
    $('#singleowner input').text('');
    $('#multiowner').removeClass('hide').addClass('show');
  } else {
   $('#multiowner').removeClass('show').addClass('hide');
    $('#singleowner').removeClass('hide').addClass('show');
  }
}

// $("#hello").on('click',function(e){
//   e.preventDefault();
//   $(this).parent('.form-group').children('.input-group-prepend').children('.form-control').val("5");
// })

function passwordcheck(value, e) {
  // alert("Password is :"+value);

  var a = $("input#password").val();
  var b = value;

  if (a == b) {
    console.log(a);
    $('input#confirm_password').css("border", "1px solid green");
    $('input#password').css("border", "1px solid green");
  } else {
    $('input#confirm_password').css("border", "1px solid red");
    $('input#password').css("border", "1px solid red");
  }
}

function hidefirstview() {
  $('.firstpage').hide(),
    $('#firstviewhide').hide(),
    $('.secondpage').show(),
    $('#secondviewhide').show(),
    $('#1').removeClass("active"),
    $('#2').addClass("active"),
    $('#3').removeClass("active"),
    $('#gobacktofirstview').show();
}

function showfirstview() {
  $('.firstpage').show(),
    $('#firstviewhide').show(),
    $('.secondpage').hide(),
    $('#secondviewhide').hide();
  $('#gobacktofirstview').hide(),
    $('#1').addClass("active"),
    $('#2').removeClass("active"),
    $('#3').removeClass("active");
}

function showsecondview() {
  $('.thirdpage').hide(),
    $('#finish').hide(),
    $('.secondpage').show(),
    $('#gobacktosecondview').hide(),
    $('#secondviewhide').show(),
    $('#gobacktofirstview').show(),
    $('#1').removeClass("active"),
    $('#2').addClass("active"),
    $('#3').removeClass("active");
}

function hidesecondview() {
  $('.secondpage').hide(),
    $('#secondviewhide').hide(),
    $('.thirdpage').show(),
    $('#finish').show(),
    $('#2').removeClass("active"),
    $('#3').addClass("active"),
    $('#gobacktofirstview').hide(),
    $('#gobacktosecondview').show(),
    $('#1').removeClass("active"),
    $('#2').removeClass("active"),
    $('#3').addClass("active");
  //////// initialize select 2

  // $('#retailerItemsold').select2({
  //     placeholder: "Items sold",
  //     allowClear: true
  //   }),
    $('#products').select2({
      placeholder: "Products",
      allowClear: true
    }),
    $('#services').select2({
      placeholder: "Machines and Tools",
      allowClear: true
    })

}