<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="group.php">Gruppen</a></b> -> <b><a href="#">Mitglieder</a></b>
</div>

<div class="content_text">

	<br />
	<table>
		<tbody>
			<tr>
				<td width="100" valign="top"><b>Anträge:</b></td>
				<td>
					<!-- BEGIN antrag -->
						<a href="group.php?mode=deleteAntrag&id={antrag.USER_ID}">[X]</a> 
						<a href="group.php?mode=aufnehmen&id={antrag.USER_ID}">[Aufnehmen]</a> 
						<a class="user" href="dorf.php?id={antrag.USER_ID}">{antrag.USERNAME}</a>
						<br />
					<!-- BEGINELSE -->
						Keine
					<!-- END -->
					<br /><br />
				</td>
			</tr>
			<tr>
				<td valign="top"><b>Mitglieder:</b></td>
				<td>
					<!-- BEGIN members -->
						<a href="group.php?mode=deleteMember&id={members.USER_ID}">[X]</a> 
						<a class="user" href="dorf.php?id={members.USER_ID}">{members.USERNAME}</a>
						<br />
					<!-- BEGINELSE -->
						Keine
					<!-- END -->
				</td>
			</tr>
		</tbody>
	</table>
	<br>
</div>

<!-- INCLUDE footer.tpl -->