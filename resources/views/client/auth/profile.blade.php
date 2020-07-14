<?php include(resource_path() . '/views/client/header.blade.php');
?>
<style type="text/css">
    .nav-tabs-custom>.nav-tabs>li {
        border: 0px;
    }
    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        color: #000;
        border-bottom: none !important;
        font-size:17px;
        letter-spacing: 1px;

    }

    .fa-thumbs-up {
        color: #7474fb;
        font-size: 18px;
    }

    .not-verified {
        padding: 5px;
        background-color: #ec3838;
        font-size: 10px;
        color: #fff;
    }

    .verified {
        padding: 5px;
        background-color: green;
        font-size: 10px;
        color: #fff;
    }
</style>

<!-- Main content -->
<section class="content">

    <div class="row px-4 px-sm-5">
    <h2 class="page-header px-3 mb-0">Your Profile</h2>
        <div class="col-sm-4 col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/photo.png') }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $users->name }}</h3>

                    <p class="text-muted text-center">Client</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Post pending</b> <a class="pull-right">{{ $cPost->countPost([0]) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Post Rejected</b> <a class="pull-right">{{ $cPost->countPost([2]) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Post Proceed</b> <a class="pull-right">{{ $cPost->countPost([1]) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Post completed</b> <a class="pull-right">{{ $cPost->countPost([3]) }}</a>
                        </li>
                    </ul>

                    <a href="{{ url('client/post') }}" class="btn btn-primary btn-block"><b>Post Your
                            Requirement</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

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
                            <a class="pull-right a-edit"><i class="fa fa-pencil"></i></a>
                        </p>
                        <form class="form-edit" role="form" action="{{url('/client/updateProfile/'.$users->id)}}" method="post" hidden>
                            <div class="form-group">
                                <input name="email" type="email" placeholder="Enter Email" class="form-control">
                                <button class="btn btn-sm btn-primary btn-submit mt-1"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-danger btn-cancel mt-1"><i class="fa fa-times"></i></button>
                            </div>
                        </form>
                    </div>
                    {!! !empty($users->email_verified_at)?'<span class="verified"><i class="fa fa-check"></i> Verified</span>':'<span class="not-verified"><i class="fa fa-close"></i> Not Verified</span>' !!}
                    <hr>
                    <div>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Phone Number</strong>

                        <p class="text-muted">
                            <span class="new_text">{{ $users->mobile }}</span>
                            <a class="pull-right a-edit"><i class="fa fa-pencil"></i></a>
                        </p>
                        <form class="form-edit" role="form" action="{{url('/client/updateProfile/'.$users->id)}}" method="post" hidden>
                            <div class="form-group">
                                <input name="mobile" type="number" placeholder="Enter Phone Number" class="form-control">
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
        <div class="col-sm-8 col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
                <div class="tab-content">
                    <?php echo view('client.timeline_content', ['posts' => $posts, 'users' => $users, 'carbon' => $carbon, 'cbid' => $cbid])->render(); ?>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

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
                    if (resp.success) {
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
                        } else if (reason.responseJSON.errors.mobile) {
                            $(form).after('<span class="error-msg" style="color: red;">*' + reason.responseJSON.errors.mobile + '</span>');
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
<?php
if (!request()->ajax()) :
    include(resource_path() . '/views/client/footer.blade.php');
endif;
?>