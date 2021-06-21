<?php require_once('header.php'); ?>
    <?php 
        if(isset($_SESSION['cpay'])){
    ?>
                <?php if(!$_SESSION['cpay']['status']){ ?>
                    <script>window.addEventListener('load',()=>{ toastr["error"]("<?php echo $_SESSION['cpay']['msg']; ?>"); });</script>
                <?php }else{ ?>
                    <form action="https://www.coinpayments.net/index.php" method="post">
                        <input type="hidden" name="cmd" value="_pay_simple">
                        <input type="hidden" name="reset" value="1">
                        <input type="hidden" name="merchant" value="<?php echo $core->cpay_merchant; ?>">
                        <input type="hidden" name="currency" value="USD">
                        <input type="hidden" name="amountf" value="<?php echo $_SESSION['cpay']['amount']; ?>">
                        <input type="hidden" name="custom" value="<?php echo $_SESSION['cpay']['amount']; ?>">
                        <input type="hidden" name="item_name" value="<?php echo $_SESSION['cpay']['name']; ?>">    
                        <input type="hidden" name="item_desc" value="<?php echo $_SESSION['cpay']['desc']; ?>">  
                        <input type="hidden" name="item_number" value="<?php echo $_SESSION['cpay']['plan_id']; ?>"> 
                        <input type="hidden" name="invoice" value="<?php echo $_SESSION['cpay']['ref_id']; ?>">
                        <input type="hidden" name="cancel_url" value="<?php echo SITEURL.'/user/deposit.php'; ?>">
                        <input type="hidden" name="success_url" value="<?php echo SITEURL.'/user/profile-deposits.php'; ?>">
                        <input type="image" id="cpaymt" src="https://www.coinpayments.net/images/pub/buynow-grey.png" alt="Buy Now with CoinPayments.net" style="display: none;">
                    </form>
                    <?php unset($_SESSION['cpay']);  ?>
                    <script>
                       document.getElementById("cpaymt").click();
                    </script>;
                <?php } ?>
    <?php  unset($_SESSION['cpay']); } ?>

    <script>
        var zpid,zmin,zname,zperiod,zterm,zpercent,ztime,zamount;
        function planSet(pid,min,max,name,period,term,percent,time){
            zpid = pid; zmin = min; zmax = max; zname = name; zperiod = period; zterm= term; zpercent = percent; ztime = time;
            document.getElementById("fplan").value = pid;
            document.getElementById("min-deposit").textContent = min;
            document.getElementById("max-deposit").textContent = max;
            document.getElementById("plan_period").textContent = period;
            document.getElementById("plan_term").textContent = term;
            document.getElementById("plan_percent").textContent = percent;
            document.getElementById("detail-period").textContent = period+' '+term;
            document.getElementById("detail-name").textContent = name;
            document.getElementById("detail-term").textContent = term+' profit';
            document.getElementById("detail-term2").textContent = term+' profit %';
            //document.querySelector('#amount-step div.noUi-handle.noUi-handle-lower').setAttribute('aria-valuemin',min);
            //document.querySelector('#amount-step div.noUi-handle.noUi-handle-lower').setAttribute('aria-valuemax',max);
            //document.querySelector('#amount-step div.noUi-handle.noUi-handle-lower').setAttribute('aria-valuenow',0);

            let r = Number(<?php echo time(); ?>)+Number(time);
            let d = new Date(r*1000);
            document.getElementById("detail-time").textContent = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear()+' '+(d.getHours())+' : '+(d.getMinutes());
        }

        function amountSet(amount){
            zamount = amount;
            document.getElementById("custom-amount").value = amount;
            document.getElementById("famount").value = amount;
            if(amount >= zmin){
               document.getElementById("detail-total1").textContent = '<?php echo ucfirst($core->site_currency); ?> '+amount; 
               document.getElementById("detail-total2").textContent = '<?php echo ucfirst($core->site_currency); ?> '+amount; 

               let profit = ((zpercent/100)*amount);
               let profit_percent = (((profit)/amount)*100);
               let profit_net = Number(zperiod)*Number(profit);
               let profit_ret = Number(amount)+Number(profit_net);

               document.getElementById("detail-profit1").textContent = '<?php echo ucfirst($core->site_currency); ?> '+profit.toFixed(2); 
               document.getElementById("detail-profit2").textContent = profit_percent.toFixed(2)+' %'; 
               document.getElementById("detail-profit3").textContent =  '<?php echo ucfirst($core->site_currency); ?> '+profit_net.toFixed(2); 
               document.getElementById("detail-profit4").textContent =  '<?php echo ucfirst($core->site_currency); ?> '+profit_ret.toFixed(2); 
            }else{
               document.getElementById("detail-total1").textContent = ""; 
               document.getElementById("detail-total2").textContent = ""; 
               document.getElementById("detail-profit1").textContent = ""; 
               document.getElementById("detail-profit2").textContent = "";  
               document.getElementById("detail-profit3").textContent = ""; 
               document.getElementById("detail-profit4").textContent = ""; 
            }
        }

        window.addEventListener('load',()=>{
            let iniz = "<?php echo ((isset($_GET['plan']) && strlen($_GET['plan']) > 0) ? $_GET['plan'] : $investment->table_arr[0]->id); ?>";
            document.getElementById("plan-"+iniz).click();

            //document.querySelector('div.noUi-touch-area').onclick = function(){
            //    document.getElementById("custom-amount").value = document.querySelector('#amount-step div.noUi-handle.noUi-handle-lower').getAttribute('aria-valuenow');
            //}

            document.getElementById("custom-amount").onchange = function(){amountSet(document.getElementById("custom-amount").value)}
            // Create a new 'change' event
            let event = new Event('change');
            // Dispatch it.
            document.getElementById("custom-amount").dispatchEvent(event);

            <?php if($core->allow_pay){ ?>
                document.onmouseover = function(){
                    if(zamount < zmin){
                        document.getElementById("final-btn").style.display = "none";
                    }else{
                        document.getElementById("final-btn").style.display = "inherit";
                    }
                }
            <?php } ?>
        });
    </script>
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><a href="invest.php" class="back-to"><em class="icon ni ni-arrow-left"></em><span>Back to plan</span></a></div>
                                    <div class="nk-block-head-content">
                                        <h2 class="nk-block-title fw-normal">Ready to get started?</h2>
                                    </div>
                                </div>
                            </div><!-- nk-block-head -->
                            <div class="nk-block invest-block">
                                <form action="#" class="invest-form">
                                    <div class="row g-gs">
                                        <div class="col-lg-7">
                                            <div class="invest-field form-group">
                                                <input type="hidden" value="silver" name="iv-plan" id="invest-choose-plan">
                                                <div class="dropdown invest-cc-dropdown">
                                                    <a href="#" class="dropdown-indicator" data-toggle="dropdown">
                                                        <div class="coin-item">
                                                            <div class="coin-icon">
                                                                <em class="icon ni ni-offer-fill"></em>
                                                            </div>
                                                            <div class="coin-info">
                                                                <span class="coin-name" id="plan_name"></span>
                                                                <span class="coin-text">Invest for <span id="plan_period">21</span> <span id="plan_term">days</span> and profit <span id="plan_percent"></span></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
                                                        <ul class="invest-cc-list">
                                                            <?php foreach ($investment->table_arr as $investmentItem) { ?>
                                                                <?php if(!$investmentItem->active) continue; ?>
                                                                    <li class="invest-cc-item selected">
                                                                        <a href="#" onclick="planSet('<?php echo $investmentItem->id; ?>','<?php echo $investmentItem->minimum; ?>','<?php echo $investmentItem->maximum; ?>','<?php echo $investmentItem->name; ?>','<?php echo $investmentItem->period; ?>','<?php echo $investmentItem->period_name; ?>','<?php echo $investmentItem->percent; ?>','<?php echo $investmentItem->period_multiply; ?>')" class="invest-cc-opt invest-cc-choosen" data-plan="silver" id="plan-<?php echo $investmentItem->id; ?>">
                                                                            <div class="coin-item">
                                                                                <div class="coin-icon">
                                                                                    <em class="icon ni ni-offer-fill"></em>
                                                                                </div>
                                                                                <div class="coin-info">
                                                                                    <span class="coin-name"><?php echo $investmentItem->name; ?></span>
                                                                                    <span class="coin-text">Invest for <?php echo $investmentItem->period.' '.$investmentItem->period_name; ?> and  profit <?php echo $investmentItem->percent; ?>%</span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div><!-- .dropdown -->
                                            </div><!-- .invest-field -->
                                            <div class="invest-field form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Choose Quick Amount to Invest</label>
                                                </div>
                                                <div class="invest-amount-group g-2">
                                                    <div class="invest-amount-item">
                                                        <input type="radio" class="invest-amount-control" name="iv-amount" id="iv-amount-1">
                                                        <label class="invest-amount-label" for="iv-amount-1" onclick="amountSet('100')"><?php echo $core->site_currency; ?> 100</label>
                                                    </div>
                                                    <div class="invest-amount-item">
                                                        <input type="radio" class="invest-amount-control" name="iv-amount" id="iv-amount-2">
                                                        <label class="invest-amount-label" for="iv-amount-2" onclick="amountSet('250')"><?php echo $core->site_currency; ?> 250</label>
                                                    </div>
                                                    <div class="invest-amount-item">
                                                        <input type="radio" class="invest-amount-control" name="iv-amount" id="iv-amount-3">
                                                        <label class="invest-amount-label" for="iv-amount-3" onclick="amountSet('500')"><?php echo $core->site_currency; ?> 500</label>
                                                    </div>
                                                    <div class="invest-amount-item">
                                                        <input type="radio" class="invest-amount-control" name="iv-amount" id="iv-amount-4">
                                                        <label class="invest-amount-label" for="iv-amount-4" onclick="amountSet('1000')"><?php echo $core->site_currency; ?> 1,000</label>
                                                    </div>
                                                    <div class="invest-amount-item">
                                                        <input type="radio" class="invest-amount-control" name="iv-amount" id="iv-amount-5">
                                                        <label class="invest-amount-label" for="iv-amount-5" onclick="amountSet('1500')"><?php echo $core->site_currency; ?> 1,500</label>
                                                    </div>
                                                    <div class="invest-amount-item">
                                                        <input type="radio" class="invest-amount-control" name="iv-amount" id="iv-amount-6">
                                                        <label class="invest-amount-label" for="iv-amount-6" onclick="amountSet('2000')"><?php echo $core->site_currency; ?> 2,000</label>
                                                    </div>
                                                </div>
                                            </div><!-- .invest-field -->
                                            <div class="invest-field form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Or Enter Your Amount</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <div class="form-info"><?php echo strtoupper($core->site_currency_letter); ?></div>
                                                    <input type="text" class="form-control form-control-amount form-control-lg" id="custom-amount" value="100.00">
                                                    <!--<div class="form-range-slider" id="amount-step"></div>-->
                                                </div>
                                                <div class="form-note pt-2">Note: Minimum invest <span id="min-deposit">100</span> <?php echo strtoupper($core->site_currency_letter); ?> and upto <span id="max-deposit">2000</span> <?php echo strtoupper($core->site_currency_letter); ?></div>
                                            </div><!-- .invest-field -->
                                            <div class="invest-field form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Choose Payment Method</label>
                                                </div>
                                                <input type="hidden" value="wallet" name="iv-wallet" id="invest-choose-wallet">
                                                <div class="dropdown invest-cc-dropdown">
                                                    <a href="#" class="invest-cc-choosen dropdown-indicator" data-toggle="dropdown">
                                                        <div class="coin-item">
                                                            <div class="coin-icon">
                                                                <em class="icon ni ni-sign-btc"></em>
                                                            </div>
                                                            <div class="coin-info">
                                                                <span class="coin-name">Coinpayments</span>
                                                                <span class="coin-text">Opens in external page</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
                                                        <ul class="invest-cc-list">
                                                            <li class="invest-cc-item selected">
                                                                <a href="#" class="invest-cc-opt" data-plan="silver">
                                                                    <div class="coin-item">
                                                                        <div class="coin-icon">
                                                                            <em class="icon ni ni-sign-btc"></em>
                                                                        </div>
                                                                        <div class="coin-info">
                                                                            <span class="coin-name">Coinpayments</span>
                                                                            <span class="coin-text">Opens in external page</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li><!-- .invest-cc-item -->
                                                            <!--<li class="invest-cc-item selected">
                                                                <a href="#" class="invest-cc-opt" data-plan="starter">
                                                                    <div class="coin-item">
                                                                        <div class="coin-icon">
                                                                            <em class="icon ni ni-wallet-alt"></em>
                                                                        </div>
                                                                        <div class="coin-info">
                                                                            <span class="coin-name">BTC Wallet</span>
                                                                            <span class="coin-text">Current balance: 2.014095 BTC</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li> .invest-cc-item
                                                            <li class="invest-cc-item">
                                                                <a href="#" class="invest-cc-opt" data-plan="dimond">
                                                                    <div class="coin-item">
                                                                        <div class="coin-icon">
                                                                            <em class="icon ni ni-sign-usd"></em>
                                                                        </div>
                                                                        <div class="coin-info">
                                                                            <span class="coin-name">USD Wallet</span>
                                                                            <span class="coin-text">Current balance: $18,934.84</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li> .invest-cc-item -->
                                                        </ul>
                                                    </div>
                                                </div><!-- .dropdown -->
                                            </div><!-- .invest-field -->
                                            <div class="invest-field form-group">
                                                <div class="custom-control custom-control-xs custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox" checked>
                                                    <label class="custom-control-label" for="checkbox">I agree the <a href="../terms.php">terms and &amp; conditions.</a></label>
                                                </div>
                                            </div><!-- .invest-field -->
                                        </div><!-- .col -->
                                        <div class="col-xl-4 col-lg-5 offset-xl-1">
                                            <div class="card card-bordered ml-lg-4 ml-xl-0">
                                                <div class="nk-iv-wg4">
                                                    <div class="nk-iv-wg4-sub">
                                                        <h6 class="nk-iv-wg4-title title">Your Investment Details</h6>
                                                        <ul class="nk-iv-wg4-overview g-2">
                                                            <li>
                                                                <div class="sub-text">Name of scheme</div>
                                                                <div class="lead-text" id="detail-name"></div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text">Term of the scheme</div>
                                                                <div class="lead-text" id="detail-period"><div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text" id="detail-term"></div>
                                                                <div class="lead-text" id='detail-profit1'></div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text" id="detail-term2"></div>
                                                                <div class="lead-text" id='detail-profit2'></div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text">Total net profit</div>
                                                                <div class="lead-text" id='detail-profit3'></div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text">Total Return</div>
                                                                <div class="lead-text" id='detail-profit4'></div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text">Term start at</div>
                                                                <div class="lead-text">Today (<?php echo to_date(time(),"d-m-Y")?>)</div>
                                                            </li>
                                                            <li>
                                                                <div class="sub-text">Term end at</div>
                                                                <div class="lead-text" id="detail-time"></div>
                                                            </li>
                                                        </ul>
                                                    </div><!-- .nk-iv-wg4-sub -->
                                                    <div class="nk-iv-wg4-sub">
                                                        <ul class="nk-iv-wg4-list">
                                                            <li>
                                                                <div class="sub-text">Payment Method</div>
                                                                <div class="lead-text">Coinpayments</div>
                                                            </li>
                                                        </ul>
                                                    </div><!-- .nk-iv-wg4-sub -->
                                                    <div class="nk-iv-wg4-sub">
                                                        <ul class="nk-iv-wg4-list">
                                                            <li>
                                                                <div class="sub-text">Amount to invest</div>
                                                                <div class="lead-text" id="detail-total1"></div>
                                                            </li>
                                                            <!--<li>
                                                                <div class="sub-text">Conversion Fee <span>(0.5%)</span></div>
                                                                <div class="lead-text">$ 1.25</div>
                                                            </li>-->
                                                        </ul>
                                                    </div><!-- .nk-iv-wg4-sub -->
                                                    <div class="nk-iv-wg4-sub">
                                                        <ul class="nk-iv-wg4-list">
                                                            <li>
                                                                <div class="lead-text">Total Charge</div>
                                                                <div class="caption-text text-primary" id="detail-total2"></div>
                                                            </li>
                                                        </ul>
                                                    </div><!-- .nk-iv-wg4-sub -->
                                                    <form></form>
                                                    <?php if($core->allow_pay){ ?>
                                                        <div class="nk-iv-wg4-sub text-center bg-lighter">
                                                            <form method="post" action="../includes/form.php">
                                                                <?php $csrf->echoInputField(); ?>
                                                                <input type="hidden" name="plan" value="" id="fplan">
                                                                <input type="hidden" name="amount" value="" id="famount">
                                                                <button type="submit" name="deposit" class="btn btn-lg btn-primary ttu" data-toggle="modal" data-target="#invest-plan" id="final-btn" style="margin: auto;">Confirm &amp; proceed</button>
                                                            </form>
                                                        </div><!-- .nk-iv-wg4-sub -->
                                                    <? } ?>
                                                </div><!-- .nk-iv-wg4 -->
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </form>
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
<?php require_once('footer.php'); ?>