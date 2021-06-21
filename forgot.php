<?php require_once('header.php'); ?>

        <!-- Start Slider Area -->
        <div class="login-area area-padding fix">
            <div class="login-overlay"></div>
            <div class="table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">
                                <div class="login-form">
                                    <h4 class="login-title text-center">FORGOT PASSWORD</h4>
                                    <div class="row">
                                        <form id="contactForm" method="POST" action="includes/form.php" class="log-form">
                                            <?php $csrf->echoInputField(); ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                        		<div class="help-block with-errors"><?php echo $form_error['forgot_error']; ?></div>
                                                <div class="help-block with-success"><?php echo $form['success']; ?></div>
                                            </div>
                                            <?php if($form['success'] == null){ ?>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="email" id="email" value="<?php echo $form['email']; ?>" name="email" class="form-control" placeholder="Email" required data-error="Please enter your Email">
                                                        <div class="help-block with-errors"><?php echo $form_error['email_error']; ?></div>
                                                    </div>
                                                    <?php if($core->captcha_enabled){ ?>
                                                            <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                                                                <div class="g-recaptcha" data-sitekey="<?php echo $core->captcha_key; ?>" style="display: inline-block;"></div>
                                                            </div>
                                                    <?php }?>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <input type="submit" name="forgot" id="submit" class="slide-btn login-btn" value="Reset">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <div class="clear"></div>
                                                        <div class="sign-icon">
                                                            <div class="acc-not">Don't have an account?  <a href="register.php">Sign up</a></div>
                                                        </div> 
                                                    </div> 
                                            <?php }?>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- End Slider Area -->
<?php require_once('footer.php'); ?>