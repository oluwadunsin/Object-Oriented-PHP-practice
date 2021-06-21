<?php require_once('header.php'); ?>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><a class="back-to" href="profile.php"><em class="icon ni ni-arrow-left"></em><span>My Profile</span></a></div>
                                    <h2 class="nk-block-title fw-normal">Withdrawal History</h2>
                                    <div class="nk-block-des">
                                        <p>Here is your last 30 Withdrawal activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
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
                                        <table class="table table-tranx">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                                    <th class="tb-col-ip"><span class="overline-title">Amt <?php echo $core->site_currency; ?></span></th>
                                                    <th class="tb-col-os"><span class="overline-title">Currency</span></th>
                                                    <th class="tb-col-os"><span class="overline-title">Method</span></th>
                                                    <th class="tb-col-ip"><span class="overline-title">T-id</span></th>
                                                    <th class="tb-col-ip"><span class="overline-title">Desc</span></th>
                                                    <th class=""><span class="overline-title">Status</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($user->withdrawal_records as $withdrawalItem) { ?>
                                                <tr>
                                                    <td class="tb-col-time"><?php echo $withdrawalItem->time; ?></td>
                                                    <td class="tb-col-ip"><span class="amount"><?php echo number_format($withdrawalItem->amount,2); ?></span></td>
                                                    <td class="tb-col-os"><?php echo strtolower($withdrawalItem->currency); ?></td>
                                                    <td class="tb-col-os"><?php echo strtolower($withdrawalItem->reference); ?></td>
                                                    <td class="tb-col-ip"><?php echo strtolower($withdrawalItem->txn_id); ?></td>
                                                    <td class="tb-col-ip"><?php echo strtolower($withdrawalItem->description); ?></td>
                                                    <td class=""><?php echo strtolower($withdrawalItem->status); ?></td>
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