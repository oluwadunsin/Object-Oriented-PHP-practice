<?php require_once('header.php'); ?>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><a class="back-to" href="profile.php"><em class="icon ni ni-arrow-left"></em><span>My Profile</span></a></div>
                                    <h2 class="nk-block-title fw-normal">Login Activity</h2>
                                    <div class="nk-block-des">
                                        <p>Here is your last 20 login activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-block-title-group mb-3">
                                    <h6 class="nk-block-title title">Activity on your account</h6>
                                    <!--<a href="#" class="link link-danger">Clear log</a>-->
                                </div>
                                <div class="card card-bordered">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="tb-col-os"><span class="overline-title">Browser</span></th>
                                                    <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                                    <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                                    <th class="tb-col-action"><span class="overline-title">Location</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($user->login_records as $loginItem) { ?>
                                                <tr>
                                                    <td class="tb-col-os"><?php echo $loginItem->browser; ?></td>
                                                    <td class="tb-col-ip"><span class="sub-text"><?php echo $loginItem->ip; ?></span></td>
                                                    <td class="tb-col-time"><span class="sub-text"><?php echo $loginItem->time; ?></span></td>
                                                    <td class="tb-col-action"><?php echo $loginItem->location; ?></td>
                                                </tr>
                                            <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
<?php require_once('footer.php'); ?>