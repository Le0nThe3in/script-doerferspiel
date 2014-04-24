<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="view.php">Dorf-Übersicht</a></b> -> <b><a href="#">Gebäude bauen</a></b>
</div>

<div class="content_text">
	<table width="100%">
		<tbody>
			<tr>
				<td>
					Dorf: <font color="#606046">{DORF}</font>
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
	<br />

	<b>Bauplatz Nr.: {PLATZ}</b><br /><br />
	<!-- IF WIRD_GEBAUT -->
		<b>Windmühle bauen</b> (es wird bereits gebaut)
	<!-- ELSE -->
		<b><a class="user" href="build.php?art=5&ort={PLATZ}">Windmühle bauen</a></b>
	<!-- ENDIF -->
	<br />Kosten: 50 Gold
	<br />Stellt her: 22 Energie/Tag
	<br />
	<br />
	<!-- IF WIRD_GEBAUT -->
		<b>Brauerei bauen</b> (es wird bereits gebaut)
	<!-- ELSE -->
		<b><a class="user" href="build.php?art=1&ort={PLATZ}">Brauerei bauen</a></b>
	<!-- ENDIF -->
	<br />Kosten: 50 Gold
	<br />Stellt her: 22 Tränke/Tag
	<br />
	<br />
	<!-- IF WIRD_GEBAUT -->
		<b>Miene bauen</b> (es wird bereits gebaut)
	<!-- ELSE -->
		<b><a class="user" href="build.php?art=2&ort={PLATZ}">Miene bauen</a></b>
	<!-- ENDIF -->
	<br />Kosten: 50 Gold
	<br />Stellt her: 22 Metll/Tag
	<br />
	<br />

	<!-- IF VERWALTUNG_EXIST == 0 -->
		<!-- IF WIRD_GEBAUT -->
			<b>Verwaltung bauen</b> (es wird bereits gebaut)
		<!-- ELSE -->
			<b><a class="user" href="build.php?art=4&ort={PLATZ}">Verwaltung bauen</a></b>
		<!-- ENDIF -->
		<br />Kosten: 50 Gold
		<br />Stellt her: Benutzergruppen verfügbar
		<br />
		<br />
	<!-- ENDIF -->

	<!-- IF WAFFENPROD_EXIST == 0 -->
		<!-- IF WIRD_GEBAUT -->
			<b>Waffenproduktion bauen</b> (es wird bereits gebaut)
		<!-- ELSE -->
			<b><a class="user" href="build.php?art=3&ort={PLATZ}">Waffenproduktion bauen</a></b>
		<!-- ENDIF -->
		<br />Kosten: 50 Gold
		<br />Stellt her: 1 Bombe/50 Gold
		<br />
		<br />
	<!-- ENDIF -->
</div>

<!-- INCLUDE footer.tpl -->