<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="view.php">Dorf-Übersicht</a></b>
	 -> 
	 <b><a href="#">Gebäude bauen</a></b>
</div>

<div class="content_text">

	<br />
	<!-- IF ERROR -->
		{ERROR}
	<!-- ENDIF -->

	<br />
	<form method="POST" action="build.php?mode=bombe_username">
		<br />
		<table>
			<tbody>
				<tr>
					<td valign="top" width="300">
						Username eingeben der bombadiert wird:
					</td>
					<td>
						<input type="text" name="user" />
						<br />
						<br />
						<input type="submit" name="submit" value="Absenden" class="button" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>

</div>

<!-- INCLUDE footer.tpl -->