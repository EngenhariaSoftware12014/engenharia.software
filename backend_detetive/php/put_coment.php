<?php

include 'conn.php';

$idPartida	= $_REQUEST['idPartida'];
$idUsuario	= $_REQUEST['idUsuario'];
$idCarta	= $_REQUEST['idCarta'];
$tipoCarta	= $_REQUEST['tipoCarta'];
$result = array();

$rs = mysql_query("SELECT idcomentarios FROM " . $idPartida . "_comentarios WHERE usuario_idusuario = $idUsuario AND carta_idcarta = $idCarta AND carta_tipocarta = '$tipoCarta'");
if (mysql_num_rows($rs) > 0) {
	$row = mysql_fetch_assoc($rs);
	$sql = "DELETE FROM " . $idPartida . "_comentarios WHERE idcomentarios = " . $row['idcomentarios'];
} else {
	$sql = "INSERT INTO " . $idPartida . "_comentarios (usuario_idusuario , carta_idcarta, carta_tipocarta) VALUES ('$idUsuario' ,'$idCarta' ,'$tipoCarta')";	
}

if (mysql_query($sql) or die(mysql_error())) 
	$result['error'] = 'true';
else
	$result['error'] = 'false';

echo json_encode($result);

?>