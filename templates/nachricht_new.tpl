<!-- INCLUDE header.tpl -->

<script language="javascript">
function emoticon(text) {
	this.document.eintrag.text.value += text;
}
</script>

<form name="eintrag" style="display:inline;" action="nachricht.php?ordner={ORDNER}&mode=new" method="POST">

	<small>{ORDNER_STATS}</small>
	<br />
	<a href="nachricht.php?ordner={ORDNER}"><b>{ORDNER_NAME}</b></a> -> <a href="#"><b>Nachricht schreiben</b></a>

	<table class="table" cellspacing="1" width="100%">
		<tbody>
			<tr>
				<td colspan="2" class="form"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF"></td>
					<td bgcolor="#EFEFEF">
					<!-- IF ERROR -->
						<br />
						<center>
							{ERROR}
						</center>
					<!-- ENDIF -->
				</td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF">
					<br>Empfänger:</td>
				<td bgcolor="#EFEFEF"><br><input name="an" value="{AN}" size="30"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF">Betreff:</td>
				<td bgcolor="#EFEFEF"><input name="betreff" value="{BETREFF}" size="30"></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF"></td>
				<td bgcolor="#EFEFEF"><!-- INCLUDE bbcodes.tpl --></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF" valign="top">Text:</td>
				<td bgcolor="#EFEFEF"><textarea name="text" cols="70" rows="10">{TEXT}</textarea></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF"></td>
				<td bgcolor="#EFEFEF">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td><!-- INCLUDE smilies.tpl --></td>
								<td align="right"><span onclick="document.getElementById('optionen').style.display = document.getElementById('optionen').style.display == 'none' ? '' : 'none';"><a onclick="return false" href="#">Optionen</a></span>&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr style="display:none;" id="optionen">
				<td bgcolor="#EFEFEF"></td>
				<td bgcolor="#EFEFEF"><br><label for=1><input id="1" class="checkbox" type="checkbox" value="1" name="bbcodes"> BBCodes ausschalten</label><br><label for=2><input id="2" class="checkbox" type="checkbox" value="1" name="smilies"> Smilies ausschalten</label><br><label for=3><input id="3" class="checkbox" type="checkbox" value="1" name="signatur" checked> Signatur anhängen</label><br><br></td>
			</tr>
			<tr>
				<td bgcolor="#EFEFEF"></td>
				<td bgcolor="#EFEFEF"><input type="submit" name="submit" value="Absenden" class="button"><br><br></td>
			</tr>
		</tbody>
	</table>
</form>

<!-- INCLUDE footer.tpl -->