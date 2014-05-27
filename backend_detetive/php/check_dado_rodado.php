<?php

$idPartida = $_REQUEST['idPartida'];
$currentPlayer = $_REQUEST['currentPlayer'];
$result = array('check_dado' => 'false');

include 'conn.php';

// Pegar o jogador corrente
$rs = mysql_query("select usuario_idusuario, numero_dado from " . $idPartida . "_jogadas order by idjogadas desc limit 0,1");
if (mysql_num_rows($rs) > 0) {
	$row = mysql_fetch_assoc($rs);
	if ($row[usuario_idusuario] === $currentPlayer) {
		$result['check_dado'] = 'true'; 
		$result['numero_dado'] = $row['numero_dado'];
	}
}

echo json_encode($result);


