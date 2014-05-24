<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$result = array();

	$rs = mysql_query("SELECT status FROM partidas WHERE idPartida = $idPartida") or die (mysql_error());
	$row = mysql_fetch_array($rs);
	if ($row['status'] == 2)
		$result['begin'] = 'true';
	else
		$result['begin'] = 'false';

	echo json_encode($result);
?>