<?php
include(resource_path() . '/views/header-index.blade.php');
?>
<style type="text/css">
    .error {
        display: none;
        font-size: 11px;
        color: red;
        padding: 5px 10px 0px 20px;
    }

    .success-msg {
        background-color: #62c462;
        color: #007921;
        font-size: 14px;
        padding: 15px;
        margin-bottom: 20px;
        display: none;
    }

    div.register_form form .form-group input::placeholder {
        opacity: 0.7;
        font-size: 13px
        /* color: red !important; */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        opacity: 0.6;
        /* color: red; */
    }

    .select2.select2-container.select2-container--default {
        width: 100% !important;
        /* border: 1px solid red; */
    }

    .select2-selection__arrow b {
        top: 70% !important;
    }

    .select2-selection.select2-selection--single {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    html {
        min-height: 100vh;
    }

    body {
        background: rgb(255, 230, 75);
        background: linear-gradient(0deg, rgba(255, 230, 75, 1) 0%, rgba(255, 183, 5, 1) 43%, rgba(255, 182, 3, 1) 74%, rgba(255, 238, 88, 1) 100%);
    }
</style>
<span id="totop"> <i class="fas fa-chevron-up fa-lg text-white"></i> </span>

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
                            Sign Up And Enjoy All Our Bidding Tools.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 m-0 p-0">
        <div class="register_form mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 style="line-height:1em;">Create your personal profile with</h4>
                                <p class="mt-2" style="color:#ffb400;font-family:'Rubik';font-size: 50px;line-height:29px;">e<span style="color:#2a2a2a;font-family:'Roboto';font-size: 39px;line-height:29px;font-weight:400">Thekka</span> </p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis impedit est ratione
                                    delectus ipsam culpa dignissimos voluptatum cumque modi.</p>
                                <div class="success-msg">
                                </div>
                                <div class="row">
                                    <h3 class="col-12">Personal Information</h3>
                                    <div class="col-12">
                                        <form class="row" action="{{ url('/client/register-form') }}" onSubmit="registerFormSubmit(event,this)" method="post" id="register-form">
                                            @csrf
                                            <div class="form-group col-12 col-md-6">
                                                <input type="name" class="form-control" placeholder="Full Name*" id="name" name="name" required>
                                                <div id="name-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="email" class="form-control" placeholder="Enter email*" id="email" name="email" required>
                                                <div id="email-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required>
                                                <div id="password-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password*" required>
                                                <div id="confirm_password-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="text" class="form-control" placeholder="Date of Birth*" id="dob" name="dob" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                                <div id="dob-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="tel" class="form-control" placeholder="Mobile Number(98xxxxxxxx)*" pattern="98+[0-9]{8}" id="mobile" name="mobile" required>
                                                <div id="mobile-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="text" class="form-control" placeholder="Occupation*" id="occupation" name="occupation" required>
                                                <div id="occupation-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <select class="js-example-basic-single" style="max-width:100%" name="district" required onchange="changeCss(this);">
                                                    <option value="" hidden style="color:red">City*</option>
                                                    @foreach($district as $d)
                                                    <option value="{{$d->id}}">{{ $d->district_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="district-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <select class="js-example-basic-single" style="max-width:100%" name="gender" required onchange="changeCss(this);">
                                                    <option value="" hidden>Select a gender*</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Others</option>
                                                </select>
                                                <div id="gender-err" class="error"></div>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <input type="address" class="form-control" placeholder="Address*" id="address" name="address" required>
                                                <div id="address-err" class="error"></div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>

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
    </div>
</div>

<script>
    // $(function () {
    //   $('input').iCheck({
    //     checkboxClass: 'icheckbox_square-blue',
    //     radioClass: 'iradio_square-blue',
    //     increaseArea: '20%' /* optional */
    //   });
    // });
    // $('#password').on('input', function(){

    // });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    function changeCss(t) {
        console.log($(t).siblings('.select2-container--default').children('.selection').children('.select2-selection').children('.select2-selection__rendered').length);
        $(t).siblings('.select2-container--default').children('.selection').children('.select2-selection').children('.select2-selection__rendered').css('color', '#000 !important');
    }
    $(document).ajaxStart(function() {
        Pace.restart()
    })

    function registerFormSubmit(e, t) {
        e.preventDefault();
        $('.error').hide();
        var url = $('#register-form').attr('action');
        var data = $('#register-form').serialize();
        e.preventDefault();
        p = t[3].value;
        console.log(p);
        errors = [];
        if (p.search(/[A-Z]/) < 0) {
            errors.push("*At least one uppercase letter.*<br/>")
        }
        if (p.search(/[a-z]/i) < 0) {
            errors.push("*At least one letter.*<br/>");
        }
        if (p.length < 8) {
            errors.push("*At least 8 characters*<br/>");
        }
        if (p.search(/[0-9]/) < 0) {
            errors.push("*At least one digit.*<br/>");
        }
        if (errors.length > 0) {
            var i = 0;
            var err = (errors.join("\n"));
            console.log(err);
            console.log($(t[3]).siblings('.error'));
            $(t[3]).siblings('.error').show().html(err);
            return false;
        }
        var xhr = submitFormAjax(url, data);
        xhr.done(function(resp) {
            $('.success-msg').show().text('You have been successfully registered. Please check your email first for verification.');
            resetForm($('#register-form'));
        }).fail(function(reason) {
            $('.error').hide();
            var resp = reason.responseJSON;
            console.log(resp);
            for (var i in resp.message) {
                $('#' + i + '-err').show();
                $('#' + i + '-err').text('*' + resp.message[i][0] + '*');
                $('#' + i).focus().css('border', '1px solid red');
                console.log(resp.message[i]);
            }
        });
    }
</script>
<?php
include(resource_path() . '/views/footer-index.blade.php');
?>