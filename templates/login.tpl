<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b>Login</b>
</div>

<div class="content_text">

	<!-- IF ERROR -->
		<br />
		<center>
			{ERROR}
		</center>
	<!-- ENDIF -->

	<br />
	<form action="login.php" method="POST">
		<table width="100%" border="0" cellpadding="5" cellspacing="1" align="center">
			<tbody>
				<tr>
					<td width="200" align="right">Benutzername:</td>
					<td width="350"><input type="text" name="username" size="20" class="input"></td>
				</tr>
				<tr>
					<td align="right">Passwort:</td>
					<td><input type="password" name="password" size="20" class="input"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<small>
							<a href="login.php?forgot">Ich habe mein Passwort vergessen</a>
						</small>
						<br />
						<br />
						<table>
							<tbody>
								<tr>
									<td>
										<input type="checkbox" id="speichern" class="checkbox" name="speichern" value="true">
									</td>
									<td>
										<label for="speichern"><small>Mich bei jedem Besuch automatisch einloggen</small></label>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Login" class="button"></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<!-- INCLUDE footer.tpl -->