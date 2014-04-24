<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

if (isset($_GET['image'])) {
	session_start();

	$str = '';
	$buchstaben = 'abcdefghijkmnpqrstuvwxyz23456789';
	$buchstabenzahl = strlen($buchstaben) - 1;
	for ($i = 1; 4 >= $i; $i++) {
		$str .= $buchstaben{rand(0,$buchstabenzahl)} . ' ';
	}
	$_SESSION['sicherheitscode'] = str_replace(' ', '', $str);

	$pic = ImageCreateFromGIF('images/captcha.gif');
	$color = ImageColorAllocate ($pic, 200, 47, 9);
	ImageTTFText($pic, 22, 1, 18, 30, $color, 'images/font.TTF', $str);
	imageline($pic, 20, 25, 90, 32, $color);
	header('Content-type: image/gif');
	ImageGIF($pic);
	ImageDestroy($pic);
	exit;
}

require 'base.php';

function userExists($username) {
	global $db;

	$res = $db->query("
		SELECT * 
		FROM browser_user 
		WHERE username = '" . $db->chars($username) . "'
	");
	$row = $db->fetch_object($res);

	return $row;
}

$error = '';

if (isset($_POST['submit'])) {

	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$email = isset($_POST['mail']) ? $_POST['mail'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

	if (!$username) {

		$error = 'Du hast den Benutzernamen vergessen!';

	} else if (!preg_match('/^[a-zA-Z0-9-_.]+$/i', $username)) {

		$error = 'Der Benutzername darf nur aus Buchstaben, Zahlen, Bindestrichen, Unterstrichen und Punkten bestehen!';

	} else if (strlen($username) < 3) {

		$error = 'Der Benutzername muss mindestens 3 Zeichen lang sein!';

	} else if (strpos($email, '@') === false || strpos($email, '.') === false) {

		$error = 'Bitte gib eine gültige E-Mail an.';

	} else if (!$password || strlen($password) < 6) {

		$error = 'Das Passwort muss mindestens 6 Zeichen lang sein.';

	} else if ($password != $password2) {

		$error = 'Die Passwörter sind nicht gleich, bitte überprüfe sie.';

	} else if($_POST['sicherheitscode'] != $_SESSION['sicherheitscode']) {

		$error = 'Bitte gib den richtigen Sicherheitscode an.';

	} else if (userExists($username)) {

		$error = 'Den Benutzernamen gibt es schon in der Community!';

	} else {
		$db->query("
			INSERT INTO browser_user 
			(username, user_dorf, user_passwort, user_email)
			VALUES 
			('" . $db->chars($username) . "', '" . $db->chars($username) . "s Dorf', '" . $db->chars(md5($password)) . "', '" . $db->chars($email) . "')
		");

		mail(
			$email,
			'Anmeldung im Browsergame',
			"Willkommen in unsererem Browsergame!\nDeine Zugangsdaten lauten wie folgt:\n\nBenutzername: " . $username . "\nPasswort: " . $password . "\n\nWir wünschen dir noch viel Spaß.",
			'From: ' . $admin_mail
		);

		unset($_SESSION['sicherheitscode']);

		message_box('Der neue Benutzer wurde erfolgreich angelegt!<br><br><a class="user" href="login.php">Klicke hier</a>, um zum Login zu kommen!');
	}
}

$tpl->assign('ERROR', $error);
$tpl->display('register.tpl');

?>