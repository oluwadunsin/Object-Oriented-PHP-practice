<?php require_once('header.php'); ?>
<script>
    window.onload = function(){
        if(window.location.href.indexOf('#password-edit') != -1) {
            $('#password-edit').modal('show');
        }
    }
</script>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><a class="back-to" href="profile.php"><em class="icon ni ni-arrow-left"></em><span>My Profile</span></a></div>
                                    <h2 class="nk-block-title fw-normal">Account Setting</h2>
                                    <div class="nk-block-des">
                                        <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info"></em></span></p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <ul class="nk-nav nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">Personal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-setting.php">Security<span class="d-none s-sm-inline"> Setting</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-deposits.php">Deposits</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-withdrawal.php">Withdrawals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-referral.php">Referrals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-login.php">Logins</a>
                                </li>
                            </ul><!-- .nav-tabs -->
                            <div class="nk-block">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Security Settings</h5>
                                        <div class="nk-block-des">
                                            <p>These settings are helps you keep your account secure.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="card card-bordered">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="nk-block-text">
                                                    <h6>Save my Activity Logs</h6>
                                                    <p>You can save your all activity logs including unusual activity detected.</p>
                                                </div>
                                                <div class="nk-block-actions">
                                                    <ul class="align-center gx-3">
                                                        <li class="order-md-last">
                                                            <div class="custom-control custom-switch mr-n2">
                                                                <input type="checkbox" class="custom-control-input" checked="" disabled id="activity-log">
                                                                <label class="custom-control-label" for="activity-log"></label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="nk-block-text">
                                                    <h6>Change Password</h6>
                                                    <p>Set a unique password to protect your account.</p>
                                                </div>
                                                <div class="nk-block-actions flex-shrink-sm-0">
                                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                        <li class="order-md-last">
                                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#password-edit">Change Password</a>
                                                        </li>
                                                        <li>
                                                            <em class="text-soft text-date fs-12px">Last login: <span><?php echo to_date((int)$_SESSION['last_login'],"M j, Y"); ?></span></em>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                       <!--<div class="card-inner">
                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="nk-block-text">
                                                    <h6>2FA Authentication <span class="badge badge-success">Enabled</span></h6>
                                                    <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                                </div>
                                                <div class="nk-block-actions">
                                                    <a href="#" class="btn btn-primary">Disable</a>
                                                </div>
                                            </div>
                                        </div> .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <div class="nk-block-title-group">
                                            <h6 class="nk-block-title title">Recent Activity</h6>
                                            <a href="profile-login.php" class="link">See full log</a>
                                        </div>
                                        <div class="nk-block-des">
                                            <p>This information about the last login activity on your account.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
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
                                                <?php 
                                                    static $counter = 0;
                                                ?>
                                                <tr>
                                                    <td class="tb-col-os"><?php echo $loginItem->browser; ?></td>
                                                    <td class="tb-col-ip"><span class="sub-text"><?php echo $loginItem->ip; ?></span></td>
                                                    <td class="tb-col-time"><span class="sub-text"><?php echo $loginItem->time; ?></span></td>
                                                    <td class="tb-col-action"><?php echo $loginItem->location; ?></td>
                                                </tr>
                                            <?php
                                                $counter++;
                                                if($counter >= 3){
                                                    $counter=null;
                                                    unset($counter);
                                                    break;
                                                }
                                            } ?>
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
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade zoom" tabindex="-1" role="dialog" id="password-edit">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <form method="post" action="../includes/form.php">
                <?php $csrf->echoInputField(); ?>
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-sm">
                        <div class="modal-header">
                            <h6 class="modal-title">Update Password</h6>
                        </div>
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="help-block with-errors"><?php echo $form_error['password_error']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Password</label>
                                            <input type="password" name="password" class="form-control form-control-lg" value="<?php echo $form['password']; ?>" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Confirm Password</label>
                                            <input type="password" name="conf_password" class="form-control form-control-lg" value="<?php echo $form['conf_password']; ?>" placeholder="Confirm password" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="submit" name="ch_password" id="submit" class="btn btn-lg btn-primary" value="Update">
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </form>
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
<?php require_once('footer.php'); ?>