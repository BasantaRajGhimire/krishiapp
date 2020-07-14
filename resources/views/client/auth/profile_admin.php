<?php
if (!request()->ajax()):
    include(resource_path() . '/views/header-minimal.php');
endif;
?>

<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $user->name;?></h3>

              <p class="text-muted text-center">Administrative User</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#change-password" data-toggle="tab" aria-expanded="true">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="change-password">
                <form role="form" onsubmit="submitFormReset(event)" method="post" id="form" class="">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="password">Old Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name='old-password' id='old-password' class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="password">New Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name='password' id='password' class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name='password_confirmation' id='password_confirmation' class="form-control" >
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                    <input type="reset" class="btn btn-danger pull-right" value="Reset Form">
                </form>
              </div>

              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
<script>
    function submitFormReset(e){
        e.preventDefault();
        var form = e.target;
        var url = baseUrl + '/auth/change-admin-pass';
        var formData = $(form).serialize();
        var xhr = submitFormAjax(url,formData);
        xhr.done(function(resp){
            $(form).trigger('reset');
            toast(resp);
        }).fail(function(resp){
            toast(resp.responseJSON);
        });
    
}
</script>
<?php
if (!request()->ajax()):
    include(resource_path() . '/views/footer.php');
endif;
?>