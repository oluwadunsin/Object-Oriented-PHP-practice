<?php require_once('header.php'); ?>
         <!-- Start Bottom Header -->
        <div class="page-area">
            <div class="breadcumb-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcrumb text-center">
                            <div class="section-headline">
                                <h2>About Us</h2>
                            </div>
                            <ul>
                                <li class="home-bread">Home</li>
                                <li>About us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header -->
        <!-- Start How to area -->
        <div class="how-to-area bg-color area-padding">
            <div class="container">
                <div class="row">
                    <div class="all-services">
                        <!-- single-well end-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="well-services first-item">
                                <div class="well-img">
                                    <a class="big-icon" href="#"><i class="flaticon-034-reward"></i></a>
                                </div>
                                <div class="main-wel">
                                    <div class="wel-content">
                                        <h4><?php echo $about->step1; ?></h4>
                                        <p><?php echo $about->step1_description; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="well-services ">
                                <div class="well-img">
                                    <a class="big-icon" href="#"><i class="flaticon-042-wallet"></i></a>
                                </div>
                                <div class="main-wel">
                                    <div class="wel-content">
                                        <h4><?php echo $about->step2; ?></h4>
                                        <p><?php echo $about->step2_description; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="well-services thired-item">
                                <div class="well-img">
                                    <a class="big-icon" href="#"><i class="flaticon-004-bar-chart"></i></a>
                                </div>
                                <div class="main-wel">
                                    <div class="wel-content">
                                        <h4><?php echo $about->step3; ?></h4>
                                        <p><?php echo $about->step3_description; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End How to area -->
        <!-- about-area start -->
        <div class="about-area bg-color2 area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="about-image">
                            <img src="img/about/ab.jpg" alt="">
                            <div class="video-content">
								<a href="<?php echo $about->youtube; ?>" class="video-play vid-zone">
									<i class="fa fa-play"></i>
								</a>
							</div>
                        </div>
                    </div>
                    <!-- column end -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="about-content">
                            <h3><?php echo $about->about_title; ?></h3>
                            <p class="hidden-sm"><?php echo $about->about_description; ?></p>
                            <div class="about-details">
                                <div class="single-about">
                                    <a href="#"><i class="flaticon-009-certificate"></i></a>
                                    <div class="icon-text">
                                        <h5><?php echo $about->sub_about_title1; ?></h5>
                                        <p><?php echo $about->sub_about_description1; ?></p>
                                    </div>
                                </div>
                                <div class="single-about">
                                    <a href="#"><i class="flaticon-032-report"></i></a>
                                    <div class="icon-text">
                                        <h5><?php echo $about->sub_about_title2; ?></h5>
                                        <p><?php echo $about->sub_about_description2; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about-area end -->
<?php require_once('footer.php'); ?>