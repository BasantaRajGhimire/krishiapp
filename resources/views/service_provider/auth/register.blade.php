<?php
include(resource_path() . '/views/header-index.blade.php');
?>
<style type="text/css">
    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    .err {
        display: none;
        color: red;
        text-align: center;
    }

    .required {
        color: red;
        margin-left: 5px;
    }

    html {
        min-height: 100vh;
    }

    .select2.select2-container.select2-container--default {
        width: 100% !important;
        /* border: 1px solid red; */
    }

    div.register_form form .form-group input::placeholder {
        opacity: 0.7;
        font-size: 13px
        /* color: red !important; */
    }

    body {
        background: rgb(255, 230, 75);
        background: linear-gradient(0deg, rgba(255, 230, 75, 1) 0%, rgba(255, 183, 5, 1) 43%, rgba(255, 182, 3, 1) 74%, rgba(255, 238, 88, 1) 100%);
    }
</style>
<span id="totop"> <i class="fas fa-fw  fa-chevron-up fa-lg text-white"></i> </span>
<div class="alert alert-success hide text-center mt-5">

</div>

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
                            Sign Up And Browse For Business Oppurtunities.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 m-0 p-0">
        <div class="register_form pb-5 h-100 d-flex">
            <div class="container d-block m-auto">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 style="line-height:1em;">Create your company profile with</h4>
                                <p class="mt-2" style="color:#ffb400;font-family:'Rubik';font-size: 60px;line-height:29px;">e<span  style="color:#2a2a2a;font-family:'Roboto';font-size: 39px;line-height:29px;font-weight:00">Thekka</span>  </p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis impedit est ratione
                                    delectus ipsam culpa dignissimos voluptatum cumque modi.</p>
                                <div class="row">
                                    <div class="col-12">
                                        <form id="sellersignup" method="post">
                                            @csrf
                                            <div class="row firstpage">
                                                <h3 class="col-12">Company Information</h3>

                                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-hard-hat"></i> </span>
                                                        <select id="vendor_type" class="form-control" onchange="registerHideVendor(this.value, event);getData(this.value,event)" name="vendor_type" required>
                                                            <option value="" hidden>Service/Vendor Type</option>
                                                            @foreach($sellerType as $s)
                                                            <option value="{{$s->id}}">{{$s->name}}</option>
                                                            @endforeach
                                                            @foreach($services as $s)
                                                            <option value="{{$s->id}}">{{$s->service_type_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="err" id="vendor_type-err"></div>
                                                </div>
                                                <div id="companyname" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-building"></i> </span>
                                                        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Company Name" required>
                                                    </div>
                                                    <div class="err" id="contact_name-err"></div>
                                                </div>
                                                <div id="companyemail" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-envelope"></i>
                                                        </span>
                                                        <input type="text" id="email" name="email" class="form-control" placeholder="Company Email Address" required>
                                                    </div>
                                                    <div class="err" id="email-err"></div>
                                                </div>
                                                <div id="mobileno" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-mobile"></i>
                                                        </span>
                                                        <input id="mobile" name="mobile" type="number" min="0" class="form-control" placeholder="Mobile No." required>
                                                    </div>
                                                    <div class="err" id="mobile-err"></div>
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"> <i class="fas fa-fw  fa-key"></i> </span>
                                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" min="6" required>
                                                    </div>
                                                    <div class="err" id="password-err"></div>
                                                </div>
                                                <div id="confirmpassword" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"> <i class="fas fa-fw  fa-key"></i> </span>
                                                        <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm your Password" oninput="passwordcheck(this.value,event)" min="6" required>
                                                    </div>
                                                    <div class="err" id="confirm_password-err"></div>
                                                </div>
                                            </div>
                                            <!-- First Page ends -->
                                            <!-- Second Page Starts -->
                                            <div class="row secondpage">

                                                <h3 class="col-12">Company Information</h3>
                                                <div id="registrationdate" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-calendar-day"></i> </span>
                                                        <input type="text" id="reg_date" name="reg_date" class="form-control" placeholder="Date of Company Registration" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                                    </div>
                                                    <div class="err" id="reg_date-err"></div>
                                                </div>
                                                <div id="registrationnumber" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-list-ol"></i> </span>
                                                        <input type="number" id="reg_num" name="reg_num" class="form-control" min="0" placeholder="Company Registration Number" required>
                                                    </div>
                                                    <div class="err" id="reg_num-err"></div>
                                                </div>
                                                <div id="companyclass" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-sitemap"></i> </span>
                                                        <select id="company_class" name="company_class" class="form-control" required>
                                                            <option value="" hidden>Company Class</option>
                                                            @foreach($companyClass as $c)
                                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="err" id="company_class-err"></div>
                                                </div>
                                                <div id="companytype" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-signal"></i> </span>
                                                        <select id="owner_type" name="owner_type" class="form-control" onchange="companiestype(this.value)" required>
                                                            <option value="" hidden>Company Type</option>
                                                            <option value="1">Single</option>
                                                            <option value="2">Partnership</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="multiowner" class="form-group col-12 col-sm-12 col-md-6 col-lg-6 hide">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="color: rgb(159, 34, 4);"> <i class="fas fa-fw  fa-users"></i>
                                                        </span>
                                                        <textarea id="multiowner_name" name="multiowner_name" type="text" class="form-control" placeholder="Owners" required></textarea>
                                                    </div>
                                                    <div class="err" id="multiowner_name-err"></div>
                                                </div>
                                                <div id="singleowner" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend" style="color: rgb(159, 34, 4);">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-user"></i>
                                                        </span>
                                                        <input type="text" id="owner_name" name="owner_name" class="form-control" placeholder="Owner" required>
                                                    </div>
                                                    <div class="err" id="owner_name-err"></div>
                                                </div>
                                                <div id="companydistrict" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-sitemap"></i> </span>
                                                        <select id="district" name="district" class="form-control" required>
                                                            <option value="" hidden>District</option>
                                                            @foreach($district as $d)
                                                            <option value="{{$d->id}}">{{$d->district_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="err" id="district-err"></div>
                                                </div>
                                                <div id="companyaddress" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-map-marker"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" required>
                                                    </div>
                                                    <div class="err" id="company_address-err"></div>
                                                </div>
                                                <div id="companyphoneno" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-phone fa-rotate-90"></i>
                                                        </span>
                                                        <input type="text" id="company_phone1" name="company_phone1" class="form-control" placeholder="Company Phone No." required>
                                                    </div>
                                                    <div class="err" id="company_phone1-err"></div>
                                                </div>
                                                <div id="companyaltphoneno" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="color: rgb(159, 34, 4);"> <i class="fas fa-fw  fa-phone-volume"></i>
                                                        </span>
                                                        <input type="number" min="0" class="form-control" id="company_phone2" name="company_phone2" placeholder="Company alternative Phone No." required>
                                                    </div>
                                                    <div class="err" id="company_phone2-err"></div>
                                                </div>
                                                <!-- <div class="col-6"></div> -->
                                                <div id="vatno" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-map-marker"></i>
                                                        </span>
                                                        <input type="number" class="form-control" min="0" id="vat_no" name="vat_no" placeholder="VAT No." required>
                                                    </div>
                                                    <div class="err" id="vat_no-err"></div>
                                                </div>
                                            </div>
                                            <!-- Second Page ends -->
                                            <!-- Third Page starts -->
                                            <div class="row thirdpage">
                                                <h3 class="col-12">Past Projects and Inventory</h3>
                                                <div class="col-12">
                                                    <button id="addnewproject" onclick="addform(event)" class="btn btn-warning rounded-0 mb-3"> <i class="fas fa-fw  fa-plus"></i> Add
                                                        a new Project</button>
                                                </div>
                                                <div class="col-12 p-0 m-0" id="addformbelowhere">
                                                </div>
                                                <div id="productsold" class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-archive"></i>
                                                        </span>
                                                        <select id="products" name="materials[]" class="js-example-basic-multiple form-control itemssold" multiple aria-placeholder="Items Sold">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="machineandtools" class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-fw  fa-tools"></i>
                                                        </span>
                                                        <select id="services" name="services[]" class="js-example-basic-multiple form-control itemssold" multiple aria-placeholder="Items Sold">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Third Page ends -->


                                            <div class="row  mt-4">
                                                <div class="col-12 col-md-6">
                                                    <span class="counter float-left d-flex d-align-center">
                                                        <ul>
                                                            <li id="1" class="active">1</li>
                                                            <li id="2">2</li>
                                                            <li id="3">3</li>
                                                        </ul>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span>
                                                        <!-- <a href="#" id="finish" type="submit" class="btn btn-warning float-right rounded-0 pl-5 pr-5">Finish</a> -->
                                                        <button type="submit" id="finish" class="btn btn-warning float-right rounded-0 pl-4 pr-4" onclick="formSubmit(event)">Finish</button>
                                                        <a href="#" id="secondviewhide" class="btn btn-warning float-right rounded-0 pl-4 pr-4" onclick="validateSecondView(event)">Next</a>
                                                        <a href="#" id="gobacktosecondview" class="btn btn-warning float-right rounded-0 pl-4 pr-4 mr-3" onclick="showsecondview()">Back</a>
                                                        <a href="#" id="firstviewhide" class="btn btn-warning float-right rounded-0 pl-4 pr-4" onclick="validateFirstView(event);">Next</a>
                                                        <a href="#" id="gobacktofirstview" class="btn btn-warning float-right rounded-0 pl-4 pr-4 mr-3" onclick="showfirstview()">Back</a>
                                                    </span>
                                                </div>
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


<!-- Optional JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<?php
include(resource_path() . '/views/footer-index.blade.php');
?>
<script>
    $(function() {
        // console.log('ok');
        console.log($('.firstpage .form-group .form-control').siblings('.input-group-text'));
        $('.firstpage .form-group .form-control').siblings('.input-group-text').css('color', '#9f2204').append('<span class="required"> *</span>');
        $('.secondpage .form-group .form-control').each(function() {
            console.log($(this).attr('required'));
            if (this.id != 'multiowner_name') {
                $(this).siblings('.input-group-text').css('color', '#9f2204').append('<span class="required"> *</span>');
            }
        })
    });

    $('#owner').tagEditor({
        forceLowercase: false,
        placeholder: 'Owner/s (use , to seperate)',
        autocomplete: {
            delay: 0, // show suggestions immediately
            position: {
                collision: 'flip'
            }, // automatic menu position up/down
        },
        delimiter: ','
    });
    // var bool =false;
    $('.form-group .form-control').on('focus', function(e) {
        $(this).parents('.form-group').children('#' + this.id + '-err').text('');
    })
    $('.form-group input:text').on('input', function(index) {
        $(this).css('border', '1px solid green');
    });
    $('.form-group select').on('change', function(index) {
        $(this).css('border', '1px solid green');
    })

    function validateFirstView(e) {
        var pwd = $('#password').val();
        var confirm = $('#confirm_password').val();
        var validation = true;
        e.preventDefault();
        console.log('here');
        $('.firstpage .form-group .form-control').css('border', '1px solid #ced4da')
        $('.firstpage .form-group .form-control').each(function(index) {
            if (this.id == 'password') {
                var vPwd = validatePassword(this);
                console.log(vPwd);
                if (vPwd == false) {
                    validation = false;
                }
            }
            if ($('#' + this.id).val() == '') {
                $('#' + this.id).css('border', '1px solid red');
                validation = false;
            }
        });

        if (pwd != confirm) {
            $('#password').css('border', '1px solid red');
            $('#confirm_password').css('border', '1px solid red');
            validation = false;
        }
        if (validation == true) {
            validatePhaseWise('firstpage', 1);
        }
    }

    function validateSecondView(e) {
        e.preventDefault();
        var validation = true;
        $('.second .form-group .form-control').css('border', '1px solid #ced4da')
        $('.secondpage .form-group .form-control').each(function(index) {
            if ($(this).closest('.form-group').hasClass('show') && this.id != 'company_phone2' && this.id != 'multiowner_name') {
                console.log(this.id);
                if ($('#' + this.id).val() == '') {
                    $('#' + this.id).css('border', '1px solid red');
                    validation = false;
                } else {
                    $('#' + this.id).css('border', '1px solid green');
                }
            }
        });
        console.log(validation);
        if (validation == true) {
            validatePhaseWise('secondpage', 2);
        }
    }

    function validatePassword(ele) {

        p = ele.value;
        console.log(ele);
        errors = [];
        if (p.length < 8) {
            errors.push("*At least 8 characters*<br/>");
            $(ele).parents('.input-group-prepend').siblings('.err').show().html(errors);
            return false;
        }
        if (p.search(/[A-Z]/) < 0) {
            errors.push("*At least one uppercase letter.*<br/>")
        }
        if (p.search(/[a-z]/i) < 0) {
            errors.push("*At least one letter.*<br/>");
        }
        if (p.search(/[0-9]/) < 0) {
            errors.push("*At least one digit.*<br/>");
        }
        if (errors.length > 0) {
            var i = 0;
            var err = (errors.join("\n"));
            console.log(err);
            console.log($(ele).siblings('.err'));
            $(ele).parents('.input-group-prepend').siblings('.err').show().html(err);
            return false;
        }
    }

    function validatePhaseWise(div, phase) {
        var formData = {};
        $('.err').text('').hide();
        $('.form-control').css('border', '1px solid #ced4da')
        var url = 'service-provider/register/validate';
        $('.' + div + ' .form-group .form-control').each(function(index) {
            formData[this.id] = $(this).val();
        });
        formData['_token'] = '{{csrf_token()}}';
        formData['phase'] = phase;
        var xhr = ajaxPostObj(url, formData);
        xhr.done(function(resp) {
            if (phase == 1) {
                hidefirstview();
            }
            if (phase == 2) {
                hidesecondview();
            }
        }).fail(function(reason) {
            var resp = reason.responseJSON;
            console.log(resp);
            for (var i in resp.message) {
                $('#' + i + '-err').show();
                $('#' + i + '-err').text('*' + resp.message[i][0] + '*');
                $('#' + i).css('border', '1px solid red');
            }
        });
    }

    var i = 0;

    function addform(e) {
        e.preventDefault();
        if (i == 9) {
            $('#addnewproject').hide();
        } else {
            i++;
            $("#addformbelowhere").append(
                '<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12"><div class="input-group-prepend"><span class="input-group-text"> <i class="fas fa-fw  fa-map-marker"></i></span><textarea name="project_details[]" class="form-control" placeholder="Project Detail" rows="3"></textarea></div></div><div class="form-group col-12 col-sm-12 col-md-12 col-lg-12"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-fw  fa-map-marker"></i></span><input type="text" class="form-control" name="project_links[]" placeholder="Project link (Facebook/Website)"></input></div></div>'
            );
            $('#addedform').focus();
        }
    }

    function getData(val, e) {
        e.preventDefault();
        var url = 'api/get-items/' + val;
        var xhr = ajaxGetObj(url);
        xhr.done(function(resp) {
            if (val == 10001 || val == 10002) {
                $('#products').empty();
                for (var i in resp) {
                    $('#products').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>')
                }
            } else {
                $('#services').empty();
                for (var i in resp) {
                    $('#services').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>')
                }
            }
        }).fail(function(reason) {
            var rsp = reason.responseJSON;
            console.log(rsp);
        });
    }

    function formSubmit(e) {
        e.preventDefault();
        var url = 'service-provider/register-form';
        var formData = $('form').serialize();
        var xhr = submitFormAjax(url, formData);
        xhr.done(function(resp) {
            resetForm($('form'));
            showfirstview();
            $('.thirdpage').hide();
            $('#finish').hide();
            $('#gobacktosecondview').hide();
            $('.thirdpage').hide();
            $('.alert-success').show().text(resp);
        }).fail(function(reason) {

        })
    }
</script>
