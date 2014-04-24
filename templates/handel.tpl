<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b>Handel</b>
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
	<br />
	<b>Energie: </b>
	<!-- IF ENERGIE != 0 -->
		<a class="user" href="handel.php?energie">Vorrat ({ENERGIE}) gegen {UMTAUSCH_ENERGIE_GOLD} Goldtsück(e) umtauschen</a>
	<!-- ELSE -->
		Keine Energievorrat vorhanden
	<!-- ENDIF -->
	<br />
	<br />
	<b>Tränke: </b>
	<!-- IF TRANK != 0 -->
		<a class="user" href="handel.php?trank">Vorrat ({TRANK}) gegen {UMTAUSCH_TRANK_GOLD} Goldstück(e) umtauschen</a>
	<!-- ELSE -->
		Keine Trankvorrat vorhanden
	<!-- ENDIF -->
	<br />
	<br />
	<b>Metall: </b>
	<!-- IF METALL != 0 -->
		<a class="user" href="handel.php?metall">Vorrat ({METALL}) gegen {UMTAUSCH_METALL_GOLD} Goldstück(e) umtauschen</a>
	<!-- ELSE -->
		Keine Metallvorrat vorhanden
	<!-- ENDIF -->
	<br />
	<br />
</div>

<!-- INCLUDE footer.tpl -->