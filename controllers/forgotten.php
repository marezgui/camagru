<?php	
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/sendMail.php';

function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	if (!empty($_POST['mail']))
	{
		$mail = htmlspecialchars($_POST['mail']);
		if (strlen($mail) <= 40)
		{
			if (filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				$userManager = new userManager();
				if ($user = $userManager->mailOccurance($mail))
				{
					$restoreKey = md5(rand(0,1000));
					$userManager->restoreKey($user['login'], $restoreKey);
					if ($sendMail = confirmationMail($user['login'], $mail, $restoreKey, 0))
						echo "OK";
				}
				else
					echo "Aucun compte associé a cette adresse e-mail !";
			}
			else
				echo "Votre adresse mail n'est pas valide !";	
		}
		else 
			echo "Votre e-mail ne doit pas dépasser 40 caractères !";
	}
	else 
		echo "Le champs adresse e-mail doit être renseigné.";
	die();
}
