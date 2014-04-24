<!-- INCLUDE header.tpl -->

<table width="100%">
	<tbody>
		<tr>
			<td height="20">
				<small>{ORDNER_STATS}</small>
				<br />
				<b><a href="nachricht.php?ordner={ORDNER}">{ORDNER_NAME}</a></b>
				 -> 
				 <b><a href="nachricht.php?ordner={ORDNER}&mode=view&id={ID}">{BETREFF}</a></b>
			</td>
			<td align="right" valign="bottom" height="20">
				<!-- IF USER_ID > 0 -->
					<b><a href="nachricht.php?ordner={ORDNER}&mode=new&mail={USER_ID}&answer={ID}">Antworten</a></b>
				<!-- ENDIF -->
			</td>
		</tr>
	</tbody>
</table>

<table class="table" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td class="form"></td>
		</tr>
		<tr>
			<td bgcolor="#EFEFEF" valign="top">
				<table width="100%">
					<tbody>
						<tr>
							<td width="73%" valign="top">
								<table width="100%" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td><small>{TIME} Uhr</small></td>
											<td align="right">
												<a href="nachricht.php?ordner={ORDNER}&mode=delete&delete={ID}"><img src="images/delete.gif" title="Löschen" border="0"></a> 
												<!-- IF USER_ID > 0 -->
													<a class="user" href="nachricht.php?ordner={ORDNER}&mode=new&mail={USER_ID}&answer={ID}&zitat={ID}"><img title="Zitat" src="images/zitat.gif" border="0"></a>
												<!-- ENDIF -->
											</td>
										</tr>
									</tbody>
								</table>
								<br>{TEXT}
								{SIGNATUR}
								<br><br>
							</td>
							<td width="27%" valign="top"><div style="padding: 7px 3px 7px 7px; border-left: 1px solid #ffffff;">
								 <!-- IF AVATAR -->
								 	<img src="{AVATAR}" border="0" />
								 	<br />
								 <!-- ENDIF -->

								<!-- IF USER_ID > 0 -->
									<b><a href="dorf.php?id={USER_ID}">{USERNAME}</a></b>
									<small>
									<br>
									<font color="#777063">{TYP}</font><br><br>Gold: <font color="#777063">{PUNKTE}</font><br><br><a href="nachricht.php?ordner={ORDNER}&mode=new&mail={USER_ID}"><img src="images/pn.gif" border="0"></a> <a href="dorf.php?id={USER_ID}"><img src="images/profil.gif" border="0"></a> | {STATUS}</small></div>
								<!-- ELSE -->
									<b>Systemnachricht</b>
								<!-- ENDIF -->
							</td>
						</tr>
					</tbody>
				</table>
				<div style="text-align: right;"><span onclick="scroll(0,0);"><a onclick="return false;" href="#"><img src="images/nachoben.gif" border="0"></a></span>&nbsp;</div>
			</td>
		</tr>
	</tbody>
</table>

<!-- INCLUDE footer.tpl -->