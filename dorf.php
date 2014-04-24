<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

require 'base.php';
require 'includes/ReplaceUtil.php';


$nverwaltung = 0;
for ($i = 1; 9 >= $i; $i++) {
	if ($user_row->{'user_haus' . $i . '_ico'} == 4) {
		$nverwaltung = 1;
	}
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$res = $db->query('
	SELECT * 
	FROM browser_user 
	WHERE user_id = ' . (int)$id
);
$row = $db->fetch_object($res);

$row2 = false;
$row3 = false;

if ($row->group_id) {
	$res2 = $db->query('
		SELECT group_name 
		FROM browser_group 
		WHERE group_id = ' . (int)$row->group_id
	);
	$row2 = $db->fetch_object($res2);

	$res3 = $db->query('
		SELECT group_id 
		FROM browser_group 
		WHERE group_id = ' . (int)$row->group_id . ' 
			AND user_id = ' . (int)$user_row->user_id
	);
	$row3 = $db->fetch_object($res3);
}

$beschreibung = nl2br(htmlspecialchars(stripslashes($row->user_beschreibung)));
if ($row->user_signatur_bbcodes == 1) {
	$beschreibung = ReplaceUtil::replaceBBCodes($beschreibung);
}
if ($row->user_signatur_smilies == 1) {
	$beschreibung = ReplaceUtil::replaceSmilies($beschreibung);
}

$tpl->assign(array(
	'GRUPPE_NAME'	=>	($row->group_id) ? htmlspecialchars($row2->group_name) : '',
	'GRUPPE_ID'		=>	$row->group_id,
	'ANTRAG'		=>	($nverwaltung == 1 && $row->group_id && $user_row && !$row3),
	'AVATAR'		=>	$row->user_avatar,
	'STATUS'		=>	($row->user_online > (time() - 300)) ? 'Online' : 'Offline',
	'TYP'			=>	(in_array($row->user_id, $adminid)) ? 'Administrator' : 'Benutzer',
	'BESCHREIBUNG'	=>	$beschreibung,
	'DORF'			=>	htmlspecialchars($row->user_dorf),
	'USER_ID'		=>	$row->user_id,
	'USERNAME'		=>	htmlspecialchars($row->username),
	'PUNKTE'		=>	$row->user_punkte,
	'EINWOHNER'		=>	$row->user_einwohner,
	'GESPERRT'		=>	($row->user_sperren == 1),
	'IS_ADMIN'		=>	(in_array($user_row->user_id, $adminid)),
	'MAHNUNGEN'		=>	$row->user_mahnung
));

$tpl->display('dorf.tpl');

?>