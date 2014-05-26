<?php

$idpatente			= intval($_REQUEST['idpatente']);
$scorepatentemin	=  $_REQUEST['scorepatentemin'];
$scorepatentemax	=  $_REQUEST['scorepatentemax'];
$descrpatente     	=  $_REQUEST['descrpatente'];


include 'conn.php';
 
$sql = "update patente set scorepatentemin='$scorepatentemin', scorepatentemax='$scorepatentemax', descrpatente='$descrpatente' where idpatente=$idpatente";
@mysql_query($sql);
echo json_encode(array(	
	'scorepatentemin'	=>$scorepatentemin,   	
	'scorepatentemax'	=>$scorepatentemax, 
	'descrpatente'		=>$descrpatente   ));
?>