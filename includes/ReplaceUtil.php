<?php
#######################################################
##   Dörferspiel • 28. Juni 2007 • © IT-Talent.de    ##
#######################################################

class ReplaceUtil {
	public static function replaceBBCodes($text) {
		$text = preg_replace('|\[CODE\](.*)\[/CODE\]|Uism', '<b>Code:</b><br><table border="0" cellpadding="5"><tr><td bgcolor="#FFFFFF">$1</td></tr></table>', $text);
		$text = preg_replace('|\[ZITAT=(.*)\](.*)\[/ZITAT\]|Uism', '<b>Zitat von $1:</b><br><table border="0" cellpadding="5"><tr><td bgcolor="#FFFFFF">$2</td></tr></table>', $text);
		$text = preg_replace('|\[ZITAT\](.*)\[/ZITAT\]|Uism', '<b>Zitat:</b><br><table border="0" cellpadding="5"><tr><td bgcolor="#FFFFFF">$1</td></tr></table>', $text);
		$text = preg_replace('|\[URL=(.*)\](.*)\[/URL\]|Uism', '<a class="user" href="$1" target="_blank">$2</a>', $text);
		$text = preg_replace('|\[URL\](.*)\[/URL\]|Uism', '<a class="user" href="$1" target="_blank">$1</a>', $text);
		$text = preg_replace('|\[B\](.*)\[/B\]|Uism', '<b>$1</b>', $text);
		$text = preg_replace('|\[I\](.*)\[/I\]|Uism', '<i>$1</i>', $text);
		$text = preg_replace('|\[U\](.*)\[/U\]|Uism', '<u>$1</u>', $text);
		$text = preg_replace('|\[IMG\](.*)\[/IMG\]|Uism', '<img src="$1" border="0">', $text);
		$text = preg_replace('|\[COLOR=(.*)\](.*)\[/COLOR\]|Uism', '<font color="$1">$2</font>', $text);
		$text = preg_replace('|\[S\](.*)\[/S\]|Uism', "<div><div style=\"border-bottom: 1px solid #CCCCCC; margin-bottom: 3px; font-size: 9px;\"><span style=\"font-size: 9px;\" onclick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') {  this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerHTML = '<b>SPOILER: </b><a href=\'#\' onclick=\'return false;\'><b>AUSBLENDEN</b></a>'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerHTML = '<b>SPOILER: </b><a href=\'#\' onClick=\'return false;\'><b>ANZEIGEN</b></a>'; }\" /><b>SPOILER: </b><a href=\"#\" onclick=\"return false;\"><b>ANZEIGEN</b></a></span></div><div><div style=\"display: none;\">$1</div></div></div></span></div></div>", $text);

		return $text;
	}

	public static function replaceSmilies($text) {
		$text = str_replace(':D','<img src="images/smilies/biggrin.gif" border="0">', $text);
		$text = str_replace(':-D','<img src="images/smilies/biggrin.gif" border="0">', $text);
		$text = str_replace(':)','<img src="images/smilies/biggrin.gif" border="0">', $text);
		$text = str_replace(':-)','<img src="images/smilies/biggrin.gif" border="0">', $text);
		$text = str_replace(':P','<img src="images/smilies/razz.gif" border="0">', $text);
		$text = str_replace(':-P','<img src="images/smilies/razz.gif" border="0">', $text);
		$text = str_replace(':(','<img src="images/smilies/sad.gif" border="0">', $text);
		$text = str_replace(':-(','<img src="images/smilies/sad.gif" border="0">', $text);
		$text = str_replace(':shock:','<img src="images/smilies/eek.gif" border="0">', $text);
		$text = str_replace(':oops:','<img src="images/smilies/redface.gif" border="0">', $text);
		$text = str_replace(':evil:','<img src="images/smilies/evil.gif" border="0">', $text);
		$text = str_replace(':roll:','<img src="images/smilies/rolleyes.gif" border="0">', $text);
		$text = str_replace(';)','<img src="images/smilies/wink.gif" border="0">', $text);
		$text = str_replace(';-)','<img src="images/smilies/wink.gif" border="0">', $text);
		$text = str_replace(':!:','<img src="images/smilies/exclaim.gif" border="0">', $text);
		$text = str_replace(':?:','<img src="images/smilies/question.gif" border="0">', $text);
		$text = str_replace(':arrow:','<img src="images/smilies/arrow.gif" border="0">', $text);
		$text = str_replace(':idea:','<img src="images/smilies/idea.gif" border="0">', $text);
		$text = str_replace(':|','<img src="images/smilies/neutral.gif" border="0">', $text);
		$text = str_replace(':-|','<img src="images/smilies/neutral.gif" border="0">', $text);

		return $text;
	}
}

?>