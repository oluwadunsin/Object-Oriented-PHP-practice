<?php
  define("_AXES_ALLOWED", true);
  require_once("init.php");
?>
<?php    
    
    // Fill these in with the information from your CoinPayments.net account.
    $cp_merchant_id = $core->cpay_merchant;
    $cp_ipn_secret = $core->cpay_ipn;
    $cp_debug_email = $core->debug_mail;

    function errorAndDie($error_msg) {
        global $cp_debug_email;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($_POST as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
          if (DEBUG) array_push($debug_error, 'CoinPayments IPN Error : '.$report,'<br>');
        }
        die('IPN Error: '.$error_msg);
    }

    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
        errorAndDie('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        errorAndDie('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        errorAndDie('Error reading POST data');
    }

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
        errorAndDie('No or incorrect Merchant ID passed');
    }

    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
    if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
        errorAndDie('HMAC signature does not match');
    }
    

    // HMAC Signature verified at this point, load some variables.

    $ipn_type = $_POST['ipn_type'];
    //$txn_id = $_POST['txn_id'];
    $item_name = $_POST['item_name']; //plan name
    $item_number = $_POST['item_number']; //plan id
    $amount1 = floatval($_POST['amount1']); //amount in usd
    $amount2 = floatval($_POST['amount2']); //amount in currency user chose
    $invoice = $_POST['invoice']; //reference id
    $order_total = $_POST['custom'];
    $currency1 = $_POST['currency1']; //usd
    $currency2 = $_POST['currency2']; //currency user chose
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];

    /**if ($ipn_type != 'button') { // Advanced Button payment
        errorAndDie("IPN OK: Not a button payment");
    }**/

    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

    // Check the original currency to make sure the buyer didn't change it.
    if(($currency1 != $currency1) || ($amount1 < $order_total)){
        if ($currency1 != $currency1) {
            errorAndDie('Original currency mismatch!');
        }

        // Check amount against order total
        if ($amount1 < $order_total) {
            errorAndDie('Amount is less than order total!');
        }
    }

    else{
        $user->updateDeposit($amount1,$currency2,/**$txn_id,**/$invoice,$status);
    }
 
    /**if ($status >= 100 || $status == 2) {
        // payment is complete or queued for nightly payout, success
    } else if ($status < 0) {
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    } else {
        //payment is pending, you can optionally add a note to the order page
    }**/
    die('IPN OK');
?>