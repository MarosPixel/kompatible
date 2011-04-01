<?php
error_reporting(E_ALL);
$config = json_decode(file_get_contents('config.json'), true);
if (isset($_REQUEST['platform']) && $_REQUEST['platform'] == "fb") {
	require_once("FacebookPlatform.php");
	$platform = new FacebookPlatform($config['facebook']);	

} else {
	require_once("KongregatePlatform.php");
	$platform = new KongregatePlatform($config['kongregate']);
}

$user_id = $platform->login();
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
</head>
<?= $platform->loadLibraries(); ?>
<body>
<?= $platform->displayHeader(); ?>
<h1>Hello <?= $platform->getUserName() ?>!</h1>
<?= $platform->showPurchaseButton() ?>
<?php if ($platform->isFeatureEnabled("invites")) { ?>
<a onclick='showInvitePopup();' href="#">Invite a Friend!</a>
<?php }?>
<?= $platform->getFriends(); ?>
<?= $platform->displayFooter(); ?>
</body>