<?php
	ob_start();
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['admin']);
    unset($_SESSION['form']);
    unset($_SESSION['form_error']);
    unset($_SESSION['ref']);
    unset($_SESSION['last_login']);
    unset($_SESSION['cpay']);
    unset($_SESSION['all_users']);
    unset($_SESSION['i_user']);
	header("location: login.php"); 
?>