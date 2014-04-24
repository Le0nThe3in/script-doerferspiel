<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

header('Content-Type: text/html; charset=utf-8');

require 'config.php';
require 'includes/MySQL.php';

$db = new MySQL($hostname, $username, $password, $database);
unset($password);

$db->query("CREATE TABLE IF NOT EXISTS `browser_group` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_beschreibung` text NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_name` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$db->query("CREATE TABLE IF NOT EXISTS `browser_mail` (
  `mail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_von` mediumint(8) unsigned NOT NULL,
  `user_id_an` mediumint(8) unsigned NOT NULL,
  `mail_text` text NOT NULL,
  `mail_time` int(9) NOT NULL,
  `mail_gelesen` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mail_betreff` varchar(50) NOT NULL DEFAULT '',
  `mail_bbcodes` tinyint(1) NOT NULL DEFAULT '1',
  `mail_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `mail_signatur` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$db->query("CREATE TABLE IF NOT EXISTS `browser_user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `user_dorf` varchar(50) NOT NULL DEFAULT '',
  `user_passwort` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_beschreibung` varchar(255) NOT NULL DEFAULT '',
  `user_punkte` int(20) NOT NULL DEFAULT '100',
  `user_trank` int(20) NOT NULL DEFAULT '0',
  `user_bombe` int(20) NOT NULL DEFAULT '0',
  `user_tag` int(20) NOT NULL DEFAULT '0',
  `user_einwohner` int(20) NOT NULL DEFAULT '0',
  `user_online` varchar(255) NOT NULL DEFAULT '',
  `user_avatar` varchar(255) NOT NULL DEFAULT '',
  `user_energie` int(100) NOT NULL DEFAULT '0',
  `user_metall` int(100) NOT NULL DEFAULT '0',
  `user_nachricht` varchar(200) NOT NULL,
  `group_id` int(9) unsigned NOT NULL,
  `groud_id_antrag` int(9) unsigned NOT NULL,
  `user_haus1` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus2` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus3` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus4` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus5` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus6` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus7` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus8` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus9` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus1_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus2_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus3_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus4_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus5_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus6_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus7_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus8_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_haus9_ico` tinyint(1) NOT NULL DEFAULT '0',
  `user_sperren` tinyint(1) NOT NULL DEFAULT '0',
  `user_mahnung` tinyint(1) NOT NULL DEFAULT '0',
  `user_ausbau_zeit` int(9) unsigned NOT NULL DEFAULT '0',
  `user_ausbau_g` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `user_ausbau_o` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `user_signatur_bbcodes` tinyint(1) NOT NULL DEFAULT '1',
  `user_signatur_smilies` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `online` (`user_online`),
  KEY `einwohner` (`user_einwohner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

chmod('avatar/', 0777);

echo 'Das Dörferspiel wurde installiert - Datei install.php kann gelöscht werden';

?>