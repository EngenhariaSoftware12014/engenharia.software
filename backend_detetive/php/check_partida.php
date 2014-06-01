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
	} else {
		$result['nextTurn'] = 'true';
	}

	echo json_encode($result);