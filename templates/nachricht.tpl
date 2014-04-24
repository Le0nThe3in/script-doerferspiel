<!-- INCLUDE header.tpl -->

<table width="100%">
	<tbody>
		<tr>
			<td height="20">
				<small>{ORDNER_STATS}</small>
				<br />
					<b><a href="nachricht.php">Posteingang</a></b>
				 | 	<b><a href="nachricht.php?ordner=2">Gesendete Nachrichten</a>
			</td>
			<td align="right" valign="bottom" height="20">
				<b><a href="nachricht.php?ordner={ORDNER}&mode=new">Nachricht schreiben</a>
			</td>
		</tr>
	</tbody>
</table>
<form name="eintrag" method="POST" action="nachricht.php?ordner={ORDNER}&mode=delete">
<table class="table" cellspacing="1" width="100%">
	<tbody>
		<tr> 
			<td colspan="2" class="form" width="95%"></td>
			<td class="form"></td>
		</tr>
		<!-- BEGIN messages -->
			<tr>
				<td bgcolor="#EFEFEF" align="center" valign="middle" width="5%" style="padding: 4px;"><img src="images/<!-- IF messages.GELESEN == 0 -->new<!-- ENDIF -->topic.gif" border="0"></td>
				<td bgcolor="#EFEFEF">
					<small>
						<b>» <a href="nachricht.php?ordner={messages.ORDNER}&mode=view&id={messages.ID}">{messages.BETREFF}</a></b>
						<br />{messages.VON_AN} 
						<!-- IF messages.USER_ID > 0 -->
							<a href="dorf.php?id={messages.USER_ID}">{messages.USERNAME}</a> am {messages.DATUM}
						<!-- ELSE -->
							Systemnachricht
						<!-- ENDIF -->
					</small>
					</td>
				<td bgcolor="#EFEFEF" align="center" valign="middle"><input type="checkbox" class="checkbox" name="{messages.ID}" value="true"></td>
			</tr>
		<!-- BEGINELSE -->
			<tr>
				<td bgcolor="#EFEFEF" align="center" valign="middle" width="22" style="padding: 4px;"></td>
				<td bgcolor="#EFEFEF" height="60" valign="top"><br>In diesem Ordner befinden sich keine Nachrichten</td>
				<td bgcolor="#EFEFEF"></td>
			</tr>
		<!-- END -->
	</tbody>
</table>

<table width="100%">
	<tbody>
		<tr>
			<td><div class="seite">{SEITEN}</div></td>
			<td valign="top" align="right">
			<select name="action" class="select" size="1">
				<option value="0">Bitte wählen...</option>
				<option value="1">Markierte löschen</option>
				<option value="2">Alle löschen</option>
			</select>
			<input class="button" type="submit" name="submit" value="Los">
			</td>
		</tr>
	</tbody>
</table>
<br><center><small><img src="images/topic.gif" border="0"> Alte Nachricht &nbsp;&nbsp;<img src="images/newtopic.gif" border="0"> Neue Nachricht</center>
</form>

<!-- INCLUDE footer.tpl -->