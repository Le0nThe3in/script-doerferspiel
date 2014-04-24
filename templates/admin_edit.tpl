<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="admin.php">Adminpanel</a></b> -> <b><a href="#">Benutzer bearbeiten</a></b>
</div>

<div class="content_text">

	<form name="eintrag" action="admin.php?mode=edit" method="POST">
		<br>
		<table>
			<tbody>
				<tr>
					<td width="200" valign="top">
						Benutzerame:
					</td>
					<td>
						<input value="{USERNAME}" type="text" size="30" name="name">
					</td>
				</tr>
				<tr>
					<td valign="top">E-mail:</td>
					<td><input value="{EMAIL}" type="text" size="30" name="email"></td>
				</tr>
				<tr>
					<td valign="top">Dorf:</td>
				<td>
					<input value="{DORF}" type="text" size="30" name="dorf"></td>
				</tr>
				<tr>
					<td valign="top">Gold:</td>
					<td><input value="{PUNKTE}" type="text" size="30" name="punkte"></td>
				</tr>
				<tr>
					<td valign="top">AvatarUrl:</td>
					<td><input value="{AVATAR}" type="text" size="30" name="avatar"></td>
				</tr>
				<tr>
					<td valign="top">Beschreibung:</td>
					<td>
						<textarea name="beschreibung" cols="40" rows="8">{BESCHREIBUNG}</textarea>
						<input value="{USER_ID}" type="hidden" name="id">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" size="1" value="{MAHNUNG}" name="mahnung"> Mahnungen</td>
				</tr>
				<tr>
					<td></td>
					<td><input class="checkbox" type="checkbox" name="sperren" value="1"<!-- IF SPERREN == 1 --> checked<!-- ENDIF -->> Gesperrt
						<br>
						<br>
					</td>
				</tr>
				<tr>
					<td>Neues Passwort:<br><small>(Passwort nur eingeben,<br>wenn es geändert werden soll)</small></td>
					<td valign="top"><input size="30" name="password" type="password" size="30"></td>
				</tr>
				<tr>
					<td>Passwort wiederholen:</td>
					<td><input name="password2" size="30" type="password" size="30"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" class="button" value="Absenden"></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<!-- INCLUDE footer.tpl -->