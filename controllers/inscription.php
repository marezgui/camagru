 <?php 
 	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
 	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';
 	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/sendMail.php';

	if (isset($_POST['submit']))
	{
		$firstName = htmlspecialchars($_POST['firstName']);
		$lastName = htmlspecialchars($_POST['lastName']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$login = htmlspecialchars($_POST['login']);
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		if (!empty($_POST['firstName']) AND !empty($_POST['lastName']) AND !empty($_POST['mail']) AND !empty($_POST['login']) 
			AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['mail2']))
		{
			$loginLength = strlen($login);
			if (strlen($firstName) <= 15 AND strlen($lastName) <= 15 AND strlen($mail) <= 40 AND strlen($login) <= 15 AND strlen($password) <= 50)
			{
				if (preg_match('/^[A-Z][A-Z]*(?:-[A-Z]+)*$/i', $firstName) AND preg_match('/^[A-Z][A-Z]*(?:-[A-Z]+)*$/i', $lastName)
					AND strlen($firstName) >= 2 AND strlen($lastName) >= 2)
				{
					if (strlen($login) >= 3)
					{
						if (preg_match('/^[A-Z0-9]{3,15}$/i', $login))
						{
							if ($mail == $mail2)
							{
								if (filter_var($mail, FILTER_VALIDATE_EMAIL))
								{
									$userManager = new UserManager();
									if (!($userManager->mailOccurance($mail)))
									{
										if (!($userManager->getUser($login)))
										{
											if ($password == $password2)
											{
												if (strlen($password) > 5)
												{
													if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])./', $password))
													{
														$password = password_hash($password, PASSWORD_DEFAULT);
														$confirmKey = md5(rand(0,1000));
														$userManager->newUser(strtolower($firstName), strtolower($lastName), strtolower($mail), strtolower($login), $password, $confirmKey);
														$sendMail = confirmationMail(strtolower($login), $mail, $confirmKey, 1);
													}
													else 
														$error = "Votre mot de passe doit au moins contenir une lettre en minuscule, une lettre en majuscule et un chiffre.";
												}
												else
													$error = "Votre mot de passe est trop court ! (6 caractères min.)";
											}
											else
												$error = "Vos mot de passes ne correspondent pas !";
										}
										else
											$error = "Pseudo déjà utilisée !";
									}
									else
										$error = "Adresse mail déjà utilisée !";	
								}
								else
									$error = "Votre adresse mail n'est pas valide !";
							}
							else
								$error = "Vos adresses mail ne correspondent pas !";
						}
							else 
								$error = "Votre pseudo doit être composer uniquement de caractères alphanumériques ! (sans accents)";
					}
					else
						$error = "Votre pseudo est trop court ! (3 caractères min.)";
				}
					else 
						if (strlen($firstName) < 2)
							$error = "Votre prenom doit être composer d'au moins 2 lettres.";
						else if (strlen($lastName) < 2)
							$error = "Votre nom doit être composer d'au moins 2 lettres.";
						else if (!preg_match('/^[A-Z][A-Z]*(?:-[A-Z]+)*$/i', $firstName))
							$error = "Votre prenom doit contenir uniquemet des caractères alphabétique (sans accents), le '-' est autoriser pour les noms composer";
						else 
							$error = "Votre nom doit contenir uniquemet des caractères alphabétique (sans accents), le '-' est autoriser pour les noms composer";
			}
			else
				if (strlen($firstName) > 15) 
					$error = "Votre prénom ne doit pas dépasser 15 caractères !";
				else if (strlen($lastName) > 15) 
					$error = "Votre nom ne doit pas dépasser 15 caractères !";
				else if (strlen($login) > 15) 
					$error = "Votre pseudo ne doit pas dépasser 15 caractères !";
				else if (strlen($mail) > 40)
					$error = "Votre e-mail ne doit pas dépasser 40 caractères !";
				else
					$error = "Votre mot de passe ne doit pas dépasser 50 caractères !";
		}
		else
			$error = "Tous les champs doivent être remplis.";
	}
?>

