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

$tpl->assign('MEMBERS_NUM', $row->num);
$tpl->display('index.tpl');

?>