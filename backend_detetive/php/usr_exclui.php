<?php

$idusuario = intval($_REQUEST['idusuario']);

include 'conn.php';

$sql = "delete from usuario where idusuario=$idusuario";
@mysql_query($sql);
echo json_encode(array('success'=>true));
?>