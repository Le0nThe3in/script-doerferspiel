<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

if (@ini_get('register_globals') == 1 || strtolower(@ini_get('register_globals')) == 'on') {
	if (isset($_REQUEST['GLOBALS'])) {
		exit;
	}

	$superglobals = array('_GET', '_POST', '_REQUEST', '_ENV', '_FILES', '_SESSION', '_COOKIES', '_SERVER');

	foreach ($superglobals as $value) {
		if (is_array($GLOBALS[$value])) {
			foreach ($GLOBALS[$value] as $key => $var) {
				if (isset($GLOBALS[$key]) && $var === $GLOBALS[$key]) {
					unset($GLOBALS[$key]);
				}
			}
		}
	}
}

header('Content-Type: text/html; charset=utf-8');

$root = dirname(__FILE__) . '/';

require "{$root}config.php";
require "{$root}includes/MySQL.php";
require "{$root}includes/Template.php";

$db = new MySQL($hostname, $username, $password, $database);
$tpl = new Template();

unset($password);

session_start();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$benutzer_id = isset($_COOKIE['bid']) ? $_COOKIE['bid'] : '';

$res = $db->query("
	SELECT *
	FROM browser_user
	WHERE username = '" . $db->chars($user) . "'
");
$user_row = $db->fetch_object($res);

$neu = 0;
if ($user_row) {
	$res = $db->query('
		SELECT COUNT(*) AS num 
		FROM browser_mail 
		WHERE user_id_an = ' . $user_row->user_id . ' 
			AND mail_gelesen = 0
	');
	$row = $db->fetch_object($res);

	$neu = $row->num;
}

if (!$user_row && $benutzer_id) {
	$res = $db->query('
		SELECT * 
		FROM browser_user 
		WHERE user_id = ' . (int)$benutzer_id . " 
			AND user_passwort = '" . $db->chars($_COOKIE['bpasswort']) . "'
	");
	$row = $db->fetch_object($res);

	if ($row) {
		$user_row = $row;
		$_SESSION['user'] = $user = $row->username;
	}
}

if ($user_row) {
	$db->query('
		UPDATE browser_user 
		SET user_online = ' . time() . ' 
		WHERE user_id = ' . $user_row->user_id
	);
	$user_row->user_online = time();
}

$res = $db->query('
	SELECT COUNT(*) AS num
	FROM browser_user
	WHERE user_online > ' . (time() - 60*5)
);
$row = $db->fetch_object($res);

$tpl->assign(array(
	'USER'		=>	$user,
	'MSG_NEW'	=>	$neu,
	'BONLINE'	=>	$row->num
));

function message_box($text) {
	global $tpl;

	$tpl->assign('TEXT', $text);
	$tpl->display('message.tpl');
	exit;
}

?>