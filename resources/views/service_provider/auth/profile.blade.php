<?php include(resource_path() . '/views/service_provider/header.blade.php');
?>
<style type="text/css">
    .nav-tabs {
        color: #000;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        color: #000;
        border-bottom: none !important;
        font-size: 17px;
        letter-spacing: 1px;
    }

    .nav-tabs-custom>.nav-tabs>li {
        border: 0px;
    }

    .latest-item {
        padding: 8px;
        margin-left: 10px;
        font-size: 15px;
        text-align: left;
    }

    span.expired {
        color: #e12424;
    }

    .bg-danger {
        background-color: #ce3131 !important;
    }

    .btn-info {
        padding: 4px;
        font-size: 13px;
    }
</style>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/vendor3.jpg') }}" alt="User profile picture">  
                                    
                    <div class="d-flex align-items-center justify-contents-center">
                    <h3 class="profile-username text-center mb-1">{{ $users->contact_name }}</h3>
                    @if(!empty($users->badge))
                        <h5 class="badge badge-success rounded-circle m-0 ml-2 ttooltip">
                            <i class="fa fa-check-circle"></i>
                          <span class="ttooltiptext">{{ config('constants.verified_user_msg') }}</span>
                        </h5>
                    @endif
                    </div>
                    <p class="text-muted text-center">{{ $users->vendor_type }}</p>
                    @if(!empty($users->badge))
                       <!-- Badge -->
                       <div class="d-flex justify-contents-center mb-4">
                           <div class="ttooltip">
                               <div class="d-flex align-items-baseline">
                                   @if($users->badge == 4)
                                     <div class="ribbon  ribbon--purple">
                                         <i class="fas fa-gem"></i>
                                     </div>
                                   <b class="pl-2" style="color:#5C3292;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                                   @elseif($users->badge == 3)
                                       <div class="ribbon  ribbon--blue">
                                           <i class="fas fa-crown"></i>
                                       </div>
                                       <b class="pl-2" style="color:#1C91C0;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                                   @elseif($users->badge == 2)
                                       <div class="ribbon  ribbon--orange">
                                           <i class="fas fa-trophy"></i>
                                       </div>
                                       <b class="pl-2" style="color:#E7711B;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                                   @elseif($users->badge == 1)
                                       <div class="ribbon  ribbon--gray">
                                           <i class="fas fa-award"></i>
                                       </div>
                                       <b class="pl-2" style="color:#8d8d8d;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);">{{$users->badge_name}}</b>
                                   @endif
                               </div>
                             <span class="ttooltiptext">{{ $users->badge_description }}</span>
                               <div class="arrow" style="left: 45px;"></div>
                           </div>
                       </div>                
                   @endif                    
                    <p class="stars starrr Delivered text-center" data-rating="{{round($users->average_stars)}}"></p>
                    <p class="description text-center">Rating: ({{$users->average_stars}} / 5)</p>
                    <p class="description text-center"><a href="{{ url('service-provider/post/reviews') }}"><u>{{$users->total_reviews}}
                                Reviews</u></a></p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>New Bids</b> <a class="pull-right">{{ $vPost->countPost(0) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Bid Processing</b> <a class="pull-right">{{ $vPost->countPost(1) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Bid Rejected</b> <a class="pull-right">{{ $vPost->countPost(2) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Bid Wins</b> <a class="pull-right">{{ $vPost->countPost(3) }}</a>
                        </li>
                    </ul>

                    <a href="{{ url('service-provider/new-bids') }}" class="btn btn-primary btn-block"><b>Find New
                            Bids</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Info</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($users->profile_progress == 100)
                        <p id="progress-status" class="text-center text-success">Completed</p>
                    @endif
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped {{$users->profile_progress != 100 ? 'bg-danger': 'bg-success'}} " role="progressbar" style="width: {{$users->profile_progress}}%;" aria-valuenow={{$users->profile_progress}} aria-valuemin="40" aria-valuemax="100">{{$users->profile_progress}}%
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" custom_type="staff" class="btn btn btn-info btn-add-profile m-1">Staff <i class="fa fa-plus text-primary"></i></button>
                    <button type="button" custom_type="vehicle" class="btn btn-info btn-add-profile m-1">Vehicle <i class="fa fa-plus text-primary"></i>
                    </button>
                    <button type="button" custom_type="machine" class="btn btn-info btn-add-profile m-1 text-primary">Machine <i class="fa fa-plus text-primary"></i>
                    </button>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Contact</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div>
                        <strong><i class="fa fa-book margin-r-5"></i> Email </strong>

                        <p class="text-muted">
                            <span class="new_text">{{ $users->email }}</span>
                            <a class="pull-right"><i class="fa fa-pencil a-edit"></i></a>
                        </p>
                        <form class="form-edit" role="form" action="{{url('/service-provider/updateProfile/'.$users->id)}}" method="post" hidden>
                            <div class="form-group">
                                <input name="email" type="email" placeholder="Enter Email" class="form-control">
                                <button class="btn btn-sm btn-primary btn-submit mt-1"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger btn-cancel mt-1"><i class="fa fa-times"></i></button>
                            </div>
                        </form>
                    </div>
                    <hr>

                    <div>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Phone Number</strong>

                        <p class="text-muted">
                            <span class="new_text"> {{ $users->mobile }}</span>

                            <a class="pull-right a-edit"><i class="fa fa-pencil"></i></a></p>
                        <form class="form-edit" role="form" action="{{url('/service-provider/updateProfile/'.$users->id)}}" method="post" hidden>
                            <div class="form-group">
                                <input name="phone_number" type="number" placeholder="Enter Phone Number" class="form-control">
                                <button class="btn btn-sm btn-primary btn-submit mt-1"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger btn-cancel mt-1"><i class="fa fa-times"></i></button>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <!-- <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li> -->
                    <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            @if(!empty(count($posts)> 0))
                            @foreach($posts as $k=>$p)
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>

                                <div id="timeline_{{$p->postid}}" class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {!! $carbon->parse($p->expired_at)->gt($carbon->now())?
                                        '<span class="expiring">Expiring on</span>':
                                        '<span class="expired">Expired </span>'
                                        !!} <a>{{ $carbon->parse($p->expired_at)->format('d M') }}</a></span>

                                    <h3 class="timeline-header"><a href="#">You</a> bided for
                                        Rs. {{$p->bid_amount }} on <b>{{ $p->client_name }}'s</b> post</h3>

                                    <div class="timeline-body">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ url('img/photo.png') }}" alt="User Image">
                                            <span class="username">
                                                <a href="#">{{ $p->client_name }}</a>
                                                <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                                            </span>
                                            <span class="description">posted - {{ $carbon->parse($p->created_at)->format('d M') }}</span>
                                        </div>
                                        <p>{{ $p->description }}</p>
                                        <div id="bid-details_{{$p->postid}}" class="bid-details row" style="display: none;">
                                            @foreach($p as $k=>$m)
                                            @if( $k=="postid" || $k=="client_name" || $k=="description" || $k=="created_at" || $k=="expired_at" )
                                            @continue;
                                            @else
                                            <div class="latest-item col-md-12 pull-left p-0">
                                                <div class="title col-md-3">
                                                    {{ getName($k) }}
                                                </div>
                                                <div class="value col-md-9">{{ $m }}</div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="timeline-footer_{{$p->postid}}" class="timeline-footer">
                                        <a class="btn btn-warning btn-flat btn-xs" onclick="showDiv('{{$p->postid}}')">View more</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @else
                            <img class="img-thumbnail" src="{{url('img/nopost.jpg')}}" style="border:0px;" />
                            @endif
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                        </ul>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div id="add-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modal-title">Add Staff</h4>
                </div>
                <div class="modal-body">
                    <form id="modal-form" role="form" action="{{url('/service-provider/addProfile')}}" method="post">
                        <input id="type" type="hidden" value="staff" name="type">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <input id="modal-name" class="form-control" type="text" placeholder="Enter Name" name="name">
                                    <div id="name-err" class="error"></div>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name='number' placeholder="Enter Number" class="form-control">
                                    <div id="number-err" class="error"></div>
                                </div>
                                <div class="col-md-2">
                                    <button class="form-control btn btn-primary modal-submit"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12" id="modal-table">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('.btn-submit').on('click', function(e) {
            e.preventDefault();
            if (confirm('This action cannot be undone. Are you sure?')) {
                $('.error-msg').remove();
                $('.success-msg').remove();

                var button = this;
                var form = $(this).closest('form');

                var url = $(form).attr('action');
                var data = $(form).serialize();
                var xhr = ajaxPostObj(url, data);
                xhr.done(function(resp) {
                    if (resp.success == true) {
                        if (resp.logout) {
                            window.location.href = '/#emailChanged';
                        }
                        $(form).hide();
                        $(form).parent().find('.new_text').text(resp.data);

                        $(form).after('<span class="success-msg" style="color: green;">*' + resp.message + '</span>');
                    } else {
                        $(form).after('<span class="error-msg" style="color: red;">*' + resp.message + '</span>');
                    }
                }).fail(function(reason) {
                    if (reason.responseJSON.errors) {
                        $(form).find('input').focus();
                        if (reason.responseJSON.errors.email) {
                            $(form).after('<span class="error-msg" style="color: red;">*' + reason.responseJSON.errors.email + '</span>');
                        } else if (reason.responseJSON.errors.phone_number) {
                            $(form).after('<span class="error-msg" style="color: red;">*' + reason.responseJSON.errors.phone_number + '</span>');
                        }
                    } else {
                        var rsp = reason.responseJSON;
                        // toast(rsp);
                    }
                });
            }
        });

        $('.btn-cancel').on('click', function(e) {
            e.preventDefault();
            $('.error-msg').remove();
            $('.success-msg').remove();

            $(this).closest('form').find('input').val('');
            $(this).closest('form').hide();
        });

        $('.a-edit').on('click', function() {
            $('.error-msg').remove();
            $('.success-msg').remove();
            $(this).closest('div').find('input').val('');

            $(this).closest('div').find('form').toggle();
        });
    </script>
</section>
<script type="text/javascript">
    function showDiv(id) {
        $('.bid-details').hide();
        $('#bid-details_' + id).show();
        $('#timeline-footer_' + id + ' a').attr('onclick', 'hideDiv("' + id + '")');
        $('#timeline-footer_' + id + ' a').text('View less');
    }

    function hideDiv(id) {
        $('#bid-details_' + id).hide();
        $('#timeline-footer_' + id + ' a').attr('onclick', 'showDiv("' + id + '")');
        $('#timeline-footer_' + id + ' a').text('View more');
    }

    $('.btn-add-profile').click(function() {
        $('div.error').hide();
        let modal = $("#add-modal");
        let title = $(modal).find("#modal-title");
        let type = $(modal).find("#type");
        let name = $(modal).find("#modal-name");
        let table = $(modal).find("#modal-table");

        $('.message').remove();
        $(table).html('');

        let custom_type = $(this).attr('custom_type');
        if (custom_type == 'staff') {
            $(title).text('Add Staff Designation');
            $(type).val("staff");
            $(name).attr('placeholder', "Enter Staff Designation");
        } else if (custom_type == 'vehicle') {
            $(title).text('Add Vehicle');
            $(type).val("vehicle");
            $(name).attr('placeholder', "Enter Vehicle Name");
        } else if (custom_type == 'machine') {
            $(title).text('Add Machine');
            $(type).val("machine");
            $(name).attr('placeholder', "Enter Machine Name");
        }
        let url = "{{url('/service-provider/getProfile').'/'}}" + custom_type;
        let xhr = ajaxGetObj(url);
        xhr.done(function(response) {
            $(table).append(response['html']);
            $(modal).modal('show');
        }).fail(function() {});

    });

    $('#modal-form').submit(function(e) {
        e.preventDefault();
        $('div.error').hide();
        let url = $(this).attr('action');
        let data = $(this).serialize();
        let xhr = ajaxPostObj(url, data);
        xhr.done(function(response) {
            if (response.success == true) {
                resetForm($('#modal-form'));
                $('#modal-table').html('');
                $('#modal-table').append(response['html']);
                $('#modal-table').prepend('<div class="message row text-center"><div class="col-12" style="display:block; background-color: green;"><span style="color:white">' + response.message + '</span></div></div>');

                if (response.progress) {
                    let progress = $('.progress-bar').text();
                    progress = parseInt(progress) + parseInt({{config('constants.percentage_to_raise_per_profile_component')}});
                    $('.progress-bar').css('width', progress + '%');
                    $('.progress-bar').text(progress +'%');
                    if(progress == 100){
                        $('.progress-bar').addClass('bg-success').removeClass('bg-danger');
                        $('p#progress-status').text('Completed');
                    }
                }
            } else {
                $('#modal-table').prepend('<div class="message row text-center"><div class="col-12"  style="display:block; background-color: red;"><span>' + response.message + '</span></div></div>');
            }
        }).fail(function(response) {
            $('.message').remove();
            $.each(response.responseJSON.errors, function(i, error) {
                console.log(i);
                $('#' + i + '-err').show().text('* ' + error);
            });
        });
    });

    $(document).on('click', ".delete-item", function() {
        $('.message').remove();
        let row = $(this).closest('tr');
        let id = $(row).find('.item-id').val();

        let url = "{{url('/service-provider/deleteProfile').'/'}}" + id;
        let xhr = ajaxGetObj(url);
        xhr.done(function(response) {
            if (response.success) {
                $(row).remove();
                $('.items-table').before('<div class="message row text-center"><div class="col-12" style="display:block; background-color: green;"><span style="color:white">' + response.message + '</span></div></div>');
                if (response.deduce) {
                    let progress = $('.progress-bar').text();
                    progress = parseInt(progress) - parseInt({{config('constants.percentage_to_raise_per_profile_component')}});
                    $('.progress-bar').css('width', progress + '%');
                    $('.progress-bar').text(progress + '%');
                    if(progress < 100){
                        $('.progress-bar').addClass('bg-danger').removeClass('bg-success');
                        $('p#progress-status').text('');
                    }
                }
            } else {
                $('.items-table').before('<div class="message row text-center"><div class="col-12"  style="display:block; background-color: red;"><span>' + response.message + '</span></div></div>');
            }
        }).fail(function(response) {
            $('.message').remove();
            $.each(response.responseJSON.errors, function(i, error) {
                $('.items-table').before('<div class="message row text-center"><div class="col-12"  style="display:block; background-color: red;"><span>' + error + '</span></div></div>');
            });
        });
    });

    $('#add-modal').on('hidden.bs.modal', function() {
        $('#add-modal').find('input').val('');
    });
</script>


<?php
include(resource_path() . '/views/service_provider/footer.blade.php');
?>