<?php require_once('header.php'); ?>
         <!-- Start Bottom Header -->
        <div class="page-area">
            <div class="breadcumb-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcrumb text-center">
                            <div class="section-headline">
                                <h2>Investment plan</h2>
                            </div>
                            <ul>
                                <li class="home-bread">Home</li>
                                <li>Investment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header -->
                <!-- Start Invest area -->
        <div class="invest-area bg-color area-padding-2">
            <div class="container">
                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $investment->title; ?></h3>
                            <p><?php echo $investment->description; ?></p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="pricing-content">
                        <?php foreach ($investment->table_arr as $investmentItem) { ?>
                            <?php if(!$investmentItem->active) continue; ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="pri_table_list">
                                    <span class="base">Best sale</span>
                                    <div class="top-price-inner">
                                       <h3><?php echo $investmentItem->name; ?></h3>
                                       <div class="rates">
                                            <span class="prices"><?php echo $investmentItem->percent; ?>%</span><span class="users"> for <?php echo $investmentItem->period.' '.$investmentItem->period_name; ?></span>
                                        </div>
                                    </div>
                                    <ol class="pricing-text">
                                        <li class="check">Minimum Deposit : <?php echo $core->site_currency.$investmentItem->minimum; ?></li>
                                        <li class="check">Maximum Deposit : <?php echo $core->site_currency.$investmentItem->maximum; ?></li>
                                        <li class="check"><?php echo $investmentItem->percent; ?>% </li>
                                        <li class="check"><?php echo $investmentItem->period.' '.$investmentItem->period_name; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature1; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature2; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature3; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature4; ?> </li>
                                        <li class="check"><?php echo $investmentItem->feature5; ?> </li>
                                    </ol>
                                    <div class="price-btn blue">
                                        <a class="blue" href="user/deposit.php?plan=<?php echo $investmentItem->id; ?>">Deposit</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Invest area -->
        <!--Start payment-history area -->
        <div class="payment-history-area bg-color fix area-padding-2">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3><?php echo $investment->deposits_title; ?></h3>
                            <p><?php echo $investment->deposits_description; ?></p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="deposite-content">
                            <div class="diposite-box">
                                <h3>Last deposits</h3>
                                <span><i class="flaticon-005-savings"></i></span>
                                    <div class="deposite-table">
                                        <table>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                            </tr>
                                            <?php foreach ($investment->deposit_arr as $investmentItem) { ?>
                                                <?php 
                                                    static $counter = 0;
                                                ?>
                                                <tr>
                                                    <td><img src="img/icon/m<?php echo $investmentItem->icon; ?>.png" alt=""><?php echo $investmentItem->username; ?></td>
                                                    <td><?php echo $investmentItem->time; ?></td>
                                                    <td><?php echo $core->site_currency.number_format($investmentItem->amount,2); ?></td>
                                                    <td><?php echo ucfirst($investmentItem->currency); ?></td>
                                                </tr>
                                            <?php
                                                $counter++;
                                                if($counter >= 10){
                                                    $counter=null;
                                                    unset($counter);
                                                    break;
                                                }
                                            } ?>
                                        </table>
                                    </div>
                            </div>
                        </div>
                        <div class="deposite-content">
                            <div class="diposite-box">
                                <h3>Last withdrawals</h3>
                                <span><i class="flaticon-042-wallet"></i></span>
                                <div class="deposite-table">
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                        </tr>
                                            <?php foreach ($investment->withdrawal_arr as $investmentItem) { ?>
                                                <?php 
                                                    static $counter = 0;
                                                ?>
                                                <tr>
                                                    <td><img src="img/icon/m<?php echo $investmentItem->icon; ?>.png" alt=""><?php echo $investmentItem->username; ?></td>
                                                    <td><?php echo $investmentItem->time; ?></td>
                                                    <td><?php echo $core->site_currency.number_format($investmentItem->amount,2); ?></td>
                                                    <td><?php echo ucfirst($investmentItem->currency); ?></td>
                                                </tr>
                                            <?php
                                                $counter++;
                                                if($counter >= 10){
                                                    $counter=null;
                                                    unset($counter);
                                                    break;
                                                }
                                            } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End payment-history area -->
<?php require_once('footer.php'); ?>