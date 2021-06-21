<?php require_once('header.php'); ?>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
</script>
<script>
    window.onload = function(){
        let tz = jstz.determine();
        let d = new Date();
        let n = (d.getTimezoneOffset())/(-60);
        let timezone = tz.name()+' '+((n<0) ? "-"+n : "+"+n);
        document.getElementById("ytz").textContent = timezone;

        if(window.location.href.indexOf('#profile-edit') != -1) {
            $('#profile-edit').modal('show');
            if(window.location.href.indexOf('#profile-edit') != -1) document.getElementById("inity").click();
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
                                    <div class="nk-block-head-sub"><span>My Profile</span></div>
                                    <h2 class="nk-block-title fw-normal">Account Info</h2>
                                    <div class="nk-block-des">
                                        <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info"></em></span></p>
                                    </div>
                                </div>
                            </div>
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
                                        <h5 class="nk-block-title">Personal Information</h5>
                                        <div class="nk-block-des">
                                            <p>Basic info, like your name and address, that you use on <?php echo $core->name; ?> Platform.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="card card-bordered">
                                    <div class="nk-data data-list">
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Full Name</span>
                                                <span class="data-value"><?php echo ucfirst($_SESSION['user']['firstname']).' '.ucfirst($_SESSION['user']['lastname']); ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Username</span>
                                                <span class="data-value"><?php echo $_SESSION['user']['username']; ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col" data-toggle="modal" data-target="#profile-edit">
                                                <span class="data-label">Email</span>
                                                <span class="data-value"><?php echo $_SESSION['user']['email']; ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Gender</span>
                                                <span class="data-value"><?php echo ucfirst($_SESSION['user']['gender']); ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Phone Number</span>
                                                <span class="data-value text-soft"><?php echo $_SESSION['user']['phone']; ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                            <div class="data-col">
                                                <span class="data-label">Address</span>
                                                <span class="data-value"><?php echo ucfirst($_SESSION['user']['address']); ?>,<br><?php echo ucfirst($_SESSION['user']['country']); ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Registered</span>
                                                <span class="data-value"><?php echo to_date( (int)$_SESSION['user']['reg_date'],"d M, Y"); ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label" style="width: 50%;">Refferal Link</span>
                                                <span class="data-value" id="refUrl"><i><?php echo SITEURL.'/?ref='.$_SESSION['user']['referral_id']; ?></span></i></span>
                                            </div>
                                            <div class="form-clip clipboard-init data-col data-col-end" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy</span></div>
                                        </div>
                                    </div><!-- .nk-data -->
                                </div><!-- .card -->
                                <!-- Another Section -->
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Site Preferences</h5>
                                        <div class="nk-block-des">
                                            <p>Site preferences allows you to make best use.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="card card-bordered">
                                    <div class="nk-data data-list">
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Language</span>
                                                <span class="data-value">English (United State)</span>
                                            </div>
                                            <div class="data-col data-col-end" style="visibility: hidden;"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change Language</a></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Date Format</span>
                                                <span class="data-value">dd-MM-YYYY</span>
                                            </div>
                                            <div class="data-col data-col-end" style="visibility: hidden;"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Site Timezone</span>
                                                <span class="data-value"><?php echo date('e').' '.date('O') ?></span>
                                            </div>
                                            <div class="data-col data-col-end" style="visibility: hidden;"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Your Timezone</span>
                                                <span class="data-value" id="ytz"></span>
                                            </div>
                                            <div class="data-col data-col-end" style="visibility: hidden;"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                        </div>
                                    </div><!-- .nk-data -->
                                </div><!-- .card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form method="post" action="../includes/form.php">
                <?php $csrf->echoInputField(); ?>
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <h5 class="title">Update Profile</h5>
                        <ul class="nk-nav nav nav-tabs">
                            <li class="nav-item">
                                <a id="inity" class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a id="initz" class="nav-link" data-toggle="tab" href="#address">Address</a>
                            </li>
                        </ul><!-- .nav-tabs -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="personal">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                            <div class="help-block with-errors"><?php echo $form_error['profile_error']; ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">First Name</label>
                                            <input type="text" name="firstname" class="form-control form-control-lg" id="full-name" value="<?php echo $_SESSION['user']['firstname']; ?>" placeholder="Enter First name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Last Name</label>
                                            <input type="text" name="lastname" class="form-control form-control-lg" id="display-name" value="<?php echo $_SESSION['user']['lastname']; ?>" placeholder="Enter Last name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Phone Number</label>
                                            <input type="phone" name="phone" class="form-control form-control-lg" id="phone-no" value="<?php echo $_SESSION['user']['phone']; ?>" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="birth-day">Email</label>
                                            <input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" class="form-control form-control-lg" placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="submit" name="profile" id="submit" class="btn btn-lg btn-primary" value="Update">
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .tab-pane -->
                            <div class="tab-pane" id="address">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                            <div class="help-block with-errors"><?php echo $form_error['profile_error']; ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="address-l1">Gender</label>
                                            <input type="text" name="gender" value="<?php echo $_SESSION['user']['gender']; ?>" class="form-control form-control-lg" id="address-l1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="address-st">Country</label>
                                            <input type="text" name="country" value="<?php echo $_SESSION['user']['country']; ?>" class="form-control form-control-lg" id="address-st" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="address-l2">Address</label>
                                            <input type="text" name="address" value="<?php echo $_SESSION['user']['address']; ?>" class="form-control form-control-lg" id="address-l2" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="submit" name="profile" id="submit" class="btn btn-lg btn-primary" value="Update">
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </form>
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
<?php require_once('footer.php'); ?>