<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

if (!$user_row) {
	header('Location: login.php');
	exit;
}

$avatar = $user_row->user_avatar;
$error = '';

if (isset($_POST['submit'])) {

	if ($_FILES['bild']['name'] || $_POST['avatar']) {

		if ($_FILES['bild']['name']) {
			$file = $_FILES['bild']['tmp_name'];
			$avatar_array = explode('.', $_FILES['bild']['name']);
		} else {
			$file = $_POST['avatar'];
			$avatar_array = explode('.', $file);
		}

		$avatar_format = strtolower($avatar_array[(count($avatar_array) - 1)]);
		$error = 0;

		if (!in_array($avatar_format, array('jpg', 'gif', 'jpeg', 'png', 'bmp'))) {
			$error = 5;
		} else {
			$groesse = @getimagesize($file);

			if (!isset($groesse[0])) {
				$error = 5;
			} else if ($groesse[0] > 130 || $groesse[1] > 160) {
				$error = 6;
			} else {
				$avatar = 'avatar/' . $user_row->user_id . '_' . rand(1000000, 9999999) . '.' . $avatar_format;

				if ($_FILES['bild']['name']) {
					if (filesize($file) > 71020) {
						$error = 4;
					} else if (!@move_uploaded_file($file, $avatar)) {
						$error = 3;
					}
				} else if ($_POST['avatar']) {
					if (!@copy($file, $avatar)) {
						$error = 3;
					} else if (filesize($avatar) > 71020) {
						@unlink($avatar);
						$error = 4;
					}
				}
			}
		}

		if($error != 0) {
			$avatar = $user_row->user_avatar;
		} else if ($avatar != $user_row->user_avatar) {
			@unlink($user_row->user_avatar);
		}

	} else if (isset($_POST['del'])) {
		$avatar = '';
		@unlink($user_row->user_avatar);
	}

	if ($error == 6) {
		$error = 'Der Avatar ist breiter als 130 oder höher als 160 Pixel.';
	} else if ($error == 5) {
		$error = 'Das Format von dem Avatar ist nicht erlaubt!';
	} else if ($error == 4) {
		$error = 'Der Avatar ist über 150 KB groß.';
	} else if ($error == 3) {
		$error = 'Der Avatar konnte nicht hochgeladen werden!';
	} else if ($error == 2) {
		$error = 'Die Passwörter sind nicht gleich.';
	} else if ($error == 1) {
		$error = 'Das alte Passwort stimmt nicht.';
	} else if (!$_POST['email']) {
		$error = 'Du musst eine E-Mail eingeben.';
	} else if (!$_POST['dorf']) {
		$error = 'Du musst einen Dorfnamen eingeben.';
	} else {

		if (!empty($_POST['password'])) {
			if ($_POST['password'] != $_POST['password2']) {
				$error = 'Die Passwörter sind nicht gleich!';
			} else {
				if ($_POST['password'] && $_POST['password'] == $_POST['password2']) {
					$db->query("
						UPDATE browser_user 
						SET user_passwort = '" . $db->chars(md5($_POST['password'])) . "' 
						WHERE user_id = " . $user_row->user_id
					);
				}
			}
		}

		$user_row->user_signatur_smilies = (isset($_POST['smilies']) && $_POST['smilies'] == 1) ? 0 : 1;
		$user_row->user_signatur_bbcodes = (isset($_POST['bbcodes']) && $_POST['bbcodes'] == 1) ? 0 : 1;
		$user_row->user_beschreibung = $_POST['beschreibung'];
		$user_row->user_dorf = $_POST['dorf'];
		$user_row->user_email = $_POST['email'];

		$db->query("
			UPDATE browser_user 
			SET 	user_signatur_smilies = '" . $user_row->user_signatur_smilies . "', 
					user_signatur_bbcodes = '" . $user_row->user_signatur_bbcodes . "', 
					user_beschreibung = '" . $db->chars($user_row->user_beschreibung) . "', 
					user_avatar = '" . $db->chars($avatar) . "', 
					user_dorf = '" . $db->chars($user_row->user_dorf) . "', 
					user_email = '" . $db->chars($user_row->user_email) . "' 
			WHERE user_id = " . $user_row->user_id
		);

		$error = 'Die Daten wurden gespeichert!';
	}
}

$tpl->assign(array(
	'ERROR'			=>	$error,
	'CHECKEDS'		=>	$user_row->user_signatur_smilies,
	'CHECKEDBB'		=>	$user_row->user_signatur_bbcodes,
	'EMAIL'			=>	htmlspecialchars($user_row->user_email),
	'BESCHREIBUNG'	=>	htmlspecialchars($user_row->user_beschreibung),
	'DORF'			=>	htmlspecialchars($user_row->user_dorf),
	'USERNAME'		=>	htmlspecialchars($user_row->username),
	'AVATAR'		=>	htmlspecialchars($avatar)
));
$tpl->display('userdaten.tpl');

?>