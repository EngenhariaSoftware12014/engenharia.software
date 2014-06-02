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

			$sql = "UPDATE ".$idPartida."_partidaxusuario SET loser = 1 WHERE usuario_idusuario = $idUsuario";
			mysql_query($sql, $conn) or die(mysql_error());

			if ($proximaPosicao == 0) {
				echo json_encode(array('endAll' => 'true'));
			} else {
				mysql_query("update partidas set current_player = $proximaPosicao where idpartida = $idPartida") or die(mysql_error());
				echo json_encode(array("winner" => 'false', "idUsuLoser" => $idUsuario));
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

			// $sql = "UPDATE ".$idPartida."_partidaxusuario SET loser = 1 WHERE usuario_idusuario = $idUsuario";
			// mysql_query($sql, $conn) or die(mysql_error());
			// echo json_encode(array("winner" => 'false', "idUsuLoser" => $idUsuario));
		}
	}
?>