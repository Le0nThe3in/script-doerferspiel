<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b>Welt</b>
</div>

<div class="content_text">
	<table border="0">
		<tbody>
			<tr>
				<td width="120" valign="top">Benutzer online:</td>
				<td>
					<!-- BEGIN online --><!-- IF online.I > 0 -->, <!-- ENDIF --><a class="user" href="dorf.php?id={online.USER_ID}">{online.USERNAME}</a><!-- BEGINELSE -->
						Keine
					<!-- END -->
					<br />
					<br />
				</td>
			</tr>
			<tr>
				<td>Spieler insgesamt:</td>
				<td>
					<font color="#606046">{SPIELER}</font>
				</td>
			</tr>
			<tr>
				<td>Gesamtes Gold:</td>
				<td><font color="#606046">{GOLD}</font></td>
			</tr>
		</tbody>
	</table>
	<br />
	<br />
	<br />
	<b>Topliste</b>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<thead>
			<tr>
				<td>Platz</td>
				<td>Dorf</td>
				<td>Gold</td>
				<td>Einwohner</td>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN toplist -->
				<tr>
					<td>{toplist.NUMMER}</td>
					<td>
						<a href="dorf.php?id={toplist.USER_ID}"><font color="#606046">{toplist.DORF}</font></a>
					</td>
					<td>
						<font color="#606046">{toplist.PUNKTE}</font>
					</td>
					<td>
						<font color="#606046">{toplist.EINWOHNER}</font>
					</td>
				</tr>
			<!-- END toplist -->
		</tbody>
	</table>
	<br />
	<br />
</div>

<!-- INCLUDE footer.tpl -->