<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

if (!$user_row) {
	header('Location: login.php');
	exit;
}

if (isset($_GET['delete'])) {

	$db->query("
		UPDATE browser_user 
		SET user_nachricht = '' 
		WHERE user_id = " . $user_row->user_id
	);
	header('Location: view.php');
	exit;

} else if (isset($_GET['hilfe'])) {

	$tpl->display('view_hilfe.tpl');

} else if (!empty($_GET['auto'])) {

	header('Location: view.php');
	exit;

}

if (!empty($_POST['sicherheitscode'])) {
	if ($_SESSION['sicherheitscode'] == $_POST['sicherheitscode']) {
		$time = (time() + 60*7);
		$db->query('
			UPDATE browser_user 
			SET user_tag = ' . $time . ' 
			WHERE user_id = ' . $user_row->user_id
		);
		$user_row->user_tag = $time;
	} else {
		header('Location: view.php?wrong=true');
		exit;
	}
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

$einwohner = (
	  $user_row->user_haus1
	+ $user_row->user_haus2
	+ $user_row->user_haus3
	+ $user_row->user_haus4
	+ $user_row->user_haus5
	+ $user_row->user_haus6
	+ $user_row->user_haus7
	+ $user_row->user_haus8
	+ $user_row->user_haus9) *3;

if ($user_row->user_einwohner != $einwohner) {
	$db->query('
		UPDATE browser_user 
		SET user_einwohner = ' . (int)$einwohner . '  
		WHERE user_id = ' . $user_row->user_id
	);
	$user_row->user_einwohner = $einwohner;
}

// Minutenanzahl (Tage)
$noch = ceil(($user_row->user_tag - time())/60);
// Minutenanzahl (Ausbau)
$noch2 = ceil(($user_row->user_ausbau_zeit - time())/60);

if ($noch <= 0) {
	if ($user_row->user_tag != 0) {
		$energie = $user_row->user_energie;
		$trank = $user_row->user_trank;
		$metall = $user_row->user_metall;

		for ($i = 1; 9 >= $i; $i++) {
			if ($user_row->{'user_haus' . $i . '_ico'} == 2)	{
				$metall = $metall+20+4*$user_row->{'user_haus' . $i};
			} else if ($user_row->{'user_haus' . $i . '_ico'} == 1) {
				$trank = $trank+20+4*$user_row->{'user_haus' . $i};
			} else if ($user_row->{'user_haus' . $i . '_ico'} == 5)	{
				$energie = $energie+20+4*$user_row->{'user_haus' . $i};
			}
		}

		$db->query('
			UPDATE browser_user 
			SET user_tag = 0, 
				user_metall = ' . (int)$metall . ', 
				user_trank = ' . (int)$trank . ', 
				user_energie = ' . (int)$energie . ' 
			WHERE user_id = ' . $user_row->user_id
		);
		header('Location: view.php');
		exit;
	}
}

$ausbau_name = '';
$ausbau_stufe = 0;

if ($noch2 > 0) {
	$ha = array('', 'Brauerei', 'Miene', 'Waffenproduktion', 'Verwaltung', 'Mühle');
	$ausbau_name = $ha[($user_row->user_ausbau_o)];
	$ausbau_stufe = $user_row->{'user_haus' . $user_row->user_ausbau_g} + 1;
} else if ($user_row->user_ausbau_zeit > 0 && $user_row->user_ausbau_g) {

	if ($user_row->{'user_haus' . $user_row->user_ausbau_g} == 0) {
		$db->query('
			UPDATE browser_user 
			SET user_haus' . $user_row->user_ausbau_g . "_ico = '" . $user_row->user_ausbau_o . "' 
			WHERE user_id = " . $user_row->user_id
		);
		$user_row->{'user_haus' . $user_row->user_ausbau_g . '_ico'} =  $user_row->user_ausbau_o;
	}

	$stufe_next = ($user_row->{'user_haus' . $user_row->user_ausbau_g} + 1);

	$db->query("
		UPDATE browser_user 
		SET user_haus" . $user_row->user_ausbau_g . " = '" . $stufe_next . "', 
			user_ausbau_zeit = 0, 
			user_ausbau_g = 0, 
			user_ausbau_o = 0 
		WHERE user_id = " . $user_row->user_id
	);

	$user_row->user_ausbau_zeit = 0;
	$user_row->user_ausbau_g = 0;
	$user_row->user_ausbau_o = 0;
	$user_row->{'user_haus' . $user_row->user_ausbau_g} = $stufe_next;
}

$tpl->assign(array(
	'AUSBAU_NAME'	=>	$ausbau_name,
	'AUSBAU_STUFE'	=>	$ausbau_stufe,
	'DORF'			=>	htmlspecialchars($user_row->user_dorf),
	'EINWOHNER'		=>	$einwohner,
	'IS_ADMIN'		=>	in_array($user_row->user_id, $adminid),
	'PUNKTE'		=>	$user_row->user_punkte,
	'TRANK'			=>	$user_row->user_trank,
	'ENERGIE'		=>	$user_row->user_energie,
	'METALL'		=>	$user_row->user_metall,
	'BOMBEN'		=>	$user_row->user_bombe,
	'NOCH'			=>	$noch,
	'NOCH2'			=>	$noch2,
	'VERWALTUNG'	=>	$nverwaltung,
	'NACHRICHT'		=>	$user_row->user_nachricht,
	'HAUS1_ICO'		=>	$user_row->user_haus1_ico,
	'HAUS2_ICO'		=>	$user_row->user_haus2_ico,
	'HAUS3_ICO'		=>	$user_row->user_haus3_ico,
	'HAUS4_ICO'		=>	$user_row->user_haus4_ico,
	'HAUS5_ICO'		=>	$user_row->user_haus5_ico,
	'HAUS6_ICO'		=>	$user_row->user_haus6_ico,
	'HAUS7_ICO'		=>	$user_row->user_haus7_ico,
	'HAUS8_ICO'		=>	$user_row->user_haus8_ico,
	'HAUS9_ICO'		=>	$user_row->user_haus9_ico,
	'HIDE_CAPTCHA'	=>	empty($_GET['wrong'])
));

$tpl->display('view.tpl');

?>