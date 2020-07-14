<?php
include(resource_path() . '/views/header-file.blade.php');
?>

<script>
    var gLoader = "loader-animation";
    var mainContainer = "main-body";
</script>
</head>
<?php
function getName($string)
{
    $name = explode('_', $string);
    foreach ($name as $n) {
        $names[] = ucfirst($n);
    }
    $names = implode(' ', $names);
    return $names;
}
$auth = new App\Auth();
$reviewPost = (new \App\ServiceProvider\WinPostDetails((new App\ServiceProvider\TableObject())))->getSingleWinPostDetails();
// dd($reviewPost);

$vendorUsers = new App\ServiceProvider\User();
$unreadCount = $vendorUsers->countUnreadMessages();
$unreadMessages = $vendorUsers->getMessages();

$users = $auth->getvendorUser(session('suserid'));
$vPost = new App\ServiceProvider\ServiceProviderBidPost();
$count = $vPost->countPost(1);
$ccount = $vPost->countPost(3);
$post = $vPost->getVendorBidPost(1);
$comPost = $vPost->getVendorBidPost(3);
$carbon = new \Carbon\Carbon();
?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header navbar-static-top">
            <nav class="navbar nav-1">
                <div class="navbar-header">
                    <a href="<?php echo url('/'); ?>" class="navbar-brand m-0 p-0 d-flex align-items-end">
                        <div><img width="50px" src="<?php echo asset('images/e4.png');?>" alt="" srcset=""></div>
                        <span class="pl-1 mt-2" style="color:#ffb400;font-family:'Rubik';font-size: 40px;line-height:29px;">e<span style="color:#ffb400;font-family:'Roboto';font-size: 29px;line-height:29px;font-weight:500">Thekka</span> </span>
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown lvl1 messages-menu taskmenu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-desktop"></i> My Bid
                                <span class="label label-danger"><?php echo $count==0?'':$count; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">
                                    You have <?php echo $count != 0 ? $count : 'no'; ?> post
                                </li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                            <?php if ($count > 0) : foreach ($post as $p) : ?>
                                                <li style="padding-right: 15px;">
                                                    <!-- Task item -->
                                                    <a href="<?php echo url('service-provider/post') . '/' . $p->id; ?>">
                                                        <!-- Task title and progress text -->
                                                        <div class="pull-left">
                                                            <!-- User Image -->
                                                            <img src="<?php echo url('img/photo.png'); ?>" class="img-circle" alt="User Image">
                                                        </div>
                                                        <!-- Message title and timestamp -->
                                                        <h4 class="wordwrap">
                                                            <small><i class="fa fa-clock-o"></i> <?php echo $carbon->parse($p->bided_at)->format('h:i d M'); ?></small>
                                                            You bided <u>Rs.<?php echo $p->bid_amount; ?></u> on <br>
                                                            <b><?php echo $p->name; ?>'s</b> Post
                                                        </h4>
                                                        <!-- The message -->

                                                    </a>
                                                </li>
                                <?php endforeach;
                                endif; ?>
                                                <!-- end task item -->
                                            </ul>
                                        </li>
                                <li class="footer">
                                    <a href="<?php echo url('service-provider/timeline'); ?>">View all bids</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown lvl1 messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i> Messages
                                <span class="label label-success"><?php echo $unreadCount != 0 ? $unreadCount : ''; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo $unreadCount != 0 ? $unreadCount : 'no'; ?> unread messages</li>
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <?php foreach ($unreadMessages as $m) : ?>
                                            <li class="<?php echo !empty($m->read_at) ? 'read' : 'unread'; ?>">
                                                <!-- start message -->
                                                <a href="<?php echo url('/service-provider') . '/' . $m->url . '?status=' . $m->id; ?>">
                                                    <div class="pull-left">
                                                        <!-- User Image -->
                                                        <img src="<?php echo url('img/photo.png'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <!-- Message title and timestamp -->
                                                   <h4> <small><i class="fa fa-clock-o"></i> <?php echo $carbon->parse($m->created_at)->format('h:i d M'); ?></small></h4>
                                                    <h4 class="mt-3">
                                                        <?php echo $m->type; ?>
                                                    </h4>
                                                    <!-- The message -->
                                                    <p class="textwrap"><?php echo $m->title; ?></p>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                        <!-- end message -->
                                    </ul>
                                    <!-- /.menu -->
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>

                        <li class="dropdown lvl1 messages-menu notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i> Won Bids
                                   <span class="label label-warning"><?php echo $ccount==0?'':$ccount; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo $ccount; ?> notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <?php if ($ccount > 0) : ?>
                                            <?php foreach ($comPost as $p) : ?>
                                                <li style="padding-right: 15px;">
                                                    <!-- Task item -->
                                                    <a href="<?php echo url('/service-provider/post') . '/' . $p->id; ?>">
                                                        <!-- Task title and progress text -->

                                                        <h4 style="top:25px"> <small class="pull-right" ><i class="fa fa-clock-o"></i> <?php echo $carbon->parse($p->bided_at)->format('h:i d M'); ?></small></h4>
                                                        <div class="post-task col-md-12">
                                                            <div class="user-block">
                                                                <img class="img-circle img-bordered-sm mr-2" src="<?php echo url('img/photo.png'); ?>" alt="User Image" />
                                                                <span>You have won bid on <b><?php echo $p->name; ?>'s</b> Post</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>

                        <li class="dropdown lvl1 tasks-menu">
                            <a class="" href="<?php echo url('/service-provider/new-bids'); ?>">
                                <button class="btn btn-danger">
                                    New Bids
                                </button>
                            </a>
                        </li>

                        <li class="dropdown lvl1 user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo url('img/photo.png'); ?>" class="user-image " alt="User Image">
                                <span class="hidden-sm"><?php echo $users->contact_name; ?></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Load Fund</a></li>
                                <li><a href="<?php echo url('service-provider/profile'); ?>">Profile</a></li>
                                <li><a href="#" onclick="$('#old-password-modal').modal('show')">Change Password</a></li>
                                <li><a href="<?php echo url('service-provider/auth/logout'); ?>">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="navbar nav-2">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse1">
                        <i class="fa fa-bars pr-2"></i>Dashboard
                    </button>
                </div>
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo url('/service-provider'); ?>">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li><a href="<?php echo url('service-provider/profile'); ?>">My Profile</a></li>
                        <li><a href="<?php echo url('/service-provider/new-bids'); ?>">New Bids</a></li>
                        <li><a href="<?php echo url('/service-provider/activity'); ?>">Activity</a></li>
                        <li><a href="<?php echo url('/service-provider/post/reviews'); ?>">Review & Rating</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php echo url('/service-provider/support-ticket'); ?>">Support Ticket</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <div id="old-password-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 70% !important;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password:</h4>
                    </div>
                    <div class="modal-body">
                        <form id="old-password-form" role="form" onsubmit="checkOldPassword(event)" method="get" id="form" class="">
                            <input type="hidden" value="" name="post_id" id="post_id">
                            <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="comment_on_bid"><span class="red">*</span> Enter old password</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="old_password" id="old_password" />
                                        <div id="old_password-err" class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success btn-sm" value="Submit">
                            <input type="reset" class="btn btn-success btn-sm pull-right" value="Reset Form">
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div id="new-password-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 70% !important;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password:</h4>
                    </div>
                    <div class="modal-body">
                        <form id="change-password-form" role="form" onsubmit="changePassword(event)" method="post" id="form" class="">
                            <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="o_pd" id="o_pd" />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="comment_on_bid"><span class="red">*</span> New password</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="new_password" id="new_password" />
                                        <div id="new_password-err" class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="comment_on_bid"><span class="red">*</span> Confirm new password</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" />
                                        <div id="confirm_password-err" class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success btn-sm" value="Submit">
                            <input type="reset" class="btn btn-success btn-sm pull-right" value="Reset Form">
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div id="main" class="content-wrapper" style="min-height:400px !important;">
            <div class="row">
                <section id="main-body" class="content col-lg-12">
                    <div id="pd-change-success" class="alert alert-success hide">
                        <strong>Hello <?php echo $users->contact_name; ?></strong>, Your password has been successfully changed.
                    </div>
                    <script type="text/javascript">
                        var url = '<?php echo url()->current(); ?>';
                        $('#navbar-collapse1 li').removeClass('active');
                        $('#navbar-collapse1 a[href="' + url + '"]').parent('li').addClass('active');

                        function checkOldPassword(e) {
                            e.preventDefault();
                            var url = "<?php echo url('/service-provider'); ?>";
                            url += '/check-old-password?old_password=' + $('#old_password').val();
                            var xhr = ajaxGetObj(url);
                            xhr.done(function(response) {
                                $('#o_pd').val(response);
                                resetForm($('#old-password-form'));
                                $('#old-password-modal').modal('hide');
                                $('#new-password-modal').modal('show');
                            }).fail(function(reason) {
                                var resp = reason.responseJSON;
                                console.log(resp);
                                $('#old_password-err').show().text('* ' + resp.message);
                            });
                        }

                        function changePassword(e) {
                            e.preventDefault();
                            $('.error').text('');
                            var url = "<?php echo url('/service-provider'); ?>";
                            url += '/change-password';
                            var data = $('#change-password-form').serialize();
                            var xhr = submitFormAjax(url, data);
                            xhr.done(function(response) {
                                resetForm($('#change-password-form'));
                                $('#new-password-modal').modal('hide');
                                $('#pd-change-success').removeClass('hide').addClass('show');
                            }).fail(function(reason) {
                                var resp = reason.responseJSON;
                                for (var i in resp.message) {
                                    console.log(i);
                                    $('#' + i + '-err').show().text('* ' + resp.message[i][0]);
                                }
                            });
                        }
                    </script>