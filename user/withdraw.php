<?php require_once('header.php'); ?>
<?php 
	if($core->allow_withdraw)redirect_to('index.php#withdraw');
	else redirect_to('index.php');
?>