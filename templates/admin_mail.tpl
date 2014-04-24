<!-- INCLUDE header.tpl -->

<script language="javascript">
function emoticon(text) {
	this.document.forms.eintrag.text.value += text;
}
</script>

<div class="content_title">
	<b><a href="admin.php">Adminpanel</a></b> -> <b><a href="admin.php?mode=mail">Rundmail (private Nachricht)</a></b>
</div>

<div class="content_text">

	<br>
	<form name="eintrag" action="admin.php?mode=mail" method="POST">
		<table>
			<tbody>
				<tr>
					<td width="100">Absender:</td>
					<td><b>Systemnachricht</b></td>
				</tr>
				<tr>
					<td>Betreff:</td>
					<td><input type="betreff" size="30" name="betreff"></td>
				</tr>
				<tr>
					<td></td>
					<td><!-- INCLUDE bbcodes.tpl --></td>
				</tr>
				<tr>
					<td width="100" valign="top">Text:</td>
					<td><textarea name="text" cols="60" rows="7"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td><!-- INCLUDE smilies.tpl --></td>
									<td align="right"><span onclick="document.getElementById('optionen').style.display = document.getElementById('optionen').style.display == 'none' ? '' : 'none';"><a onclick="return false" href="#">Optionen</a></span></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr style="display:none;" id="optionen">
					<td></td>
					<td>
						<br>
						<input type="checkbox" class="checkbox" value="1" name="bbcodes" id="1"> <label for=1>BBCodes ausschalten</label>
						<br>
						<input type="checkbox" class="checkbox" name="smilies" value="1" id="2"> <label for=2>Smilies ausschalten</label>
						<br>
						<br>
					</td>
				</tr>
				<tr>
					<td><input type="hidden" value="'.$_GET['id'].'" name="id"></td>
					<td><input class="button" type="submit" name="submit" value="Absenden">
						<br>
						<br>
					</td>
				</tr>
			</tbody>
		</table>
		<br>
	</form>
</div>

<!-- INCLUDE footer.tpl -->