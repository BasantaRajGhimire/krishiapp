<?php
if (!request()->ajax()):
    include(resource_path() . '/views/header-minimal.php');
endif;
?>
<link rel="stylesheet" href="<?php echo asset('assets/plugins/select2/select2.min.css');?>">
<style type="text/css">
  .error {
    display:none;
    font-size: 11px;
    color: red;
    padding: 5px 10px 0px 20px;
}
	.register-box{
		width:40%;
	}
  span.select2{
    width:50% !important;
  }
  .select2-selection__choice{
    color:#000 !important;
  }
  .required{
    color:red;
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
    <a href="../../index2.html">Are you <b>Service Provider</b></a>
  </div>
  <div class="success-msg">
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ url('/service-provider/register-form') }}" onSubmit="registerFormSubmit(event)" method="post" id="register-form"  class="oas-form-inline">
      <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
      <div class="form-group">
        <label><span class="required">*</span> Vendor Type</label>
        <select class="form-control" name="vendor_type" id="vendor_type">
          <option value="">Select One</option>
          @foreach($sellerType as $v)
          <option value="{{$v->id}}">{{ $v->name }}</option>
          @endforeach
        </select>
        <div id="vendor_type-err" class="error"></div>
      </div>
      <div class="form-group">
        <label>Your Supply</label>
        <select class="js-example-basic-multiple form-control" name="materials[]" id="materialid" multiple="multiple">
            @foreach($materials as $v)
              <option value="{{$v->id}}">{{ $v->name }}</option>
            @endforeach
        </select>
        <div id="vendor_type-err" class="error"></div>
      </div>      
      <div class="form-group">
        <label>Your Services</label>
        <select class="js-example-basic-multiple form-control" name="services[]" id="serviceid" multiple="multiple">
            @foreach ($services as $s)
                    <option value="<?php echo $s->id; ?>"><?php echo $s->service_type_name; ?></option>
            @endforeach
        </select>
        <div id="service-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label><span class="required">*</span> Contact Name</label>
        <input type="text" class="form-control" placeholder="Contact name" name="contact_name" id="contact_name">
        <div id="contact_name-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label>Company Name</label>
        <input type="text" class="form-control" placeholder="Company name" name="company_name" id="company_name">
        <div id="company_name-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label><span class="required">*</span> District</label>
        <select class="form-control" name="district" id="district">
          <option value="">Select district</option>
          @foreach($district as $d)
          <option value="{{ $d->id}}">{{ $d->district_name }}</option>
          @endforeach
        </select>
        <div id="district-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label><span class="required">*</span> Email</label>
        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div id="email-err" class="error"></div>
      </div>
      <div class="form-group has-feedback">
      	<label><span class="required">*</span> Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <div id="password-err" class="error"></div>
      </div>
      <div class="form-group has-feedback">
      	<label><span class="required">*</span> Confirm Password</label>
        <input type="password" class="form-control" placeholder="Retype password" name="confirm_password" id="confirm_password">
        <div id="confirm_password-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label><span class="required">*</span> Mobile</label>
        <input type="text" class="form-control" placeholder="Mobile" name="mobile" id="mobile">
        <div id="contact_name-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label>Website</label>
        <input type="text" class="form-control" placeholder="Website" name="website" id="website">
        <div id="website-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label>Any Branches?</label>
      	<select class="form-control" name="have_branches" id="have_branches">
      		<option value="0">No</option>
      		<option value="1">Yes</option>
      	</select>
        <div id="contact_name-err" class="error"></div>
      </div>
      <div class="form-group">
      	<label>About you</label>
        <textarea class="form-control" placeholder="Full name" name="description" id="description"></textarea>
        <div id="website-err" class="error"></div>
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
  <script src="<?php echo asset('assets/plugins/select2/select2.min.js');?>"></script>
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

  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
  });
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  function registerFormSubmit(e){
    $('.error').text('');
    e.preventDefault();
    console.log($('#materialid').val());
    if($('#materialid').val()==null && $('#serviceid').val()==null){
      $('#service-err').text('* Choose items either from supply or services');
      // $('#service-err').show();
      $('.error').show();
      return false;
    }
        var url = $('#register-form').attr('action');
        var data = $('#register-form').serialize();
        var xhr = submitFormAjax(url, data);
        xhr.done(function (resp) {
          console.log(resp);
          resetForm($('#register-form'));
          $('.success-msg').text(resp);
          $('.success-msg').show();
        }).fail(function (reason) {
          $('.error').hide();
            var resp = reason.responseJSON;
            console.log(resp);
            for(var i in resp.message){
              $('#'+i+'-err').show();
              $('#'+i+'-err').text('*' +resp.message[i][0] + '*');
              console.log(resp.message[i]);
            }       
            $('.error').show();
        });
    }
     function setTitle() {
        var title = $('#main-body > .row').data('title');
        if (title) {
            $('.body-header').html('<div>' + title + '</div>');
            $('title').text(title);
        } else {
            $('.body-header').html('');
            $('title').text('Register Form');
        }
    }
    setTitle();
  //}
  //$('[data-mask]').inputmask();
</script>
</body>
</html>
