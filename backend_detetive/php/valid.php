<?php include 'conn.php'; ?>
<html>
<head>
<title>Autenticando Usuario</title>
<link rel='stylesheet' type='text/css' href='css/Login.css'	 />
<script typ="text/javascript">
function loginSuccess(){
	setTimeout("window.location='../menu.php'",500);
}
function loginFail(){
	setTimeout("window.location='../login.php'",1000);
}
</script>
</head>
<body>

<?php
$usuario	= $_POST['log'];
$senha 		= $_POST['pwd'];
$url        = "";
$sql	    = mysql_query("SELECT * from usuario where  email='$usuario' and senha='$senha' and status_2='1'") or die(mysql_error());
$rows		= mysql_num_rows($sql);
$rs			= mysql_fetch_array($sql);

if($rows > 0 ){
	
	session_start();
	$_SESSION['id_usuario']= $rs['idusuario'];
    $_SESSION['usuario']   = $rs['nome'];
	$_SESSION['senha']     = $_POST['pwd'];
	$_SESSION['dados']     = json_encode($rs);
    if($rs['perfil']==1){
    
        $url ='window.location="..*menu.php"' ;
    }else
    {
        $url ='window.location="..*painel.php"' ;
    }    
    echo json_encode(array(
        'success'   =>true         ,
        'successMsg'=>'Cadastrado com Sucesso',
        'error'     =>false          ,
        'errorMsg'  =>"" ,
        'nome'		=>$rs['nome']    	,   	
        'sobrenome'	=>$rs['sobrenome'] 	, 
        'email'		=>$rs['email'] 		, 
        'senha'		=>$rs['senha']   	, 
        'status_2' 	=>$rs['status_2'] 	, 
        'perfil'	=>$rs['perfil']     ,
        'url'       =>$url));

  
	
} else{
     echo json_encode(array(
        'success'   =>false         ,
        'error'     =>true          ,
        'errorMsg'  =>"<center>Verifique se o seus dados estão corretos! </center>" ,
        'nome'		=>$rs['nome']    	,   	
        'sobrenome'	=>$rs['sobrenome'] 	, 
        'email'		=>$rs['email'] 		, 
        'senha'		=>$rs['senha']   	, 
        'status_2' 	=>$rs['status_2'] 	, 
        'perfil'	=>$rs['perfil']     ));
	
} 
 
?>

</body>
</html>
