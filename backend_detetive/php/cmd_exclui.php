<?php

$idcomodos = intval($_REQUEST['idcomodos']);

include 'conn.php';

$sql = "delete from comodos where idcomodos=$idcomodos";
@mysql_query($sql);
echo json_encode(array('success'=>true));
?>