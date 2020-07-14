
<?php
if (!request()->ajax()):
    include(resource_path() . '/views/header-minimal.php');
//include(resource_path().'/views/leftmail-aside.php');
endif;
?>
<style>
    .width-200{
        width: 200%;
        /* text-align: center; */
        left: -49.6%;
        position: relative;
        font-size: 30px;
        color: #fff;
    }
    .login-box, .register-box {
        width: 100%;
        margin: 4% auto;
    }
    .login-text{
        width: 300px;
        padding: 50px;
        font-size: 18px;
        /*        text-align: justify;*/
        color: white;
    }
    .login-design-wrapper .login-box-body{
        background: #fff;
        padding: 20px;
        border-top: 0;
        color: #666;
        vertical-align: middle;
        top:8px;
        position: relative;
    }
    .skin-blue .wrapper{
        background-image: linear-gradient(141deg, #1fc8db 51%, #2cb5e8 75%);
    }
    .login-design-wrapper{
        background: #fff;
        overflow: hidden;
    }
    .width-900{
        width: 900px;
    }
    .footer-login-text{
        padding: 25px;
        background: white;
        margin-top: 5px;
    }
    .login-logo.width-200 h3 {
        margin-top: 7px;
        margin-bottom: 3px;
    }
</style>

<div class="row">

    <div class="login-box">

        <div class="login-logo">
            <img src="images/nepal-gov.png" width="100">
            <div class="login-logo width-200">
                <h5>नेपाल सरकार </h5>
                <h5>सञ्चार तथा सूचना प्रविधि मन्त्रालय</h5>
                <h4>सूचना तथा प्रसारण विभाग</h4>
                <h3>सूचना व्यवस्थापन प्रणाली</h3>
                <h3>(Information Management System)</h3>
            </div>
        </div>
        <!-- /.login-logo -->
        <div class="container width-900">
            <div class="row">
                <div class="login-design-wrapper">
                    <div class="col-md-6" style="padding-left:0px;">
                        <div style="background: url(img/oas-login.jpg);background-size: cover;">
                            <div class="login-text"><p>A system to store, generate and print data for Press Section, Broadcasting Section, Online Media & Welfare Ads.</p> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-box-body">
                            <p class="login-box-msg">Sign in to get started</p>
                            <form action="<?php echo url('/') . '/auth/login'; ?>" method="post" id="loginForm" onsubmit="login(event)">
                                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="dig_sig" id="dig_sig" value="">
                                <div class="form-group has-feedback">
                                    <input class="form-control" placeholder="Username" type="text"  name="username" id="username">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input class="form-control" placeholder="Password" type="password" name="password" id="password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
                                    </div>
                                    <div class="col-xs-4 pull-right">
                                        <a href="<?php echo url('/auth/signup'); ?>" class="btn btn-primary pull-right">Sign Up</a>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center footer-login-text">
                    To sign in, users should use their own username and password provided by their respective organization.<br>
                    Or can signup and contact administrator to activate the account.
                </div>
            </div>
        </div>

        <!-- /.login-box-body -->
    </div>
</div>
<script>
    function login(e) {
        e.preventDefault();
        $('#dig_sig').val('');
        if ($('#username').val() == '' || $('#password').val() == '') {
            toast({status: "0", title: "error", text: 'Username & password are both required'});
            return false;
        } else {
            var url = $('#loginForm').attr('action');
            var xhrCheck = ajaxGetObj(baseUrl + '/auth/check-dsrequire?username=' + $('#username').val());
            
            xhrCheck.done(function (data) {
                if (data.userType == 'Business' && data.require_ds == '1') {
                    startConnection();
                    //wait until connection is started
                    var timeout = setInterval(function () {
                        if (connection && connection.readyState < 2) {
                            var toBeSigned = 'OAS_USER_DS_' + $('#username').val();
                            signForm(toBeSigned, connection).then(function (sdata) {
                                if (emSignerConfig.cancelled == sdata) {
                                    toast({status: "0", title: "error", text: "Cancelled the signing process."});
                                    return;
                                }
                                $('#dig_sig').val(sdata);
                                var data = $('#loginForm').serialize();
                                var xhr = submitFormAjax(url, data);
                                xhr.done(function (resp) {
                                    toast(resp);
                                    window.location.href = '<?php echo url('/'); ?>';
                                }).fail(function (reason) {
                                    var resp = reason.responseJSON;
                                    toast(resp);
                                });
                            }).catch(function (err) {
                                 toast({status: "0", title: "error", text: "Error on signing"});
                            });
                            clearInterval(timeout);
                        }
                    },1);
                } else {
                    var data = $('#loginForm').serialize();
                    var xhr = submitFormAjax(url, data);
                    xhr.done(function (resp) {
                        toast(resp);
                        window.location.href = '<?php echo url('/'); ?>';
                    }).fail(function (reason) {
                        var resp = reason.responseJSON;
                        toast(resp);
                    });
                }
            }).fail(function (reason) {
                var resp = reason.responseJSON;
                toast(resp);
            });
        }
    }
</script>

<?php
if (!request()->ajax()):
    include(resource_path() . '/views/footer.php');
endif;
?>