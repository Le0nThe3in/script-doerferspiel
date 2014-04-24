<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b><a href="#">Gruppen</a></b>
</div>

<div class="content_text">

	<!-- IF GRUPPE_ID -->
		<br />
		Gruppenmitgliedsschaft:
		<br />
		<br />
		-> <a class="user" href="group.php?mode=view&id={GRUPPE_ID}">Gruppe anschauen</a>
		<br />
		<!-- IF NOT EIGENE_GRUPPE -->
			-> <a class="user" href="group.php?mode=deleteMembership">Gruppenmitgliedschaft kündigen</a>
		<!-- ENDIF -->
		<br />
		<br />
		<!-- IF EIGENE_GRUPPE -->
			Eigene Gruppe:
			<br />
			<br />
			-> <a class="user" href="group.php?mode=edit">Gruppeneinstellungen ändern</a>
			<br />
			-> <a class="user" href="group.php?mode=members">Mitgliederliste/Anträge bearbeiten</a>
			<br />
			-> <a class="user" href="group.php?mode=delete">Gruppe löschen</a>
			<br />
			<br />
		<!-- ENDIF -->
	<!-- ELSE -->
		<br />Gruppenmitgliedsschaft:
		<br />
		<br />Um einer Gruppe beizutreten, musst du das Profil der Gruppe besuchen.
		<br />
		<br />Eigene Gruppe:
		<br />
		<br />
		-> <a class="user" href="group.php?mode=new">Neue Gruppe erstellen</a>
	<!-- ENDIF -->

</div>

<br />
<br />

<!-- INCLUDE footer.tpl -->