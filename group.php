<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

if (!$user_row) {
	header('Location: login.php');
	exit;
}

if ($user_row->user_sperren == 1) {
	message_box('Ein Administrator/Aufpasser hat dich aus dem Dörferspiel geworfen.');
}

$nverwaltung = 0;
for ($i = 1; 9 >= $i; $i++) {
	if ($user_row->{'user_haus' . $i . '_ico'} == 4) {
		$nverwaltung = 1;
	}
}

$res = $db->query('
	SELECT * 
	FROM browser_group 
	WHERE user_id = ' . (int)$user_row->user_id
);
$row = $db->fetch_object($res);


$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

switch ($mode) {
	case 'new':

		if ($user_row->group_id) {
			message_box('Du bist schon in einer Gruppe mitglied!');
		} else if ($nverwaltung != 1) {
			message_box('Du brauchst eine Verwaltung!');
		} else if (empty($_POST['name'])) {
			$tpl->assign(array(
				'MODE'			=>	'new',
				'TITLE'			=>	'Neue Gruppe',
				'NAME'			=>	'',
				'BESCHREIBUNG'	=>	''
			));
			$tpl->display('gruppen_edit.tpl');
		} else {
			$db->query("
				INSERT INTO browser_group 
				(group_name, user_id, group_beschreibung)
				VALUES
				('" . $db->chars($_POST['name']) . "', " . (int)$user_row->user_id . ", '" . $db->chars($_POST['text']) . "')
			");

			$res = $db->query('
				SELECT * 
				FROM browser_group 
				WHERE user_id = ' . (int)$user_row->user_id . " 
				 	AND group_name = '" . $db->chars($_POST['name']) . "' 
			");
			$row = $db->fetch_object($res);

			$db->query('
				UPDATE browser_user 
				SET group_id = ' . (int)$row->group_id . ' 
				WHERE user_id = ' . $user_row->user_id
			);
			message_box('Die Gruppe wurde erfolgreich angelegt.<br><br><a class="user" href="group.php?m0de=view&id=' . $row->group_id . '">Klicke hier</a>, um zur Gruppenübersicht zu kommen.');
		}

	break;

	case 'edit':

		if (!$row) {
			message_box('Du bist nicht Besitzer dieser Gruppe');
		}

		if (empty($_POST['name'])) {
			$tpl->assign(array(
				'MODE'			=>	'edit',
				'TITLE'			=>	'Gruppeneinstellungen',
				'NAME'			=>	htmlspecialchars($row->group_name),
				'BESCHREIBUNG'	=>	htmlspecialchars($row->group_beschreibung)
			));
			$tpl->display('gruppen_edit.tpl');
		} else {
			$db->query("
				UPDATE browser_group 
				SET group_beschreibung = '" . $db->chars($_POST['text']) . "', 
					group_name = '" . $db->chars($_POST['name']) . "' 
				WHERE group_id = " . (int)$row->group_id
			);
			message_box('Die Daten wurden erfolgreich eingetragen.<br /><br /><a class="user" href="group.php?id=' . $row->group_id . '">Klicke hier</a>, um zur Gruppenübersicht zu kommen.');
		}

	break;

	case 'antrag':

		$db->query('
			UPDATE browser_user 
			SET group_id_antrag = ' . (int)$_GET['id'] . ' 
				WHERE user_id = ' . $user_row->user_id
		);

		message_box('Die Anfrage wurde erfolgreich abgeschickt.<br><br><a href="view.php" class="user">Klicke hier</a>, um zur Dorf-Übersicht zurückzukehren');

	break;

	case 'view':

		include_once 'includes/ReplaceUtil.php';
		$res = $db->query('
			SELECT * 
			FROM browser_group 
			WHERE group_id = ' . (int)$_GET['id']
		);
		$row = $db->fetch_object($res);

		$num = 0;
		$AT = '';

		$res2 = $db->query('
			SELECT * 
			FROM browser_user 
			WHERE user_id != ' . $row->user_id . ' 
				AND group_id = ' . (int)$_GET['id']
		);
		while ($row2 = $db->fetch_object($res2)) {
			$tpl->block_assign('members', array(
				'USER_ID'	=>	$row2->user_id,
				'USERNAME'	=>	$row2->username
			));
			$num++;
		}

		$res2 = $db->query('
			SELECT * 
			FROM browser_user 
			WHERE user_id = ' . $row->user_id
		);
		$row2 = $db->fetch_object($res2);

		if (!$row) {
			message_box('Die Gruppe existiert nicht!');
		} else {
			$tpl->assign(array(
				'NAME'			=>	htmlspecialchars($row->group_name),
				'BESITZER'		=>	htmlspecialchars($row2->username),
				'DORF'			=>	htmlspecialchars($row2->user_dorf),
				'MEMBERS_NUM'	=>	$num,
				'BESCHREIBUNG'	=>	ReplaceUtil::replaceBBCodes(ReplaceUtil::replaceSmilies(nl2br(htmlspecialchars(stripslashes($row->group_beschreibung))))),
				'USER_ID'		=>	$row2->user_id
			));
			$tpl->display('gruppen_view.tpl');
		}

	break;

	case 'members':

		if ($nverwaltung != 1) {
			message_box('Du bist nicht im Besitz einer Verwaltung!');
		} else if (!$row) {
			message_box('Du bist nicht Besitzer dieser Gruppe');
		} else {
			$res2 = $db->query('
				SELECT * 
				FROM browser_user 
				WHERE user_id != ' . (int)$row->user_id . ' 
					AND group_id_antrag = ' . (int)$row->group_id
			);
			while ($row2 = $db->fetch_object($res2))	{
				$tpl->block_assign('antrag', array(
					'USER_ID'	=>	$row2->user_id,
					'USERNAME'	=>	$row2->username
				));
			}

			$res2 = $db->query('
				SELECT * 
				FROM browser_user 
				WHERE user_id != ' . (int)$row->user_id . ' 
					AND group_id = ' . (int)$row->group_id
			);
			while ($row2 = $db->fetch_object($res2))	{
				$tpl->block_assign('members', array(
					'USER_ID'	=>	$row2->user_id,
					'USERNAME'	=>	$row2->username
				));
			}

			$tpl->display('gruppen_members.tpl');
		}

	break;

	case 'aufnehmen':

		if (!$row) {
			message_box('Du hast keine eigene Gruppe');
		}

		$db->query('
			UPDATE browser_user 
			SET group_id = group_id_antrag, 
				group_id_antrag = 0 
			WHERE user_id = ' . (int)$_GET['id'] . ' 
				AND group_id_antrag = ' . (int)$row->group_id
		);

		message_box('Der User wurde in die Gruppe aufgenommen.<br><br><a href="group.php?mode=members">Zurück zur Übersicht</a>');

	break;

	case 'deleteAntrag':

		if (!$row) {
			message_box('Du hast keine eigene Gruppe');
		}

		$db->query('
			UPDATE browser_user 
			SET group_id_antrag = 0 
			WHERE user_id = ' . (int)$_GET['id'] . '
				AND group_id_antrag = ' . (int)$row->group_id
		);

		message_box('Der User wurde abgelehnt.<br /><br /><a class="user" href="group.php?mode=members">Klicke hier</a>, um zum Bearbeiten zurückzukehren');

	break;

	case 'deleteMember':

		if (!$row) {
			message_box('Du bist nicht Besitzer dieser Gruppe');
		}

		$db->query('
			UPDATE browser_user 
			SET group_id = 0 
			WHERE user_id = ' . (int)$_GET['id'] . '
				AND group_id = ' . (int)$row->group_id
		);
		message_box('Der User wurde aus der Gruppe gelöscht.<br /><br /><a class="user" href="group.php?mode=members">Klicke hier</a>, um zum Bearbeiten zurückzukehren');

	break;

	case 'deleteMembership':

		if ($row) {
			message_box('Du kannst aus deiner eigenen Gruppe nicht austreten');
		}

		$db->query('
			UPDATE browser_user 
			SET group_id = 0 
			WHERE user_id = ' . $user_row->user_id
		);

		message_box('Du bist aus der Gruppe ausgetreten.<br /><br /><a class="user" href="group.php">Klicke hier</a>, um zur Übersicht zurückzukehren');

	break;

	case 'delete':

		if (!$row) {
			message_box('Du hast keine eigene Gruppe');
		}

		if (empty($_GET['ok'])) {
			message_box('Willst du deine Gruppe wirklich löschen?<br /><br /><a class="user" href="group.php?mode=delete&ok=1">Ja</a> <a class="user" href="group.php">Abbrechen</a>');
		}

		$db->query('
			UPDATE browser_user 
			SET group_id = 0 
			WHERE group_id = ' . (int)$row->group_id
		);
		$db->query('
			DELETE FROM browser_group 
			WHERE user_id = ' . (int)$user_row->user_id
		);

		message_box('Die Gruppe wurde erfolgreich gelöscht.<br /><br /><a class="user" href="group.php">Klicke hier</a>, um zur Übersicht zurückzukehren');

	break;

	default:

		$tpl->assign(array(
			'GRUPPE_ID'		=>	$user_row->group_id,
			'EIGENE_GRUPPE'	=>	$row->group_id
		));
		$tpl->display('gruppen.tpl');

	break;
}

?>