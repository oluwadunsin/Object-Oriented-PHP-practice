<?php require_once('header.php'); ?>
         <!-- Start Bottom Header -->
        <div class="page-area">
            <div class="breadcumb-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcrumb text-center">
                            <div class="section-headline">
                                <h2>Important FAQ</h2>
                            </div>
                            <ul>
                                <li class="home-bread">Home</li>
                                <li>FAQ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header -->
                <!-- Start FAQ area -->
        <div class="faq-area bg-color2 area-padding">
            <div class="container">
                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $faq->title; ?></h3>
                            <p><?php echo $faq->description; ?></p>
						</div>
					</div>
				</div>
                <div class="row">
                    <!-- Start Column Start -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="company-faq left-faq">
                            <div class="faq-full">
								<div class="faq-details">
									<div class="panel-group" id="accordion">
										<?php $cnt=1; ?>
                        				<?php foreach ($faq->faqs1 as $faqItemKey=>$faqItemValue) { ?>
											<!-- Panel Default -->
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="check-title">
														<a data-toggle="collapse" class="active collapsed" data-parent="#accordion" href="#check<?php echo $cnt; ?>">
															<span class="acc-icons"></span><?php echo $faqItemValue->question; ?>
														</a>
													</h4>
												</div>
												<div id="check<?php echo $cnt; ?>" class="panel-collapse collapse in">
													<div class="panel-body">
														<p>
															<?php echo $faqItemValue->answer; ?> 
														</p>		
													</div>
												</div>
											</div>
											<!-- End Panel Default -->
											<?php $cnt++; ?>	
                        				<?php } ?>								
									</div>
								</div>
								<!-- End FAQ -->
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="company-faq right-faq">
                            <div class="faq-full">
								<div class="faq-details">
									<div class="panel-group" id="accordion1">
                        				<?php foreach ($faq->faqs2 as $faqItemKey=>$faqItemValue) { ?>
											<!-- Panel Default -->
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="check-title">
														<a data-toggle="collapse" class="active collapsed" data-parent="#accordion1" aria-expanded="false" href="#check<?php echo $cnt; ?>">
															<span class="acc-icons"></span><?php echo $faqItemValue->question; ?>
														</a>
													</h4>
												</div>
												<div id="check<?php echo $cnt; ?>" class="panel-collapse collapse in">
													<div class="panel-body">
														<p>
															<?php echo $faqItemValue->answer; ?> 
														</p>		
													</div>
												</div>
											</div>
											<!-- End Panel Default -->	
											<?php $cnt++; ?>
                        				<?php } ?>									
									</div>
								</div>
								<!-- End FAQ -->
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End FAQ area -->
<?php require_once('footer.php'); ?>