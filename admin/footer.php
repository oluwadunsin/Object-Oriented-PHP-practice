
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; <?php echo date("Y"); ?> <?php echo $core->name; ?>. </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#"><?php echo to_date((int)$core->cron,"M d, Y h:i A"); ?></a></li>
                                    <li class="nav-item"><a class="nav-link" href="../terms.php">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../privacy.php">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../faq.php">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="assets/js/bundle.js?ver=1.4.0"></script>
    <script src="assets/js/scripts.js?ver=1.4.0"></script>
    <script src="assets/js/charts/chart-invest.js?ver=1.4.0"></script>
    <script src="assets/js/charts/gd-invest.js?ver=1.4.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>    
        if(typeof window.history.pushState == 'function') {
            window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
        }
    </script>
    <?php 
        clean_form();
    ?>
</body>

</html>