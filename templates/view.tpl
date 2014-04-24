<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="view.php">Dorf-Übersicht</a></b>
</div>

<div class="content_text">

	<table width="100%">
		<tbody>
			<tr>
				<td>
					Dorf: <font color="#606046">{DORF} • </font> 
					Einwohner: <font color="#606046">{EINWOHNER}</font> 
				</td>
				<td align="right">
					Gold: <font color="#606046">{PUNKTE} •</font> 
					Tränke: <font color="#606046">{TRANK} •</font> 
					Energie: <font color="#606046">{ENERGIE} •</font> 
					Metall: <font color="#606046">{METALL} •</font> 
					Bomben: <font color="#606046">{BOMBEN}</font>
				</td>
			</tr>
		</tbody>
	</table>

	Links:
	<!-- IF NOCH > 0 -->
		<u>Tag beginnen</u>
	<!-- ELSE -->
		<span onclick="document.getElementById('box').style.display = document.getElementById('box').style.display == 'none' ? '' : 'none';">
			<noscript><a href="view.php?wrong=true"></noscript>
			<a class="user" onclick="return false" href="#">Tag beginnen</a>
			<noscript></a></noscript>
		</span>
	<!-- ENDIF -->

	<!-- IF VERWALTUNG == 1 -->
		 | <a class="user" href="group.php">Gruppe</a>
	<!-- ENDIF -->

	 | <a class="user" href="userdaten.php">Einstellungen</a>
	 | <a class="user" href="view.php?hilfe">Hilfe</a>
	 <br />

	<!-- IF NACHRICHT -->
		<a href="view.php?delete=1">[X]</a> 
		<font color="red">{NACHRICHT}</font>
		<br />
	<!-- ENDIF -->

	<!-- IF NOCH > 0 -->
		<br />
		<b>Ein Tag ist am laufen</b> noch <font id="min">{NOCH}</font> <font id="min_text">Minute<!-- IF NOCH != 1 -->n<!-- ENDIF --></font> 
		<a href="build.php?mode=cancel_tag">Abbrechen</a>
	<!-- ENDIF -->

	<!-- IF NOCH2 > 0 -->
		<br><b>{AUSBAU_NAME} wird <!-- IF AUSBAU_STUFE == 1 -->gebaut<!-- ELSE --> ausgebaut auf Stufe {AUSBAU_STUFE}<!-- ENDIF --></b> noch <font id="min2">{NOCH2}</font> <font id="min2_text">Minute<!-- IF NOCH2 != 1 -->n<!-- ENDIF --></font> 
		<a href="build.php?mode=cancel_ausbauen">Abbrechen</a>
		<br />
	<!-- ENDIF -->

	<div style="<!-- IF HIDE_CAPTCHA -->display: none;<!-- ENDIF -->" padding="5px" id="box"><form action="view.php?begin" method="POST"><img align="left" src="register.php?image=true" border="0"> Sicherheitscode (Schutz vor Bots):<br><input type="text" size="4" name="sicherheitscode"> <input class="button" type="submit" value="Los"></form></div><center><br><table width="395" cellpadding="0" cellspacing ="0"><tbody><tr><td valign="top" height="367" style="background-image: url(images/meindorf.gif);"><table width="100%" border="0" height="100%"><tbody><tr><td valign="bottom" align="right">
	<!-- IF HAUS1_ICO != 0 --><a href="build.php?g=1"><img src="images/{HAUS1_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=1"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF -->
	<!-- IF HAUS2_ICO != 0 -->&nbsp;<a href="build.php?g=2"><img src="images/{HAUS2_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=2"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --></td><td height="30%" valign="middle">
	<!-- IF HAUS3_ICO != 0 --><a href="build.php?g=3"><img src="images/{HAUS3_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=3"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --></td></tr><tr><td align="center" valign="bottom" height="55%">
	<!-- IF HAUS4_ICO != 0 --><a href="build.php?g=4"><img src="images/{HAUS4_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=4"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --><br><br>
	<!-- IF HAUS5_ICO != 0 --><a href="build.php?g=5"><img src="images/{HAUS5_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=5"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --></td><td align="center">
	<!-- IF HAUS6_ICO != 0 --><a href="build.php?g=6"><img src="images/{HAUS6_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=6"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --><br><br><br>
	<!-- IF HAUS7_ICO != 0 --><a href="build.php?g=7"><img src="images/{HAUS7_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=7"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --><br><br>
	<!-- IF HAUS8_ICO != 0 --><a href="build.php?g=8"><img src="images/{HAUS8_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=8"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --></td></tr><tr><td></td><td width="52%">
	<!-- IF HAUS9_ICO != 0 --><a href="build.php?g=9"><img src="images/{HAUS9_ICO}.gif" border="0"></a><!-- ELSE --><a href="build.php?ort=9"><img border="0" alt="Bauplatz" src="images/build.gif"></a><!-- ENDIF --></td></tr></tbody></table></td></tr></tbody></table></center><br><br>

	<!-- IF IS_ADMIN -->
		<center><small><a href="admin.php">Administration Bereich</a></small></center>
		<br />
	<!-- ENDIF -->

</div>


<script type="text/javascript">
var min = {NOCH};
var min2 = {NOCH2};
var inter = window.setInterval('timeto()', 60000);

function load() {
	window.clearInterval(inter);
	window.location.href = 'view.php?auto=true';
}

function timeto() {
	min--;
	min2--;

<!-- IF NOCH > 0 -->
	document.getElementById('min').innerHTML = min;
	if (min == 1) {
		document.getElementById('min_text').innerHTML = 'Minute';
	}
	if (min == 0) {
		load();
	}
<!-- ENDIF -->

<!-- IF NOCH2 > 0 -->
	document.getElementById('min2').innerHTML = min2;
	if (min2 == 1) {
		document.getElementById('min2_text').innerHTML = 'Minute';
	}
	if (min2 == 0) {
		load();
	}
<!-- ENDIF -->
}
</script>

<!-- INCLUDE footer.tpl -->