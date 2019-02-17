<?PHP
require 'database.php';

function setup($dbh,$dbname)
{
	$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
	$result = $dbh->exec($sql); 

	$sql = "USE ".$dbname;
	$result = $dbh->exec($sql); 

	$sql = 'CREATE TABLE IF NOT EXISTS `users` (
			`id` int(11) AUTO_INCREMENT PRIMARY KEY,
			`firstName` varchar(255) NOT NULL,
			`lastName` varchar(255) NOT NULL,
			`mail` varchar(255) NOT NULL,
			`login` varchar(255) NOT NULL,
			`password` varchar(255) NOT NULL,
			`notifications` tinyint(1) NOT NULL DEFAULT 1,
			`registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`activate` tinyint(1) DEFAULT NULL,
			`confirmKey` varchar(255) NOT NULL,
			`restoreKey` varchar(255) DEFAULT NULL
		);
			INSERT INTO `users` (`id`, `firstName`, `lastName`, `mail`, `login`, `password`, `notifications`, `registrationDate`, `activate`, `confirmKey`, `restoreKey`) VALUES
			(1, "Rezgui", "Malek", "m.rezgui12@gmail.com", "marezgui", "$2y$10$YImWH8WPvzktL4WahZbxAOjxbHRWHyquWibbMQggw2wP7rwXSvz/u", 1, "2019-01-27 00:00:00", 1, "777", NULL);';

	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `images` (
			`id` int(11) AUTO_INCREMENT PRIMARY KEY,
			`id_user` int(255) NOT NULL,
			`path` varchar(255) NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		);";
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `comments` (
			`id` int(11) AUTO_INCREMENT PRIMARY KEY,
			`id_user` int(11) NOT NULL,
			`id_image` int(11) NOT NULL,
			`comment` text NOT NULL,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)";
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `likes` (
			`id` int(11) AUTO_INCREMENT PRIMARY KEY,
			`id_user` int(11) NOT NULL,
			`id_image` int(11) NOT NULL
		);";
	$result = $dbh->exec($sql); 
}

$DSN = "mysql:host=" . $DB_HOST;
$db = new PDO($DSN, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
setup($db, $DB_NAME);
echo 'setup completed'.PHP_EOL;