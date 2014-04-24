<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

if (isset($_GET['logout'])) {

	$db->query('
		UPDATE browser_user 
		SET user_online = 0 
		WHERE user_id = ' . $user_row->user_id
	);
	unset($_SESSION['user']);
	header('Location: index.php');
	exit;

} else if (isset($_GET['forgot'])) {

	$error = '';

	if (isset($_POST['send'])) {

		$res = $db->query("
			SELECT * 
			FROM browser_user 
			WHERE username = '" . $db->chars($_POST['user']) . "' 
				AND user_email = '" . $db->chars($_POST['email']) . "'
		");
		$row = $db->fetch_object($res);

		if (!$row) {
			$error = 'Email und Benutzername stimmen nicht überein.';
		} else {
			$hostname = $_SERVER['HTTP_HOST'];
			$path = dirname($_SERVER['PHP_SELF']);

			mail(
				$row->user_email,
				"Dörferspiel - Passwort anfordern!",
				"Hallo " . $row->username . ",\n\ndu hast ein neues Passwort angefordert.\nKlicke auf den folgenden Link um dein neues Passwort zu bestätigen:\n\nhttp://" . $hostname . ($path == '/' ? '' : $path) . "/login.php?set=" . $row->user_id . "&alt=" . $row->user_passwort . "\n\nAnschließend erhältst du eine Email mit deinem neuen Passwort.\n\nWir wünschen dir noch viel Spaß beim Surfen.\n\n--\nmailto: " . $admin_mail,
				"From: " . $admin_mail
			);
			message_box('Du hast eine Email erhalten mit den weiteren Schritten zu deinem neuen Passwort.<br /><br /><a href="login.php"><u>Klicke hier</u></a>, um zum Login zu kommen');
		}
	}

	$tpl->assign('ERROR', $error);
	$tpl->display('password_forget.tpl');

} else if (isset($_GET['set'])) {

	$res = $db->query("
		SELECT * 
		FROM browser_user 
		WHERE user_id = '" . $db->chars($_GET['set']) . "' 
			AND user_passwort = '" . $db->chars($_GET['alt']) . "'
	");
	$row =  $db->fetch_object($res);

	if ($row) {
		$passwort = rand(100000, 999999);
		$db->query("
			UPDATE browser_user 
			SET user_passwort = '" . $db->chars(md5($passwort)) . "' 
			WHERE user_id =  " . $row->user_id
		);

		mail(
			$row->user_email,
			"Dörferspiel - Neues Passwort!",
			"Hallo " . $row->username . ",\n\ndein neues Passwort wurde gespeichert!\nDeine neuen Zugangsdaten lauten:\n\nBenutzername: " . $row->username . "\nPasswort: " . $passwort . "\n\nWir wünschen dir noch viel Spaß beim Surfen.\n--\nmailto: " . $admin_mail,
			"From: " . $admin_mail
		);

		message_box('Soeben wurde ein neues Passwort an deine Email versendet.<br /><br /><a href="login.php"><u>Klicke hier</u></a>, um zum Login zu kommen');
	} else {
		message_box('Es ist ein Fehler aufgetreten!');
	}

} else {

	$error = '';

	if (isset($_POST['submit'])) {
		$res = $db->query("
			SELECT * 
			FROM browser_user 
			WHERE username = '" . $db->chars($_POST['username']) . "'
		");
		$row = $db->fetch_object($res);

		$password = isset($_POST['password']) ? $_POST['password'] : '';

		if (empty($_POST['username'])) {
			$error = 'Bitte gib einen Benutzernamen an!';
		} else if (!$password) {
			$error = 'Bitte gib ein Passwort an!';
		} else if(!$row || md5($password) != $row->user_passwort) {
			$error = 'Der Benutzername oder das Passwort ist falsch.';
		} else {
			if($_POST['speichern']) {
				setCookie('bid', $row->user_id, time()+60*60*24*7);
				setCookie('bpasswort', $row->user_passwort, time()+60*60*24*7);
			}

			$_SESSION['user'] = $row->username;
			header('Location: view.php');
			exit;
		}
	}

	$tpl->assign('ERROR', $error);
	$tpl->display('login.tpl');
}

?>