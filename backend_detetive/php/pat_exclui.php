<?php

$idpatente = intval($_REQUEST['idpatente']);

include 'conn.php';

$sql = "delete from patente where idpatente=$idpatente";
@mysql_query($sql);
echo json_encode(array('success'=>true));
?>