<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="admin.php">Adminpanel</a></b> -> <b><a href="#">Aktionen</a></b>
</div>

<div class="content_text">

	<table width="100%" border="0" cellspacing="1" cellpadding="3">
		<thead>
			<tr>
				<td><b>ID</b></td>
				<td><b>Nickname</b></td>
				<td><b>E-Mail</b></td>
				<td><b>Gold</b></td>
				<td><b>Aktion</b></td>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN members -->
			<tr>
				<td>{members.USER_ID}</td>
				<td>{members.USERNAME}</td>
				<td>{members.EMAIL}</td>
				<td>{members.PUNKTE}</td>
				<td>
					<a href="admin.php?mode=delete&id={members.USER_ID}">löschen</a> &nbsp; 
					<a href="admin.php?mode=edit&id={members.USER_ID}">bearbeiten</a>
				</td>
			</tr>	
			<!-- END -->
		</tbody>
	</table>

	<br />
	<div class="seite">Gehe zu Seite: {SEITEVIEW}</div>
	<br />
</div>

<!-- INCLUDE footer.tpl -->