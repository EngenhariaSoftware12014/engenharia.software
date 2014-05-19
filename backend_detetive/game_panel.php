<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detetive</title>
	<link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="CSS/game_main.css">
</head>
<body>
	
	<div id="container-panel">

		<img id="logo" src="images/logo_chaves.png">

		<a href="game_board.php" class="btn" id="btn_play">Jogar</a>
		<a href="php/logout.php" class="btn" id="btn_logout">Sair</a>	
	</div>
	
	<div class="modal">
		<div id="loading-message">
			<h3>Procurando partidas...</h3>
			<img src="images/spinner.gif">
		</div>
		<div id="suspect-menu">
			<h3>Escolha o seu personagem...</h3>
			<div class="row">
				<div class="col"><a class="suspect indisponible"><img src="images/cards/bruxa.png" alt="" id-suspect="t"></a></div>
				<div class="col"><a class="suspect"><img src="images/cards/chaves.png" alt="" id-suspect="t"></a></div>
				<div class="col"><a class="suspect"><img src="images/cards/chiquinha.png" alt="" id-suspect="t"></a></div>
				<div class="col"><a class="suspect"><img src="images/cards/florinda.png" alt="" id-suspect="t"></a></div>
			</div>
			<div class="row">
				<div class="col"><a class="suspect"><img src="images/cards/girafales.png" alt="" id-suspect="t"></a></div>
				<div class="col"><a class="suspect"><img src="images/cards/madruga.png" alt="" id-suspect="t"></a></div>
				<div class="col"><a class="suspect"><img src="images/cards/nhonho.png" alt="" id-suspect="t"></a></div>
				<div class="col"><a class="suspect"><img src="images/cards/quico.png" alt="" id-suspect="t"></a></div>
			</div>
		</div>
	</div>

	<script src="jquery/jquery.min.js"></script>
	<script src="JS/game_main.js"></script>
</body>
</html>