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
  </div>
 -->


<div class="row p-0 m-0 image_header" style="min-height:95vh">
  <div class="col-12 m-0 p-0">
    <div class="login_form pb-5 h-100 d-flex">
      <div class="container d-block m-auto">
        <div class="row">
          <div class="col-5 mx-auto">
            <div class="card">
              <div class="card-header">
                <h5>Reset Password</h5>
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
                <form class="mt-3 mb-3" id="loginForm" method="post" action="{{url('/client').'/auth/send-email'}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address <span class="red">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off" required>
                  </div>
                  <div class="col-4 pt-2 float-right">
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