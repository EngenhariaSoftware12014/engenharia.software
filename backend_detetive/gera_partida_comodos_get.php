<?php

include 'conn.php';

$rs = mysql_query('SELECT IDCOMODOS, NOME, IMAGEM FROM COMODOS WHERE DELETE_2 = 1');
$result = array();

while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>
