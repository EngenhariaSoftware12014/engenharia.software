<?php
 
$nome		=  $_REQUEST['nome'];
$sobrenome	=  $_REQUEST['sobrenome'];
$email      =  $_REQUEST['email'];
$senha      =  $_REQUEST['senha'];
$status_2   =  "1";
$perfil     =  "2";


include 'conn.php';
$sql	    = mysql_query("SELECT * from usuario where  email='$email' and status_2='$status_2' and perfil='$perfil'") or die(mysql_error());
$rows		= mysql_num_rows($sql);

if ($rows < 1) {
        $sql = "INSERT INTO  usuario (nome ,sobrenome ,email ,senha ,status_2 ,perfil)VALUES ('$nome' ,'$sobrenome' ,'$email' ,'$senha' ,'$status_2' ,'$perfil' )";

    if (mysql_query($sql)){;
        echo json_encode(array(
        'success'   =>true          ,
        'successMsg'=>'Cadastrado com Sucesso',
        'error'     =>false          ,
        'errorMsg'  =>mysql_error() ,
        'nome'		=>$nome    		,   	
        'sobrenome'	=>$sobrenome 	, 
        'email'		=>$email 		, 
        'senha'		=>$senha   		, 
        'status_2' 	=>$status_2   	, 
        'perfil'	=>$perfil       ));
                          }
    else{
         echo json_encode(array(
        'success'   =>false         ,
        'error'     =>true          ,
        'errorMsg'  =>mysql_error() ,
        'nome'		=>$nome    		,   	
        'sobrenome'	=>$sobrenome 	, 
        'email'		=>$email 		, 
        'senha'		=>$senha   		, 
        'status_2' 	=>$status_2   	, 
        'perfil'	=>$perfil));
        }
}else{
     echo json_encode(array(
    'success'   =>false         ,
    'error'     =>true          ,
    'errorMsg'  =>'Já existe uma conta cadastrada com este e-mail, verifique e tente novamente',
	'nome'		=>$nome    		,   	
	'sobrenome'	=>$sobrenome 	, 
	'email'		=>$email 		, 
	'senha'		=>$senha   		, 
	'status_2' 	=>$status_2   	, 
	'perfil'	=>$perfil));
}
              
?> 