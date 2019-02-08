<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';


function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	$login = htmlspecialchars($_POST['login']);
	$password = $_POST['password'];
	if (!empty($login) AND !empty($password))
	{
		$userManager =  new UserManager();
		if ($user = $userManager->logOnUser($login, $password))
		{
			if ($user['activate'] == 1)
			{
				$_SESSION['id'] = $user['id'];
				$_SESSION['firstName'] = $user['firstName'];
				$_SESSION['lastName'] = $user['lastName'];
				$_SESSION['mail'] = $user['mail'];
				$_SESSION['login'] = $user['login'];
				$_SESSION['registrationDate'] = $user['registrationDate'];
				echo "1";
			}
			else
				echo "Votre compte n'est pas activé";
		}
		else 
			echo "Mauvais mail ou mot de passe.";
	}
	else
		echo "Tous les champs doivent être remplis.";
	die();
}