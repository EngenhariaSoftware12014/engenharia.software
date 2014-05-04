<?php

$idarmas = intval($_REQUEST['idarmas']);

include 'conn.php';

$sql = "delete from armas where idarmas=$idarmas";
@mysql_query($sql);
echo json_encode(array('success'=>true));
?>