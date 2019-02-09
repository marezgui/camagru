<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php'; ?>

<?php 

function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	if(isset($_POST['login']) && !empty($_POST['login']) AND isset($_POST['key']) && !empty($_POST['key']))
	{
		$login = htmlspecialchars($_POST['login']);
		$restoreKey = htmlspecialchars($_POST['key']);

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
								if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])./', $password))
								{
									$password = password_hash($password, PASSWORD_DEFAULT);
									$userManager = new UserManager();
									$userManager->updatePassword($login, $password);
									$userManager->restoreKey($user['login'], NULL);
									echo "OK";
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
			else 
				echo "error";
		}
		else 
			echo "error";
	}
	else
	 	echo "error";
	die();
}