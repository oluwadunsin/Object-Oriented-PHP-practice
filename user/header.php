<?php
  define("_AXES_ALLOWED", true);
  require_once("../includes/init.php");
?>

<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $core->meta_description; ?>">
    <meta name="keywords" content="<?php echo $core->meta_keywords; ?>">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="../img/logo/favicon.ico">
    <!-- Page Title  -->
    <title>User Investment Dashboard | <?php echo $core->title; ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=1.4.0">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=1.4.0">
    <!--toastr-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script>
        window.addEventListener('load',()=>{
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": true,
              "progressBar": true,
              "positionClass": "toast-top-center",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut",
            }
        });
    </script>
         <?php echo $core->before_head; ?>   
</head>

<body class="nk-body npc-invest bg-lighter ">
    <?php echo $core->after_body; ?>  
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fluid is-theme">
                <div class="container-xl wide-lg">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="../index.php" class="logo-link">
                                <img class="logo-light logo-img" src="../img/logo/logo.png" srcset="../img/logo/logo.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="../img/logo/logo.png" srcset="../img/logo/logo.png 2x" alt="logo-dark">
                                <span class="nio-version">Invest</span>
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="../index.php" class="logo-link">
                                        <img class="logo-light logo-img" src="../img/logo/logo.png" srcset="../img/logo/logo.png 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="../img/logo/logo.png" srcset="../img/logo/logo.png 2x" alt="logo-dark">
                                        <span class="nio-version">Invest</span>
                                    </a>
                                </div>
                                <div class="nk-menu-trigger mr-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <!-- Menu -->
                            <ul class="nk-menu nk-menu-main">
                                <li class="nk-menu-item">
                                    <a href="index.php" class="nk-menu-link">
                                        <span class="nk-menu-text">Overview</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="schemes.php" class="nk-menu-link">
                                        <span class="nk-menu-text">MY Plan</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="invest.php" class="nk-menu-link">
                                        <span class="nk-menu-text">Invest</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="profile.php" class="nk-menu-link">
                                        <span class="nk-menu-text">Profile</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item active has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Finance</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="deposit.php" class="nk-menu-link">
                                                <span class="nk-menu-text">Deposit</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="withdraw.php" class="nk-menu-link">
                                                <span class="nk-menu-text">Withdraw</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php if(isset($_SESSION['admin'])){ ?>
                                    <li class="nk-menu-item">
                                        <a href="../admin" class="nk-menu-link">
                                            <span class="nk-menu-text">Admin</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <?php if(1==2){ ?>
                                <li class="dropdown notification-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Notifications</span>
                                            <a href="#">Mark All as Read</a>
                                        </div>
                                        <div class="dropdown-body">
                                            <div class="nk-notification">
                                                <?php echo $user->notifications_summary; ?>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">You have requested to <span>Widthdraw</span></div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">You have requested to <span>Widthdraw</span></div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-notification -->
                                        </div><!-- .nk-dropdown-body -->
                                        <div class="dropdown-foot center">
                                            <a href="#">View All</a>
                                        </div>#"
                                    </div>
                                </li>
                                <?php } ?>
                                <!-- .dropdown -->
                                <li class="hide-mb-sm"><a href="../logout.php" class="nk-quick-nav-icon"><em class="icon ni ni-signout"></em></a></li>
                                <li class="dropdown user-dropdown order-sm-first">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-xl-block">
                                                <div class="user-name dropdown-indicator"><?php echo $_SESSION['user']['username']; ?></div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span><?php echo strtoupper($_SESSION['user']['firstname'][0].$_SESSION['user']['lastname'][0]); ?></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo ucwords($_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname']); ?></span>
                                                    <span class="sub-text"><?php echo $_SESSION['user']['email']; ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <a class="btn btn-icon mr-n2" href="profile-setting.php"><em class="icon ni ni-setting"></em></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner user-account-info">
                                            <h6 class="overline-title-alt">Account Balance</h6>
                                            <div class="user-balance"><?php echo number_format($user->investment_total,2); ?> <small class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></small></div>
                                            <div class="user-balance-sub">Locked <span><?php echo number_format($user->investment_invested,2); ?> <span class="currency currency-usd"><?php echo strtoupper($core->site_currency_letter); ?></span></span></div>
                                            <a href="withdraw.php" class="link"><span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em></a>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="profile.php"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="profile.php#profile-edit"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a href="profile-login.php"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="../logout.php"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->