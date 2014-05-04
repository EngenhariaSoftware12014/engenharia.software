<?php

$idusuario	= intval($_REQUEST['idusuario']);
$nome		=  $_REQUEST['nome'];
$sobrenome	=  $_REQUEST['sobrenome'];
$email      =  $_REQUEST['email'];
$senha      =  $_REQUEST['senha'];
$status_2   =  intval($_REQUEST['status_2']);
$perfil     =  intval($_REQUEST['perfil']);
$imagem		=  $_REQUEST['imagem'];

include 'conn.php';
 
$sql = "update usuario set nome='$nome', sobrenome='$sobrenome', email='$email', senha='$senha', status_2='$status_2', perfil='$perfil', imagem='$imagem' where idusuario=$idusuario";
@mysql_query($sql);
echo json_encode(array(	
	'nome'		=>$nome    	,   	
	'sobrenome'	=>$sobrenome, 
	'email'		=>$email 	, 
	'senha'		=>$senha   	, 
	'senhaconf' =>$senha	,
	'status_2' 	=>$status_2 ,
	'perfil'	=>$perfil    ));
?>