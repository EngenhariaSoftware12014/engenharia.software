<?php

$idsuspeitos = intval($_REQUEST['idsuspeitos']);

include 'conn.php';

$sql = "delete from suspeitos where idsuspeitos=$idsuspeitos";
@mysql_query($sql);
echo json_encode(array('success'=>true));
?>