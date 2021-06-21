<!-- Start Footer Area -->
        <footer class="footer1">
            <div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="footer-content logo-footer">
                                <div class="footer-head" style="margin-top:-40px;">
                                    <div class="footer-logo" style="margin-bottom:-30px;">
                                    	<a class="footer-black-logo" href="index.php"><img src="img/logo/logo.png" alt="" width="200px"></a>
                                    </div>
                                    <p> <?php echo $landing->subscribe; ?></p>
                                    <div class="subs-feilds">
                                        <div class="suscribe-input">
                                            <form action="includes/form.php" method="post">
                                            <?php $csrf->echoInputField(); ?>
                                                <input type="email" value="<?php echo $form['sub_email']; ?>" name="sub-email" class="email form-control width-80" id="sus_email" placeholder="Type Email" required>
                                                <div class="help-block with-errors"><?php echo $form_error['sub_email_error']; ?></div>
                                                <button type="submit" id="sus_submit" class="add-btn">Subscribe</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end single footer -->
                        <div class="col-md-4 col-sm-3 col-xs-12">
                            <div class="footer-content">
                                <div class="footer-head">
                                    <h4>Services Link</h4>
                                    <ul class="footer-list">
                                        <li><a href="about.php">About us</a></li>
                                        <li><a href="faq.php">Faq</a></li>
                                        <li><a href="investment.php">Investment</a></li>
                                    </ul>
                                    <ul class="footer-list hidden-sm">
                                        <li><a href="privacy.php">Privacy</a></li>
                                        <li><a href="terms.php">Terms & Condition</a></li>
                                        <li><a href="contact.php">Contact us </a></li>
									</ul>
                                </div>
                            </div>
                        </div>
                        <!-- end single footer -->
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="footer-content last-content">
                                <div class="footer-head">
                                    <h4>Information</h4> 
                                    <div class="footer-contacts">
										<p><span>Tel :</span> <?php echo $core->contact_mail; ?></p>
										<p><span>Email :</span> <?php echo $core->contact_phone; ?></p>
										<p><span>Location :</span> <?php echo $core->contact_address; ?></p>
									</div> 
                                    <div class="footer-icons">
                                        <ul>
                                            <li>
                                                <a href="<?php echo $core->contact_facebook; ?>">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $core->contact_twitter; ?>">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $core->contact_whatsapp; ?>">
                                                    <i class="fa fa-whatsapp"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $core->contact_instagram; ?>">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="copyright">
                                <p>
                                    Copyright © <?php echo date("Y"); ?>
                                    <a href="#"><?php echo $core->name; ?></a> All Rights Reserved
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer area -->
		
		<!-- all js here -->

		<!-- jquery latest version -->
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
		<!-- bootstrap js -->
		<script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
		<script src="js/owl.carousel.min.js"></script>
		<!-- magnific js -->
        <script src="js/magnific.min.js"></script>
        <!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- Form validator js -->
		<script src="js/form-validator.min.js"></script>
		<!-- plugins js -->
		<script src="js/plugins.js"></script>
		<!-- main js -->
		<script src="js/main.js"></script>
        <!-- sweet alert -->        <script>
            let notifMessage = '<?php echo $core->announcement_pub; ?>';
            function notify(){
                Swal.fire({
                      position: 'top-end',
                      icon: 'info',
                      html: notifMessage,
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                });
            }
        </script>
        <?php 
           echo $core->before_body; 
           clean_form();
        ?> 
	</body>
</html>