<?php
	include 'php/conn.php';		

	$idUsuario = $_REQUEST['idUsuario'];
	$idPartida = $_REQUEST['idPartida'];

	$rs = mysql_query("SELECT usuario_idusuario FROM ".$idPartida."_partidaxusuario 
					   WHERE usuario_idusuario = $idUsuario AND loser = 0 ");

	if(mysql_num_rows($rs) > 0){
		$sql = "UPDATE usuario SET pontuacao = (pontuacao + 3)  WHERE idusuario = $idUsuario ";
		mysql_query($sql, $conn) or die(mysql_error());
	} else {
		$sql = "UPDATE usuario SET pontuacao = (pontuacao + 1)  WHERE idusuario = $idUsuario ";
		mysql_query($sql, $conn) or die(mysql_error());
	}

	$sql = "DELETE FROM ".$idPartida."_partidaxusuario WHERE usuario_idusuario = $idUsuario ";
	mysql_query($sql, $conn) or die(mysql_error());

	$rs = mysql_query("SELECT usuario_idusuario FROM ".$idPartida."_partidaxusuario ");

	if(mysql_num_rows($rs) == 0){
		$sql = "DROP TABLE ".$idPartida."_cartas, ".$idPartida."_comentarios, 
		".$idPartida."_jogadas, ".$idPartida."_partidaxusuario,
		".$idPartida."_suspeitosxposicao, ".$idPartida."_usuario_cartas";
		mysql_query($sql, $conn) or die(mysql_error());

		$sql = "UPDATE partidas SET status = 3 WHERE idpartida = $idPartida ";
		mysql_query($sql, $conn) or die(mysql_error());
	}

	$res = mysql_query("select usu.nome as nome from partidas as par left join usuario as usu on usu.idusuario = par.vencedor where idpartida = $idPartida");
	$row = mysql_fetch_assoc($res);
	$vencedor = $row['nome'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detetive</title>
	<link rel="stylesheet" href="CSS/game_main.css">
</head>
<body>
	<div id="container-final">
		<h1><?= $vencedor ?> venceu!!!</h1>
	</div>
</body>
</html>