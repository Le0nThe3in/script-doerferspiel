<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="view.php">Dorf-Übersicht</a></b>
	 -> 
	<b><a href="#">Gebäude bauen</a></b>
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
					Bomben: <font color="#606046">{BOMBE}</font>
				</td>
			</tr>
		</tbody>
	</table>
	<br />

	<b>{NAME}</b>
	<br />
	Stufe: {STUFE}
	<br />
	<br />Kosten: {KOSTEN}<br>Vorteil bei {STUFE_NEXT} Stufe: {VORTEIL}

	<!-- IF HAUS_ICO == 3 -->
		<br />
		<br />
		<b>:: Bomben</b> (im Besitz: {BOMBEN})
		<br />
		-> <a class="user" href="build.php?mode=bombe_prod&platz={PLATZ}">1 Bombe herstellen (kosten: 50 Gold)</a><br>-> <a class="user" href="build.php?mode=bombe_username">Bomben abwerfen</a>
	<!-- ENDIF -->

	<br /><br />
	<!-- IF STUFE_NEXT > 20 -->
		<b>Das Gebäude ist vollständig ausgebaut</b>
	<!-- ELSEIF WIRD_GEBAUT -->
		<u>Ausbauen nicht möglich (es wird bereits gebaut)</u>
	<!-- ELSE -->
		<a class="user" href="build.php?mode=ausbau&platz={PLATZ}">Dieses Gebäude ausbauen auf Stufe {STUFE_NEXT}</a>
	<!-- ENDIF -->
	 | <a class="user" href="build.php?mode=abreissen&platz={PLATZ}">Gebäude abreißen</a>
	<br /><br /><br />

	<!-- IF STUFE == 0 -->
		<br />Das Haus muss erst gebaut werden!
		<br /><br />
		<a href="view.php" class="user">Klicke hier</a>, um zur Dorf-Übersicht zurückzukehren
	<!-- ENDIF -->

</div>

<!-- INCLUDE footer.tpl -->