<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="view.php">Dorf-Übersicht</a></b> -> <b><a href="#">Bomben</a></b>
</div>

<div class="content_text">

	<table width="100%">
		<tbody>
			<tr>
				<td>Dorf: <font color="#606046">{DORF}</font></td>
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
	<br />
	<b>Dorf angreifen:</b> {DORF_USER} | Besitzer: {USERNAME}
	<br />Bomben in meinem Besitz: {BOMBEN}<br /><br /><b>Bauplatz Nr.1: {HAUS1_NAME}</b>
	<!-- IF HAUS1 > 0 -->(Stufe: {HAUS1}) <a class="user" href="build.php?mode=bombe&send=1&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.2: {HAUS2_NAME}</b>
	<!-- IF HAUS2 > 0 -->(Stufe: {HAUS2}) <a class="user" href="build.php?mode=bombe&send=2&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.3: {HAUS3_NAME}</b>
	<!-- IF HAUS3 > 0 -->(Stufe: {HAUS3}) <a class="user" href="build.php?mode=bombe&send=3&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.4: {HAUS4_NAME}</b>
	<!-- IF HAUS4 > 0 -->(Stufe: {HAUS4}) <a class="user" href="build.php?mode=bombe&send=4&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.5: {HAUS5_NAME}</b>
	<!-- IF HAUS5 > 0 -->(Stufe: {HAUS5}) <a class="user" href="build.php?mode=bombe&send=5&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.6: {HAUS6_NAME}</b>
	<!-- IF HAUS6 > 0 -->(Stufe: {HAUS6}) <a class="user" href="build.php?mode=bombe&send=6&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.7: {HAUS7_NAME}</b>
	<!-- IF HAUS7 > 0 -->(Stufe: {HAUS7}) <a class="user" href="build.php?mode=bombe&send=7&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.8: {HAUS8_NAME}</b>
	<!-- IF HAUS8 > 0 -->(Stufe: {HAUS8}) <a class="user" href="build.php?mode=bombe&send=8&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br /><b>Bauplatz Nr.9: {HAUS9_NAME}</b>
	<!-- IF HAUS9 > 0 -->(Stufe: {HAUS9}) <a class="user" href="build.php?mode=bombe&send=9&id={USER_ID}">Bombe abschicken</a><!-- ELSE -->Kein Gebäude vorhanden<!-- ENDIF --><br /><br />

</div>

<!-- INCLUDE footer.tpl -->