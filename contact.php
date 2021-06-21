<?php require_once('header.php'); ?>
         <!-- Start Bottom Header -->
        <div class="page-area">
            <div class="breadcumb-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcrumb text-center">
                            <div class="section-headline">
                                <h2>Contact us </h2>
                            </div>
                            <ul>
                                <li class="home-bread">Home</li>
                                <li>Contact us </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header -->
        <!-- Start contact Area -->
        <div class="contact-page bg-color area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="contact-details">
                            <div class="contact-icon">
                                <div class="single-contact">
                                    <h5>Our Office</h5>
                                    <a href="mailto:<?php echo $core->contact_mail; ?>"><i class="fa fa-envelope"></i> <?php echo $core->contact_mail; ?></a>
                                    <a href="tel:<?php echo $core->contact_phone; ?>"><i class="fa fa-phone"></i> <?php echo $core->contact_phone; ?></a>
                                    <a href="#"><i class="fa fa-map"></i><span><?php echo $core->contact_address; ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End contact icon -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="contact-form">
                            <div class="row">
                                <form id="contactForm" method="POST" action="includes/form.php" class="contact-form">
                                    <?php $csrf->echoInputField(); ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="help-block with-errors"><?php echo $form_error['contact_error']; ?></div>
                                        <div class="help-block with-success"><?php echo $form['success']; ?></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?php echo $form['name']; ?>" name="name" id="name" class="form-control" placeholder="Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"><?php echo $form_error['name_error']; ?></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" value="<?php echo $form['email']; ?>" class="email form-control" name="email"  id="email" placeholder="Email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"><?php echo $form_error['email_error']; ?></div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" value="<?php echo $form['subject']; ?>" name="subject" id="msg_subject" class="form-control" placeholder="Subject" required data-error="Please enter your message subject">
                                        <div class="help-block with-errors"><?php echo $form_error['subject_error']; ?></div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea id="message" name="message" rows="7" placeholder="Message" class="form-control" required data-error="Write your message"><?php echo $form['message']; ?></textarea>
                                        <div class="help-block with-errors"><?php echo $form_error['message_error']; ?></div>
                                    </div>
									<?php if($core->captcha_enabled){ ?>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="g-recaptcha" data-sitekey="<?php echo $core->captcha_key; ?>" style="display: inline-block;"></div>
											</div>
									<?php } ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <input type="submit" class="contact-btn" name="contact">
                                    </div>   
                                </form>  
                            </div>
                        </div>
                    </div>
                    <!-- End contact Form -->
                </div>
            </div>
        </div>
        <!-- End Contact Area -->
        <!-- End Subscribe area -->
        <?php require_once('footer.php'); ?>