<style type="text/css">
    span.required {
        color: red;
    }
</style>

{{-- @dd($data->material); --}}
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add Material</h3>
    </div>
    <div class="box-body">
        <form method="post" id="form" onsubmit="formSubmit(event)" class="oas-form-inline">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="id" id="id" value="{{ $data->id }}"/>

            <div class="col-md-12">
                <fieldset>
                    <legend>Requirement</legend>
                    <div class="form-group">
                        <label for="category"><span class="required">*</span> What you prefer?</label>
                        <select class="form-control" name="category" onchange="showDiv(this.value)" disabled>
                            @if($data->category=='M')
                                <option value="M">Material</option>
                            @else
                                <option value="S">Service</option>
                            @endif
                        </select>
                        <div id="category-err"
                             class="error">{{ session('errors') ? session('errors')->first('category') : '' }}</div>
                    </div>
                    @if(isset($data['filepath']))
                        <div class="form-group">
                            <label for="file"> File Uploaded</label>
                            <a href="{{$data['filepath']}}" target="_blank" download="{{$data['originalFilename']}}">{{$data['originalFilename']}}</a>
                            <div id="category-err"
                                 class="error">{{ session('errors') ? session('errors')->first('category') : '' }}</div>
                        </div>
                    @endif
                    @if(isset($data['material']))
                        <div class="material">
                            <div class="form-group">
                                <label for="material_id"><span class="required">*</span> Which Material?</label>
                                <select class="form-control" name="material_id" id="material_id"
                                        onchange="getMaterialTypes(this.value)" disabled>
                                    @foreach($material as $m)
                                        @if($m->id == $data->material->material_id)
                                            <option value="{{$m->id}}">{{ $m->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="materialid-err"
                                     class="error">{{ session('errors') ? session('errors')->first('materialid') : '' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="material_type_id">Which Type?</label>
                                <select class="form-control" name="material_type_id" id="material_type_id"
                                        onchange="getBrand(this.value)" disabled>
                                    @foreach($data['materialType'] as $m)
                                        @if($m->id == $data->material->material_type_id)
                                            <option value="{{$m->id}}" >{{ $m->material_type_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id"><span class="required">*</span> Which Brand?</label>
                                <select class="form-control" name="brand_id" id="brand_id" onchange="" disabled>
                                    @foreach($data['material_brand'] as $m)
                                        @if($m->id == $data->material->brand_id)
                                            <option value="{{$m->id}}">{{ $m->brand_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="brand_id-err"
                                     class="error">{{ session('errors') ? session('errors')->first('brand_id') : '' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="quantity"><span class="required">*</span> Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="quantity"
                                       value="{{ $data['material']->quantity }}"/>
                                <div id="quantity-err"
                                     class="error">{{ session('errors') ? session('errors')->first('quantity') : '' }}</div>
                            </div>
                        </div>
                    @else
                        <div class="service">
                            <div class="form-group">
                                <label for="service_type_id"><span class="required">*</span> Which Service Type?</label>
                                <select class="form-control" name="service_type_id" id="service_type_id"
                                        onchange="getServices(this.value)" disabled>
                                    @foreach($serviceType as $m)
                                        @if($m->id == $data->services->service_type_id)
                                            <option value="{{$m->id}}">{{ $m->service_type_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="service_type_id-err"
                                     class="error">{{ session('errors') ? session('errors')->first('service_type_id') : '' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="service_id"><span class="required">*</span> Which Service?</label>
                                <select class="form-control" name="service_id" id="service_id" onchange="" disabled>
                                    @foreach($data['service'] as $m)
                                        @if($m->id == $data->services->service_id)
                                            <option value="{{$m->id}}">{{ $m->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="service_id-err"
                                     class="error">{{ session('errors') ? session('errors')->first('service_id') : '' }}</div>
                            </div>
                        </div>

                        <div id="structural-service-fields" style="display: none;">
                            <div class="form-group">
                                <label for="land_area"><span class="required">*</span> Land Area</label>
                                <input type="text" name="land_area" class="form-control" placeholder="Enter Land Area">
                                <div id="land_area_err"
                                     class="error">{{ session('errors') ? session('errors')->first('land_area') : '' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="no_of_storey"><span class="required">*</span> No. of Storey</label>
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
                                <label for="floor_space"><span class="required">*</span> Floor Space</label>
                                <input type="text" name="floor_space" class="form-control"
                                       placeholder="Enter Floor Space">
                                <div id="floor_space_err"
                                     class="error">{{ session('errors') ? session('errors')->first('floor_space') : '' }}</div>
                            </div>
                        </div>

                    @endif
                    <div class="form-group">
                        <label for="estimated_cost">Estimated Cost</label>
                        <input type="number" class="form-control" name="estimated_cost" id="estimated_cost"
                               value="{{$data->estimated_cost}}"/>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Others</legend>
                    <div class="form-group">
                        <label for="district"><span class="required">*</span> District</label>
                        <select class="form-control" name="district" id="district">
                            @foreach($district as $d)
                                <option value="{{$d->id}}" {!! $data->district == $d->id ?'selected': '' !!} >
                                    {{$d->district_name}}
                                </option>
                            @endforeach
                        </select>
                        <div id="district-err"
                             class="error">{{ session('errors') ? session('errors')->first('district') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="address"><span class="required">*</span> Full Address</label>
                        <input type="text" class="form-control" placeholder="Email" name="address" id="address"
                               value="{{$data->address}}">
                        <div id="email-err"
                             class="error">{{ session('errors') ? session('errors')->first('address') : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="duration">No. of days</label>
                        <input type="number" class="form-control" placeholder="Number Of Days" name="duration_days"
                               id="duration_days" value="{{$data->duration_days}}">
                        <div id="email-err" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">About your Requirement</label>
                        <textarea class="form-control" name="description" id="description"
                                  style="float:right;width:50%;height:150px;">{{ $data->description ?? ''}}</textarea>
                        <div id="email-err" class="error"></div>
                    </div>
                </fieldset>
            </div>
            <div class=" row col-xs-12">
                <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{url('/admin/client-post')}}" class="btn btn-danger pull-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script>
    function formSubmit(e) {
        e.preventDefault();
        $('input').prop('disabled',false);
        $('select').prop('disabled',false);
        var url = baseUrl + '/update';
        if ($('#id').val() == "") {
            var formData = $("#form").serialize();
        } else {
            url += "/" + $('#id').val();
            var formData = $("#form").serialize() + '&_method=PUT';
        }
        var xhr = submitFormAjax(url, formData);
        xhr.done(function (resp) {
            resetForm($('#form'));
            window.location.href = baseUrl;
            //table();
            toast(resp);
        }).fail(function (reason) {
            var rsp = reason.responseJSON;
            toast(rsp);
        });
    }

    var show_structural_service_fields = function () {
        let val_service = $('#service_id:visible').val();
        if (val_service == 2) {
            $('#structural-service-fields').prop('disabled', false);
            $('#structural-service-fields').show();
        } else {
            $('#structural-service-fields').prop('disabled', true);
            $('#structural-service-fields').hide();
        }
    };
    show_structural_service_fields();
</script>
