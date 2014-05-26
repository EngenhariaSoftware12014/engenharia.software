<?php

include 'conn.php';

$idPartida = $_REQUEST['id_partida'];

$result = array();

$rsArmas = mysql_query("SELECT idarmas, nome, 'A' AS tipo FROM armas") or die (mysql_error());
while($row = mysql_fetch_array($rsArmas, MYSQL_ASSOC)){
	$row['nome'] = utf8_encode($row['nome']);
	$result['armas'][] = $row; 
}

$rsCmds = mysql_query("SELECT idcomodos, nome, 'C' AS tipo FROM comodos") or die (mysql_error());
while($row = mysql_fetch_assoc($rsCmds)){
	$row['nome'] = utf8_encode($row['nome']);
    $result['comodos'][] =  $row;
}

$rsSusp = mysql_query("SELECT idsuspeitos, nome, 'S' AS tipo FROM suspeitos") or die (mysql_error());
while($row = mysql_fetch_assoc($rsSusp)){
	$row['nome'] = utf8_encode($row['nome']);
    $result['suspeitos'][] =  $row;
}

echo json_encode($result);
?>