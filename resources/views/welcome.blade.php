<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>Aplikasi Kas</title>
<!--
App Starter Template
http://www.templatemo.com/tm-492-app-starter
-->
<link rel="stylesheet" href="welcome/css/bootstrap.min.css">
<link rel="stylesheet" href="welcome/css/animate.css">
<link rel="stylesheet" href="welcome/css/font-awesome.min.css">

<link rel="stylesheet" href="welcome/css/magnific-popup.css">

<link rel="stylesheet" href="welcome/css/owl.theme.css">
<link rel="stylesheet" href="welcome/css/owl.carousel.css">

<link href='https://fonts.googleapis.com/css?family=Unica+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700' rel='stylesheet' type='text/css'>

<!-- Main css -->
<link rel="stylesheet" href="welcome/css/style.css">

</head>
<body data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


<!-- PRE LOADER -->

<div class="preloader">
     <div class="sk-spinner sk-spinner-pulse"></div>
</div>



<!-- Navigation Section -->




<!-- Home Section -->

<section id="home" class="main">
     <div class="overlay"></div>
	<div class="container">
		<div class="row">

               <div class="wow fadeInUp col-md-6 col-sm-5 col-xs-10 col-xs-offset-1 col-sm-offset-0" data-wow-delay="0.2s">
                    <img src="welcome/images/home-img.png" class="img-responsive" alt="Home">
               </div>

               <div class="col-md-6 col-sm-7 col-xs-12">
                    <div class="home-thumb">
                         <h1 class="wow fadeInUp" data-wow-delay="0.6s">Sistem Informasi Kas Warga</h1>
                         <p class="wow fadeInUp" data-wow-delay="0.8s">Aplikasi Untuk Mencatan Dan Semua Jadi Lebih Terstrutur</p>
                            @if (Route::has('login'))
                                <div class="top-right links">
                                    @auth
                                        <a class="btn btn-info btn-sm" href="{{ url('/data-warga') }}">Home</a>
                                    @else
                                        <a class="btn btn-info btn-sm" href="{{ route('login') }}">Login</a>

                                        @if (Route::has('register'))
                                            <a class="btn btn-info btn-sm" href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                    </div>
               </div>

		</div>
	</div>
</section>



<!-- SCRIPTS -->

<script src="welcome/js/jquery.js"></script>
<script src="welcome/js/bootstrap.min.js"></script>
<script src="welcome/js/jquery.magnific-popup.min.js"></script>
<script src="welcome/js/magnific-popup-options.js"></script>
<script src="welcome/js/owl.carousel.min.js"></script>
<script src="welcome/js/smoothscroll.js"></script>
<script src="welcome/js/wow.min.js"></script>
<script src="welcome/js/custom.js"></script>

</body>
</html>