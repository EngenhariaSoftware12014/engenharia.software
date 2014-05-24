<?php
	session_start();
	$idUsuario = $_SESSION['id_usuario'];
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Detetive</title>
	<link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="CSS/game_main.css">
</head>
<body>
	
	<div id="container-panel">

		<img id="logo" src="images/logo_chaves.png">

		<a href="#" class="btn" id="btn_play">Jogar</a>
		<a href="php/logout.php" class="btn" id="btn_logout">Sair</a>	
	</div>
	
	<div class="modal">
		<div id="loading-message">
			<h3>Procurando partidas...</h3>
			<img src="images/spinner.gif">
		</div>
		<div id="suspect-menu">
			<h3>Escolha o seu personagem...</h3>
			<div id="s-menu"></div>
		</div>
	</div>

	<script src="jquery/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#btn_play').click(function(e) {
			e.preventDefault();
			$('.modal').show();
			$('#loading-message').show();
			
			$.getJSON('php/enter_matche.php', {'idUsuario': <?= $idUsuario ?>})
				.done(function(data) {
					console.log(data); 
					buildSuspectsMenuSearch(data);
					$('#loading-message').hide();
					$('#suspect-menu').show();
				});
			return false;
		});
	});

	function selectSuspect(idSuspeito, idPartida) {
			console.log('teste');
			$.getJSON('php/choose_suspects.php', {'idUsuario': <?= $idUsuario ?>, 'idPartida': idPartida, 'idSuspeito': idSuspeito})
				.done(function(data) {
					// console.log(data);
					if (data.error === 'true') {
						alert('O personagem já está sendo utilizado, por favor escolha outro!');
						buildSuspectsMenuSearch();
					} else {
						if (data.begin === 'true') {
							location.href = 'game_board.php'
						} else {
							$('#loading-message h3').html('Aguardando novos jogadores');
							$('#loading-message').show();
							$('#suspect-menu').hide();
							checkStatus(idPartida);
						}
					}
						
				});
			return false;
		} 

		function buildSuspectsMenuSearch(data) {
			var row = $('<div class="row"></div>'), menu = $('#s-menu');
			for (var i = 0, len = data.suspects.length; i < len; i++) {
					
				var suspect = data.suspects[i];
				if (suspect.unavailable === 'true')
					row.append('<div class="col"><a href="#" class="suspect indisponible"><img src="images/cards/' + suspect.imagem + '" alt=""></a></div>');
				else
					row.append('<div class="col"><a href="#" class="suspect" onclick="selectSuspect(' + suspect.idsuspeitos + ', ' + data.idPartida + ');"><img src="images/cards/' + suspect.imagem + '" alt=""></a></div>');

				if (i === 3 || i === 7) {
					menu.append(row);
					if (i === 3)
						row = $('<div class="row"></div>');
				}	
			}
		}

		function checkStatus(idPartida) {
			console.log('Passou o primeiro teste');
			var check = window.setInterval(function() {
				$.getJSON('php/check_status.php', {'idPartida': idPartida}).done(function(data) {
					console.log(data);
					if (data.begin === 'true') {
						//window.clearInterval(check);
						location.href = 'game_board.php'
					}
				});
			}, 3000);
		}
	</script>
</body>
</html>