<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b>Passwort vergessen</b>
</div>

<div class="content_text">
	<center>

	<!-- IF ERROR -->
		<br />
			{ERROR}
	<!-- ENDIF -->

		<form action="login.php?forgot" method="POST">
			<br />
			<br />
			<table width="80%" border="0" cellpadding="5" align="center">
				<tbody>
					<tr>
						<td width="150" align="right">Benutzername:</td>
						<td>
							<input type="text" name="user" class="input" size="25">
						</td>
					</tr>
					<tr>
						<td width="150" align="right">Angegebene E-Mail:</td>
						<td>
							<input type="text" name="email" size="25" class="input">
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="send" value="Absenden" class="button">
						</td>
					</tr>
				</tbody>
			</table>
			<br />
			<br />
		</form>
	</center>
</div>

<!-- INCLUDE footer.tpl -->