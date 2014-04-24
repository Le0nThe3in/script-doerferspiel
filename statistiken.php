<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';

$res = $db->query('
	SELECT COUNT(*) AS num 
	FROM browser_user
');
$row = $db->fetch_object($res);

$spieler = $row->num;


$i = 0;
$res = $db->query('
	SELECT * 
	FROM browser_user 
	WHERE user_online > ' . (time() - 300) . '
	ORDER BY username
');
while($row = $db->fetch_object($res)) {
	$tpl->block_assign('online', array(
		'I'			=>	$i++,
		'USER_ID'	=>	$row->user_id,
		'USERNAME'	=>	htmlspecialchars($row->username)
	));
}


$res = $db->query('
	SELECT SUM(user_punkte) AS gesamt 
	FROM browser_user
');
$row = $db->fetch_object($res);

$gold = $row->gesamt;
if (!$row->gesamt) {
	$gold = 0;
}

$nummer = 1;
$res = $db->query('
	SELECT * 
	FROM browser_user 
	ORDER BY user_einwohner DESC 
	LIMIT 10
');
while ($row = $db->fetch_object($res)) {
	$tpl->block_assign('toplist', array(
		'NUMMER'	=>	$nummer++,
		'USER_ID'	=>	$row->user_id,
		'DORF'		=>	htmlspecialchars($row->user_dorf),
		'PUNKTE'	=>	$row->user_punkte,
		'EINWOHNER'	=>	$row->user_einwohner
	));
}

$tpl->assign(array(
	'GOLD'		=>	$gold,
	'SPIELER'	=>	$spieler
));
$tpl->display('statistiken.tpl');

?>