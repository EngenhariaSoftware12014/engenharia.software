<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$idUsuario = intval($_REQUEST['idUsuario']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$posicaoX = intval($_REQUEST['position_x']);
	$posicaoY = intval($_REQUEST['position_y']);
	$result = array();

	$sql = "UPDATE ".$idPartida."_suspeitosxposicao SET position_x = $posicaoX, position_y = $posicaoY WHERE idsuspeito = $idSuspeito";
	mysql_query($sql, $conn) or die(mysql_error());

	$rs = mysql_query("SELECT ".$idPartida."_cartas.id_carta AS idCarta, ".$idPartida."_cartas.id_original AS idOriginal  
		FROM comodos LEFT OUTER JOIN ".$idPartida."_cartas ON comodos.idcomodos = ".$idPartida."_cartas.id_original  WHERE position_x = $posicaoX and position_y = $posicaoY and tipo_carta = 'comodo' ") or die(mysql_error());

	if (mysql_num_rows($rs) > 0) {
		$result['comodo'][] = mysql_fetch_object($rs);

		$rs = mysql_query("SELECT ".$idPartida."_cartas.id_carta AS idCarta, ".$idPartida."_cartas.id_original AS idOriginal, 
						   ".$idPartida."_comentarios.idcomentarios AS comentario, ".$idPartida."_cartas.tipo_carta AS  tipoCarta,
						   ".$idPartida."_cartas.caminho_carta AS caminhoCarta 
						   FROM ".$idPartida."_usuario_cartas
						   LEFT OUTER JOIN ".$idPartida."_cartas ON ".$idPartida."_usuario_cartas.id_carta = ".$idPartida."_cartas.id_carta
						   LEFT OUTER JOIN ".$idPartida."_comentarios ON ".$idPartida."_cartas.id_original = ".$idPartida."_comentarios.carta_idcarta
						   AND ".$idPartida."_cartas.tipo_carta = ".$idPartida."_comentarios.carta_tipocarta 
						   AND ".$idPartida."_comentarios.usuario_idusuario = $idUsuario
						   WHERE tipo_carta != 'comodo'") or die(mysql_error());

		while ($row = mysql_fetch_assoc($rs)) {
			if($row['tipoCarta'] == 'suspeito'){		
					$result['suspeito'][] = $row;
			} else if($row['tipoCarta'] = 'arma'){
					$result['arma'][] = $row;
			}
		}
	
		echo json_encode($result);
	} else {
		
		$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario WHERE idpartidaxusuario > (SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario WHERE usuario_idusuario = $idUsuario)") or die(mysql_error());
		if(mysql_num_rows($rs) > 0){
			$idProxUsuario = mysql_fetch_array($rs);
			$sql = "UPDATE partidas SET current_player = ".$idProxUsuario['idpartidaxusuario']." WHERE idpartida = $idPartida";
			mysql_query($sql, $conn);
		} else {
			$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario ") or die(mysql_error());
			if(mysql_num_rows($rs) > 0){
				$idProxUsuario = mysql_fetch_array($rs);
				$sql = "UPDATE partidas SET current_player = ".$idProxUsuario['idpartidaxusuario']." WHERE idpartida = $idPartida";
				mysql_query($sql, $conn);
			}
		}
		echo json_encode(array("end" => true));
	}

?>