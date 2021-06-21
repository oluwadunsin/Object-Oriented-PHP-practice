<?php require_once('header.php'); ?>
	<script>
	    window.onload = function(){
	    	let xtemp = '<?php echo $core->announcement_pub; ?>';
	        if(xtemp.length > 0) setTimeout(function(){notify();}, 2000);
	    }
	</script>
<!-- Start Slider Area -->
        <div class="intro-area">
            <div class="bg-wrapper">
            	<img src="img/background/slide-bg.png" alt="">
            </div>
			<div class="intro-content">
				<div class="slider-content">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="slide-all-text">
								    <!-- layer 1 -->
                                    <div class="layer-1 wow fadeInUp" data-wow-delay="0.3s">
                                        <h2 class="title2"><?php echo $landing->slider_title; ?></h2>
                                    </div>
                                    <!-- layer 2 -->
                                    <div class="layer-2 wow fadeInUp" data-wow-delay="0.5s">
                                        <p><?php echo $landing->slider_description; ?></p>
                                    </div>
                                    <!-- layer 3 -->
                                    <div class="layer-3 wow fadeInUp" data-wow-delay="0.7s">
                                        <a href="login.php" class="ready-btn" >Get Started</a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <!-- End Slider Area -->
        <!-- Start Count area -->
        <div class="counter-area fix bg-color area-padding-2">
            <div class="container">
                <!-- Start counter Area -->
                 <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single-fun">
                            <span class="counter-icon"><i class="flaticon-034-reward"></i></span>
                            <div class="fun-text">
                                <span class="counter"><?php echo $landing->members; ?></span>
                                <h4>All Members</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single-fun">
                            <span class="counter-icon"><i class="flaticon-016-graph"></i></span>
                            <div class="fun-text">
                                <span class="counter"><?php echo $core->site_currency.$landing->deposits; ?></span>
                                <h4>Total Deposit</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single-fun">
                            <span class="counter-icon"><i class="flaticon-043-world"></i></span>
                            <div class="fun-text"> 
                                <span class="counter"><?php echo $landing->countries; ?></span>
                                <h4>World Country</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Count area -->
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
        <!-- Start Invest area -->
        <div class="invest-area bg-color area-padding-2">
            <div class="container">
                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $investment->title; ?></h3>
                            <p><?php echo $investment->description; ?></p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="pricing-content">
                        <?php foreach ($investment->table_arr as $investmentItem) { ?>
                            <?php if(!$investmentItem->active) continue; ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="pri_table_list">
                                    <span class="base">Best sale</span>
                                    <div class="top-price-inner">
                                       <h3><?php echo $investmentItem->name; ?></h3>
                                       <div class="rates">
                                            <span class="prices"><?php echo $investmentItem->percent; ?>%</span><span class="users"> for <?php echo $investmentItem->period.' '.$investmentItem->period_name; ?></span>
                                        </div>
                                    </div>
                                    <ol class="pricing-text">
                                        <li class="check">Minimum Deposit : <?php echo $core->site_currency.$investmentItem->minimum; ?></li>
                                        <li class="check">Maximum Deposit : <?php echo $core->site_currency.$investmentItem->maximum; ?></li>
                                        <li class="check"><?php echo $investmentItem->percent; ?>% </li>
                                        <li class="check"><?php echo $investmentItem->period.' '.$investmentItem->period_name; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature1; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature2; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature3; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature4; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature5; ?> </li>
                                    </ol>
                                    <div class="price-btn blue">
                                        <a class="blue" href="user/invest.php?plan=<?php echo $investmentItem->id; ?>">Deposit</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Invest area -->
        <!-- Start Support-service Area -->
        <div class="support-service-area bg-color2 area-padding-2">
            <div class="container">
                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $landing->choose_title; ?></h3>
                            <p><?php echo $landing->choose_description; ?></p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="support-all">
                        <!-- Start About -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="support-services ">
                                <span class="top-icon"><i class="flaticon-023-management"></i></span>
                                <a class="support-images" href="#"><i class="flaticon-023-management"></i></a>
                                <div class="support-content">
                                    <h4><?php echo $landing->choose_title1; ?></h4>
                                    <p><?php echo $landing->choose_description1; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Start About -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="support-services ">
                                <span class="top-icon"><i class="flaticon-036-security"></i></span>
                                <a class="support-images" href="#"><i class="flaticon-036-security"></i></a>
                                <div class="support-content">
                                    <h4><?php echo $landing->choose_title2; ?></h4>
                                    <p><?php echo $landing->choose_description2; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="support-services ">
                               <span class="top-icon"><i class="flaticon-003-approve"></i></span>
                                <a class="support-images" href="#"><i class="flaticon-003-approve"></i></a>
                                <div class="support-content">
                                    <h4><?php echo $landing->choose_title3; ?></h4>
                                    <p><?php echo $landing->choose_description3; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="support-services">
                               <span class="top-icon"><i class="flaticon-042-wallet"></i></span>
                                <a class="support-images" href="#"><i class="flaticon-042-wallet"></i></a>
                                <div class="support-content">
                                    <h4><?php echo $landing->choose_title4; ?></h4>
                                    <p><?php echo $landing->choose_description4; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="support-services ">
                               <span class="top-icon"><i class="flaticon-032-report"></i></span>
                                <a class="support-images" href="#"><i class="flaticon-032-report"></i></a>
                                <div class="support-content">
                                    <h4><?php echo $landing->choose_title5; ?></h4>
                                    <p><?php echo $landing->choose_description5; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="support-services">
                               <span class="top-icon"><i class="flaticon-024-megaphone"></i></span>
                                <a class="support-images" href="#"><i class="flaticon-024-megaphone"></i></a>
                                <div class="support-content">
                                    <h4><?php echo $landing->choose_title6; ?></h4>
                                    <p><?php echo $landing->choose_description6; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Support-service Area -->
        <!--Start payment-history area -->
        <div class="payment-history-area bg-color fix area-padding-2">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $investment->deposits_title; ?></h3>
                            <p><?php echo $investment->deposits_description; ?></p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="deposite-content">
                            <div class="diposite-box">
                                <h3>Last deposits</h3>
                                <span><i class="flaticon-005-savings"></i></span>
                                    <div class="deposite-table">
                                        <table>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                            </tr>
                                            <?php foreach ($investment->deposit_arr as $investmentItem) { ?>
                                                <?php 
                                                    static $counter = 0;
                                                ?>
                                                <tr>
                                                    <td><img src="img/icon/m<?php echo $investmentItem->icon; ?>.png" alt=""><?php echo $investmentItem->username; ?></td>
                                                    <td><?php echo $investmentItem->time; ?></td>
                                                    <td><?php echo $core->site_currency.$investmentItem->amount; ?></td>
                                                    <td><?php echo $investmentItem->currency; ?></td>
                                                </tr>
                                            <?php
                                                $counter++;
                                                if($counter >= 5){
                                                    $counter=null;
                                                    unset($counter);
                                                    break;
                                                }
                                            } ?>
                                        </table>
                                    </div>
                            </div>
                        </div>
                        <div class="deposite-content">
                            <div class="diposite-box">
                                <h3>Last withdrawals</h3>
                                <span><i class="flaticon-042-wallet"></i></span>
                                <div class="deposite-table">
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                        </tr>
                                            <?php foreach ($investment->withdrawal_arr as $investmentItem) { ?>
                                                <?php 
                                                    static $counter = 0;
                                                ?>
                                                <tr>
                                                    <td><img src="img/icon/m<?php echo $investmentItem->icon; ?>.png" alt=""><?php echo $investmentItem->username; ?></td>
                                                    <td><?php echo $investmentItem->time; ?></td>
                                                    <td><?php echo $core->site_currency.$investmentItem->amount; ?></td>
                                                    <td><?php echo $investmentItem->currency; ?></td>
                                                </tr>
                                            <?php
                                                $counter++;
                                                if($counter >= 5){
                                                    $counter=null;
                                                    unset($counter);
                                                    break;
                                                }
                                            } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End payment-history area -->
        <!-- Start Affiliate Area -->
        <div class="work-proses fix bg-color2 area-padding-2">
			<div class="container">
			    <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $landing->referral_title; ?></h3>
                            <p><?php echo $landing->referral_description; ?></p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="work-proses-inner text-center">
							    <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-proses">
                                        <div class="proses-content">
                                            <div class="proses-icon point-orange">
                                                <span class="point-view">01</span>
                                                <a href="#"><i class="ti-briefcase"></i></a>
                                            </div>
                                            <div class="proses-text">
                                                <h4><?php echo $landing->referral_level1; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End column -->
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-proses">
                                        <div class="proses-content">
                                            <div class="proses-icon point-blue">
                                               <span class="point-view">02</span>
                                                <a href="#"><i class="ti-layers"></i></a>
                                            </div>
                                            <div class="proses-text">
                                                <h4><?php echo $landing->referral_level2; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End column -->
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-proses last-item">
                                        <div class="proses-content">
                                            <div class="proses-icon point-green">
                                               <span class="point-view">03</span>
                                                <a href="#"><i class="ti-bar-chart-alt"></i></a>
                                            </div>
                                            <div class="proses-text">
                                                <h4><?php echo $landing->referral_level3; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End column -->
							</div>
						</div>
                    </div>
				</div>
			</div>
		</div>
        <!-- End Affiliate Area -->
        <!-- Start Overview Area -->
        <div class="overview-area bg-color fix area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="overview-content">
                            <div class="overview-images">
                                <img src="img/about/ab2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="overview-text">
                            <h3><?php echo $landing->footer_about_title; ?></h3>
						    <p><?php echo $landing->footer_about_description; ?></p>
                            <ul>
                               <li><a href="#"><?php echo $landing->footer_about_point1; ?></a></li>
                                <li><a href="#"><?php echo $landing->footer_about_point2; ?></a></li>
                                <li><a href="#"><?php echo $landing->footer_about_point3; ?></a></li>
                            </ul>
                            <a class="overview-btn" href="register.php">Signup today</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Overview Area -->
        <!-- Start Subscribe area -->
        <div class="payments-area bg-color fix area-padding">
            <div class="container">
                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $landing->paymentgateways_title; ?></h3>
                            <p><?php echo $landing->paymentgateways_description; ?></p>
						</div>
					</div>
				</div>
                <!-- Start counter Area -->
                 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card-list payment-carousel">
                            <div class="single-card">
                                <a href="#"><img src="img/brand/1.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/2.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/3.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/4.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/5.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/6.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/7.png" alt=""></a>
                            </div>
                            <div class="single-card">
                                <a href="#"><img src="img/brand/8.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Subscribe area -->
        <?php require_once('footer.php'); ?>