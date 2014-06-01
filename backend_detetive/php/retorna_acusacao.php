<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$idUsuario = intval($_REQUEST['idUsuario']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$idArma = intval($_REQUEST['idArma']);
	$idComodo = intval($_REQUEST['idComodo']);

	$rs = mysql_query("SELECT MAX(idjogadas) as idJogada FROM ".$idPartida."_jogadas") or die(mysql_error());
	if (mysql_num_rows($rs) > 0) {
		$idJogada = mysql_fetch_array($rs);
		$sql = "UPDATE ".$idPartida."_jogadas 
			   SET 
			   acusacao = 1,
			   suspeito_suspeita = $idSuspeito,
			   arma_suspeita = $idArma,
			   comodo_suspeita = $idComodo
			   WHERE idjogadas = ".$idJogada['idJogada'];
		mysql_query($sql, $conn) or die(mysql_error());

		$rs = mysql_query("SELECT ".$idPartida."_cartas.id_carta AS idCarta, ".$idPartida."_cartas.id_original as idOriginal, 
						   ".$idPartida."_cartas.caminho_carta AS caminhoCarta
						   FROM ".$idPartida."_usuario_cartas 
						   LEFT OUTER JOIN ".$idPartida."_cartas ON ".$idPartida."_usuario_cartas.id_carta = ".$idPartida."_cartas.id_carta
						   WHERE id_usuario = 0") or die(mysql_error());

		$countAcertos = 0;
		while($row = mysql_fetch_assoc($rs)){
			$cartas[] = $row;
			if(($row['idCarta'] == $idSuspeito) || ($row['idCarta'] == $idArma) || ($row['idCarta'] == $idComodo) ){
				$countAcertos++;
			}
		}

		if($countAcertos > 2){
			$sql = "UPDATE partidas SET status = 3, vencedor = $idUsuario WHERE idpartida = $idPartida";
			mysql_query($sql, $conn) or die(mysql_error());
			echo json_encode(array("winner" => 'true', "idUsuWinner" => $idUsuario, "cartasEnvelope" => $cartas));
		} else {
			$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario WHERE idpartidaxusuario > (SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario WHERE usuario_idusuario = $idUsuario)") or die(mysql_error());
			$idProxUsuario = 0;
			if(mysql_num_rows($rs) > 0){
				$idProxUsuario = mysql_fetch_array($rs);
			} else {
				$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario ") or die(mysql_error());
				if(mysql_num_rows($rs) > 0){
					$idProxUsuario = mysql_fetch_array($rs);
				}
			}
			$sql = "UPDATE partidas SET current_player = ".$idProxUsuario['idpartidaxusuario']." 
				    WHERE idpartida = $idPartida";
			mysql_query($sql, $conn) or die(mysql_error());
			$sql = "UPDATE ".$idPartida."_partidaxusuario SET loser = 1 WHERE usuario_idusuario = $idUsuario";
			mysql_query($sql, $conn) or die(mysql_error());
			echo json_encode(array("winner" => 'false', "idUsuLoser" => $idUsuario));
		}
	}
?>