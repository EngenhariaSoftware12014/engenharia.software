<?php

	include 'conn.php';

	$idPartida = $_REQUEST['idPartida'];
	$idUsuario = $_REQUEST['idUsuario'];
	$idCarta = $_REQUEST['idCarta'];

	$res = mysql_query("select max(idjogadas) as max_idJogadas from " . $idPartida . "_jogadas");
	$row = mysql_fetch_assoc($res);
	$max_idJogadas = $row['max_idJogadas'];

	mysql_query("update " . $idPartida . "_jogadas set resposta_carta = $idCarta where idjogadas = $max_idJogadas") or die(mysql_error());

	echo json_encode(array('end' => true));
?>