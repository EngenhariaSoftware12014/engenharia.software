<?php

include 'conn.php';

$rs = mysql_query('select *,CASE perfil	WHEN 1 THEN "Usuario" WHEN 2 THEN "Administrador" END as perfildesc,CASE status_2 WHEN 1 THEN "Ativo" WHEN 2 THEN "Bloqueado" END as statusdesc  from usuario');
$result = array();

while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>