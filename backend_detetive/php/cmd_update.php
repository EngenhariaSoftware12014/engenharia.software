<?php

$idcomodos	= intval($_REQUEST['idcomodos']);
$nome		=  $_REQUEST['nome'];
$imagem		=  $_REQUEST['imagem'];
$delete_2   =  $_REQUEST['delete_2'];

include 'conn.php';
 
$sql = "update comodos set nome='$nome', imagem='$imagem', delete_2='$delete_2' where idcomodos=$idcomodos";
@mysql_query($sql);
echo json_encode(array(	
	'nome'		=>$nome,   	
	'imagem'		=>$nome, 
	'delete_2'	=>$delete_2,
	'sql'		=>$sql	));
?>