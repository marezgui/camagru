<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Manager.php';

class UserManager extends Manager
{
	function mailOccurance($mail)
	{
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT * FROM users WHERE mail = ?');
	    $req->execute(array($mail));
	    $user = $req->fetch(PDO::FETCH_ASSOC);

	    return $user;
	}

	function newUser($firstName, $lastName, $mail, $login, $password, $confirmKey)
	{
		$db = $this->dbConnect();
	    $user = $db->prepare('INSERT INTO users(firstName, lastName, mail, login, password, confirmKey) VALUES (?, ?, ?, ?, ?, ?)');
	    $addedUser = $user->execute(array($firstName, $lastName, $mail, $login, $password, $confirmKey));

	    return $addedUser;
	}

	function getUser($login)
	{
	    $db = $this->dbConnect();
	    $req = $db->prepare('SELECT * FROM users WHERE login = ?');
	    $req->execute(array($login));
	    $user = $req->fetch(PDO::FETCH_ASSOC);

	    return $user;
	}

	function activateUser($login, $confirmKey)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE users SET activate = ? WHERE login = ?');
	    $req->execute(array(1, $login));

	    return 1;
	}

	function logOnUser($login, $password)
	{
		$user = $this->getUser($login);
		if ($user)
		{
			if (password_verify($password, $user['password']))
				return $user;
		}
		else
			return 0;
	}

	function updateLogin($login, $newLogin)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE users SET login = ? WHERE login = ?');
		$req->execute(array($newLogin, $login));

		return 1;
	}

	function updateMail($login, $newMail)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE users SET mail = ? WHERE login = ?');
		$req->execute(array($newMail, $login));

		return 1;
	}

	function updatePassword($login, $newPassword)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE users SET password = ? WHERE login = ?');
		$req->execute(array($newPassword, $login));

		return 1;
	}

	function restoreKey($login, $restoreKey)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE users SET restoreKey = ? WHERE login = ?');
		$req->execute(array($restoreKey, $login));

		return 1;
	}
}