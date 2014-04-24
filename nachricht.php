<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

if (!$user_row) {
	header('Location: login.php');
	exit;
}

$ordner = (isset($_GET['ordner']) && $_GET['ordner'] == 2) ? 2 : 1;
$ordner_query = ($ordner == 2) ? 'user_id_von' : 'user_id_an';
$res = $db->query("
	SELECT COUNT(*) AS num
	FROM browser_mail 
	WHERE " . $ordner_query . ' = ' . $user_row->user_id
);
$row = $db->fetch_object($res);
$gesamt = $row->num;

$ordner_stats = 'Ordner ist zu ' . round($gesamt/200*100, 0) . '% voll. (' . $gesamt . ' von 200 Nachrichten)';
$ordner_name = ($ordner == 1) ? 'Posteingang' : 'Gesendete Nachrichten';

$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

switch ($mode) {

	case 'delete':

		function displayMessage($text) {
			global $ordner, $ordner_name;

			message_box('<meta http-equiv="refresh" content="3; URL=nachricht.php?ordner=' . $ordner . '"><br />' . $text . '<br /><br /><a class="user" href="nachricht.php?ordner=' . $ordner . '">Klicke hier</a>, um zum Ordner ' . $ordner_name . ' zurückzukehren');
		}

		$delete_id = isset($_GET['delete']) ? $_GET['delete'] : '';
		$action	   = isset($_POST['action']) ? $_POST['action'] : '';

		if ($delete_id) {
			$db->query('
				DELETE FROM browser_mail 
				WHERE mail_id = ' . (int)$delete_id . ' 
					AND (  	   user_id_von = ' . (int)$user_row->user_id . '  
							OR user_id_an  = ' . (int)$user_row->user_id . ')
			');

			displayMessage('Die Nachricht wurde gelöscht.');
		} else if ($action == 1) {

			$i = 0;
			foreach ($_POST as $key => $value) {
				if (isset($_POST[$key]) && $_POST[$key] == 'true') {
					$i++;
					$db->query('
						DELETE FROM browser_mail 
						WHERE mail_id = ' . (int)$key . ' 
							AND ( 	user_id_von = ' . (int)$user_row->user_id . ' 
								OR  user_id_an  = ' . (int)$user_row->user_id . ')
					');
				}
			}

			displayMessage('Die Nachricht' . ($i != 1 ? 'en' : '') . ' wurden gelöscht.');

		} else if ($action == 2) {
				$db->query("
					DELETE FROM browser_mail 
					WHERE " . $ordner_query . " = '" . $user_row->user_id . "'
				");
				displayMessage('Alle Nachrichten wurden gelöscht.');

		} else {
			displayMessage('Keine Aktion ausgewählt.');
		}

	break;

	case 'new':

		$an = isset($_POST['an']) ? $_POST['an'] : '';
		$betreff = isset($_POST['betreff']) ? $_POST['betreff'] : '';
		$text = isset($_POST['text']) ? $_POST['text'] : '';
		$error = '';

		if (isset($_POST['submit'])) {

			function countMessages($user_id) {
				global $db;

				$res = $db->query('
					SELECT COUNT(*) AS num
					FROM browser_mail 
					WHERE user_id_von = ' . (int)$user_id
				);
				$row = $db->fetch_object($res);

				return $row->num;
			}

			$an = isset($_POST['an']) ? $_POST['an'] : '';
			$res = $db->query("
				SELECT * 
				FROM browser_user 
				WHERE username = '" . $db->chars($an)."'
			");
			$row = $db->fetch_object($res);

			if (!$row) {
				$error = 'Du musst einen Empfänger eingeben der existiert.';
			} else if (countMessages($row->user_id) >= 200) {
				$error = 'Posteingang vom Empfänger ist voll. Nachricht nicht gesendet!';
			} else if (countMessages($user_row->user_id) >= 200) {
				$error = 'Gesendete Nachrichten Ordner ist voll. Nachricht nicht gesendet!';
			} else if (!$_POST['betreff']) {
				$error = 'Du musst einen Betreff eingeben der existiert.';
			} else if (!$_POST['text'])	{
				$error = 'Du musst einen Text eingeben.';
			} else {
				$bbcodes = isset($_POST['bbcodes']) && $_POST['bbcodes'] == 0 ? 1 : 0;
				$smilies = isset($_POST['smilies']) && $_POST['smilies'] == 0 ? 1 : 0;
				$signatur = isset($_POST['signatur']) && $_POST['signatur'] == 1 ? 1 : 0;
				$db->query("
					INSERT INTO browser_mail 
					(mail_betreff, user_id_von, user_id_an, mail_text, mail_time, mail_bbcodes, mail_smilies, mail_signatur) 
					VALUES
					('" . $db->chars($_POST['betreff']) . "', " . (int)$user_row->user_id . ', ' . (int)$row->user_id . ", '" . $db->chars($text)."', " . time() . ", '" . $bbcodes . "', '" . $smilies . "', '" . $signatur . "')
				");

				message_box('<meta http-equiv="refresh" content="3; URL=nachricht.php?ordner=' . $ordner . '"><br>Die Nachricht wurde gesendet.<br><br><a class="user" href="nachricht.php?ordner=' . $ordner . '">Klicke hier</a>, um zum Ordner '.$ordner_name.' zurückzukehren');
			}
		}

		if (isset($_GET['answer'])) {
			$res = $db->query('
				SELECT * 
				FROM browser_mail 
				WHERE mail_id = ' . (int)$_GET['answer']
			);
			$row = $db->fetch_object($res);
			$betreff = ($user_row->user_id == $row->user_id_an || $user_row->user_id == $row->user_id_von) ? 'Re: ' . $row->mail_betreff : '';
		}

		if (isset($_GET['zitat'])) {
			$res = 	$db->query("
				SELECT m.*, u.username 
				FROM browser_mail m 
					LEFT JOIN browser_user u ON u.user_id = m.user_id_von
				WHERE m.mail_id = '" . $db->chars($_GET['zitat']) . "'
			");
			$row2 = $db->fetch_object($res);

			$text = '[ZITAT=' . $row2->username . ']' . $row2->mail_text . '[/ZITAT]';
		}

		if (!empty($_GET['mail'])) {
			$res = $db->query("
				SELECT * 
				FROM browser_user 
				WHERE user_id = '" . $db->chars($_GET['mail']) . "'
			");
			$row = $db->fetch_object($res);

			if (!$row) {
				$error = 'Der Empfänger existiert nicht!';
			} else {
				$an = $row->username;
			}
		}

		$tpl->assign(array(
			'AN'			=>	htmlspecialchars($an),
			'BETREFF'		=>	htmlspecialchars($betreff),
			'TEXT'			=>	htmlspecialchars($text),
			'ERROR'			=>	$error,
			'ORDNER'		=>	$ordner,
			'ORDNER_STATS'	=>	$ordner_stats,
			'ORDNER_NAME'	=>	$ordner_name
		));

		$tpl->display('nachricht_new.tpl');

	break;

	case 'view':

		include_once 'includes/ReplaceUtil.php';

		$res = $db->query('
			SELECT * 
			FROM browser_mail 
			WHERE mail_id = ' . (int)$_GET['id']
		);
		$row = $db->fetch_object($res);

		if(!$row || $row->user_id_an != $user_row->user_id && $row->user_id_von != $user_row->user_id) {
			message_box('Die Nachricht wurde nicht gefunden!');
		}

		$res2 = $db->query('
			SELECT * 
			FROM browser_user 
			WHERE user_id = ' . (int)$row->user_id_von
		);
		$row2 = $db->fetch_object($res2);

		if ($row->mail_gelesen == 0) {
			$db->query('
				UPDATE browser_mail 
				SET mail_gelesen = 1 
				WHERE mail_id = ' . $row->mail_id . ' 
					AND user_id_an = ' . $user_row->user_id
			);
		}

		$typ = in_array($row2->user_id, $adminid) ? 'Administrator' : 'Benutzer';

		$signatur = '';
		if ($row2->user_beschreibung AND $row->mail_signatur == 1) {
			$signatur = '<hr><font color="#606046">' . nl2br(htmlspecialchars(stripslashes($row2->user_beschreibung))) . '</font>';
			if($row2->user_signatur_bbcodes == 1)	$signatur = ReplaceUtil::replaceBBCodes($signatur);
			if($row2->user_signatur_smilies == 1)	$signatur = ReplaceUtil::replaceSmilies($signatur);
		}

		$username = $row2 ? $row2->username : 'Unbekannt';

		$text = nl2br(htmlspecialchars(stripslashes($row->mail_text)));

		if ($row->mail_bbcodes == 1) {
			$text = ReplaceUtil::replaceBBCodes($text);
		}

		if($row->mail_smilies == 1) {
			$text = ReplaceUtil::replaceSmilies($text);
		}

		$tpl->assign(array(
			'USERNAME'		=>	$username,
			'AVATAR'		=>	$row2->user_avatar,
			'PUNKTE'		=>	$row2->user_punkte,
			'STATUS'		=>	$row2->user_online > (time() - 300) ? 'Online' : 'Offline',
			'BETREFF'		=>	htmlspecialchars($row->mail_betreff),
			'TEXT'			=>	$text,
			'SIGNATUR'		=>	$signatur,
			'USER_ID'		=>	$row2->user_id,
			'TYP'			=>	$typ,
			'ID'			=>	$row->mail_id,
			'ORDNER'		=>	$ordner,
			'ORDNER_STATS'	=>	$ordner_stats,
			'ORDNER_NAME'	=>	$ordner_name,
			'TIME'			=>	date('d.m.Y H:i', $row->mail_time)
		));
		$tpl->display('nachricht_view.tpl');

	break;

	default:

		$limitpn = 20;
		$perpage = $limitpn;
		$pages = isset($_GET['page']) ? $_GET['page'] : 1;
		$abeintrag =  $pages * $perpage - $perpage;

		$res = $db->query("
			SELECT * 
			FROM browser_mail 
			WHERE " . $ordner_query . " = '" . $user_row->user_id . "' 
			ORDER BY mail_id DESC 
			LIMIT " . $abeintrag . ',' . $perpage
		);
		while ($row = $db->fetch_object($res)) {
			$von_an = $ordner == 1 ? 'von' : 'an';
			$res2 = $db->query("
				SELECT * 
				FROM browser_user 
				WHERE user_id = '" . $row->{'user_id_' . $von_an} . "'
			");
			$row2 = $db->fetch_object($res2);

			$tpl->block_assign('messages', array(
				'GELESEN'	=>	$row->mail_gelesen,
				'BETREFF'	=>	htmlspecialchars($row->mail_betreff),
				'USERNAME'	=>	($row2 ? $row2->username : 'Unbekannt'),
				'VON_AN'	=>	$von_an,
				'USER_ID'	=>	$row2->user_id,
				'DATUM'		=>	date('d.m.Y H:i', $row->mail_time),
				'ID'		=>	$row->mail_id,
				'ORDNER'	=>	$ordner
			));
		}

		$seite = 1;
		$anhang = '';
		$seiteview = '';
		$seitengesamt = ceil($gesamt/$limitpn);

		for ($i = 1; $i <= $seitengesamt; $i++) {
			if ($seite <= 3 || $seite >= $seitengesamt-2 || $seite >= $pages-1 && $seite <= $pages+1) {
				$seiteview .= ($seite == $pages) ? $anhang . '<a class="hide">' . $seite . '</a> ' : $anhang . '<a href="nachricht.php?ordner=' . $ordner . '&page=' . $seite . '">' . $seite . '</a> ';
				$anhang = '';
			} else {
				$anhang = ' ... ';
			}

			$seite++;
		}

		$seiteview = ($seitengesamt <= 1) ? '' : 'Gehe zu Seite: ' . $seiteview;

		$tpl->assign(array(
			'SEITEN'		=>	$seiteview,
			'ORDNER'		=>	$ordner,
			'ORDNER_STATS'	=>	$ordner_stats
		));

		$tpl->display('nachricht.tpl');

	break;
}

?>