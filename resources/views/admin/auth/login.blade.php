<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ url('css/AdminLTE.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('assets/plugins/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('assets/plugins/iCheck/square/blue.css') }}">

  <!-- toaster -->
  <link href="<?php echo url('assets/plugins/toaster/css/jquery.notify.css'); ?>" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- jQuery 3 -->
  <script src=" {{ url('assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ url('js/jquery.toast.min.js') }}"></script>
  <script src="{{ url('js/scripts.js') }}"></script>
  <script type="text/javascript">
    //some essential global variables
    var baseUrl = "<?php echo url('/'); ?>";
    var gLoader = "loader-animation";
    var mainContainer = "main-body";
  </script>
  <style type="text/css">
    body {
      background: #0F2027;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027)!important;
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #2C5364, #203A43, #0F2027)!important;
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
       
      background-attachment: fixed;
      background-size: cover !important;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo" >
      <a style="color:#fff" href="../../index2.html"><b>Admin</b> Login Panel</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="<?php echo url('/') . '/admin/auth/login'; ?>" method="post" id="loginForm" onsubmit="login(event)">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ url('/admin') }}">I forgot my password</a><br>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- AdminLTE App -->
  <script src="<?php echo asset('js/app.min.js'); ?>"></script>
  <!-- iCheck -->
  <script src="{{ url('assets/plugins/iCheck/icheck.min.js') }}"></script>
  <script src="<?php echo asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo url('assets/plugins/toaster/js/jquery.notify.min.js'); ?>"></script>

  <script src="{{ url('js/function.js') }}"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });

    function login(e) {
      e.preventDefault();
      if ($('#username').val() == '' || $('#password').val() == '') {
        toast({
          status: "0",
          title: "error",
          text: 'Username & password are both required'
        });
        return false;
      } else {
        var url = 'admin/auth/login';
        var data = $('#loginForm').serialize();
        var xhr = submitFormAjax(url, data);
        xhr.done(function(resp) {
          toast(resp);
          window.location.href = '<?php echo url('/admin'); ?>';
        }).fail(function(reason) {
          var resp = reason.responseJSON;
          toast(resp);
        });
      }
    }
  </script>
  <?php
  if (!request()->ajax()) :
    include(resource_path() . '/views/footer.php');
  endif;
  ?>