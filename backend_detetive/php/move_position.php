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

		$res = mysql_query("select idpartidaxusuario from " . $idPartida . "_partidaxusuario where loser != 1 and idpartidaxusuario > (select idpartidaxusuario from " . $idPartida . "_partidaxusuario where usuario_idusuario = $idUsuario) limit 0,1");
		if (mysql_num_rows($res) > 0) {
			$row = mysql_fetch_assoc($res);
			$proximaPosicao = $row['idpartidaxusuario'];
		} else {

			$res = mysql_query("select idpartidaxusuario from " . $idPartida . "_partidaxusuario where loser != 1 order by idpartidaxusuario asc limit 0, 1");
			if (mysql_num_rows($res) > 0) {
				$row = mysql_fetch_assoc($res);
				$proximaPosicao = $row['idpartidaxusuario'];
			} else {
				$proximaPosicao = 0;
			}
		}

		if ($proximaPosicao == 0) {
			echo json_encode(array('endAll' => true));
		} else {
			mysql_query("update partidas set current_player = $proximaPosicao where idpartida = $idPartida") or die(mysql_error());
			echo json_encode(array("end" => true));
		}
		

		// $idProxUsuario = array();
		// $menor = array();
		// $maior = array();
		// $rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario 
		// 				   WHERE loser != 1 AND idpartidaxusuario != (SELECT idpartidaxusuario 
		// 				   FROM ".$idPartida."_partidaxusuario WHERE usuario_idusuario = $idUsuario)") or die(mysql_error());

		// while ($row = mysql_fetch_assoc($rs)) {
		// 	if($idProxUsuario > $row['idpartidaxusuario'] ){
		// 		$menor[] = $row['idpartidaxusuario'];
		// 	} else {
		// 		$maior[] = $row['idpartidaxusuario'];
		// 	}
		// }

		// $idProxUsuario = array_merge($maior, $menor);
		
		// if(count($idProxUsuario) > 0 ){
		// 	$sql = "UPDATE partidas SET current_player = ".$idProxUsuario[0]." WHERE idpartida = $idPartida";
		// 	mysql_query($sql, $conn);
		// }

	}

?>