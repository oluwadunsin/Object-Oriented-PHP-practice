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
                                    <h4 class="login-title text-center">LOGIN</h4>
                                    <div class="row">
                                        <form id="contactForm" method="POST" action="includes/form.php" class="log-form">
                                            <?php $csrf->echoInputField(); ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                        		<div class="help-block with-errors"><?php echo $form_error['login_error']; ?></div>
                                                <input type="text" value="<?php echo $form['username']; ?>" id="name" name="username" class="form-control" placeholder="Username" required data-error="Please enter your username">
                                        		<div class="help-block with-errors"><?php echo $form_error['name_error']; ?></div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="password" value="<?php echo $form['password']; ?>" name="password" id="msg_subject" class="form-control" placeholder="Password" required data-error="Please enter your password">
                                        		<div class="help-block with-errors"><?php echo $form_error['password_error']; ?></div>
                                            </div>
											<?php if($core->captcha_enabled){ ?>
													<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
														<div class="g-recaptcha" data-sitekey="<?php echo $core->captcha_key; ?>" style="display: inline-block;"></div>
													</div>
											<?php } ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="check-group flexbox">
                                                    <label class="check-box">
                                                        <input type="checkbox" name="remember" class="check-box-input" checked>
                                                        <span class="remember-text">Remember me</span>
                                                    </label>

                                                    <a class="text-muted" href="forgot.php">Forgot password?</a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <input type="submit" name="login" id="submit" class="slide-btn login-btn" value="login">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="clear"></div>
                                                <div class="sign-icon">
                                                    <div class="acc-not">Don't have an account?  <a href="register.php">Sign up</a></div>
                                                </div> 
                                            </div> 
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