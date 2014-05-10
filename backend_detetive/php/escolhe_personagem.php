<?php

	include 'conn.php';

	$idUsuario = intval($_REQUEST['idUsuario']);
	$idPartida = intval($_REQUEST['idPartida']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);

	$rs = mysql_query("SELECT suspeito_idsuspeito FROM ".$idPartida."_partidaxusuario WHERE suspeito_idsuspeito = $idSuspeito;");

	if (mysql_num_rows($rs) == 0){
		$sql = "UPDATE ".$idPartida."_partidaxusuario SET suspeito_idsuspeito = $idSuspeito WHERE usuario_idusuario = $idUsuario AND suspeito_idsuspeito IS NULL";
		mysql_query($sql);
		echo json_encode(array('error' => false, 'message' => 'Suspeito selecionado com sucesso!'));
	} else {
		echo json_encode(array('error' => true,'message' => utf8_encode('Esse suspeito já foi selecionado por outro jogado!')));
	}

?>