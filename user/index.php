<?php require_once('header.php'); ?>
<script>
    window.onload = function(){
        if(window.location.href.indexOf('#withdraw') != -1) {
            $('#withdraw').modal('show');
        }
    }
</script>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-between-md g-3">
                                    <div class="nk-block-head-content">
                                        <div class="nk-block-head-sub"><span>Welcome!</span></div>
                                        <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                            <div>
                                                <h2 class="nk-block-title fw-normal"><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname']; ?></h2>
                                            </div>
                                            <div><a href="schemes.php" class="btn btn-white btn-light">My Plans <em class="icon ni ni-arrow-long-right ml-2"></em></a></div>
                                        </div>
                                        <div class="nk-block-des">
                                            <p>At a glance summary of your investment account. Have fun!</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content d-none d-md-block">
                                        <div class="nk-slider nk-slider-s1">
                                            <div class="slider-init" data-slick='{"dots": true, "arrows": false, "fade": true}'>
                                                <?php foreach ($user->active_investments as $activeItem){ ?>
                                                    <div class="slider-item">
                                                        <div class="nk-iv-wg1">
                                                            <div class="nk-iv-wg1-sub sub-text">My Active Plans</div>
                                                            <h6 class="nk-iv-wg1-info title"><?php echo $activeItem->name; ?> - <?php echo $activeItem->percent; ?>% for <?php echo $activeItem->period; ?> <?php echo $activeItem->period_name; ?><?php echo (($activeItem->period>1) ? "s" : ""); ?></h6>
                                                            <a href="scheme-detail.php?i=<?php echo $activeItem->id; ?>" class="nk-iv-wg1-link link link-light"><em class="icon ni ni-trend-up"></em> <span>Check Details</span></a>
                                                            <div class="nk-iv-wg1-progress">
                                                                <div class="progress-bar bg-primary" data-progress="80"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="slider-dots"></div>
                                        </div><!-- .nk-slider -->
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-news card card-bordered">
                                    <div class="card-inner">
                                        <div class="nk-news-list">
                                            <a class="nk-news-item" href="#">
                                                <div class="nk-news-icon">
                                                    <em class="icon ni ni-card-view"></em>
                                                </div>
                                                <div class="nk-news-text">
                                                    <p>Announcement <span> <?php echo $core->announcement_pri; ?></span></p>
                                                    <em class="icon ni ni-external"></em>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                            <div class="nk-block">
                                <div class="row gy-gs">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="nk-wg-card is-dark card card-bordered">
                                            <div class="card-inner">
                                                <div class="nk-iv-wg2">
                                                    <div class="nk-iv-wg2-title">
                                                        <h6 class="title">Available Balance <em class="icon ni ni-info"></em></h6>
                                                    </div>
                                                    <div class="nk-iv-wg2-text">
                                                        <div class="nk-iv-wg2-amount"> <?php echo number_format($user->available_balance,2); ?> <span class="change up"><span class="sign"></span><?php echo number_format($user->available_balance_percent,1); ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="nk-wg-card is-s1 card card-bordered">
                                            <div class="card-inner">
                                                <div class="nk-iv-wg2">
                                                    <div class="nk-iv-wg2-title">
                                                        <h6 class="title">Total Invested <em class="icon ni ni-info"></em></h6>
                                                    </div>
                                                    <div class="nk-iv-wg2-text">
                                                        <div class="nk-iv-wg2-amount"> <?php echo number_format($user->investment_invested,2); ?> <span class="change up"><span class="sign"></span><?php echo number_format($user->total_profits_percent,1); ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-12 col-lg-4">
                                        <div class="nk-wg-card is-s3 card card-bordered">
                                            <div class="card-inner">
                                                <div class="nk-iv-wg2">
                                                    <div class="nk-iv-wg2-title">
                                                        <h6 class="title">Total Profits <em class="icon ni ni-info"></em></h6>
                                                    </div>
                                                    <div class="nk-iv-wg2-text">
                                                        <div class="nk-iv-wg2-amount"> <?php echo number_format($user->total_profits,2); ?> <span class="change up"><span class="sign"></span><?php echo number_format($user->total_profits_percent,1); ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                            <div class="nk-block">
                                <div class="row gy-gs">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="nk-wg-card card card-bordered h-100">
                                            <div class="card-inner h-100">
                                                <div class="nk-iv-wg2">
                                                    <div class="nk-iv-wg2-title">
                                                        <h6 class="title">Balance in Account</h6>
                                                    </div>
                                                    <div class="nk-iv-wg2-text">
                                                        <div class="nk-iv-wg2-amount ui-v2"><?php echo number_format($user->investment_total,2); ?></div>
                                                        <ul class="nk-iv-wg2-list">
                                                            <li>
                                                                <span class="item-label">Available Funds</span>
                                                                <span class="item-value"><?php echo number_format($user->investment_profits,2); ?></span>
                                                            </li>
                                                            <li>
                                                                <span class="item-label">Invested Funds</span>
                                                                <span class="item-value"><?php echo number_format($user->investment_invested,2); ?></span>
                                                            </li>
                                                            <li class="total">
                                                                <span class="item-label">Total</span>
                                                                <span class="item-value"><?php echo number_format($user->investment_total,2); ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="nk-iv-wg2-cta">
                                                        <a href="withdraw.php" class="btn btn-primary btn-lg btn-block">Withdraw Funds</a>
                                                        <a href="deposit.php" class="btn btn-trans btn-block">Deposit Funds</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="nk-wg-card card card-bordered h-100">
                                            <div class="card-inner h-100">
                                                <div class="nk-iv-wg2">
                                                    <div class="nk-iv-wg2-title">
                                                        <h6 class="title">Profit Analysis<em class="icon ni ni-info text-primary"></em></h6>
                                                    </div>
                                                    <div class="nk-iv-wg2-text">
                                                        <div class="nk-iv-wg2-amount ui-v2"><?php echo number_format($user->total_profits,2); ?> <span class="change up"><span class="sign"></span><?php echo number_format($user->total_profits_percent,1); ?>%</span></div>
                                                        <ul class="nk-iv-wg2-list">
                                                            <li>
                                                                <span class="item-label">Profits</span>
                                                                <span class="item-value"><?php echo number_format($user->investment_profits,2); ?></span>
                                                            </li>
                                                            <li>
                                                                <span class="item-label">Referrals</span>
                                                                <span class="item-value"><?php echo number_format($user->commission2,2); ?></span>
                                                            </li>
                                                            <li>
                                                                <span class="item-label">Rewards</span>
                                                                <span class="item-value">0.00</span>
                                                            </li>
                                                            <li class="total">
                                                                <span class="item-label">Total Profit</span>
                                                                <span class="item-value"><?php echo number_format($user->total_profits,2); ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="nk-iv-wg2-cta">
                                                        <a href="invest.php" class="btn btn-primary btn-lg btn-block">Invest & Earn</a>
                                                        <div class="cta-extra">Earn up to <?php echo $core->referral_rate; ?>% <a href="#reffer" class="link link-dark">Refer friend!</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-12 col-lg-4">
                                        <div class="nk-wg-card card card-bordered h-100">
                                            <div class="card-inner h-100">
                                                <div class="nk-iv-wg2">
                                                    <div class="nk-iv-wg2-title">
                                                        <h6 class="title">My Investment</h6>
                                                    </div>
                                                    <div class="nk-iv-wg2-text">
                                                        <div class="nk-iv-wg2-amount ui-v2"><?php echo $user->total_active; ?> <span class="sub">00</span> Active</div>
                                                        <ul class="nk-iv-wg2-list">
                                                            <?php foreach ($user->active_investments as $activeItem){ ?>
                                                                <li>
                                                                    <span class="item-label"><a href="schemes.php?i=<?php echo $activeItem->id; ?>"><?php echo $activeItem->name; ?></a> <small>- <?php echo $activeItem->percent; ?>% for <?php echo $activeItem->period; ?> <?php echo $activeItem->period_name; ?><?php echo (($activeItem->period>1) ? "s" : ""); ?></small></span>
                                                                    <span class="item-value"><?php echo number_format($activeItem->invested,2); ?></span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                    <div class="nk-iv-wg2-cta">
                                                        <a href="schemes.php" class="btn btn-light btn-lg btn-block">See all Investment</a>
                                                        <div class="cta-extra">Check out <a href="schemes.php" class="link link-dark">Analytic Report</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="nk-refwg">
                                        <div class="nk-refwg-invite card-inner" id="reffer">
                                            <div class="nk-refwg-head g-3">
                                                <div class="nk-refwg-title">
                                                    <h5 class="title">Refer Us & Earn</h5>
                                                    <div class="title-sub">Use the below link to invite your friends.</div>
                                                </div>
                                                <!--<div class="nk-refwg-action">
                                                    <a href="#" class="btn btn-primary">Invite</a>
                                                </div>-->
                                            </div>
                                            <div class="nk-refwg-url">
                                                <div class="form-control-wrap">
                                                    <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Link</span></div>
                                                    <div class="form-icon">
                                                        <em class="icon ni ni-link-alt"></em>
                                                    </div>
                                                    <input type="text" class="form-control copy-text" id="refUrl" value="<?php echo SITEURL.'/?ref='.$_SESSION['user']['referral_id']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-refwg-stats card-inner bg-lighter">
                                            <div class="nk-refwg-group g-3">
                                                <div class="nk-refwg-name">
                                                    <h6 class="title">My Referral <em class="icon ni ni-info" data-toggle="tooltip" data-placement="right" title="Referral Informations"></em></h6>
                                                </div>
                                                <div class="nk-refwg-info g-3">
                                                    <div class="nk-refwg-sub">
                                                        <div class="title"><?php echo $user->referral_joined; ?></div>
                                                        <div class="sub-text">Total Joined</div>
                                                    </div>
                                                    <div class="nk-refwg-sub">
                                                        <div class="title"><?php echo number_format($user->commission1,2); ?></div>
                                                        <div class="sub-text">Referral Earn</div>
                                                    </div>
                                                </div>
                                                <div class="nk-refwg-more dropdown mt-n1 mr-n1">
                                                    <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                        <ul class="link-list-plain sm">
                                                            <li><a href="#">7 days</a></li>
                                                            <li><a href="#">15 Days</a></li>
                                                            <li><a href="#">30 Days</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-refwg-ck">
                                                <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade zoom" tabindex="-1" role="dialog" id="withdraw">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="../includes/form.php">
                <?php $csrf->echoInputField(); ?>
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body">
                        <div class="modal-header">
                            <h6 class="modal-title">Make Withdrawal</h6>
                        </div>
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="help-block with-errors"><?php echo $form_error['withdraw_error']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Withdrawable Total</label>
                                            <input type="text" readonly class="form-control form-control-lg" value="<?php echo number_format($user->total_profits,2); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Fees & Infos</label>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>Method</th>
                                                                        <th>Currency</th>
                                                                        <th>Charge</th>
                                                                        <th>Minimum</th>
                                                                        <th>Maximum</th>
                                                                        <th>Delay</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($core->wMethods as $coreItem) { ?>
                                                                        <?php if(!$coreItem->istatus) continue; ?>
                                                                        <tr>
                                                                            <td id="meth-<?php echo $coreItem->id; ?>"><?php echo $coreItem->method; ?></td>
                                                                            <td id="curr-<?php echo $coreItem->id; ?>"><?php echo $coreItem->currency; ?></td>
                                                                            <td id="char-<?php echo $coreItem->id; ?>"><?php echo $coreItem->charge; ?></td>
                                                                            <td id="min-<?php echo $coreItem->id; ?>"><?php echo $coreItem->minimum; ?></td>
                                                                            <td id="max-<?php echo $coreItem->id; ?>"><?php echo $coreItem->maximum; ?></td>
                                                                            <td id="del-<?php echo $coreItem->id; ?>"><?php echo $coreItem->delay; ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Amount</label>
                                            <input type="text" name="amount" class="form-control form-control-lg" value="<?php echo number_format($user->total_profits,2); ?>" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Method</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select form-control form-control-lg select2-hidden-accessible" name="method" tabindex="-1" aria-hidden="true" required="">
                                                    <?php foreach ($core->wMethods as $coreItem) { ?> 
                                                        <option value="<?php echo $coreItem->id; ?>"><?php echo $coreItem->method; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Payment Info</label>
                                            <input type="text" name="address" class="form-control form-control-lg" value="Payment Information or Address" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <?php if($core->allow_withdraw){ ?>
                                        <div class="col-12">
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <input type="submit" name="mk-withdraw" id="submit" class="btn btn-lg btn-primary" value="Update">
                                                </li>
                                                <li>
                                                    <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </form>
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
<?php require_once('footer.php'); ?>