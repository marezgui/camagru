<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';

	if (isset($_POST['submit']))
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
					header ('location: ../index.php'); 
					exit;
				}
				else
					$error = "Votre compte n'est pas activé";
			}
			else 
				$error = "Mauvais mail ou mot de passe.";
		}
		else
			$error = "Tous les champs doivent être remplis.";
	}