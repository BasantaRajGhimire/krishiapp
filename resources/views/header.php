<?php 
include(resource_path().'/views/header-file.blade.php');
?>

  <script type="text/javascript">
      //some essential global variables
      var baseUrl = "<?php echo url('/');?>";
      var gLoader = "loader-animation";
      var mainContainer="main-body";
        $('.user.user-menu .dropdown-menu .user-header').click(function (event) {
            event.stopPropagation();
        });
  </script>
  <style>
      .navbar-nav>.user-menu>.dropdown-menu>li.user-header:hover {
    background: #3c8dbc;
}
span.en{
    font-size: 14px !important;
}
div.dropdown li a{
    font-size:13px;
    color:#000;
}
div a#dropdownMenuLink{
    height:25px !important;
}
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo url('/');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>BS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="<?php echo url('/').'/images/building.jpg'; ?>" width="45px" height="40px"> <b>Bidding</b>System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div id="top-static-menu"class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php $cu = (new \App\Auth())->getSystemUser(session('userid'));
          ?>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height:50px;">
                <?php echo $cu->name;?>
            </a>
          
            <ul class="dropdown-menu">
              <li class="user-header d-flex align-items-center">
                  <div class="no-padding">
                      <div class="head-user-name-style">
                        A
                      </div>                      
                  </div>
                  <div class="pl-3">
                      <div class="user-info-head">
                          <div class="head-title-name">
                             <?php echo $cu->name;?>
                          </div>
                          <div class="head-sub-name">
                              Administrator
                          </div>
                      </div>
                  </div>
               
              </li>
              <li class="user-footer d-flex align-items-center justify-contents-between">
                <div class="">
                  <a href="javascript:loadPage('<?php echo url('/').'/auth/profile';?>','main-body')" class="btn btn-warning btn-flat">Profile</a>
                </div>
                <div class="">
                    <a href="javascript:void(0)" class="btn btn-warning btn-flat" onclick="logout(event)">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
