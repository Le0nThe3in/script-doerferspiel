<!-- INCLUDE header.tpl -->

<script language="javascript">
function emoticon(text) {
	this.document.eintrag.text.value += text;
}
</script>

<div class="content_title">
	<b><a href="group.php">Gruppen</a></b> -> <b><a href="#">{NAME}</a></b>
</div>

<div class="content_text">

	<br />
	<table cellpadding="5">
		<tbody>
			<tr>
				<td align="right">Besitzer:</td>
				<td>
					<a class="user" href="dorf.php?id={USER_ID}">{BESITZER}</a>
				</td>
			</tr>
			<tr>
				<td align="right">Dorf:</td>
				<td><font color="#606046">{DORF}</font></td>
			</tr>
			<tr>
				<td align="right">Mitglieder (Zahl):</td>
				<td>{MEMBERS_NUM}</td>
			</tr>
			<tr>
				<td valign="top" align="right">Mitglieder (User):</td>
				<td>
					<!-- BEGIN members -->
						<a class="user" href="dorf.php?id={members.USER_ID}">{members.USERNAME}</a>
						<br />
					<!-- BEGINELSE -->
						<font color="#606046">Keine</font>
					<!-- END -->
				</td>
			</tr>
		</tbody>
	</table>
	<br />Beschreibung
	<br />
	<font color="#606046">{BESCHREIBUNG}</font>
	<br />
	<br />

</div>

<!-- INCLUDE footer.tpl -->