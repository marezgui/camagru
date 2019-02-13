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
		);
		INSERT INTO `images` (`id`, `id_user`, `path`, `date`) VALUES
		(7, 1, '5c63c37060ff8.png', '2019-02-13 08:12:48'),
		(8, 1, '5c63c3ad51985.png', '2019-02-13 08:13:49');";
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
		);
		INSERT INTO `likes` (`id`, `id_user`, `id_image`) VALUES
		(70, 1, 8),
		(71, 1, 8),
		(72, 1, 8),
		(73, 1, 8),
		(74, 1, 8),
		(75, 1, 8),
		(76, 1, 8),
		(77, 1, 8),
		(78, 1, 8),
		(79, 1, 8),
		(80, 1, 8),
		(81, 1, 8),
		(82, 1, 8),
		(83, 1, 8),
		(84, 1, 8),
		(85, 1, 8),
		(86, 1, 8),
		(87, 1, 8),
		(88, 1, 8),
		(89, 1, 8),
		(90, 1, 8),
		(91, 1, 8),
		(92, 1, 8),
		(93, 1, 8),
		(94, 1, 8),
		(95, 1, 8),
		(96, 1, 8),
		(97, 1, 8),
		(98, 1, 8),
		(99, 1, 8),
		(100, 1, 8),
		(101, 1, 8),
		(102, 1, 8),
		(103, 1, 8),
		(104, 1, 8),
		(105, 1, 8),
		(106, 1, 8),
		(107, 1, 8),
		(108, 1, 8),
		(109, 1, 8),
		(110, 1, 8),
		(111, 1, 8),
		(112, 1, 8);";
	$result = $dbh->exec($sql); 
}

$DSN = "mysql:host=" . $DB_HOST;
$db = new PDO($DSN, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
setup($db, $DB_NAME);
echo 'setup completed'.PHP_EOL;