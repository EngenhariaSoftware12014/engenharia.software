<?php

include 'conn.php';

$idPartida	= $_REQUEST['idPartida'];
$idUsuario	= $_REQUEST['idUsuario'];
$idCarta	= $_REQUEST['idCarta'];
$tipoCarta	= $_REQUEST['tipoCarta'];
$result = array();

$sql = "INSERT INTO " . $idPartida . "_comentarios (usuario_idusuario ,id_carta ,tipocarta)VALUES ('$idUsuario' ,'$idCarta' ,'$tipoCarta')";
if (mysql_query($sql)) 
	$result['error'] = 'true';
else
	$result['error'] = 'false';
echo json_encode($result);

?>