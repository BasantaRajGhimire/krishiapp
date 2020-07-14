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

  .red {
    color: red;
    font-size: 12px;
  }
</style>
<!-- <div class="image_header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mt-5 mb-5 pt-3 pb-3 text-center">
          <h3 class="text-warning">
            Sign In to our platform for job oppurtunities.
          </h3>
        </div>
      </div>
    </div>
  </div> -->



<div class="row p-0 m-0 image_header" style="min-height:95vh">
  <div class="col-12 m-0 p-0">
    <div class="login_form mt-5 mb-5">
      <div class="container">
        <div class="row">
          <div class="col-5 mx-auto">
            <div class="card">
              <div class="card-header">
                <h5>Set New Password</h5>
              </div>
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
                <form class="mt-3 mb-3" id="loginForm" method="post" action="{{url('/service-provider').'/auth/token/'.$token}}">
                  @csrf
                  <div class="form-group">
                    <label for="email">Current Email <span class="red">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" autocomplete="off" required value="{{old('email')}}">
                    <div class="red {{$errors->has('email')?'show':'hide'}}">*{{$errors->has('email')?$errors->first('email'):'' }}</div>
                  </div>
                  <div class="form-group">
                    <label for="new_password">New Password <span class="red">*</span></label>
                    <input type="password" class="form-control" id="new_password" name="new_password" aria-describedby="emailHelp" placeholder="Enter New Password" autocomplete="off" required value="{{old('new_password')}}">
                    <div class="red {{$errors->has('new_password')?'show':'hide'}}">*{{$errors->has('new_password')?$errors->first('new_password'):'' }}</div>
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Confirm Password <span class="red">*</span></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" aria-describedby="emailHelp" placeholder="Confirm Password" autocomplete="off" required value="{{old('confirm_password')}}">
                    <div class="red {{$errors->has('confirm_password')?'show':'hide'}}">*{{$errors->has('confirm_password')?$errors->first('confirm_password'):'' }}</div>
                  </div>
                  <div class="col-3 pt-2 float-right">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    function validatePassword(e,t){
      e.preventDefault();
       p = t[2].value;
      errors = [];  
      if (p.search(/[A-Z]/) < 0) { 
        errors.push("*Your password must contain at least one uppercase letter.*<br/>") 
      }
      if (p.search(/[a-z]/i) < 0) {
        errors.push("*Your password must contain at least one letter.*<br/>");
      }
      if (p.length < 8) {
        errors.push("*Your password must be at least 8 characters*<br/>"); 
      }
      if (p.search(/[0-9]/) < 0) {
        errors.push("*Your password must contain at least one digit.*<br/>"); 
      }
      if (errors.length > 0) {
        var i = 0;
          var err = (errors.join("\n"));
          console.log(err);
          console.log($(t).siblings('.red'));
          $(t[2]).siblings('.red').show().html(err);
          return false;
      }else{
        $(t).attr('action',"{{url('/service-provider').'/auth/token/'.$token}}")
        t.submit();
      }
  }
  </script>