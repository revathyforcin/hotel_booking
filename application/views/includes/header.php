<?php
if(!$this->session->userdata('id'))
{
	?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from preview.colorlib.com/theme/sona/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Feb 2021 08:23:06 GMT -->
<head>
<meta charset="UTF-8">
<meta name="description" content="Sona Template">
<meta name="keywords" content="Sona, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Sona | Template</title>

<link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/flaticon.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/nice-select.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/magnific-popup.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/style.css" type="text/css">
</head>
<body>

<!-- <div id="preloder">
<div class="loader"></div>
</div> -->

<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
<i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
<div class="canvas-close">
<i class="icon_close"></i>
</div>
<div class="search-icon  search-switch">
<i class="icon_search"></i>
</div>
<div class="header-configure-area">
<div class="language-option">
<img src="<?php echo STYLE_URL; ?>img/flag.jpg" alt="">
<span>EN <i class="fa fa-angle-down"></i></span>
<div class="flag-dropdown">
<ul>
<li><a href="#">Zi</a></li>
<li><a href="#">Fr</a></li>
</ul>
</div>
</div>
<a href="<?=base_url('register_now')?>" class="bk-btn">Booking Now</a>
</div>
<nav class="mainmenu mobile-menu">
<ul>
<li class="active"><a href="index-2.html">Home</a></li>
<li><a href="rooms.html">Rooms</a></li>
<li><a href="about-us.html">About Us</a></li>
<li><a href="pages.html">Pages</a> 
<ul class="dropdown">
<li><a href="room-details.html">Room Details</a></li>
<li><a href="#">Deluxe Room</a></li>
<li><a href="#">Family Room</a></li>
<li><a href="#">Premium Room</a></li>
</ul>
</li>
<li><a href="blog.html">News</a></li>
<li><a href="contact.html">Contact</a></li>
</ul>
</nav>
<div id="mobile-menu-wrap"></div>
<div class="top-social">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-tripadvisor"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
</div>
<ul class="top-widget">
<li><i class="fa fa-phone"></i> (12) 345 67890</li>
<li><i class="fa fa-envelope"></i> <a href="https://preview.colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f29b9c949ddc919d9e9d809e9b90b2959f939b9edc919d9f">example@gmail.com</a></li>
</ul>
</div>


<header class="header-section">
<div class="top-nav">
<div class="container">
<div class="row">
<div class="col-lg-6">
<ul class="tn-left">
<li><i class="fa fa-phone"></i> (12) 345 67890</li>
<li><i class="fa fa-envelope"></i> <a href="https://preview.colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="86efe8e0e9a8e5e9eae9f4eaefe4c6e1ebe7efeaa8e5e9eb">example@gmail.com</a></li>
</ul>
</div>
<div class="col-lg-6">
<div class="tn-right">
<div class="top-social">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-tripadvisor"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
</div>
<a href="<?=base_url('book_now')?>" class="bk-btn">Book Now</a>
<div class="language-option">
	<a href="<?=base_url('register_now')?>" class="btn btn-warning">Register</a>
	<a href="<?=base_url('login')?>" class="btn btn-info">Login</a>
<!-- <img src="<?php echo STYLE_URL; ?>img/flag.jpg" alt="">
<span>EN <i class="fa fa-angle-down"></i></span> -->
<!-- <div class="flag-dropdown">
<ul>
<li><a href="#">Zi</a></li>
<li><a href="#">Fr</a></li>
</ul> -->
</div>
</div> 
</div>
</div>
</div>
</div>
</div>
<div class="menu-item">
<div class="container">
<div class="row">
<div class="col-lg-2">
<div class="logo">
<a href="<?=base_url()?>">
<img src="<?php echo STYLE_URL; ?>img/logo.png" alt="">
</a>
</div>
</div>
<div class="col-lg-10">
<div class="nav-menu">
<nav class="mainmenu">
<ul>
<li class="active"><a href="index-2.html">Home</a></li>
<li><a href="rooms.html">Rooms</a></li>
<li><a href="about-us.html">About Us</a></li>
<li><a href="pages.html">Pages</a>
<ul class="dropdown">
<li><a href="room-details.html">Room Details</a></li>
<li><a href="blog-details.html">Blog Details</a></li>
<li><a href="#">Family Room</a></li>
<li><a href="#">Premium Room</a></li>
</ul>
</li>
<li><a href="blog.html">News</a></li>
<li><a href="contact.html">Contact</a></li>
</ul>
</nav>
<div class="nav-right search-switch">
<i class="icon_search"></i>
</div>
</div>
</div>
</div>
</div>
</div>
</header>
<?php 
}
else
{ ?>
<?php
$profile = getProfilePic($this->session->userdata('id'));
?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from preview.colorlib.com/theme/sona/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Feb 2021 08:23:06 GMT -->
<head>
<meta charset="UTF-8">
<meta name="description" content="Sona Template">
<meta name="keywords" content="Sona, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Sona | Template</title>

<link href="https://fonts.googleapis.com/css?family=Lora:400,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/flaticon.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/nice-select.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/magnific-popup.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo STYLE_URL; ?>css/style.css" type="text/css">
</head>
<body>

<!-- <div id="preloder">
<div class="loader"></div>
</div> -->

<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
<i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
<div class="canvas-close">
<i class="icon_close"></i>
</div>
<div class="search-icon  search-switch">
<i class="icon_search"></i>
</div>
<div class="header-configure-area">
<div class="language-option">
<img src="<?php echo STYLE_URL; ?>img/flag.jpg" alt="">
<span>EN <i class="fa fa-angle-down"></i></span>
<div class="flag-dropdown">
<ul>
<li><a href="#">Zi</a></li>
<li><a href="#">Fr</a></li>
</ul>
</div>
</div>
<a href="<?=base_url('register_now')?>" class="bk-btn">Booking Now</a>
</div>
<nav class="mainmenu mobile-menu">
<ul>
<li class="active"><a href="index-2.html">Home</a></li>
<li><a href="rooms.html">Rooms</a></li>
<li><a href="about-us.html">About Us</a></li>
<li><a href="pages.html">Pages</a> 
<ul class="dropdown">
<li><a href="room-details.html">Room Details</a></li>
<li><a href="#">Deluxe Room</a></li>
<li><a href="#">Family Room</a></li>
<li><a href="#">Premium Room</a></li>
</ul>
</li>
<li><a href="blog.html">News</a></li>
<li><a href="contact.html">Contact</a></li>
</ul>
</nav>
<div id="mobile-menu-wrap"></div>
<div class="top-social">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-tripadvisor"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
</div>
<ul class="top-widget">
<li><i class="fa fa-phone"></i> (12) 345 67890</li>
<li><i class="fa fa-envelope"></i> <a href="https://preview.colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f29b9c949ddc919d9e9d809e9b90b2959f939b9edc919d9f">[email&#160;protected]</a></li>
</ul>
</div>


<header class="header-section">
<div class="top-nav">
<div class="container">
<div class="row">
<div class="col-lg-6">
<ul class="tn-left">
<li><i class="fa fa-phone"></i> (12) 345 67890</li>
<li><i class="fa fa-envelope"></i> <a href="https://preview.colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="86efe8e0e9a8e5e9eae9f4eaefe4c6e1ebe7efeaa8e5e9eb">example@gmail.com</a></li>
</ul>
</div>
<div class="col-lg-6">
<div class="tn-right">
<div class="top-social">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-tripadvisor"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
</div>
<a href="<?=base_url('book_now')?>" class="bk-btn">Book Now</a>
<div class="language-option">
<img src="<?php echo base_url().$profile; ?>" alt="">
<span><?=$this->session->userdata('uacc_name')?> <i class="fa fa-angle-down"></i></span>
<div class="flag-dropdown">
<ul>
<li><a href="<?=base_url('profile')?>">Profile</a></li>
<li><a href="<?=base_url('Auth/logout')?>">Logout</a></li>
</ul>
</div>
</div> 
</div>
</div>
</div>
</div>
</div>
<div class="menu-item">
<div class="container">
<div class="row">
<div class="col-lg-2">
<div class="logo">
<a href="<?=base_url()?>">
<img src="<?php echo STYLE_URL; ?>img/logo.png" alt="">
</a>
</div>
</div>
<div class="col-lg-10">
<div class="nav-menu">
<nav class="mainmenu">
<ul>
<li class="active"><a href="index-2.html">Home</a></li>
<li><a href="rooms.html">Rooms</a></li>
<li><a href="about-us.html">About Us</a></li>
<li><a href="pages.html">Pages</a>
<ul class="dropdown">
<li><a href="room-details.html">Room Details</a></li>
<li><a href="blog-details.html">Blog Details</a></li>
<li><a href="#">Family Room</a></li>
<li><a href="#">Premium Room</a></li>
</ul>
</li>
<li><a href="blog.html">News</a></li>
<li><a href="contact.html">Contact</a></li>
</ul>
</nav>
<div class="nav-right search-switch">
<i class="icon_search"></i>
</div>
</div>
</div>
</div>
</div>
</div>
</header>

<?php }
?>