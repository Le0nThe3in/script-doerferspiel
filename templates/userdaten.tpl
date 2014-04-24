<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="view.php">Dorf-Übersicht</a></b> -> <b><a href="userdaten.php">Einstellungen</a></b>
</div>

<form enctype="multipart/form-data" action="userdaten.php" method="POST">
	<table class="table" cellspacing="1" width="100%">
		<tbody>
			<tr>
				<td colspan="2" class="form"></td>
			</tr>
			<tr>
				<td colspan="2" height="20" bgcolor="#EFEFEF">

					<!-- IF ERROR -->
						<br />
						<center>
							{ERROR}
						</center>
					<!-- ENDIF -->

				</td>
			</tr>
			<tr>
				<td width="170" bgcolor="#EFEFEF">Benutzername: *</td>
				<td bgcolor="#EFEFEF"><b>{USERNAME}</b></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF">Email: *</td>
				<td bgcolor="#EFEFEF"><input name="email" value="{EMAIL}" size="30"></td>
			</tr>
			<tr>
				<td colspan="2" bgcolor="#EFEFEF" height="10"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" colspan="2" width="150" height="10"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF">Dorfname: *</td>
				<td bgcolor="#EFEFEF"><input name="dorf" value="{DORF}" size="30" /></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" valign="top">Beschreibung:</td>
				<td bgcolor="#EFEFEF">
					<table cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td><textarea name="beschreibung" cols="50" rows="5">{BESCHREIBUNG}</textarea>
									<div style="text-align: right;"><span onclick="document.getElementById('optionen').style.display = document.getElementById('optionen').style.display == 'none' ? '' : 'none';"><a onclick="return false" href="#">Optionen</a></span></div>
									<div style="display: none;" id="optionen">
										<input type="checkbox" name="bbcodes" class="checkbox" value="1" id="bb"<!-- IF CHECKEDBB == 0 --> checked<!-- ENDIF -->> <label for=bb>BBCodes auschalten</label>
										<br />
										<input type="checkbox" name="smilies" value="1" class="checkbox" id="s"<!-- IF CHECKEDS == 0 --> checked<!-- ENDIF -->> <label for=s>Smilies ausschalten</label><br><br></div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" colspan="2" height="15"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" colspan="2">
					<center>
						<table cellpadding="5">
							<tbody>
								<tr>
									<td width="280"><small>Der Avatar ist eine kleine Grafik der in deinem Profil und neben deinen Beiträge angezeigt wird. Die Grafik darf nicht größer als 70 KB, nicht breiter als 130 Pixel und nicht größer als 160 Pixel sein.</small></td>
									<td width="10"></td>
									<td align="center">
										<small>
											<!-- IF AVATAR -->
												Aktuelles Bild:
												<br />
												<img src="{AVATAR}" border="0" />
												<br />
												<label style="cursor:pointer;" for="del">
													<input type="checkbox" name="del" id="del" value="true" class="checkbox"> Bild löschen
												</label>
											<!-- ENDIF -->
										</small>
									</td>
								</tr>
							</tbody>
						</table>
					</center>
				</td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" width="150" valign="top">Avatar&nbsp;von&nbsp;URL&nbsp;hochladen:</td>
				<td bgcolor="#EFEFEF"><input name="avatar" type="text" value="" size="30"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" width="150" valign="top">Avatar von PC hochladen:</td>
				<td bgcolor="#EFEFEF"><input class="input" size="30" type="file" name="bild"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" colspan="2" height="15"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF">Neues Passwort:</td>
				<td bgcolor="#EFEFEF"><input name="password" type="password" size="30" /></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF">Passwort wiederholen:</td>
				<td bgcolor="#EFEFEF"><input name="password2" type="password" size="30" /></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" colspan="2" height="15"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF"></td>
				<td bgcolor="#EFEFEF"><small>Alle Felder mit einem * müssen ausgefüllt werden.</small></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF"></td>
				<td bgcolor="#EFEFEF"><input type="submit" name="submit" value="Absenden" class="button"><br><br></td>
			</tr>
		</tbody>
	</table>
</form>

<!-- INCLUDE footer.tpl -->