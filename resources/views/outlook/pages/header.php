<?php
use App\Darbandi;
    global $scrptForFooter;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo csrf_token();?>">
  <title>OAS-Office Automation System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo asset('assets/bootstrap/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo asset('css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo asset('css/skins/_all-skins.min.css');?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo asset('assets/plugins/datepicker/datepicker3.css');?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo asset('assets/plugins/daterangepicker/daterangepicker.css');?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
  <link rel="stylesheet" href="<?php echo asset('css/style.css');?>">
  <link rel="stylesheet" href="<?php echo asset('css/jquery.toast.min.css');?>">
  <link rel="stylesheet" href="<?php echo asset('js/tinymce/skins/lightgray/skin.min.css');?>">
  <link rel="stylesheet" href="<?php echo asset('dm-uploader/css/jquery.dm-uploader.min.css');?>">
  <link rel="stylesheet" href="<?php echo asset('css/nepali-date-picker.css');?>">
  <link rel="stylesheet" href="<?php echo asset('css/bootstrap-treeview.min.css');?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo asset('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
  <script src="<?php echo asset('js/scripts.js'); ?>" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo asset('js/tinymce/tinymce.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/nepali-date-picker.js');?>"></script>
   <script type="text/javascript" src="<?php echo asset('js/bootstrap-treeview.min.js');?>"></script>


  <script type="text/javascript">
      //some essential global variables
      var baseUrl = "<?php echo url('/');?>";
      var gLoader = "loader-animation";
      var mainContainer="main-body";
      var langCode = '<?php echo lang_code();?>';
      var genLabels = {};
      <?php if((!empty(session('usertype')) && session('usertype') == 'admin')):
          $orgid = (new Darbandi())->getOrgId();
        ?>
        var org = '<?php echo $orgid;?>'; 
      <?php else:
        $drb = new Darbandi();
        $dtls = $drb->getGeneralInfo(session('darbandiid'));
          ?>
        var org = '<?php echo $dtls->orgid;?>';
        var section = '<?php echo $dtls->officeid;?>';
        var darbandi = '<?php echo $dtls->darbandiid;?>';
      <?php endif;?>
          
      function t_field(field){
          return field+langCode;
      }
      
      function t_label(label){
          if(genLabels.hasOwnProperty(label)){
              return genLabels[label];
          }else{
              return label;
          }
      }
        $('.user.user-menu .dropdown-menu .user-header').click(function (event) {
            event.stopPropagation();
        });
  </script>
  <style>
      .navbar-nav>.user-menu>.dropdown-menu>li.user-header:hover {
    background: #3c8dbc;
}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo url('/');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>OAS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="./images/nepal-gov.png" style="margin-right:10px" width="50px"><b>OAS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div id="top-static-menu"class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu width">
            <a href="#" id="test" >
              <i class="fa fa-th"></i>
              
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu width">
              <a href="#" id="bell" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              
            </a>
           
          </li>
          <li class="width">
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu width">
              <a href="#" id="help" >
              <i class="fa fa-question"></i>
             
            </a>
            
          </li>
          <?php if(!empty(session('usertype'))):?>
          <?php $cu = (new \App\Auth())->getSystemUser(session('userid'));?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height:50px;">
                <?php echo $cu->name;?>
            </a>
          
            <ul class="dropdown-menu">
              <li class="user-header">
              <p>
                  <?php echo $cu->name;?>
               </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-default btn-flat" onclick="logout(event)">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <?php else:?>
          <?php $cu = (new \App\Auth())->getUser(session('darbandiid'));?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height:50px;">
                <?php echo $cu->{t_field('firstname')};?> <?php echo $cu->{t_field('lastname')};?>
             
            </a>
          
            <ul class="dropdown-menu">
              <li class="user-header">
                <p>
                  <?php echo $cu->{t_field('firstname')};?> <?php echo $cu->{t_field('lastname')};?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-default btn-flat" onclick="logout(event)">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <?php endif;?>
        </ul>
      </div>
    </nav>
  </header>
   <div class="col-md-12 body-header">
        <div id="" class=" "><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</div>
    </div>