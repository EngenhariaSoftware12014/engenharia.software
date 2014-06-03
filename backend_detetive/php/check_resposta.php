<?php

	include 'conn.php';

	$idPartida = $_REQUEST['idPartida'];
	$idUsuario = $_REQUEST['idUsuario'];
	$result = array();

	$res = mysql_query("select car.caminho_carta as caminho_carta, jog.resposta_carta as resposta_carta from " . $idPartida . "_jogadas as jog left join " . $idPartida . "_cartas as car on car.id_carta = jog.resposta_carta order by idjogadas desc limit 0, 1;");
	$row = mysql_fetch_assoc($res);
	
	if ($row['resposta_carta'] != 0) {
		$result['find'] = 'true';
		$result['card'] = $row['caminho_carta'];

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
			$result['endAll'] = true;
		} else {
			mysql_query("update partidas set current_player = $proximaPosicao where idpartida = $idPartida") or die(mysql_error());
			$result["end"] = true;
		}

	} else {
		$result['find'] = 'false';
	}

	echo json_encode($result);
?>