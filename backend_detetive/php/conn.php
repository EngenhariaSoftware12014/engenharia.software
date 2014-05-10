<?php

$conn = @mysql_connect('168.168.56.1','root','root');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('chavesholmes', $conn);

?>