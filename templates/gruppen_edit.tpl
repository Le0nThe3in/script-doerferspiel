<!-- INCLUDE header.tpl -->

<script language="javascript">
function emoticon(text) {
	this.document.eintrag.text.value += text;
}
</script>

<div class="content_title">
	<b><a href="group.php">Gruppe</a></b> -> <b><a href="#">{TITLE}</a></b>
</div>

<div class="content_text">
	<br />
	<form name="eintrag" action="group.php?mode={MODE}" method="POST">
		<table cellpadding="5" cellpadding="2" width="100%" border="0" align="center">
			<tbody>
				<tr>
					<td width="150" align="right">Name:</td>
					<td>
						<input name="name" value="{NAME}" size="30">
					</td>
				</tr>
				<tr>
					<td width="150" height="10"></td>
					<td>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td height="10" style="padding: 0px 5px 0px 5px;"><!-- INCLUDE bbcodes.tpl --></td>
				</tr>
				<tr>
					<td align="right" width="150" valign="top">Beschreibung:</td>
					<td><textarea name="text" cols="50" rows="8">{BESCHREIBUNG}</textarea></td>
				</tr>
				<tr>
					<td></td>
					<td style="padding: 0px 5px 0px 5px;"><!-- INCLUDE smilies.tpl --></td>
				</tr>
				<tr>
					<td width="150"></td>
					<td><input type="submit" name="submit" value="Absenden" class="button"></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<br />
<br />

<!-- INCLUDE footer.tpl -->