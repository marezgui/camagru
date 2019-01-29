<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php'; ?>

<?php 
	if(isset($_GET['login']) && !empty($_GET['login']) AND isset($_GET['key']) && !empty($_GET['key']))
	{
		$login = htmlspecialchars($_GET['login']);
		$restoreKey = htmlspecialchars($_GET['key']);

		if (isset($_POST['submit']))
		{
			$userManager = new UserManager();
			if ($user = $userManager->getUser($login))
			{
				if ($user['restoreKey'] == $restoreKey)
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
									$userManager->restoreKey($user['login'], NULL);
									$error = "OK";
								}
								else
									$error = "Votre mot de passe est trop court ! (6 caractères min.)";
							}
							else
								$error = "Vos mot de passes ne correspondent pas !";
						}
						else 
							$error = "Votre mot de passe ne doit pas dépasser 50 caractères !";
					}
					else 
						$error = "Les deux champs doivent être remplis.";
				}
				else 
				{
					header ('location: ../index.php'); 
					exit;
				}
			}
			else 
			{
				header ('location: ../index.php'); 
				exit;
			}
		}
	}
	else
	{
	 	header ('location: ../index.php'); 
		exit;
	}