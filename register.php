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
                                    <h4 class="login-title text-center">REGISTER</h4>
                                    <div class="row">
                                        <form id="contactForm" method="POST" action="includes/form.php" class="log-form">
                                            <?php $csrf->echoInputField(); ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="help-block with-errors"><?php echo $form_error['register_error']; ?></div>
                                                <div class="help-block with-success"><?php echo $form['success']; ?></div>
                                                <input type="text" value="<?php echo $form['username']; ?>" name="username" id="name" class="form-control" placeholder="Username" required data-error="Please enter your username">
                                                <div class="help-block with-errors"><?php echo $form_error['username_error']; ?></div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" value="<?php echo $form['firstname']; ?>" name="firstname" id="name" class="form-control" placeholder="Firstname" required data-error="Please enter your firstname">
                                                <div class="help-block with-errors"><?php echo $form_error['firstname_error']; ?></div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" value="<?php echo $form['lastname']; ?>" name="lastname" id="name" class="form-control" placeholder="Lastname" required data-error="Please enter your lastname">
                                                <div class="help-block with-errors"><?php echo $form_error['lastname_error']; ?></div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="email" value="<?php echo $form['email']; ?>" name="email" id="email" class="form-control" placeholder="Your Email" required data-error="Please enter your email">
                                                <div class="help-block with-errors"><?php echo $form_error['email_error']; ?></div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="password" value="<?php echo $form['password']; ?>" name="password" id="msg_subject" class="form-control" placeholder="Password" required data-error="Please enter your password">
                                                <div class="help-block with-errors"><?php echo $form_error['password_error']; ?></div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="password" value="<?php echo $form['conf_password']; ?>" name="conf_password" id="cmsg_subject" class="form-control" placeholder="Confirm Password" required data-error="Please enter your password">
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
                                                        <input type="hidden" name="terms[0]" value="0" />
                                                        <input type="checkbox" name="terms[0]" class="check-box-input" value="1" checked required>
                                                        <span class="remember-text"><a href="terms.php" target="_blank" >I agree terms & conditions</a></span>
                                                        <div class="help-block with-errors"><?php echo $form_error['terms_error']; ?></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <input type="submit" name="register" id="submit" class="slide-btn login-btn" value="register">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="clear"></div>
                                                <div class="sign-icon">
                                                    <div class="acc-not">have an account?  <a href="login.php">Login</a></div>
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