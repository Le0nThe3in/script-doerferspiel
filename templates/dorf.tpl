<!-- INCLUDE header.tpl -->

<div class="content_title">
	<b>{DORF}</b>
</div>

<div class="content_text">
	<table cellspacing="1" width="100%">
		<tbody>
			<tr>
				<td align="center">
					<!-- IF AVATAR -->
						<img src="{AVATAR}" border="0" />
					<!-- ELSE -->
						 <br />
					<!-- ENDIF -->
					<br />

					<br /><small><font color="#606046">{TYP}</font></small>
				</td>
				<td align="center">
						<br />
					<table>
						<tbody>
							<tr>
								<td align="right">Besitzer:</td>
								<td><font color="#606046">{USERNAME}</font></td>
							</tr>
							<tr>
								<td align="right">Gold:</td>
								<td><font color="#606046">{PUNKTE}</font></td>
							</tr>
							<tr>
								<td align="right">Einwohner:</td>
								<td><font color="#606046">{EINWOHNER}</font></td>
				 			</tr>
							<tr>
								<td valign="top" align="right">Gruppe:</td>
								<td>
									<font color="#606046">
										<!-- IF GRUPPE_ID -->
											<a class="user" href="group.php?mode=view&id={GRUPPE_ID}">{GRUPPE_NAME}</a>
										<!-- ELSE -->
											Keine
										<!-- ENDIF -->
										<!-- IF ANTRAG -->
											<br />
											-> <a href="group.php?mode=antrag&id={GRUPPE_ID}">Mitgliedsantrag schicken</a>
										<!-- ENDIF -->
									</font>
								</td>
							</tr>
							<tr>
								<td align="right">Status:</td>
								<td><font color="#606046">{STATUS}</font></td>
							</tr>
						</tbody>
					</table><br />
				</td>
			</tr>
			<tr>
				<td valign="top"><br /><small>» <a href="nachricht.php?mode=new&id={USER_ID}"><img src="images/pn.gif" border="0"> Nachricht schreiben</a></small><br /><br /></td>
				<td valign="top" bgcolor="#EFEFEF"><br /><font color="#606046">{BESCHREIBUNG}</font></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>

<!-- IF IS_ADMIN -->
	<!-- IF GESPERRT -->
		[ <a href="admin.php?mode=entsperren&id={USER_ID}">User entsperren</a> ]
	<!-- ELSE -->
		[ <a href="admin.php?mode=sperren&id={USER_ID}">User sperren</a> ]
	<!-- ENDIF --> 

	[ <a href="admin.php?mode=mahn&id={USER_ID}">User mahnen</a> (Bisling {MAHNUNGEN}) ]
<!-- ENDIF -->

<!-- INCLUDE footer.tpl -->