<?php

	include 'conn.php';

	$idUsuario = intval($_REQUEST['idUsuario']);
	$idPartida = intval($_REQUEST['idPartida']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$result = array();

	$rs = mysql_query("SELECT suspeito_idsuspeito FROM " . $idPartida . "_partidaxusuario WHERE suspeito_idsuspeito = $idSuspeito;");
	if (mysql_num_rows($rs) > 0) {		
		$result['error'] = 'true';
	} else {
		mysql_query("UPDATE " . $idPartida . "_partidaxusuario SET suspeito_idsuspeito = $idSuspeito WHERE usuario_idusuario = $idUsuario AND suspeito_idsuspeito IS NULL");
		
		$rs = mysql_query('SELECT idpartidaxusuario FROM ' . $idPartida . '_partidaxusuario WHERE suspeito_idsuspeito IS NOT NULL');
		if (mysql_num_rows($rs) === 4) {
			mysql_query("UPDATE partidas SET status = 2");
			$result['begin'] = 'true';
		} 

		$result['error'] = 'false';

	} 
	echo json_encode($result);
?>