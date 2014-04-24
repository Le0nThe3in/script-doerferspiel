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

if (isset($_GET['energie'])) {
	$db->query('
		UPDATE browser_user 
		SET user_punkte = ' . (int)round($user_row->user_punkte+$user_row->user_energie/10, 0) . ', 
			user_energie = 0 
		WHERE user_id = ' . $user_row->user_id
	);
	header('Location: handel.php');
	exit;
}

if (isset($_GET['trank'])) {
	$db->query('
		UPDATE browser_user 
		SET user_punkte = ' . (int)round($user_row->user_punkte+$user_row->user_trank/10, 0) . ', 
			user_trank = 0 
		WHERE user_id = ' . $user_row->user_id
	);
	header('Location: handel.php');
	exit;
}

if (isset($_GET['metall'])) {
	$db->query('
		UPDATE browser_user 
		SET user_punkte = ' . (int)round($user_row->user_punkte+$user_row->user_metall/10, 0) . ', 
			user_metall = 0 
		WHERE user_id = ' . $user_row->user_id
	);
	header('Location: handel.php');
	exit;
}

$tpl->assign(array(
	'DORF' 					=>	htmlspecialchars($user_row->user_dorf),
	'PUNKTE'				=>	$user_row->user_punkte,
	'TRANK' 				=>	$user_row->user_trank,
	'ENERGIE' 				=>	$user_row->user_energie,
	'METALL'				=>	$user_row->user_metall,
	'BOMBEN'				=>	$user_row->user_bombe,
	'UMTAUSCH_ENERGIE_GOLD'	=>	($user_row->user_energie > 0) ? round($user_row->user_energie/10, 0) : 0,
	'UMTAUSCH_TRANK_GOLD'	=>	($user_row->user_trank   > 0) ? round($user_row->user_trank/10, 0) : 0,
	'UMTAUSCH_METALL_GOLD'	=>	($user_row->user_metall  > 0) ? round($user_row->user_metall/10, 0) : 0
));
$tpl->display('handel.tpl');

?>