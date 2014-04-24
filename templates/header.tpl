<!doctype html>
<html>
<head>
	<title>Dörferspiel</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="templates/style.css" />
	<script type="text/javascript" src="templates/style.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="title_img">
		<img src="images/title.png" />
	</div>
	<div id="title">
		<big>
			<i>
				<strong>Titel</strong>
			</i>
		</big>
		<br />Beschreibung der Seite
	</div>
	<div id="status"><span>{BONLINE}</span> Online</div>
	<div id="menue">

		<a href="index.php">Startseite</a>
		<div class="line"></div>
		<a href="statistiken.php">Welt</a>
		<div class="line"></div>
		<a href="handel.php">Handel</a>
		<!-- IF USER -->
			<div class="line"></div>
			<a href="view.php">Mein Dorf</a>
		<!-- ENDIF -->

		<div id="short">
			<!-- IF USER -->
				<a href="nachricht.php"><img src="images/icon_mails.gif" /> Nachrichten<!-- IF MSG_NEW > 0 --> ({MSG_NEW})<!-- ENDIF --></a>
				<a href="login.php?logout"><img src="images/icon_incorrect.gif" /> Logout [ {USER} ]</a>
			<!-- ELSE -->
				<a href="register.php"><img src="images/icon_correct.gif" /> Registrieren</a>
				<a href="login.php"><img src="images/icon_arrow.gif" /> Login</a>
			<!-- ENDIF -->
		</div>
	</div>
	<div id="box">
