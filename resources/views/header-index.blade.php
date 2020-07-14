<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Required meta tags -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo url('css/main.css'); ?>">
  <link rel="stylesheet" href="<?php echo url('css/abc.css'); ?>">
  <title>eThekka</title>
  <link rel="stylesheet" href="<?php echo url('css/tageditor.css'); ?>">
  <link rel="stylesheet" href="<?php echo url('css/jquery.toast.min.css'); ?>">
  <script src="<?php echo asset('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
  <link rel="icon" href="<?php echo asset('images/e4.png');?>" type="image/x-icon">

   <!-- OwlCarousel2 -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha256-qvCL5q5O0hEpOm1CgOLQUuHzMusAZqDcAZL9ijqfOdI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha256-nXBV7Gr2lU0t+AwKsnS05DYtzZ81oYTXS6kj7LBQHfM=" crossorigin="anonymous" />
    
  <script type="text/javascript">
    //some essential global variables
    var baseUrl = "<?php echo url('/'); ?>";
    var gLoader = "loader-animation";
    var mainContainer = "main-body";
  </script>
</head>
<?php
$pageDom = new DomDocument();
?>

<body>
  <span id="totop"> <i class="fas fa-chevron-up fa-lg text-white"></i> </span>
  <div class="container p-0">
    <nav class="main-nav navbar navbar-expand-lg navbar-light bg-light bg-white sticky-top" style="box-shadow: 0 0px 2px rgba(0,0,0,0.25), 0 2px 2px rgba(0,0,0,0.22);z-index:2;">
      <!-- <span> <i class="fas fa-bars fa-lg"></i> </span> -->
      <a class="navbar-brand ml-auto mr-auto" href="#"><img src="<?php echo asset('images/e1.png');?>" class="img-fluid" style=" height: 50px !important; width: auto;" alt="" srcset=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border: 0px;">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <i class="fas fa-ellipsis-v text-dark "></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link nav-line" href="<?php echo url('/'); ?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-line" href="<?php echo url('/aboutus'); ?>">About Us</a>
          </li>
          <?php
          if (!empty(session('cuserid')) || !empty(session('suserid')) || !empty(session('userid'))) {
            $user = (!empty(session('cuserid')) ? 'client' : (!empty(session('suserid')) ? 'service-provider' : 'admin'));
            ?>
            <li class="nav-item pt-1">
              <a class="btn btn-outline-warning rounded-0 mt-2 ml-3 m-1" href="<?php echo url('/') . '/' . $user; ?>">Go to Dashboard</a>
            </li>
          <?php
          } else {
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link nav-line dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                Sign In
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo url('client/auth'); ?>">Login as Individual</a>
                <a class="dropdown-item" href="<?php echo url('service-provider/auth'); ?>"> Login as Service Provider</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link nav-line dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-plus"></i>
                Register
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo url('client/register'); ?>">Register as Client</a>
                <a class="dropdown-item" href="<?php echo url('service-provider/register'); ?>"> Register as Service Provider</a>
                <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div> -->
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </nav>
  </div>