<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="manifest" href="site.webmanifest">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>asset/img/logo/logo-no-background.png">

	<!-- CSS here -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/owl.carousel.min.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/ticker-style.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/flaticon.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/slicknav.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/animate.min.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/magnific-popup.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/fontawesome-all.min.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/themify-icons.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/slick.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/nice-select.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/style.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url() . 'asset/css/demo.css' ?>">
</head>

<body>

	<!-- Preloader Start -->
	<div id="preloader-active">
		<div class="preloader d-flex align-items-center justify-content-center">
			<div class="preloader-inner position-relative">
				<div class="preloader-circle"></div>
				<div class="preloader-img pere-text">
					<img src="<?php echo base_url() ?>asset/img/logo/logo-no-background.png" alt="">
				</div>
			</div>
		</div>
	</div>
	<!-- Preloader Start -->

	<header>
		<!-- Header Start -->
		<div class="header-area">
			<div class="main-header ">
				<div class="header-top black-bg d-none d-md-block">
					<div class="container">
						<div class="col-xl-12">
							<div class="row d-flex justify-content-between align-items-center">
								<div class="header-info-left">
									<ul>
										<li><img src="<?php echo base_url() ?>asset/img/icon/header_icon1.png" alt=""><?php echo date('l') . ', ' . date('d/m/y'); ?></li>
									</ul>
								</div>
								<div class="header-info-right">
									<ul class="header-social">
										<li><a href="#"><i class="fab fa-twitter"></i></a></li>
										<li><a href="#"><i class="fab fa-instagram"></i></a></li>
										<li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header-mid d-none d-md-block">
					<div class="container">
						<div class="row d-flex align-items-center">
							<!-- Logo -->
							<div class="col-xl-3 col-lg-3 col-md-3">
								<div class="logo">
									<a href="<?php echo base_url(); ?>"><img width='200px' src="<?php echo base_url() ?>asset/img/logo/logo-no-background.png" alt=""></a>
								</div>
							</div>
							<div class="col-xl-9 col-lg-9 col-md-9">
								<div class="header-banner f-right ">
									<img src="<?php echo base_url(); ?>asset/img/hero/header_card.jpg" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header-bottom header-sticky">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-xl-10 col-lg-10 col-md-12 header-flex">
								<!-- sticky -->
								<div class="sticky-logo">
									<a href="index.html"><img src="<?php echo base_url() ?>asset/img/logo/logo.png" alt=""></a>
								</div>
								<!-- Main-menu -->
								<div class="main-menu d-none d-md-block">
									<nav>
										<ul id="navigation" class="d-inline">
											<li><a href="<?php echo base_url() ?>">Home</a></li>
											<?php
											$index = 0;
											if (isset($data['categories'])) {
												foreach ($data['categories'] as $row) {
													if ($index <= 6) { ?>
														<li><a href="<?php echo base_url() . 'category/' . $row['categorytitle'] ?>"><?php echo $row['categorytitle']; ?></a></li>
													<?php $index++;
													} else { ?>
														<ul class="d-inline">
															<li id="page"><a href="#">More</a>
																<ul class="submenu">
																	<li><a href="<?php echo base_url() . 'category/' . $row['categorytitle'] ?>"><?php echo $row['categorytitle']; ?></a></li>
																</ul>
															</li>
														</ul>
										</ul>

							<?php }
												}
											} ?>
									</nav>
								</div>
							</div>

							<div class="col-xl-2 col-lg-2 col-md-4">
								<div class="header-right-btn f-right d-none d-lg-block">

									<div class="">
										<form id="searchForm" class="d-flex flex-row">
											<input type="text" value="" placeholder="Search" id="find">

										</form>
									</div>
								</div>
							</div>

							<!-- Mobile Menu -->
							<div class="col-12">
								<div class="mobile_menu d-block d-md-none"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header End -->
	</header>
