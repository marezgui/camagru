<?php 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';

function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	if (isset($_SESSION['login']) AND !empty($_SESSION['login']))
	{
		$login = htmlspecialchars($_SESSION['login']);

	/*--*/
		if (isset($_POST['newLogin']))
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
									$_SESSION['login'] = $newLogin;
									echo "Pseudo modifié !";
								}
								else 
									echo "Pseudo déjà utilisée !";
							}
							else 
								echo "Votre pseudo doit être composer uniquement de caractères alphanumériques ! (sans accents)";
						}
						else 
							echo "Votre pseudo ne doit pas dépasser 15 caractères !";
					}
					else
						echo "Votre pseudo est trop court ! (3 caractères min.)";
				}
				else 
					echo "Le champs nouveau pseudo doit être remplis.";
		}

	/*--*/
		if (isset($_POST['newMail']))
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
								$_SESSION['mail'] = $newMail;
								echo "E-mail modifié !";
							}
							else 
								echo "Adresse mail déjà utilisée !";
						}
						else
							echo "Votre adresse mail n'est pas valide !";
					}
					else
						echo "Votre e-mail ne doit pas dépasser 40 caractères !";
				}
				else 
					echo "Le champs nouvel e-mail doit être renseigné.";
		}

	/*--*/
		if (isset($_POST['password']))
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
							if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])./', $password))
							{
								$password = password_hash($password, PASSWORD_DEFAULT);
								$userManager = new UserManager();
								$userManager->updatePassword($login, $password);
								echo "Mot de passe modifié !";
							}
							else 
								echo "Votre mot de passe doit au moins contenir une lettre en minuscule, une lettre en majuscule et un chiffre.";
						}
						else
							echo "Votre mot de passe est trop court ! (6 caractères min.)";
					}
					else
						echo "Vos mot de passes ne correspondent pas !";
				}
				else 
					echo "Votre mot de passe ne doit pas dépasser 50 caractères !";
			}
			else 
				echo "Les deux champs doivent être remplis.";
		}
	}
	die();
}