<?php require_once('header.php'); ?>
<?php 
    if(isset($_GET['i']) & !empty($_GET['i'])) $scheme = $user->schemeInfo($_GET['i']);
    else redirect_to('schemes.php');
?>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><a href="schemes.php" class="text-soft back-to"><em class="icon ni ni-arrow-left"> </em><span>My Investment</span></a></div>
                                    <div class="nk-block-between-md g-4">
                                        <div class="nk-block-head-content">
                                            <h2 class="nk-block-title fw-normal"><?php echo $scheme->name; ?> - <?php echo $scheme->percent; ?> for <?php echo $scheme->period; ?> <?php echo $scheme->period_name; ?><?php echo (($scheme->period>1) ? "s" : ""); ?></h2>
                                            <div class="nk-block-des">
                                                <p><?php echo $scheme->ref_id; ?> <span class="badge badge-outline <?php echo $scheme->status_color; ?>"><?php echo $scheme->status; ?></span></p>
                                            </div>
                                        </div>
                                        <!--<div class="nk-block-head-content">
                                            <ul class="nk-block-tools gx-3">
                                                <li class="order-md-last"><a href="#" class="btn btn-danger"><em class="icon ni ni-cross"></em> <span>Cancel this plan</span> </a></li>
                                                <li><a href="#" class="btn btn-icon btn-light"><em class="icon ni ni-reload"></em></a></li>
                                            </ul>
                                        </div>-->
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="row gy-gs">
                                            <div class="col-md-6">
                                                <div class="nk-iv-wg3">
                                                    <div class="nk-iv-wg3-group flex-lg-nowrap gx-4">
                                                        <div class="nk-iv-wg3-sub">
                                                            <div class="nk-iv-wg3-amount">
                                                                <div class="number"><?php echo number_format($scheme->invested,2); ?></div>
                                                            </div>
                                                            <div class="nk-iv-wg3-subtitle">Invested Amount</div>
                                                        </div>
                                                        <div class="nk-iv-wg3-sub">
                                                            <span class="nk-iv-wg3-plus text-soft"><em class="icon ni ni-plus"></em></span>
                                                            <div class="nk-iv-wg3-amount">
                                                                <div class="number"><?php echo number_format($scheme->profit,2); ?> <span class="number-up"><?php echo number_format($scheme->profit_percent,1); ?>%</span></div>
                                                            </div>
                                                            <div class="nk-iv-wg3-subtitle">Profit Earned</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6 col-lg-4 offset-lg-2">
                                                <div class="nk-iv-wg3 pl-md-3">
                                                    <div class="nk-iv-wg3-group flex-lg-nowrap gx-4">
                                                        <div class="nk-iv-wg3-sub">
                                                            <div class="nk-iv-wg3-amount">
                                                                <div class="number"><?php echo number_format($scheme->net_return,2); ?> <span class="number-up"><?php echo number_format($scheme->net_return_percent,1); ?>% <!--<em class="icon ni ni-info-fill" data-toggle="tooltip" data-placement="right" title="tooltip text"></em>--></span></div>
                                                            </div>
                                                            <div class="nk-iv-wg3-subtitle">Total Return</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div>
                                    <div id="schemeDetails" class="nk-iv-scheme-details">
                                        <ul class="nk-iv-wg3-list">
                                            <li>
                                                <div class="sub-text">Term</div>
                                                <div class="lead-text"><?php echo $scheme->period; ?> <?php echo $scheme->period_name; ?><?php echo (($scheme->period>1) ? "s" : ""); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Term start at</div>
                                                <div class="lead-text"><?php echo to_date((int)$scheme->start,"M d, Y h:i A"); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Term end at</div>
                                                <div class="lead-text"><?php echo to_date((int)$scheme->end,"M d, Y h:i A"); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text"><?php echo $scheme->period_name.'ly'; ?> interest</div>
                                                <div class="lead-text"><?php echo $scheme->percent_div; ?>%</div>
                                            </li>
                                        </ul><!-- .nk-iv-wg3-list -->
                                        <ul class="nk-iv-wg3-list">
                                            <li>
                                                <div class="sub-text">Ordered date</div>
                                                <div class="lead-text"><?php echo to_date((int)$scheme->order_date,"M d, Y h:i A"); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Approved date</div>
                                                <div class="lead-text"><?php echo to_date((int)$scheme->start,"M d, Y h:i A"); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Payment method</div>
                                                <div class="lead-text">Coinpayments</div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Paid <small>(fee include)</small></div>
                                                <div class="lead-text"><span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span> 0.00</div>
                                            </li>
                                        </ul><!-- .nk-iv-wg3-list -->
                                        <ul class="nk-iv-wg3-list">
                                            <li>
                                                <div class="sub-text">Captial invested</div>
                                                <div class="lead-text"><span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span><?php echo number_format($scheme->invested,2); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Profit</div>
                                                <div class="lead-text"><span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span> <?php echo number_format($scheme->profit,2); ?></div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Net profit</div>
                                                <div class="lead-text"><?php echo number_format($scheme->percent,2); ?>%</div>
                                            </li>
                                            <li>
                                                <div class="sub-text">Total return</div>
                                                <div class="lead-text"><span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span> <?php echo number_format($scheme->net_return,2); ?></div>
                                            </li>
                                        </ul><!-- .nk-iv-wg3-list -->
                                    </div><!-- .nk-iv-scheme-details -->
                                </div>
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-block-lg">
                                <div class="nk-block-head">
                                    <h5 class="nk-block-title">Graph View</h5>
                                </div>
                                <div class="row g-gs">
                                    <div class="col-lg-5">
                                        <div class="card card-bordered h-100">
                                            <div class="card-inner justify-center text-center h-100">
                                                <div class="nk-iv-wg5">
                                                    <div class="nk-iv-wg5-head">
                                                        <h5 class="nk-iv-wg5-title">Overview</h5>
                                                    </div>
                                                    <div class="nk-iv-wg5-ck">
                                                        <input type="text" class="knob-half" value="<?php echo $scheme->final_capital_percent; ?>" data-fgColor="#6576ff" data-bgColor="#d9e5f7" data-thickness=".06" data-width="300" data-height="155" data-displayInput="false">
                                                        <div class="nk-iv-wg5-ck-result">
                                                            <div class="text-lead"><?php echo number_format($scheme->final_capital_percent,2); ?>%</div>
                                                            <div class="text-sub"><?php echo $scheme->percent_div; ?>% for <?php echo $scheme->period.' '.$scheme->period_name; ?><?php echo (($scheme->period>1) ? "s" : ""); ?></div>
                                                        </div>
                                                        <div class="nk-iv-wg5-ck-minmax"><span><?php echo number_format($scheme->invested,2); ?></span><span><?php echo number_format($scheme->final_capital,2); ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-lg col-sm-6">
                                        <div class="card card-bordered h-100">
                                            <div class="card-inner justify-center text-center h-100">
                                                <div class="nk-iv-wg5">
                                                    <div class="nk-iv-wg5-head">
                                                        <h5 class="nk-iv-wg5-title">Net Profit</h5>
                                                        <div class="nk-iv-wg5-subtitle">Earn so far <strong><?php echo number_format($scheme->profit,2); ?></strong> <span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span></div>
                                                    </div>
                                                    <div class="nk-iv-wg5-ck sm">
                                                        <input type="text" class="knob-half" value="<?php echo $scheme->final_capital_percent; ?>" data-fgColor="#33d895" data-bgColor="#d9e5f7" data-thickness=".07" data-width="240" data-height="125" data-displayInput="false">
                                                        <div class="nk-iv-wg5-ck-result">
                                                            <div class="text-lead sm"><?php echo $scheme->percent; ?>%</div>
                                                            <div class="text-sub"><?php echo $scheme->period_name.'ly'; ?> profit</div>
                                                        </div>
                                                        <div class="nk-iv-wg5-ck-minmax"><span>0.00</span><span><?php echo number_format($scheme->final_profit,2); ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-lg col-sm-6">
                                        <div class="card card-bordered h-100">
                                            <div class="card-inner justify-center text-center h-100">
                                                <div class="nk-iv-wg5">
                                                    <div class="nk-iv-wg5-head">
                                                        <h5 class="nk-iv-wg5-title">Day Remain</h5>
                                                        <div class="nk-iv-wg5-subtitle">Earn so far <strong><?php echo number_format($scheme->profit,2); ?></strong> <span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span></div>
                                                    </div>
                                                    <div class="nk-iv-wg5-ck sm">
                                                        <input type="text" class="knob-half" value="<?php echo $scheme->final_day_percent; ?>" data-fgColor="#816bff" data-bgColor="#d9e5f7" data-thickness=".07" data-width="240" data-height="125" data-displayInput="false">
                                                        <div class="nk-iv-wg5-ck-result">
                                                            <div class="text-lead sm"><?php echo strtolower($scheme->final_day); ?> <?php echo substr($scheme->period_name,0,1); ?></div>
                                                            <div class="text-sub"><?php echo strtolower($scheme->period_name); ?> remain</div>
                                                        </div>
                                                        <div class="nk-iv-wg5-ck-minmax"><span>0</span><span><?php echo $scheme->period; ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                            <!--<div class="nk-block nk-block-lg">
                                <div class="nk-block-head">
                                    <h5 class="nk-block-title">Transactions</h5>
                                </div>
                                <div class="card card-bordered">
                                    <table class="table table-iv-tnx">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="tb-col-type"><span class="overline-title">Type</span></th>
                                                <th class="tb-col-date"><span class="overline-title">Date</span></th>
                                                <th class="tb-col-time tb-col-end"><span class="overline-title">Amount</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="tb-col-type"><span class="sub-text">Investment</span></td>
                                                <td class="tb-col-date"><span class="sub-text">04 Nov, 2018</span></td>
                                                <td class="tb-col-time tb-col-end"><span class="lead-text text-danger">- 2,500.00</span></td>
                                            </tr>
                                            <tr>
                                                <td class="tb-col-type"><span class="sub-text">Profit - 4.76%</span></td>
                                                <td class="tb-col-date"><span class="sub-text">05 Nov, 2018</span></td>
                                                <td class="tb-col-time tb-col-end"><span class="lead-text">+ 119.10</span></td>
                                            </tr>
                                            <tr>
                                                <td class="tb-col-type"><span class="sub-text">Profit - 4.76%</span></td>
                                                <td class="tb-col-date"><span class="sub-text">06 Nov, 2018</span></td>
                                                <td class="tb-col-time tb-col-end"><span class="lead-text">+ 119.10</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> .card 
                            </div> .nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
<?php require_once('footer.php'); ?>