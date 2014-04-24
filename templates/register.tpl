<!-- INCLUDE header.tpl -->

<script type="text/javascript">
function newimg() {
	document.getElementById('img').innerHTML = '<img style="position: relative;" height="42" width="132" src="register.php?image=' + new Date().getTime() + '" border="0" />';
}
</script>

<div class="content_title">
	<b>Registrieren</b>
</div>

<div class="content_text">

	<!-- IF ERROR -->
		<br />
		<center>
			{ERROR}
		</center>
	<!-- ENDIF -->

	<br />
	<form action="register.php" method="POST">
		<table width="100%" border="0" cellpadding="5" align="center">
			<tbody>
				<tr>
					<td width="200" align="right">Benutzername:</td>
					<td width="350">
						<input type="text" name="username" class="input" size="25">
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">E-Mail:</td>
					<td>
						<input type="text" name="mail" size="25" class="input">
						<br />
						<br />
					</td>
				</tr>
				<tr>
					<td align="right">Passwort:</td>
					<td>
						<input type="password" name="password" size="25" class="input">
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">Passwort wiederholen:</td>
					<td>
						<input type="password" name="password2" size="25" class="input">
						<br />
						<br />
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">Sicherheitscode:</td>
					<td>
						<table cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td width="70">
										<input type="text" name="sicherheitscode" size="5" maxlength="5">
									</td>
									<td rowspan="2" height="42" id="img">
										<img style="position: relative;" height="42" width="132" src="register.php?image=true" border="0" title="Sicherheitscode">
									</td>
								</tr>
								<tr>
									<td>
										<small><a href="javascript: newimg();">Neues Bild?</a></small>
									</td>
								</tr>
							</tbody>
						</table>
						<br />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Benutzer anlegen" class="button">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<!-- INCLUDE footer.tpl -->