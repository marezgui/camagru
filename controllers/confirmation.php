<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php'; ?>

<?php 
	if(isset($_GET['login']) && !empty($_GET['login']) AND isset($_GET['key']) && !empty($_GET['key']))
	{
		$login = htmlspecialchars($_GET['login']);
		$confirmKey = htmlspecialchars($_GET['key']);

		$userManager = new UserManager();
		if ($user = $userManager->getUser($login))
		{
			if ($user['activate'] == 1 AND $user['confirmKey'] == $confirmKey)
			{
				$msg = "Votre compte a déjà été activé.";
			}
			else if ($user['activate'] == 0 AND $user['confirmKey'] == $confirmKey)
			{
				$userManager->activateUser($login, $confirmKey);
				$msg = "Votre compte a bien été activé.";
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
	else
	{
	 	header ('location: ../index.php'); 
		exit;
	}