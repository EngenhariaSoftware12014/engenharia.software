<?php

$idPartida = $_REQUEST['idPartida'];
$currentPlayer = $_REQUEST['currentPlayer'];
$result = array();
$numero_dado = rand(2, 12);

include 'conn.php';

$rs = mysql_query("insert into " . $idPartida . "_jogadas (`usuario_idusuario`, `numero_dado`) values ($currentPlayer, $numero_dado)");
$result['numero_dado'] = $numero_dado;

echo json_encode($result);