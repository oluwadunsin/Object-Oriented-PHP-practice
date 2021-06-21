<?php require_once('header.php'); ?>

        <!-- Start Slider Area -->
        <div class="login-area area-padding fix">
            <div class="login-overlay"></div>
            <div class="table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">
                                <div class="login-form signup-form">
                                    <h4 class="login-title text-center">RESET PASSWORD</h4>
                                    <div class="row">
                                        <form id="contactForm" method="POST" action="includes/form.php" class="log-form">
                                            <?php $csrf->echoInputField(); ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="help-block with-errors"><?php echo $form_error['reset_error']; ?></div>
                                                <div class="help-block with-success"><?php echo $form['success']; ?></div>
                                            </div>
                                            <?php if(($form['success']==null) && (empty($form_error['reset_error']) )){ ?>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="password" name="password" value="<?php echo $form['password']; ?>" id="msg_subject" class="form-control" placeholder="Password" required data-error="Please enter your password">
                                                    <div class="help-block with-errors"><?php echo $form_error['password_error']; ?></div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="password" name="conf_password" value="<?php echo $form['conf_password']; ?>" id="cmsg_subject" class="form-control" placeholder="Confirm Password" required data-error="Please enter your password">
                                                    <div class="help-block with-errors"><?php echo $form_error['password_error']; ?></div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="hidden" name="uid" value="<?php echo get('u'); ?>">
                                                    <input type="hidden" name="token" value="<?php echo get('t'); ?>">
                                                </div>
                                                <?php if($core->captcha_enabled){ ?>
                                                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                                                            <div class="g-recaptcha" data-sitekey="<?php echo $core->captcha_key; ?>" style="display: inline-block;"></div>
                                                        </div>
                                                <?php } ?>
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <input type="submit" name="reset" id="submit" class="slide-btn login-btn" value="reset">
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <div class="clear"></div>
                                                    <div class="sign-icon">
                                                        <div class="acc-not">have an account?  <a href="login.php">Login</a></div>
                                                    </div>
                                                </div>
                                            <?php } ?>
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