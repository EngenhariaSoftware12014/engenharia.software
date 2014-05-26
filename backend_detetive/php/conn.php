<?php

$conn = @mysql_connect('localhost','root','Pudim1408');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('chaveholmes', $conn);

?>