<?php

	include 'conn.php';

	$idPartida = $_REQUEST['idPartida'];
	$idUsuario = $_REQUEST['idUsuario'];
	$currentPlace = $_REQUEST['currentPlace']; 
	$keepAsking = isset($_REQUEST['keepAsking']) ? $_REQUEST['keepAsking'] : false;

	$result = array();

	$res = mysql_query("select idpartida from partidas where idpartida = $idPartida and status = 3");
	if (mysql_num_rows($res) > 0) {
		$result['endAll'] = 'true';
	} else {

		$res = mysql_query("select current_player from partidas where idpartida = $idPartida") or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		
		if ($row['current_player'] == $currentPlace) {
			$result['nextTurn'] = 'false';

			if (!$keepAsking) {
				$res = mysql_query("select suspeito_suspeita, arma_suspeita, comodo_suspeita, resposta_usuario from " . $idPartida . "_jogadas order by idjogadas desc limit 0, 1") or die(mysql_error());
				$row = mysql_fetch_assoc($res);
				if ($row['suspeito_suspeita'] != 0 && $row['arma_suspeita'] != 0 && $row['comodo_suspeita'] != 0) {
					
					$resposta_usuario = $row['resposta_usuario'];
					$idCartas = array($row['suspeito_suspeita'], $row['arma_suspeita'], $row['comodo_suspeita']);
					
					$res = mysql_query("select caminho_carta, tipo_carta from " . $idPartida . "_cartas where id_carta in (" . join(',', $idCartas) . ") order by tipo_carta"); 
					while ($row = mysql_fetch_assoc($res)) {
						$result['suspeita'][$row['tipo_carta']] = $row['caminho_carta'];
					}

					if ($resposta_usuario == $idUsuario) {
						$res = mysql_query("select car.id_carta as id_carta, car.caminho_carta as caminho_carta from " . $idPartida . "_usuario_cartas as uxc left join " . $idPartida . "_cartas as car on car.id_carta = uxc.id_carta where uxc.id_usuario = $idUsuario and uxc.id_carta in (" . join(',', $idCartas) . ")");
						while ($row = mysql_fetch_assoc($res)) {
							$result['resposta'][] = $row;
						}	
					}
				}	
			}	

		} else {
			$result['nextTurn'] = 'true';
		}
	}
	echo json_encode($result);
?>