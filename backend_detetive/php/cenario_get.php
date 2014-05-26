<?php

include 'conn.php';

$rs = mysql_query('SELECT IDCENARIOS, ARMAS_IDARMAS, COMODOS_IDCOMODOS, COMODOS_IDCOMODOS FROM CENARIOS WHERE IDCENARIOS = 1');
$result = array();

while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>
