<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Manager.php';

class Gallery extends Manager
{
	function addImages($id_user, $path)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO images(id_user, path) VALUES (?, ?)');
	    $req->execute(array($id_user, $path));
	}

	function getImages()
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT images.id, images.path, users.login, DATE_FORMAT(images.date, \'%Hh%i le %d/%m/%Y\') AS date FROM images INNER JOIN users ON images.id_user = users.id ORDER BY images.date DESC');
	    $req->execute();
	    $img = $req->fetchAll(PDO::FETCH_ASSOC);

	    return $img;
	}

	function getImage($id_image)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT images.id, images.path, users.login, DATE_FORMAT(images.date, \'%Hh%i le %d/%m/%Y\') AS date FROM images INNER JOIN users ON images.id_user = users.id WHERE images.id = ?');
	    $req->execute(array($id_image));
	    $img = $req->fetchAll(PDO::FETCH_ASSOC);

	    return $img;
	}

	function getLikes($id_image)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT COUNT(id) FROM likes WHERE id_image = ?');
	    $req->execute(array($id_image));
	    $likes = $req->fetch(PDO::FETCH_NUM);

	    return $likes[0];
	}

	function getComments($id_image)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT comments.id, comments.comment, users.login, DATE_FORMAT(comments.date, \'%d/%m/%Y à %Hh%i\') AS date FROM comments INNER JOIN users ON comments.id_user = users.id WHERE id_image = ? ORDER BY comments.date DESC');
	    $req->execute(array($id_image));
	    $comments = $req->fetchAll(PDO::FETCH_ASSOC);

	    return $comments;
	}

	function getNbComments($id_image)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT COUNT(id) FROM comments WHERE id_image = ?');
	    $req->execute(array($id_image));
	    $nbCom = $req->fetch(PDO::FETCH_NUM);

	    return $nbCom[0];
	}

	function addLike($id_user, $id_image)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO likes(id_user, id_image) VALUES (?, ?)');
	    $req->execute(array($id_user, $id_image));
	}

	function delLike($id_user, $id_image)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('DELETE FROM likes WHERE id_user = 1 AND id_image = 3 LIMIT 1');
	    $req->execute(array($id_user, $id_image));
	}
}

