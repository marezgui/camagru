<?php
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';

function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	$userManager = new UserManager();
	if (isset($_POST['activate']))
	{
		$userManager->updateNotifications($_SESSION['login'], 1);
		$_SESSION['notifications'] = 1;
	}
	else
	{
		$userManager->updateNotifications($_SESSION['login'], 0);
		$_SESSION['notifications'] = 0;
	}
	die();
}