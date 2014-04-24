<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

if (!$user_row) {
	header('Location: login.php');
	exit;
} else if (!in_array($user_row->user_id, $adminid)) {
	message_box('Du bist dazu nicht berechtigt!');
}

$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

switch ($mode) {

	case 'delete':
		$user_id = (int)$_GET['id'];
		if (empty($_GET['ok'])) {
			message_box('Willst du den Benutzer wirklich löschen?<br /><br /><a class="user" href="admin.php?mode=delete&id=' . $user_id . '&ok=1">Ja</a> <a class="user" href="admin.php?mode=members">Abbrechen</a>');
		}

		$db->query('
			DELETE FROM browser_user 
			WHERE user_id = ' . $user_id
		);

		message_box('Der User wurde gelöscht!<br /><br /><a class="user" href="admin.php">Klicke hier</a>, um zum Adminpanel zurückzukehren');

	break;

	case 'entsperren':

		$db->query('
			UPDATE browser_user 
			SET user_sperren = 0 
			WHERE user_id = ' . (int)$_GET['id']
		);
		message_box('Der User wurde entsperrt!<br /><br /><a class="user" href="dorf.php?id=' . (int)$_GET['id'] . '">Klicke hier</a>, um zum Profil zurückzukehren');

	break;

	case 'sperren':

		$db->query('
			UPDATE browser_user 
			SET user_sperren = 1 
			WHERE user_id = ' . (int)$_GET['id']
		);
		message_box('Der User wurde gesperrt!<br /><br /><a class="user" href="dorf.php?id=' . (int)$_GET['id'] . '">Klicke hier</a>, um zum Profil zurückzukehren');

	break;

	case 'mahn':

		$db->query('
			UPDATE browser_user 
			SET user_mahnung = user_mahnung + 1  
			WHERE user_id = ' . (int)$_GET['id']
		);
		message_box('Der User hat eine Mahnung erhalten!<br /><br /><a class="user" href="dorf.php?id=' . (int)$_GET['id'] . '">Klicke hier</a>, um zum Profil zurückzukehren');

	break;

	case 'edit':

		if (!isset($_POST['submit'])) {
			$res = $db->query('
				SELECT * 
				FROM browser_user 
				WHERE user_id = ' . (int)$_GET['id']
			);
			$row = $db->fetch_object($res);

			if (!$row) {
				message_box('Der Benutzer existiert nicht!');
			}

			$tpl->assign(array(
				'USER_ID'		=>	$row->user_id,
				'USERNAME'		=>	htmlspecialchars($row->username),
				'EMAIL'			=>	htmlspecialchars($row->user_email),
				'DORF'			=>	htmlspecialchars($row->user_dorf),
				'AVATAR'		=>	htmlspecialchars($row->user_avatar),
				'BESCHREIBUNG'	=>	htmlspecialchars($row->user_beschreibung),
				'PUNKTE'		=>	$row->user_punkte,
				'MAHNUNG'		=>	$row->user_mahnung,
				'SPERREN'		=>	$row->user_sperren
			));
			$tpl->display('admin_edit.tpl');
		} else {

			$sperren = (isset($_POST['sperren']) && $_POST['sperren'] == 1) ? 1 : 0;

			$db->query("
				UPDATE browser_user 
				SET username = '" . $db->chars($_POST['name']) . "', 
					user_sperren = " . $sperren . ", 
					user_mahnung = '" . $db->chars($_POST['mahnung']) . "', 
					user_email = '" . $db->chars($_POST['email']) . "', 
					user_avatar = '" . $db->chars($_POST['avatar']) . "', 
					user_beschreibung = '" . $db->chars($_POST['beschreibung']) . "', 
					user_punkte = '" . $db->chars($_POST['punkte']) . "', 
					user_dorf = '" . $db->chars($_POST['dorf']) . "' 
				WHERE user_id = " . (int)$_POST['id']
			);

			if ($_POST['password'] == $_POST['password2']) {
				$db->query("
					UPDATE browser_user 
					SET user_passwort = '" . $db->chars(md5($_POST['password'])) . "' 
					WHERE user_id = " . (int)$_POST['id']
				);
			}
			message_box('Die Daten wurde erfolgreich geändert!<br /><br /><a class="user" href="admin.php?mode=edit&id=' . (int)$_POST['id'] . '">Klicke hier</a>, um zum Adminpanel zurückzukehren');
		}

	break;

	case 'members':

		$pages = isset($_GET['page']) ? $_GET['page'] : 1;
		$perpage = 20;
		$abeintrag = $pages * $perpage - $perpage;

		$res = $db->query('
			SELECT * 
			FROM browser_user 
			ORDER BY user_id ASC 
			LIMIT ' . $abeintrag . ', ' . $perpage
		);
		while ($row = $db->fetch_object($res)) {
			$tpl->block_assign('members', array(
				'USER_ID'	=>	$row->user_id,
				'USERNAME'	=>	htmlspecialchars($row->username),
				'EMAIL'		=>	htmlspecialchars($row->user_email),
				'PUNKTE'	=>	$row->user_punkte
			));
		}

		$seite = 1;
		$anhang = '';
		$seiteview = '';
		$res = $db->query('
			SELECT COUNT(*) AS num 
			FROM browser_user
		');
		$row = $db->fetch_object($res);

		$anzahl = $row->num;
		$seitengesamt = ceil($anzahl/20);

		for ($i = 1; $i <= $seitengesamt; $i++) {
			if (($seite <= 3) || ($seite >= $seitengesamt-2) || ($seite >= $pages-1) && ($seite <= $pages+1)) {
				$seiteview .= ($seite == $pages) ? $anhang . '<a class="hide">' . $seite . '</a> ' : $anhang . '<a href="admin.php?mode=members&page=' . $seite . '">' . $seite . '</a> ';
				$anhang = '';
			} else {
				$anhang = ' ... ';
			}
			$seite++;
		}

		$tpl->assign('SEITEVIEW', $seiteview);
		$tpl->display('admin_members.tpl');

	break;

	case 'mail':
		if (empty($_POST['betreff']) || empty($_POST['text']) ) {
			$tpl->display('admin_mail.tpl');
		} else {
			$bbcodes = (isset($_POST['bbcodes']) && $_POST['bbcodes'] == 1) ? 0 : 1;
			$smilies = (isset($_POST['smilies']) && $_POST['smilies'] == 1) ? 0 : 1;

			$sql = '';
			$res = $db->query('
				SELECT * 
				FROM browser_user
			');
			while ($row = $db->fetch_object($res)) {
				$sql .= ($sql) ? ', ' : '';
				$sql .= "('" . $db->chars($_POST['text']) . "', '" . $db->chars($_POST['betreff']) . "', " . $row->user_id . ', ' . time() . ', 0, ' . $bbcodes . ', ' . $smilies . ')';
			}

			$db->query('
				INSERT INTO browser_mail 
				(mail_text, mail_betreff, user_id_an, mail_time, mail_signatur, mail_bbcodes, mail_smilies) 
				VALUES ' . $sql
			);

			message_box('Die Nachricht wurde verschickt!<br /><br /><a href="admin.php?mode=mail" class="user">Klicke hier</a>, um zum Nachricht schreiben zurückzukehren');
		}

	break;

	default:

		$error = '';

		if (!empty($_POST['user'])) {
			$res = $db->query("
				SELECT user_id 
				FROM browser_user 
				WHERE username = '" . $db->chars($_POST['user']) . "'
			");
			$row = $db->fetch_object($res);

			if ($row) {
				header('Location: admin.php?mode=edit&id=' . $row->user_id);
				exit;
			} else {
				$error = 'Kein User gefunden';
			}
		}

		$tpl->assign('ERROR', $error);
		$tpl->display('admin_index.tpl');

	break;

}

?>