<?php
if (!request()->ajax()):
    include(resource_path() . '/views/header-minimal.php');
endif;
?>
<style type="text/css">
  .error {
    display:none;
    font-size: 11px;
    color: red;
    padding: 5px 10px 0px 20px;
}

.success-msg{
  background-color: #62c462;
  color: #000;
  font-size: 14px;
  padding: 15px;
  margin-bottom: 20px;
  display: none;
}
</style>
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Buyer</b>Form</a>
  </div>

  <div class="success-msg">
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ url('/client/register-form') }}" onSubmit="registerFormSubmit(event)" method="post" id="register-form">
      <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="name" id="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div id="name-err" class="error"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" data-inputmask='"mask": "9999999999"' data-mask>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        <div id="phone_number-err" class="error"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <div id="email-err" class="error"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div id="password-err" class="error"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="confirm_password" id="confirm_password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <div id="confirm_password-err" class="error"></div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <!-- <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label> -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
    <a href="{{ url('client') }}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
  <script src="<?php echo asset('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo asset('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo asset('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
<!-- iCheck -->
<script src="{{ url('assets/plugins/iCheck/icheck.min.js') }}"></script>
<!-- PACE -->
<script src="{{ url('assets/plugins/pace/pace.min.js') }}"></script>
<script>
  // $(function () {
  //   $('input').iCheck({
  //     checkboxClass: 'icheckbox_square-blue',
  //     radioClass: 'iradio_square-blue',
  //     increaseArea: '20%' /* optional */
  //   });
  // });
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  function registerFormSubmit(e){
    e.preventDefault();
        $('.error').hide();
        var url = $('#register-form').attr('action');
        var data = $('#register-form').serialize();
        var xhr = submitFormAjax(url, data);
        xhr.done(function (resp) {
            $('.success-msg').show().text('You have been successfully registered. Please check your email first for verification.');
            resetForm($('#register-form'));
        }).fail(function (reason) {
          $('.error').hide();
            var resp = reason.responseJSON;
            console.log(resp);
            for(var i in resp.message){
              $('#'+i+'-err').show();
              $('#'+i+'-err').text('*' +resp.message[i][0] + '*');
              console.log(resp.message[i]);
            }
        });
    }
  //}
  //$('[data-mask]').inputmask();
</script>
</body>
</html>
