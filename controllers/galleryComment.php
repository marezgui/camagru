<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';

function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	if (isset($_POST['newCmt']) )
	{
		$cmt = htmlspecialchars($_POST['newCmt']);
		if (!empty($cmt))
		{
			if (strlen($cmt) <= 255) 
			{	
				$id_user = $_SESSION['id'];
				$id_image = $_POST['id_img'];
				$gallery = new Gallery();
				$gallery->addComment($id_user, $id_image, $cmt);


				echo "
				<p class='cmt-user'>" . $_SESSION['login'] . "</p>
				<p class='cmt'>" . $cmt . "</p>
				<p> A l'insant </p>
				<hr>";
			}
			else 
				echo "Votre commentaire ne doit pas dépasser 255 caractères !";
		}
		else
			echo "Le champs commentaire doit être remplis.";
	}
	die();
}
