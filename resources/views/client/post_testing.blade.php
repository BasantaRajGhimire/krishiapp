
<style type="text/css">
    span.required {
        color: red;
    }

    .error {
        font-size: 11px;
        color: red;
        padding: 5px 10px 0px 20px;
        float: right;
        text-align: center;
        width: 50%;
    }

    .client-post {
        background-color: antiquewhite !important;
        min-height: 450px;
    }

    fieldset {
        width: 45%;
        float: left;
    }

    .box {
        background-color: #4e5b806b;
        border-color: bisque;
        margin-bottom: 0px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .box h1 {
        margin-top: 5px;
        margin-bottom: 5px;
        color: #fff;
    }
</style>
<div class="box">
    <div class="box-header">
        <div class="col-sm-12 text-center">
            <h1>Post Your Requirement</h1>
        </div>
    </div><!-- /.container-fluid -->
</div>
<section class="content client-post">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li class="text-center">{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('msg'))
        <div class="alert alert-danger">
            <ul>
                <li class="text-center">{!! \Session::get('msg') !!}</li>
            </ul>
        </div>
    @endif
    <form action="{{ url('/client/post') }}" method="post" id="register-form" class="oas-form-inline" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
        <div class="col-md-12">
            <fieldset>
                <legend>Requirement</legend>
                <div class="form-group">
                    <label for="category"><span class="required">*</span> What you prefer?</label>
                    <select class="form-control" name="category" id="category" onchange="showDiv(this.value)">
                        <option value="M">Material</option>
                        <option value="S">Service</option>
                    </select>
                    <div id="category-err"
                         class="error">{{ session('errors') ? session('errors')->first('category') : '' }}</div>
                </div>
                <div class="form-group">
                    <label for="file"> File Upload</label>
                    <input type="file" name="doc" class="btn btn-md" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .pdf" onchange="changeRequired(this)">
                    <div id="file-err"
                         class="error">{{ session('errors') ? session('errors')->first('doc') : '' }}</div>
                </div>
                <div class="material">
                    <div class="form-group">
                        <label for="material_id"><span class="required mayberequired">*</span> Which Material?</label>
                        <select class="form-control" name="material_id" id="material_id"
                                onchange="getMaterialTypes(this.value)">
                            <option value="">Select One</option>
                            @foreach($material as $m)
                                <option value="{{$m->id}}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                        <div id="material_id-err"
                             class="error">{{ session('errors') ? session('errors')->first('material_id') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="material_type_id">Which Type?</label>
                        <select class="form-control" name="material_type_id" id="material_type_id"
                                onchange="getBrand(this.value)">
                            <option value="">Select One</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_id"><span class="required mayberequired">*</span> Which Brand?</label>
                        <select class="form-control" name="brand_id" id="brand_id" onchange="">
                        </select>
                        <div id="brand_id-err"
                             class="error">{{ session('errors') ? session('errors')->first('brand_id') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="quantity"><span class="required mayberequired">*</span> Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity"/>
                        <div id="quantity-err"
                             class="error">{{ session('errors') ? session('errors')->first('quantity') : '' }}</div>
                    </div>
                </div>
                <div class="service" style="display: none;">
                    <div class="form-group">
                        <label for="service_type_id"><span class="required mayberequired">*</span> Which Service
                            Type?</label>
                        <select class="form-control" name="service_type_id" id="service_type_id"
                                onchange="getServices(this.value)">
                            <option value="">Select One</option>
                            @foreach($serviceType as $m)
                                <option value="{{$m->id}}">{{ $m->service_type_name }}</option>
                            @endforeach
                        </select>
                        <div id="service_type_id-err"
                             class="error">{{ session('errors') ? session('errors')->first('service_type_id') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="service_id"><span class="required mayberequired">*</span> Which Service?</label>
                        <select class="form-control" name="service_id" id="service_id" onchange="">
                        </select>
                        <div id="service_id-err"
                             class="error">{{ session('errors') ? session('errors')->first('service_id') : '' }}</div>
                    </div>
                </div>

                <div id="structural-service-fields" style="display: none;">
                    <div class="form-group">
                        <label for="land_area"><span class="required mayberequired">*</span> Land Area</label>
                        <input type="text" name="land_area" class="form-control" placeholder="Enter Land Area">
                        <div id="land_area_err"
                             class="error">{{ session('errors') ? session('errors')->first('land_area') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="no_of_storey"><span class="required mayberequired">*</span> No. of Storey</label>
                        <select class="form-control" name="no_of_storey" id="no_of_storey">
                            <option value="">Select One</option>
                            @for($i = 1; $i<=15; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <div id="no_of_storey_err"
                             class="error">{{ session('errors') ? session('errors')->first('no_of_storey') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="floor_space"><span class="required mayberequired">*</span> Floor Space</label>
                        <input type="text" name="floor_space" class="form-control" placeholder="Enter Floor Space">
                        <div id="floor_space_err"
                             class="error">{{ session('errors') ? session('errors')->first('floor_space') : '' }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="estimated_cost"><span class="required mayberequired">*</span> Estimated Cost</label>
                    <input type="number" class="form-control" name="estimated_cost" id="estimated_cost"/>
                    <div id="estimated_cost-err"
                         class="error">{{ session('errors') ? session('errors')->first('estimated_cost') : '' }}</div>
                </div>
            </fieldset>
            <fieldset style="float:right">
                <legend>Others</legend>
                <div class="form-group">
                    <label for="district"><span class="required mayberequired">*</span> District</label>
                    <select class="form-control" name="district" id="district">
                        <option value="1">Kathmandu</option>
                        <option value="2">Lalitpur</option>
                        <option value="3">Bhaktapur</option>
                    </select>
                    <div id="district-err"
                         class="error">{{ session('errors') ? session('errors')->first('district') : '' }}</div>
                </div>
                <div class="form-group">
                    <label for="address"><span class="required mayberequired">*</span> Full Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address" id="address">
                    <div id="email-err"
                         class="error">{{ session('errors') ? session('errors')->first('address') : '' }}</div>
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="number" class="form-control" placeholder="Number Of Days" name="duration_days"
                           id="duration_days">
                    <div id="email-err" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="description"><span class="required">*</span> About your Requirement</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                    <div id="description-err"
                         class="error">{{ session('errors') ? session('errors')->first('description') : '' }}</div>
                </div>
            </fieldset>
        </div>
        <div class=" row col-xs-4">
            <button type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>
    </div>
    <!-- /.form-box -->
</section>
<script>
    var gLoader = "loader-animation";
    var mainContainer = "main-body";
    $(document).ajaxStart(function () {
        $('#' + gLoader).show();
    });
    $(document).ajaxStop(function () {
        hideLoader();
    });
    var baseUrl = "<?php echo url('/client'); ?>";

    function showDiv(value) {
        if (value == 'S') {
            $('.material').hide();
            $('.service').show();
            $('label[for="description"]').html('<span class="required">*</span> About your Requirement');
        } else {
            $('label[for="description"]').text('About your Requirement');
            $('.service').hide();
            $('.material').show();
        }
    }

    function getMaterialTypes(materialid, typeid) {
        $('#brand_id').empty();
        $('#material_type_id').empty();
        if (materialid == '') {
            emptySelection('material_type_id');
            return true;
        }
        var url = 'get-material-types/' + materialid;
        var xhr = ajaxGetObj(url);
        xhr.done(function (resp) {
            if (resp.length > 0) {
                createSelection('material_type_id', resp, 'id', 'material_type_name', typeid);
            } else {
                getBrand('');
            }
        }).fail(function (reason) {
            var rsp = reason.responseJSON;
            console.log(rsp);
            //toast(rsp);
        });

    }

    function getBrand(typeid, brandid) {
        var materialid = $('#materialid').val();
        if (typeid == '') {
            var url = 'get-brand?materialid=' + materialid;
            var xhr = ajaxGetObj(url);
            xhr.done(function (resp) {
                //console.log(resp);
                createSelection('brand_id', resp, 'id', 'brand_name', typeid);
            }).fail(function (reason) {
                var rsp = reason.responseJSON;
                console.log(rsp);
                //toast(rsp);
            });
        } else {
            var url = 'get-brand?typeid=' + typeid;
            var xhr = ajaxGetObj(url);
            xhr.done(function (resp) {
                //console.log(resp);
                createSelection('brand_id', resp, 'id', 'brand_name', typeid);
            }).fail(function (reason) {
                var rsp = reason.responseJSON;
                console.log(rsp);
                //toast(rsp);
            });
        }

    }

    function getServices(servicetypeid) {
        $('#service_id').empty();
        // if(materialid==''){
        //   emptySelection('material_type_id');
        //   return true;
        // }
        var url = 'get-services/' + servicetypeid;
        var xhr = ajaxGetObj(url);
        xhr.done(function (resp) {
            createSelection('service_id', resp, 'id', 'name');
        }).fail(function (reason) {
            var rsp = reason.responseJSON;
            console.log(rsp);
            //toast(rsp);
        });
    }

    function changeRequired(elem) {
        if ($(elem).val()) {
            $('span.mayberequired').hide();
            $('span.mayberequired').closest('.form-group').find('.error').hide();
        } else {
            $('span.mayberequired').show();
        }
    }

    $(document).on('change', "#service_id, #service_type_id, #category", function () {
        let val_service = $('#service_id:visible').val();
        if (val_service == 2) {
            $('#structural-service-fields').prop('disabled', false);
            $('#structural-service-fields').show();
        } else {
            $('#structural-service-fields').prop('disabled', true);
            $('#structural-service-fields').hide();
        }
    });

    //}
    //$('[data-mask]').inputmask();
</script>