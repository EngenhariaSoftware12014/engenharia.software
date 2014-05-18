<?php
 
$scorepatentemin	=  $_REQUEST['scorepatentemin'];
$scorepatentemax	=  $_REQUEST['scorepatentemax'];
$descrpatente     	=  $_REQUEST['descrpatente'];


include 'conn.php';

$sql = "INSERT INTO  patente (scorepatentemin ,scorepatentemax ,descrpatente)VALUES ('$scorepatentemin' ,'$scorepatentemax' ,'$descrpatente')";
@mysql_query($sql);
echo json_encode(array(	
	'scorepatentemin'	=>$scorepatentemin,   	
	'scorepatentemax'	=>$scorepatentemax, 
	'descrpatente'		=>$descrpatente   ));
?>             
                
                       