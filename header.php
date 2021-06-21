<?php
  define("_AXES_ALLOWED", true);
  require_once("includes/init.php");
?>

<!doctype html>
<html class="no-js" lang="en">
	
<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php echo $core->title; ?></title>
		<meta name="description" content="<?php echo $core->meta_description; ?>">
        <meta name="keywords" content="<?php echo $core->meta_keywords; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->		
		<link rel="shortcut icon" type="image/x-icon" href="img/logo/favicon.ico">

		<!-- all css here -->

		<!-- bootstrap v3.3.6 css -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- owl.carousel css -->
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/owl.transitions.css">
       <!-- Animate css -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- font-awesome css -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/themify-icons.css">
		<link rel="stylesheet" href="css/flaticon.css">
		<!-- magnific css -->
        <link rel="stylesheet" href="css/magnific.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="css/style.css">
		<!-- responsive css -->
		<link rel="stylesheet" href="css/responsive.css">
        <!--google captcha-->
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>

		<!-- modernizr css -->
		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.0.0/animate.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
         <?php echo $core->before_head; ?>   
	</head>
		<body>
           <?php echo $core->after_body; ?>   

		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

        <div id="preloader"></div>
        <?php if(!check_path("/login") && !check_path("/register") && !check_path("/forgot") && !check_path("/reset") && !check_path("/maintenance") && !check_path("/activate")){ ?>
            <header class="header-one">
                <!-- Start top bar -->
                <div class="topbar-area">
                    <div class="container">
                        <div class="row">
                            <div class=" col-md-8 col-sm-8 col-xs-12">
                                <div class="topbar-left">
                                    <ul>
                                        <li><a href="mailto:<?php echo $core->contact_mail; ?>"><i class="fa fa-envelope"></i> <?php echo $core->contact_mail; ?></a></li>
                                        <li><a href="tel:<?php echo $core->contact_phone; ?>"><i class="fa fa-phone"></i> <?php echo $core->contact_phone; ?></a></li>
                                    </ul>  
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="topbar-right">
    								<ul>
                                        <li><a href="#"><img src="img/icon/w1.png" alt="">ENG</a>
                                           <ul>
                                               <li><a href="#"><img src="img/icon/w2.png" alt="">DEU</a>
                                               <li><a href="#"><img src="img/icon/w3.png" alt="">ESP</a>
                                               <li><a href="#"><img src="img/icon/w4.png" alt="">FRA</a>
                                               <li><a href="#"><img src="img/icon/w5.png" alt="">KSA</a>
                                           </ul>
                                        </li>
                                        <?php if(isset($_SESSION['user'])){ ?>
                                            <?php if(isset($_SESSION['admin'])){ ?>
                                                <li><a href="admin"><img src="img/icon/login.png" alt="">Admin</a>
                                            <?php } ?>
                                            <li><a href="logout.php"><img src="img/icon/logout.png" alt="">Logout</a>
                                        <?php }else{ ?>
                                            <li><a href="login.php"><img src="img/icon/login.png" alt="">Login</a>
                                        <?php } ?>
                                    </ul>
    							</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End top bar -->
                <!-- header-area start -->
                <div id="sticker" class="header-area hidden-xs">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="row">
                                    <!-- logo start -->
                                    <div class="col-md-3 col-sm-3">
                                        <div class="logo">
                                            <!-- Brand -->
                                            <a class="navbar-brand page-scroll" href="index.php" style="padding:0px;">
                                                <img src="img/logo/logo.png" alt="<?php echo $core->name; ?>" style="height: 150px;padding: 0px;margin-top: -25px;">
                                            </a>
                                        </div>
                                        <!-- logo end -->
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="header-right-link">
                                            <!-- search option end -->
                                            <?php if(isset($_SESSION['user'])){ ?>
                                                <a class="s-menu" href="logout.php">Logout</a>
                                            <?php }else{ ?>
                                                <a class="s-menu" href="login.php">Login</a>
                                            <?php } ?>
                                        </div>
                                        <!-- mainmenu start -->
                                        <nav class="navbar navbar-default">
                                            <div class="collapse navbar-collapse" id="navbar-example">
                                                <div class="main-menu">
                                                    <ul class="nav navbar-nav navbar-right">
                                                        <li><a href="index.php">Home</a></li>
                                                        <li><a href="about.php">About us</a></li>
                                                        <li><a href="investment.php">Investment</a></li>
                                                        <li><a href="faq.php">FAQ</a></li>
                                                        <li><a href="review.php">Reviews</a></li>
                                                        <li><a href="contact.php">Contact</a></li>
                                                        <?php if(isset($_SESSION['user'])){ ?>
                                                            <li><a href="user/index.php">Dashboard</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </nav>
                                        <!-- mainmenu end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=no" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
                <!-- header-area end -->
                <!-- mobile-menu-area start -->
                <div class="mobile-menu-area hidden-lg hidden-md hidden-sm">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mobile-menu">
                                    <div class="logo">
                                        <a href="index.php"><img src="img/logo/logo.png" alt="<?php echo $core->name; ?>" /></a>
                                    </div>
                                    <nav id="dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About us</a></li>
                                            <li><a href="investment.php">Investment</a></li>
                                            <li><a href="faq.php">FAQ</a></li>
                                            <li><a href="review.php">Reviews</a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                            <?php if(isset($_SESSION['user'])){ ?>
                                                <li><a href="user/index.php">Dashboard</a></li>
                                                <li><a href="logout.php">Logout</a></li>
                                            <?php }else{ ?>
                                                <li><a href="login.php">Login</a></li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>					
                            </div>
                        </div>
                    </div>
                </div>
                <!-- mobile-menu-area end -->	
            </header>
        <?php } ?>
        <!-- header end -->