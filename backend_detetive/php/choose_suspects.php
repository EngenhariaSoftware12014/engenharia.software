<?php

	include 'conn.php';

	$idUsuario = intval($_REQUEST['idUsuario']);
	$idPartida = intval($_REQUEST['idPartida']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);

	$rs = mysql_query("SELECT suspeito_idsuspeito FROM " . $idPartida . "_partidaxusuario WHERE suspeito_idsuspeito = $idSuspeito;");
	if (mysql_num_rows($rs) > 0) {
		echo json_encode(array('error' => 'true'));
	} else {
		mysql_query("UPDATE " . $idPartida . "_partidaxusuario SET suspeito_idsuspeito = $idSuspeito WHERE usuario_idusuario = $idUsuario AND suspeito_idsuspeito IS NULL");

		//Retorna personagens disponíveis

		$rs = mysql_query("SELECT suspeito_idsuspeito FROM " . $idPartida . "_partidaxusuario WHERE suspeito_idsuspeito IS NOT NULL");
		$result = array();

		while($row = mysql_fetch_array($rs)){
			$result[] = $row['suspeito_idsuspeito'];
		}

		$unavailable_suspect = count($result) > 0 ? join(',', $result) : 0;

		$rs2 = mysql_query("SELECT idsuspeitos, nome, imagem, IF(idsuspeitos IN ($unavailable_suspect), 'true', 'false') AS unavailable FROM suspeitos");
		$result2 = array();	
		while($row = mysql_fetch_object($rs2)){
			$result2['suspects'][] = $row;
		}

		$result2['idPartida'] = $idPartida;
		$result2['error'] = 'false';
		echo json_encode($result2);

	} 
?>