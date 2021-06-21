<?php
  define("_AXES_ALLOWED", true);
  require_once("init.php");

  //if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['admin']));
  //else if(!$csrf->isTokenValid($_REQUEST['_csrf'])) die("CSRF validation failed");

  if(!$core->captcha_enabled) $captcha = 1; 
  else $captcha = post('g-recaptcha-response');

  if(isset($_POST['login'])) {
  	if($user->login(post('username'),post('password'),$captcha)) redirect_to("../user/index.php");
  	else redirect_to('../login.php');
  }

  if(isset($_POST['forgot'])) {
  	if($user->passForgot(post('email'),$captcha)) redirect_to("../forgot.php");
  	else redirect_to('../forgot.php');
  }

  if(isset($_POST['reset'])) {
  	if($user->passReset(post('password'),post('conf_password'),post('uid'),post('token'),$captcha)) redirect_to("../reset.php");
  	else redirect_to('../reset.php');
  }

  if(isset($_POST['activate1'])) {
  	if($user->activateResend(post('email'),$captcha)) redirect_to("../activate.php");
  	else redirect_to('../activate.php');
  }

  if(isset($_POST['activate2'])) {
  	if($user->activateUser(post('uid'),post('token'))) redirect_to("../activate.php");
  	else redirect_to('../activate.php');
  }

  if(isset($_POST['register'])) {
    if($user->register(post('username'),post('firstname'),post('lastname'),post('email'),post('password'),post('conf_password'),post('terms')[0],$captcha)) redirect_to("../register.php");
    else redirect_to('../register.php');
  }

  if(isset($_POST['contact'])) {
    if($user->contact(post('name'),post('email'),post('subject'),post('message'),$captcha)) redirect_to("../contact.php");
    else redirect_to('../contact.php');
  }

  if(isset($_SESSION['user'])){

      if(isset($_POST['profile'])) {
        if($user->profile(post('firstname'),post('lastname'),post('phone'),post('email'),post('gender'),post('country'),post('address'))) redirect_to("../user/profile.php");
        else redirect_to('../user/profile.php#profile-edit');
      }

      if(isset($_POST['ch_password'])) {
        if($user->changePassword(post('password'),post('conf_password'))) redirect_to("../user/profile-setting.php");
        else redirect_to('../user/profile-setting.php#password-edit');
      }

      if(isset($_POST['deposit'])) {
        if($user->processDeposit(post('plan'),post('amount'))) redirect_to("../user/deposit.php");
        else redirect_to('../user/deposit.php');
      }

      if(isset($_POST['mk-withdraw']) && ($core->allow_withdraw)){
          if($user->makeWithdraw(post('amount'),post('method'),post('address')))  redirect_to("../user/profile-withdrawal.php");
          else  redirect_to("../user/index.php#withdraw");
      }else if(isset($_POST['mk-withdraw']) && (!$core->allow_withdraw))redirect_to("../user/index.php");
  }

  if(isset($_SESSION['admin'])){

    if(isset($_POST['set-about'])){
        if($about->setAbout($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-review'])){
        if($review->setReview($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['update-review'])){
        if($review->updateReview($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-new-review'])){
        if($review->setNewReview($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_GET['ract'])){
        if($review->deleteReview($_GET['rid'])) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-faq'])){
        if($faq->setFaq($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['update-faq'])){
        if($faq->updateFaq($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-new-faq'])){
        if($faq->setNewFaq($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_GET['fact'])){
        if($faq->deleteFaq($_GET['fid'])) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-terms'])){
        if($pages->setTerms($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-policy'])){
        if($pages->setPolicy($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-landing'])){
        if($landing->setLanding($_POST)) redirect_to("../admin/pages.php?t=1");
        else redirect_to('../admin/pages.php');
    }

    if(isset($_POST['set-logo'])){
        if($core->setLogo($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-name'])){
        if($core->setName($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-seo'])){
        if($core->setSeo($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-contact'])){
        if($core->setContact($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-mail'])){
        if($core->setMail($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-captcha'])){
        if($core->setCaptcha($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-script'])){
        if($core->setScript($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-announce'])){
        if($core->setAnnounce($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-auth'])){
        if($core->setAuth($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-rates'])){
        if($core->setRates($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-cpay'])){
        if($core->setCpay($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-withdraw'])){
        if($core->setWithdraw($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['update-pmethod'])){
        if($core->updatePmethod($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_POST['set-new-pmethod'])){
        if($core->setNewPmethod($_POST)) redirect_to("../admin/settings.php?t=1");
        else redirect_to('../admin/settings.php');
    }

    if(isset($_GET['mact'])){
        if($core->deletePmethod($_GET['mid'])) redirect_to("../admin/settings.php?t=1");
        else redirect_to("../admin/settings.php?t=0");
    }

    if(isset($_POST['update-withdraws'])){
        if($core->updateWithdrawals(post('status'),post('item2'))) redirect_to("../admin/withdrawals.php?t=1");
        else redirect_to('../admin/withdrawals.php');
    }

    if(isset($_GET['wact'])){
        if($core->deleteWithdrawals($_GET['wid'])) redirect_to("../admin/withdrawals.php?t=1");
        else redirect_to("../admin/withdrawals.php?t=0");
    }

    if(isset($_POST['update-deposits'])){
        if($core->updateDeposits(post('status'),post('item2'))) redirect_to("../admin/deposits.php?t=1");
        else redirect_to('../admin/deposits.php');
    }

    if(isset($_GET['dact'])){
        if($core->deleteDeposits($_GET['did'])) redirect_to("../admin/deposits.php?t=1");
        else redirect_to("../admin/deposits.php?t=0");
    }

    if(isset($_POST['update-referrals'])){
        if($core->updateReferrals(post('status'),post('validity'),post('item3'))) redirect_to("../admin/referrals.php?t=1");
        else redirect_to('../admin/referrals.php');
    }

    if(isset($_GET['rract'])){
        if($core->deleteReferrals($_GET['rid'])) redirect_to("../admin/referrals.php?t=1");
        else redirect_to("../admin/referrals.php?t=0");
    }

    if(isset($_GET['uact'])){
        if($core->deleteUsers($_GET['uid'])) redirect_to("../admin/users.php?t=1");
        else redirect_to("../admin/users.php?t=0");
    }

    if(isset($_GET['ubact'])){
        if($core->suspendUsers($_GET['sid'],$_GET['uid'])) redirect_to("../admin/users.php?t=1");
        else redirect_to("../admin/users.php?t=0");
    }

    if(isset($_GET['ucact'])){
        if($core->activateUsers($_GET['uid'])) redirect_to("../admin/users.php?t=1");
        else redirect_to("../admin/users.php?t=0");
    }

    if(isset($_GET['ueact'])){
       $_SESSION['i_user'] = $_SESSION['all_users'][$_GET['uid']]['raw_data'];
       redirect_to("../admin/user-edit.php");
    }

      if(isset($_POST['adm-profile'])) {
        if($user->profile(post('firstname'),post('lastname'),post('phone'),post('email'),post('gender'),post('country'),post('address'),post('username'),post('uid'))) redirect_to("../admin/users.php?t=1");
        else{
          $_SESSION['i_user'] = $_SESSION['all_users'][$_POST['uid']]['raw_data'];
          redirect_to('../admin/user-edit.php#profile-edit?t=0');
        }
      }

      if(isset($_POST['adm-ch_password'])) {
        if($user->changePassword(post('password'),post('conf_password'),post('uid'))) redirect_to("../admin/users.php?t=1");
        else{
          $_SESSION['i_user'] = $_SESSION['all_users'][$_POST['uid']]['raw_data'];
          redirect_to('../admin/user-edit.php#password-edit?t=0');
        }
      }

    if(isset($_GET['delp'])){
        if($core->deletePlans($_GET['pid'])) redirect_to("../admin/plans.php?t=1");
        else redirect_to("../admin/plans.php?t=0");
    }

    if(isset($_POST['set-new-plan'])){
        if($core->setNewPlan($_POST)) redirect_to("../admin/plans.php?t=1");
        else redirect_to('../admin/plans.php');
    }

    if(isset($_POST['update-plan'])){
        if($core->updatePlan($_POST)) redirect_to("../admin/plans.php?t=1");
        else redirect_to('../admin/plans.php');
    }

    if(isset($_GET['udelp'])){
        if($core->deleteUserPlans($_GET['upid'])) redirect_to("../admin/plans.php?t=1");
        else redirect_to("../admin/plans.php?t=0");
    }

    if(isset($_POST['update-uplan'])){
        if($core->updateUPlan($_POST)) redirect_to("../admin/plans.php?t=1");
        else redirect_to('../admin/plans.php');
    }
  }

?>