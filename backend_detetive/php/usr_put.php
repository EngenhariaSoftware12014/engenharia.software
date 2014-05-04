<?php
 
$nome		=  $_REQUEST['nome'];
$sobrenome	=  $_REQUEST['sobrenome'];
$email      =  $_REQUEST['email'];
$senha      =  $_REQUEST['senha'];
$status_2   =  intval($_REQUEST['status_2']);
$perfil     =  intval($_REQUEST['perfil']);
$imagem		=  $_REQUEST['imagem'];


include 'conn.php';

$sql = "INSERT INTO  usuario (nome ,sobrenome ,email ,senha ,status_2 ,perfil,imagem)VALUES ('$nome' ,'$sobrenome' ,'$email' ,'$senha' ,'$status_2' ,'$perfil','$imagem' )";
@mysql_query($sql);
echo json_encode(array(	
	'nome'		=>$nome    		,   	
	'sobrenome'	=>$sobrenome 	, 
	'email'		=>$email 		, 
	'senha'		=>$senha   		, 
	'SenhaConf' =>$senha		,
	'status_2' 	=>$status_2   	, 
	'perfil'	=>$perfil));                
?>             
                
                       