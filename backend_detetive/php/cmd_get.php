<?php

include 'conn.php';

$rs = mysql_query('select *,CASE delete_2 WHEN 1 THEN "Ativo" WHEN 2 THEN "Bloqueado" END as statusdesc  from comodos');
$result = array();

while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>