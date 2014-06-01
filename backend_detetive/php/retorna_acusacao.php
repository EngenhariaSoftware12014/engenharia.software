<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$idUsuario = intval($_REQUEST['idUsuario']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$idArma = intval($_REQUEST['idArma']);
	$idComodo = intval($_REQUEST['idComodo']);

	$rs = mysql_query("SELECT ".$idPartida."_cartas.id_carta, ".$idPartida."_cartas.id_original, ".$idPartida."_cartas.caminho_carta 
					   FROM ".$idPartida."_usuario_cartas 
					   LEFT OUTER JOIN ".$idPartida."_cartas ON ".$idPartida."_usuario_cartas.id_carta = ".$idPartida."_cartas.id_carta
					   WHERE id_usuario = 0 AND ".$idPartida."_cartas.id_carta IN ( $idSuspeito , $idArma , $idComodo )") or die(mysql_error());

	while($row = mysql_fetch_assoc($rs)){
		$cartas[] = $row;
	}

	if(mysql_num_rows($rs) > 2){
		$sql = "UPDATE partidas SET status = 3, vencedor = $idUsuario WHERE idpartida = $idPartida";
		mysql_query($sql, $conn) or die(mysql_error());
		echo json_encode(array("winner" => true, "idUsuWinner" => $idUsuario, "cartasEnvelope" => $cartas));
	} else {
		$sql = "UPDATE ".$idPartida."_partidaxusuario SET loser = 1 WHERE usuario_idusuario = $idUsuario";
		mysql_query($sql, $conn) or die(mysql_error());
		echo json_encode(array("winner" => false, "idUsuLoser" => $idUsuario));
	}

?>