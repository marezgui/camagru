<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserManager.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/sendMail.php';
	date_default_timezone_set('Europe/Paris');

function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	if (isset($_POST['newCmt']) )
	{
		$cmt = nl2br(trim(htmlspecialchars($_POST['newCmt'])));
		if (!empty($cmt))
		{
			if (strlen($cmt) <= 500) 
			{	
				$id_user = $_SESSION['id'];
				$id_image = $_POST['id_img'];
				$gallery = new Gallery();
				$gallery->addComment($id_user, $id_image, $cmt);

				echo "
				<p class='cmt-user'>" . $_SESSION['login'] . "</p>
				<p class='cmt'>" . $cmt . "</p>
				<p> ". date("d/m/Y \à H\hi ") . "</p>
				<hr>";

				$image = $gallery->getImage($id_image);
				$login = $image['login'];
				
				$userManager = new UserManager();
				$user = $userManager->getUser($login);

				if ($user['notifications'] && ($_SESSION['login'] != $user['login']))
				{
					confirmationMail($login, $user['mail'], 0, 2);
				}
			}
			else 
				echo "Votre commentaire ne doit pas dépasser 500 caractères !";
		}
		else
			echo "Le champs commentaire doit être remplis.";
	}
	die();
}
