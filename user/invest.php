<?php require_once('header.php'); ?>
    <script>
        function optioner(opt){
            document.getElementById("opter").href = "deposit.php?plan="+opt;
        }
    </script>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head text-center">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><span>Choose an Option</span></div>
                                    <div class="nk-block-head-content">
                                        <h2 class="nk-block-title fw-normal">Investment Plan</h2>
                                        <div class="nk-block-des">
                                            <p>Choose your investment plan and start earning.</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- nk-block -->
                            <div class="nk-block">
                                <form action="html/invest/invest-form.html" class="plan-iv">
                                    <div class="plan-iv-currency text-center">
                                        <ul class="nav nav-switch nav-tabs bg-white">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link active"><?php echo strtoupper($core->site_currency_letter); ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">EUR</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">BTC</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">ETH</a>
                                            </li>
                                        </ul><!-- nav-tabs -->
                                    </div>
                                    <div class="plan-iv-list nk-slider nk-slider-s2">
                                        <ul class="plan-list slider-init" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite":false, "responsive":[
						{"breakpoint": 992,"settings":{"slidesToShow": 2}},
						{"breakpoint": 768,"settings":{"slidesToShow": 1}}
					]}'>
                                <?php foreach ($investment->table_arr as $investmentItem) { ?>
                                    <?php if(!$investmentItem->active) continue; ?>
                                        <?php 
                                            static $counter = 1;
                                        ?>
                                            <li class="plan-item">
                                                <input type="radio" id="plan-iv-<?php echo $counter; ?>" name="plan-iv" class="plan-control">
                                                <div class="plan-item-card">
                                                    <div class="plan-item-head">
                                                        <div class="plan-item-heading">
                                                            <h4 class="plan-item-title card-title title"><?php echo $investmentItem->name; ?></h4>
                                                            <p class="sub-text"><?php echo $investmentItem->description; ?></p>
                                                        </div>
                                                        <div class="plan-item-summary card-text">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <span class="lead-text"><?php echo $investmentItem->percent; ?>%</span>
                                                                    <span class="sub-text">Daily Interest</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <span class="lead-text"><?php echo $investmentItem->period.' '.$investmentItem->period_name; ?></span>
                                                                    <span class="sub-text">Term</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="plan-item-body">
                                                        <div class="plan-item-desc card-text">
                                                            <ul class="plan-item-desc-list">
                                                                <li><span class="desc-label">Min Deposit</span> - <span class="desc-data"><?php echo $core->site_currency.$investmentItem->minimum; ?></span></li>
                                                                <li><span class="desc-label">Max Deposit</span> - <span class="desc-data"><?php echo $core->site_currency.$investmentItem->maximum; ?></span></li>
                                                                <li style="text-align: center;margin: auto; display:inherit;"><?php echo $investmentItem->feature1; ?></li>
                                                                <li style="text-align: center;margin: auto; display:inherit;"><?php echo $investmentItem->feature2; ?></li>
                                                                <li style="text-align: center;margin: auto; display:inherit;"><?php echo $investmentItem->feature3; ?></li>
                                                                <li style="text-align: center;margin: auto; display:inherit;"><?php echo $investmentItem->feature4; ?></li>
                                                                <li style="text-align: center;margin: auto; display:inherit;"><?php echo $investmentItem->feature5; ?></li>
                                                            </ul>
                                                            <div class="plan-item-action">
                                                                <label for="plan-iv-<?php echo $counter; ?>" class="plan-label">
                                                                    <span class="plan-label-base" onclick="optioner('<?php echo $investmentItem->id; ?>')">Choose this plan</span>
                                                                    <span class="plan-label-selected">Plan Selected</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                <?php
                                    $counter++;
                                } ?>
                                <?php
                                        $counter=null;
                                        unset($counter);
                                ?>
                                        </ul><!-- .plan-list -->
                                    </div>
                                    <div class="plan-iv-actions text-center">
                                        <a href="" class="btn btn-primary btn-lg" id="opter"> <span>Continue to Invest</span> <em class="icon ni ni-arrow-right"></em></a>
                                    </div>
                                </form>
                            </div><!-- nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
<?php require_once('footer.php'); ?>