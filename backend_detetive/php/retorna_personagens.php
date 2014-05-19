<?php

	include 'conn.php';

	$idUsuario = 1;
	$idPartida = 1;

	$rs = mysql_query("SELECT suspeito_idsuspeito  FROM ".$idPartida."_partidaxusuario WHERE suspeito_idsuspeito IS NOT NULL ;") or die (mysql_error());



	if($row = mysql_fetch_array($rs)){
		$suspeitosUsados = " idsuspeitos != ".$row[0];	

		while($row = mysql_fetch_array($rs)){

			$suspeitosUsados = $suspeitosUsados." AND ";

			$suspeitosUsados = $suspeitosUsados." idsuspeitos != ".$row[0];	
		}
	}

	$rs = mysql_query("SELECT idsuspeitos, nome, imagem  FROM suspeitos WHERE $suspeitosUsados; ") or die (mysql_error());
	$result = array();	
	while($row = mysql_fetch_object($rs)){
		array_push($result, $row);
	}

	echo json_encode($result);

?>