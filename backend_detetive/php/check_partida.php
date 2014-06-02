<?php

	include 'conn.php';

	$idPartida = $_REQUEST['idPartida'];
	$idUsuario = $_REQUEST['idUsuario'];
	$currentPlace = $_REQUEST['currentPlace']; 

	$result = array();

	$res = mysql_query("select current_player from partidas where idpartida = $idPartida") or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	
	if ($row['current_player'] == $currentPlace) {
		$result['nextTurn'] = 'false';

		$res = mysql_query("select suspeito_suspeita, arma_suspeita, comodo_suspeita, resposta_usuario from 1_jogadas order by idjogadas desc limit 0, 1") or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		if ($row['suspeito_suspeita'] != 0 && $row['arma_suspeita'] != 0 && $row['comodo_suspeita'] != 0) {
			$result['suspeita'] = $row;
		}	

	} else {
		$result['nextTurn'] = 'true';
	}

	echo json_encode($result);
?>