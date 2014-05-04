<?php 
	include ("php/conn.php");
	include("php/jogadas.php");
	include("php/tabelas.php");
	include("php/score.php");
	?>
<html>
	<head>
		<title>Pagina de teste</title>
	</head>
	<body>
	
<?php
	$idusuarioAtual = 6;
	$idusuarioAlvo = 3;
	$idtabelas = 00002;
	$cartaExibida = "Madruguinha";
	$idPartida = 00001;
	$acusacao = "S";
	$comodo = "Fonte da sorte";
	$personagem = "Girafales";
	$arma = "Bola quadrada";
	
	//excluirtabelas($idtabelas);
	
	gerartabelas($idtabelas);
?>
	
	<?php echo putscore($idusuarioAtual); ?> <br /><br />
	<?php echo getscore($idusuarioAtual); ?> <br /><br />
	
	<?php echo putjogadaexibir($idtabelas, $idusuarioAtual, $idusuarioAlvo, $cartaExibida, $idPartida); ?> <br /><br />
	<?php echo putjogadasugestao($idtabelas, $idusuarioAtual, $comodo, $personagem, $arma, $idPartida, $acusacao); ?> <br /><br />
	
	<?php	echo getjogadas($idtabelas, $idusuarioAtual); ?>
	
	</body>
</html>