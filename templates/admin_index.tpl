<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="admin.php">Adminpanel</a></b>
</div>

<div class="content_text">
	<form method="POST" action="admin.php">
		<br />
		<table>
			<tbody>
				<tr>
					<td width="200" valign="top">
						Benutzer bearbeiten:
						<br />
						<font color="#606046">Gib den Usernamen ein.</font>
					</td>
					<td>
						<input type="text" name="user" />
						<br />
						<br />
						<input class="button" type="submit" name="submit" value="Absenden" />
						<!-- IF ERROR -->
							{ERROR}
						<!-- ENDIF -->
						<br />
						<br />
						<br />
					</td>
				</tr>
				<tr>
					<td>Links:</td>
					<td>
						<a href="admin.php?mode=members">Mitglieder anzeigen</a>
						<br /><a href="admin.php?mode=mail">Rundmail (private Nachricht)</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<!-- INCLUDE footer.tpl -->