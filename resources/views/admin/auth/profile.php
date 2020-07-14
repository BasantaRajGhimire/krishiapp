<?php
if (!request()->ajax()):
    include(resource_path() . '/views/header.php');
    include(resource_path() . '/views/leftmail-aside.php');
endif;
$lang = t_label_bulk(['Close','Submit']);
use \App\Auth ;

$default = (new Auth())->infoDefaultLoginDarbandi(session('empid'), session('darbandiid'));
?>
<?php $config = (new \App\OrganizationConfiguration());?>
<style>
#edit-employee .form-group{
  padding-left: 15px;
  padding-right: 15px;
}
.row a{ 
  font-size:12px;
 }
</style>
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

                <h3 class="profile-username text-center"><?php echo $user->{t_field('firstname')}." ".$user->{t_field('lastname')};?></h3>

              <p class="text-muted text-center"><?php echo (new \App\Darbandi())->getPostText(session('darbandiid_exec'));?></p>
              <a data-toggle="modal" data-target="#edit-employee" class='btn btn-xs btn-primary' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>

<!--              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Inbox</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Forwarded</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>In Progress</b> <a class="pull-right">13,287</a>
                </li>
              </ul>-->
            </div> 
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <br />
          <a <?php echo $default==1 ?'disabled':'' ?> id="set-login" onclick='<?php echo $default==1 ?:"setDefaultLogin()" ?>' class="btn btn-md btn-primary pull-left">Set to Default Login </a>
          <?php if($config->checkForDsEnforce()):?>
          &nbsp; <a id="set-login" onclick="enrollDigSig('<?php echo $user->username;?>');" class="btn btn-md btn-primary pull-left">Enroll Digital Signature</a>
          <?php endif;?>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#change-password" data-toggle="tab" aria-expanded="true">Change Password</a></li>
              <!-- <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li> -->
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
    <div id="edit-employee" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><?php echo t_message('Edit Your Profile Info'); ?></h4>
              </div>
              <div class="modal-body">
                <form id="form15" class="form-horizontal" onsubmit="submitForm(event);" method="post">
                  <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2 ">First Name[EN]</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="firstnameen" name="firstnameen" placeholder="First Name[EN]" type="text" value="<?php echo $user->firstnameen; ?>" />
                      </div>
                    </div>
                      <div class="form-group">                        
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2 ">Last Name[EN]</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="lastnameen" name="lastnameen" placeholder="Last Name[EN]" type="text" value="<?php echo $user->lastnameen; ?>">
                      </div>
                    </div>
                      <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2 ">First Name[NP]</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="firstnamenp" name="firstnamenp" placeholder="First Name[NP]" type="text" value="<?php echo $user->firstnamenp; ?>">
                      </div>
                    </div>
                      <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2 ">Last Name[NP]</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="lastnamenp" name="lastnamenp" placeholder="Last Name[NP]" type="text" value="<?php echo $user->lastnamenp; ?>">
                      </div>
                    </div>
                      <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2 ">First Name[Local]</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="firstnamelc" name="firstnamelc" placeholder="First Name[Local]" type="text" value="<?php echo $user->firstnamelc; ?>">
                      </div>
                    </div>
                      <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2">Last Name[Local]</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="lastnamelc" name="lastnamelc" placeholder="Last Name[Local]" type="text" value="<?php echo $user->lastnamelc; ?>">
                      </div>
                    </div>
                      <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2">Email</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="email" name="email" placeholder="Email" type="text" value="<?php echo $user->email; ?>">
                      </div>
                    </div>
                      <div class="form-group">
                      <div class="col-sm-4">
                        <label for="inputName" class="col-sm-2">Phone</label>
                      </div>
                      <div class="col-sm-8">
                        <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text" value="<?php echo $user->phone; ?>">
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-success"><?php echo $lang['Submit']; ?></button>  
                      </div>                     
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Close']; ?></button>
              </div>
          </div>

      </div>
    </div>
<script>
    var enDigitalSig = <?php echo $config->checkForDsEnforce()?'true':'false';?>;
    if (enDigitalSig) {
        startConnection();
    }
function submitFormReset(e){
        e.preventDefault();
        var form = e.target;
        var url = baseUrl + '/auth/change-emp-pass';
        var formData = $(form).serialize();
        var xhr = submitFormAjax(url,formData);
        xhr.done(function(resp){
            $(form).trigger('reset');
            toast(resp);
        }).fail(function(resp){
            toast(resp.responseJSON);
        });
    
}
function submitForm(e){
  e.preventDefault();
  var url = baseUrl + '/employee/update-employee-info';
  var formData = $('#form15').serialize();
  var xhr = submitFormAjax(url,formData);
        xhr.done(function(resp){
            toast(resp);
        }).fail(function(resp){
            toast(resp.responseJSON);
        });
}
function setDefaultLogin(){
  var empid = '<?php echo session("empid"); ?>';
  var darbandiid = '<?php echo session("darbandiid"); ?>';
  var url = baseUrl + '/auth/set-default-login';
  var data = {empid, darbandiid};
  var xhr = ajaxPostObj(url,data);
  console.log(data);
    xhr.done(function(resp){
      $('#set-login').attr("disabled","disabled");
      $('#set-login').removeAttr('onclick');
            toast(resp);
        }).fail(function(resp){
            toast(resp.responseJSON);
        });
}
function enrollDigSig(username){
    var toBeSigned = 'OAS_USER_DS_'+username;
    signForm(toBeSigned, connection).then(function (data) {
                if (emSignerConfig.cancelled == data) {
                    toast({status: "0", title: "error", text: "Cancelled the signing process."});
                    return;
                }
                var url = baseUrl+'/auth/enrollds';
                var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                var formData = {tbs_data:toBeSigned,dig_sig:data,_token:csrfToken,username:username};
                var xhr = submitFormAjax(url, formData);
                xhr.done(function (resp) {
                    toast(resp);
                }).fail(function (err) {
                    toast(err.responseJSON);
                });
            }).catch(function (err) {
                toast({status: "0", title: "error", text: "Failed to sign data."});
            });
}
</script>
<?php
if (!request()->ajax()):
    include(resource_path() . '/views/footer.php');
endif;
?>