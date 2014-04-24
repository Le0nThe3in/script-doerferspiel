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

function setAusbauzeit() {
	global $db, $user_row;
	$time = (time() + 60*7);
	$db->query('
		UPDATE browser_user 
		SET user_ausbau_zeit = ' . $time . ' 
		WHERE user_id = ' . $user_row->user_id
	);
	$user_row->user_ausbau_zeit = $time;
}

function getPlatz($platz) {
	$platz = (int)$platz;

	if ($platz < 1 || $platz > 9) {
		message_box('Der Bauplatz ist unbekannt');
	}

	return $platz;
}

$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

switch ($mode) {

	case 'cancel_ausbauen':
		$db->query('
			UPDATE browser_user 
			SET user_ausbau_zeit = 0, 
				user_ausbau_g = 0, 
				user_ausbau_o = 0 
			WHERE user_id = ' . $user_row->user_id
		);
		header('Location: view.php');
		exit;
	break;

	case 'cancel_tag':
		$db->query('
			UPDATE browser_user 
			SET user_tag = 0  
			WHERE user_id = ' . $user_row->user_id
		);
		header('Location: view.php');
		exit;
	break;

	case 'bombe_username':

		$username = isset($_POST['user']) ? $_POST['user'] : '';
		$row2 = false;
		$error = '';

		if ($username) {
			$res = $db->query("
				SELECT * 
				FROM browser_user 
				WHERE username = '" . $db->chars($username) . "'
			");
			$row2 = $db->fetch_object($res);
		}

		if ($row2) {
			header('Location: build.php?mode=bombe&id=' . $row2->user_id);
			exit;
		} else {
			if (isset($_POST['submit'])) {
				$error = 'Kein Benutzer gefunden';
			}
			$tpl->assign('ERROR', $error);
			$tpl->display('build_search_username.tpl');
		}

	break;

	case 'bombe':

		$exist = 0;
		for ($i = 1; 9 >= $i; $i++) {
			if ($user_row->{'user_haus' . $i . '_ico'} == 3) {
				$exist++;
			}
		}

		$row2 = false;
		if (isset($_GET['id'])) {
			$res = $db->query('
				SELECT * 
				FROM browser_user 
				WHERE user_id = ' . (int)$_GET['id']
			);
			$row2 = $db->fetch_object($res);
		}

		if ($exist == 0) {
			message_box('Du hast keine Waffenproduktion');
		} else if (isset($_GET['send']) && $row2) {

			if ($user_row->user_bombe <= 0) {
				message_box('Du hast keine Bomben mehr');
			}

			$platz = getPlatz($_GET['send']);

			if ($row2->{'user_haus' . $platz} == 1) {
				$db->query('
					UPDATE browser_user 
					SET user_haus' . $platz . '_ico = 0 
					WHERE user_id = ' . $row2->user_id
				);
			}

			$db->query("
				UPDATE browser_user 
				SET user_haus" . $platz . " = '" . ($row2->{'user_haus' . $platz} - 1) . "' 
				WHERE user_id = " . $row2->user_id
			);
			$db->query("
				UPDATE browser_user 
				SET user_nachricht = '" . $db->chars($user_row->username) . " hat dein Gebäude (Standort: " . $platz . ") mit einer Bombe getroffen'
				WHERE user_id = " . $row2->user_id
			);
			$db->query('
				UPDATE browser_user 
				SET user_bombe = user_bombe - 1  
				WHERE user_id = ' . $user_row->user_id
			);
			message_box('Das Gebäude wurde voll erwischt.<br />Eine Stufe des Gebäudes wurde zerstört.<br /><br /><a class="user" href="build.php?mode=bombe&id=' . $row2->user_id . '">Klicke hier</a>, um zur Bombadierübersicht zurückzukehren');
		}

		$ha = array('', 'Brauerei', 'Miene', 'Waffenproduktion', 'Verwaltung', 'Mühle');

		for ($i = 1; $i <= 9; $i++) {
			$tpl->assign(array(
				'HAUS' . $i				=>	$row2->{'user_haus' . $i},
				'HAUS' . $i . '_NAME'	=>	$ha[$row2->{'user_haus' . $i . '_ico'}]
			));			
		}

		$tpl->assign(array(
			'DORF'		=>	htmlspecialchars($user_row->user_dorf),
			'DORF_USER'	=>	htmlspecialchars($row2->user_dorf),
			'PUNKTE'	=>	$user_row->user_punkte,
			'TRANK'		=>	$user_row->user_trank,
			'ENERGIE'	=>	$user_row->user_energie,
			'METALL'	=>	$user_row->user_metall,
			'BOMBEN'	=>	$user_row->user_bombe,
			'USERNAME'	=>	$row2->username,
			'USER_ID'	=>	$row2->user_id
		));
		$tpl->display('build_bomb.tpl');

	break;

	case 'ausbau':
		$platz = getPlatz($_GET['platz']);

		if ($user_row->user_punkte < 100) {
			message_box('Du hast nicht genug Gold<br /><br /><a class="user" href="view.php">Klicke hier</a>, um zur Dorf-Übersicht zurückzukehren');
		} else {
			setAusbauzeit();
			$db->query('
				UPDATE browser_user 
				SET user_punkte = user_punkte - 100, 
					user_ausbau_o = ' . (int)$user_row->{'user_haus' . $platz . '_ico'} . ', 
					user_ausbau_g = ' . (int)$platz . ' 
				WHERE user_id = ' . $user_row->user_id
			);

			header('Location: view.php');
			exit;
		}
	break;

	case 'abreissen':

		$platz = getPlatz($_GET['platz']);

		$db->query('
			UPDATE browser_user 
			SET user_haus' . $platz . ' = 0, 
				user_haus' . $platz . '_ico = 0 
				WHERE user_id = ' . $user_row->user_id
		);
		header('Location: view.php');
		exit;

	break;

	case 'bombe_prod':

		if ($user_row->user_punkte < 50) {
			message_box('Du hast nicht genug Gold<br /><br /><a class="user" href="view.php">Klicke hier</a>, um zur Dorf-Übersicht zurückzukehren');
		} else {
			$db->query('
				UPDATE browser_user 
				SET user_punkte = user_punkte - 50, 
				user_bombe = user_bombe + 1 
				WHERE user_id = ' . $user_row->user_id
			);
			message_box('Die Bombe wurde hergestellt!<br /><br /><a class="user" href="build.php?g=' . (int)$_GET['platz'] . '">Klicke hier</a>, um zur Waffenproduktion zurückzukehren');
		}

	break;

	default:

		function getArt($art) {
			$art = (int)$art;

			if ($art < 1 || $art > 5) {
				message_box('Der Bautyp ist unbekannt');
			}

			return $art;
		}

		if (isset($_GET['g'])) {

			$platz = getPlatz($_GET['g']);

			$haus_ico = $user_row->{'user_haus' . $platz . '_ico'};
			$stufe = $user_row->{'user_haus' . $platz};
			$stufe_next = $stufe + 1;

			switch ($haus_ico) {
				case 1:
					$name = 'Brauerei';
					$vorteil = '4 Tränke/Tag mehr';
					$kosten = '100 Gold';
				break;
				case 2:
					$name = 'Miene';
					$vorteil = '4 Metall/Tag mehr';
					$kosten = '100 Gold';
				break;
				case 3:
					$name = 'Waffenproduktion';
					$vorteil = 'höhere Standfestigkeit';
					$kosten = '-';
				break;
				case 4:
					$name = 'Verwaltung';
					$vorteil = 'höhere Standfestigkeit';
					$kosten = '-';
				break;
				case 5:
					$name = 'Mühle';
					$vorteil = '4 Energie/Tag mehr';
					$kosten = '100 Gold';
				break;
			}

			if ($stufe_next > 20) {
				$vorteil = 'keiner';
				$kosten = '-';
			}

			$tpl->assign(array(
				'DORF'		=>	htmlspecialchars($user_row->user_dorf),
				'PUNKTE'	=>	$user_row->user_punkte,
				'TRANK'		=>	$user_row->user_trank,
				'ENERGIE'	=>	$user_row->user_energie,
				'METALL'	=>	$user_row->user_metall,
				'BOMBE'		=>	$user_row->user_bombe,
				'STUFE'		=>	$user_row->{'user_haus' . $platz},
				'HAUS_ICO'	=>	$haus_ico,
				'KOSTEN'	=>	$kosten,
				'NAME'		=>	$name,
				'VORTEIL'	=>	$vorteil,
				'BOMBEN'	=>	$user_row->user_bombe,
				'PLATZ'		=>	htmlspecialchars($_GET['g']),
				'STUFE_NEXT'=>	$stufe_next,
				'WIRD_GEBAUT'=>	$user_row->user_ausbau_zeit > time()
			));

			$tpl->display('build_g.tpl');
			exit;
		}

		// beim Klick auf einen leeren Bauplatz

		$platz = getPlatz($_GET['ort']);
		$art = isset($_GET['art']) ? $_GET['art'] : '';

		if ($art) {
			$art = getArt($art);
			if ($user_row->user_punkte < 50) {
				message_box('Du hast nicht genug Gold<br /><br /><a href="view.php" class="user">Klicke hier</a>, um zur Dorf-Übersicht zurückzukehren');
			} else {
				setAusbauzeit();
				$db->query('
					UPDATE browser_user 
					SET user_punkte = user_punkte - 50, 
						user_ausbau_g = ' . (int)$platz . ', 
						user_ausbau_o = ' . (int)$art . ' 
					WHERE user_id = ' . $user_row->user_id
				);
				header('Location: view.php');
				exit;
			}
		}

		if ($user_row->{'user_haus' . $platz . '_ico'} >  0) {

			message_box('Der Bauplatz ist schon belegt.');

		} else {
			$verwaltung_exist = 0;
			for ($i = 1; 9 >= $i; $i++) {
				if ($user_row->{'user_haus' . $i . '_ico'} == 4) {
					$verwaltung_exist++;
				}
			}

			$waffenprod_exist = 0;
			for ($i = 1; 9 >= $i; $i++) {
				if ($user_row->{'user_haus' . $i . '_ico'} == 3) {
					$waffenprod_exist++;
				}
			}

			$tpl->assign(array(
				'DORF'				=>	htmlspecialchars($user_row->user_dorf),
				'PLATZ'				=>	$platz,
				'WIRD_GEBAUT'		=>	$user_row->user_ausbau_zeit > time(),
				'PUNKTE'			=>	$user_row->user_punkte,
				'TRANK'				=>	$user_row->user_trank,
				'ENERGIE'			=>	$user_row->user_energie,
				'METALL'			=>	$user_row->user_metall,
				'BOMBEN'			=>	$user_row->user_bombe,
				'VERWALTUNG_EXIST'	=>	$verwaltung_exist,
				'WAFFENPROD_EXIST'	=>	$waffenprod_exist
			));
			$tpl->display('build.tpl');
			exit;
		}

	break;
}

?>