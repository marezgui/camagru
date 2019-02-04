<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';

/*---------------------------LIKE------------------------------------*/
function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest'));
}

if (isAjax())
{
	if (isset($_POST['like']) && !empty($_POST['like']))
	{
		if (isset($_SESSION['login']))
		{
			$id_user = $_SESSION['id'];
			if (isset($_POST['id_img']) && !empty($_POST['id_img']))
			{
				$gallery = new Gallery();
				$id_img = $_POST['id_img'];
				if ($gallery->getImage($id_img))
				{
					if(!($likeStatus = $gallery->likeStatus($id_user, $id_img)))
					{
						$gallery->addLike($id_user, $id_img);
					}
					else 
					{
						$gallery->delLike($id_user, $id_img);
					}
				}
			}
		}
	}
	if ($likeStatus)
		echo "<i class='far fa-heart' ></i> " . $gallery->getLikes($id_img);
	else 
		echo "<i class='fas fa-heart' ></i> " . $gallery->getLikes($id_img);
	die();
}