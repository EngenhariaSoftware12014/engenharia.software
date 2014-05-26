<?php
 
$nome		=  $_REQUEST['nome'];
$imagem		=  $_REQUEST['imagem'];
$delete_2   =  $_REQUEST['delete_2'];


include 'conn.php';

$sql = "INSERT INTO  armas (nome ,imagem ,delete_2)VALUES ('$nome' ,'$imagem' ,'$delete_2')";
@mysql_query($sql);
echo json_encode(array(	
	'nome'		=>$nome,   	
	'imagem'	=>$imagem, 
	'delete_2'	=>$delete_2   ));
?>             
                
                       