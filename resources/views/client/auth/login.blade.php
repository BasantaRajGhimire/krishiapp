<?php
include(resource_path() . '/views/header-index.blade.php');
?>

<style type="text/css">
  .error {
    background-color: #931e1e;
    color: #ffc0c0;
    text-align: center;
    font-size: 14px;
    padding: 15px;
    margin-bottom: 20px;
    display: none;
  }

  .show {
    display: block;
  }

  .hide {
    display: none;
  }

  html {
    min-height: 100vh;
  }

  body {
    background: rgb(255, 230, 75);
    background: linear-gradient(0deg, rgba(255, 230, 75, 1) 0%, rgba(255, 183, 5, 1) 43%, rgba(255, 182, 3, 1) 74%, rgba(255, 238, 88, 1) 100%);
  }
</style>
<script type="text/javascript">
  //some essential global variables
  var baseUrl = "<?php echo url('/'); ?>";
  var gLoader = "loader-animation";
  var mainContainer = "main-body";
</script>
<div class="row p-0 m-0 image_header" style="min-height:95vh">
    <div class="col-12 m-0 p-0">
        <div class="h-100 d-flex">
            <div class="container-fluid d-block m-auto">
                <div class="row align-items-center">
                    <div class="col-12 mt-5 mb-5 pt-3 pb-3 text-center">
                        <h1 class="text-warning">
                            Welcome! 
                        </h1>
                        <h3 class="text-warning">
                          Post Your Requirement And Choose From The Best.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 m-0 p-0">
        <div class="login_form pb-5 h-100 d-flex">
            <div class="container d-block m-auto">
                <div class="row">
                    <div class="col-9 col-sm-8 col-md-5 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="error {{ Session::has('err')?'show':'hide'}}">
                                    @if(Session::has('err'))
                                    {{ Session::get('err') }}
                                    @endif
                                </div>
                                <div class="alert alert-success {{ Session::has('msg')?'show':'hide'}}">
                                    @if(Session::has('msg'))
                                    {{ Session::get('msg') }}
                                    @endif
                                </div>
                                <form class="mt-3 mb-3" id="loginForm" method="post" onsubmit="login(event)">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>

                                        </div>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <hr>
                                    <a href="{{url('client/auth/forget-password')}}">Forget Password?</a><br />
                                    <span>Or Sign up
                                        <a href="{{url('client/register')}}">
                                            <b>
                                                here
                                            </b>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3 -->
<script src=" {{ url('assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('assets/plugins/iCheck/icheck.min.js') }}"></script>
<script src="<?php echo asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>

<script src="{{ url('js/function.js') }}"></script>

<script src="{{ url('js/jquery.toast.min.js') }}"></script>
<script src="{{ url('js/scripts.js') }}"></script>
<!-- PACE -->
<script src="{{ url('assets/plugins/pace/pace.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="{{ url('js/main.js') }}"></script>
<script src="https://kit.fontawesome.com/33e9b2fcd6.js"></script>
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  $(document).ajaxStart(function() {
    Pace.restart()
  })
  $(function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  function login(e) {
    e.preventDefault();
    console.log($('#username').val());
    $('.error').hide();
    if ($('#email').val() == '' || $('#password').val() == '') {
      $('.error').show();
      $('.error p').text('* Username or password blank.');
      return false;
    } else {
      var url = "<?php echo url('/') . '/client/auth/login'; ?>"
      var data = $('#loginForm').serialize();
      var xhr = submitFormAjax(url, data);
      xhr.done(function(resp) {
        //toast(resp);
        window.location.href = '<?php echo url('/client'); ?>';
      }).fail(function(reason) {
        console.log(reason.responseJSON);
        $('.error').show();
        $('.error').text('* ' + reason.responseJSON);
      });
    }
  }

  function setTitle() {
    var title = $('#main-body > .row').data('title');
    if (title) {
      $('.body-header').html('<div>' + title + '</div>');
      $('title').text(title);
    } else {
      $('.body-header').html('');
      $('title').text('Client | Log In');
    }
  }
  setTitle();
</script>