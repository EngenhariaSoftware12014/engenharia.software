<?php

include 'conn.php';

$rs = mysql_query('INSERT INTO CENARIOS (IDCENARIOS, ARMAS_IDARMAS, COMODOS_IDCOMODOS, COMODOS_IDCOMODOS) VALUES('', '', '', '') ');
$result = array();

while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>
