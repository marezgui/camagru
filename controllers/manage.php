<?php 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';

	if (isset($_SESSION['login']) AND !empty($_SESSION['login']))
	{
		$login = htmlspecialchars($_SESSION['login']);

		if (isset($_POST['submitLogin']))
		{
			if (!empty($_POST['newLogin']))
			{
				$newLogin = htmlspecialchars($_POST['newLogin']);
				if (strlen($newLogin) >= 3)
				{
					if (strlen($newLogin) <= 15) 
					{
						if (preg_match('/^[A-Z0-9]{3,15}$/i', $newLogin))
						{
							$userManager = new UserManager();
							if (!($userManager->getUser($newLogin)))
							{
								$userManager->updateLogin($login, $newLogin);
								$errorLogin = "OK";
								$_SESSION['login'] = $newLogin;
								unset($newLogin);
							}
							else 
								$errorLogin = "Pseudo déjà utilisée !";
						}
						else 
							$errorLogin = "Votre pseudo doit être composer uniquement de caractères alphanumériques ! (sans accents)";
					}
					else 
						$errorLogin = "Votre pseudo ne doit pas dépasser 15 caractères !";
				}
				else
					$errorLogin = "Votre pseudo est trop court ! (3 caractères min.)";
			}
			else 
				$errorLogin = "Le champs nouveau pseudo doit être remplis.";
		}

		if (isset($_POST['submitMail']))
		{
			if (!empty($_POST['newMail']))
			{
				$newMail = htmlspecialchars($_POST['newMail']);
				if (strlen($newMail) <= 40)
				{
					if (filter_var($newMail, FILTER_VALIDATE_EMAIL))
					{
						$userManager = new UserManager();
						if (!($userManager->mailOccurance($newMail)))
						{
							$userManager->updateMail($login, $newMail);
							$errorMail = "OK";
							$_SESSION['mail'] = $newMail;
							unset($newMail);
						}
						else 
							$errorMail = "Adresse mail déjà utilisée !";
					}
					else
						$errorMail = "Votre adresse mail n'est pas valide !";
				}
				else
					$errorMail = "Votre e-mail ne doit pas dépasser 40 caractères !";
			}
			else 
				$errorMail = "Le champs nouvel e-mail doit être renseigné.";
		}

		if (isset($_POST['submitPassword']))
		{
			if (!empty($_POST['password']) AND !empty($_POST['password2']))
			{
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
				if (strlen($password) <= 50)
				{
					if ($password == $password2)
					{
						if (strlen($password) > 5)
						{
							$password = password_hash($password, PASSWORD_DEFAULT);
							$userManager = new UserManager();
							$userManager->updatePassword($login, $password);
							$errorPassword = "OK";
						}
						else
							$errorPassword = "Votre mot de passe est trop court ! (6 caractères min.)";
					}
					else
						$errorPassword = "Vos mot de passes ne correspondent pas !";
				}
				else 
					$errorPassword = "Votre mot de passe ne doit pas dépasser 50 caractères !";
			}
			else 
				$errorPassword = "Les deux champs doivent être remplis.";
		}
		
		if (isset($_POST['submitNotifications']))
		{
			$userManager = new UserManager();
			if (isset($_POST['yes']))
			{
				$userManager->updateNotifications($_SESSION['login'], 1);
			}
			else 
				$userManager->updateNotifications($_SESSION['login'], 0);
		}
	}
	else
	{
		header ('location: ../index.php'); 
		exit;
	}