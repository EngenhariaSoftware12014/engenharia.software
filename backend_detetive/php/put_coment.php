<?php

include 'conn.php';

$idPartida	=$_REQUEST['idPartida'];
$idUsuario	=$_REQUEST['idUsuario'];
$idCarta	=$_REQUEST['idCarta'];
$tipoCarta	=$_REQUEST['tipoCarta'];

if  ($idPartida<>"" && $idUsuario<>""	&&	$idCarta<>"" && $tipoCarta<>"")
{
	$sql = "INSERT INTO ".$idPartida."_"."comentarios (usuario_idusuario ,id_carta ,tipocarta)VALUES ('$idUsuario' ,'$idCarta' ,'$tipoCarta')";
	$rs = mysql_query($sql)or die (mysql_error());

	echo json_encode(array('error'=>True));
	
}


?>