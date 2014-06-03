	<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$idArma = intval($_REQUEST['idArma']);
	$idComodo = intval($_REQUEST['idComodo']);
	$idUsuario = intval($_REQUEST['idUsuario']);

	$rs = mysql_query("SELECT MAX(idjogadas) as idJogada FROM ".$idPartida."_jogadas") or die(mysql_error());
	// if (mysql_num_rows($rs) > 0) {
	$row = mysql_fetch_assoc($rs);
	$idJogada = $row['idJogada'];
	$sql = "UPDATE ".$idPartida."_jogadas 
		   SET 
		   acusacao = 0,
		   suspeito_suspeita = $idSuspeito,
		   arma_suspeita = $idArma,
		   comodo_suspeita = $idComodo
		   WHERE idjogadas = $idJogada";
	mysql_query($sql) or die (mysql_error());
	// }

	$rs = mysql_query('select position_x, position_y from comodos where idcomodos = $idComodo');
	$row = mysql_fetch_assoc($rs);
	mysql_query('update ' . $idPartida . '_suspeitosxposicao set position_x = ' . $row['position_x'] . ', position_y = ' . $row['position_y'] . ' where idsuspeito = 2');

	// Verifica jogador que possui a carta
	$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario 
					   WHERE idpartidaxusuario = (SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario 
					   WHERE usuario_idusuario = $idUsuario)") or die(mysql_error());
	$idPartUsuCurrent = 0;  

	while ($row = mysql_fetch_assoc($rs)) {
		$idPartUsuCurrent = $row['idpartidaxusuario'];
	}

	$sort = array();

	$res = mysql_query("select idpartidaxusuario from " . $idPartida . "_partidaxusuario where loser != 1 and idpartidaxusuario > (select idpartidaxusuario from " . $idPartida . "_partidaxusuario where usuario_idusuario = $idUsuario)");
	while ($row = mysql_fetch_assoc($res)) {
		$sort[] = $row['idpartidaxusuario'];
	}

	$res = mysql_query("select idpartidaxusuario from " . $idPartida . "_partidaxusuario where usuario_idusuario = $idUsuario and loser != 1" . (count($sort) > 0 ? " and idpartidaxusuario not in (" . join(',', $sort) . ")" : "" ) . " order by idpartidaxusuario asc");
	while ($row = mysql_fetch_assoc($res)) {
		$sort[] = $row['idpartidaxusuario'];
	}
	
	$achou = false;
	foreach ($sort as $outroUsu) {
		$res = mysql_query("select uxc.id_usuario as id from " . $idPartida . "_usuario_cartas as uxc 
			left join " . $idPartida . "_cartas as car on car.id_carta = uxc.id_carta 
			left join " . $idPartida . "_partidaxusuario as pxu on pxu.usuario_idusuario = uxc.id_usuario 
			where pxu.idpartidaxusuario = $outroUsu and ( 
				(car.tipo_carta = 'comodo' and car.id_carta = $idComodo) or 
				(car.tipo_carta = 'arma' and car.id_carta = $idArma) or 
				(car.tipo_carta = 'suspeito' and car.id_carta = $idSuspeito))");
		if (mysql_num_rows($res) > 0) {
			$achou = true;
			$row = mysql_fetch_assoc($res);
			mysql_query("UPDATE " . $idPartida . "_jogadas SET resposta_usuario = " . $row['id'] . " WHERE idjogadas = $idJogada") or die(mysql_error());
			break;
		}
	}

	if ($achou)
		echo json_encode(array('error' => false));
	else
		echo json_encode(array('error' => false, 'message' => 'Nenhum dos jogadores possuir qualquer uma dessas cartas!'));
?>