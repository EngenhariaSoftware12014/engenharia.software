<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmação de envio</title>
		<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>

		<script type="text/javascript">
	function getUrlImg(cdirfig){
			//Objetos que receberão os valores 
			var winFig		= window.opener.document.getElementById('figura').src;
			var winImg		= window.opener.document.getElementById('imagem');

	  		winfig = cdirfig;
			winImg.innerHtml = cdirfig;
			winImg.value = cdirfig;
			window.opener.LoadImg();
			window.close();
		}
</script>		
</head>
<body>  
<?php 
include('conn.php'); 
$pasta =  '../'.$_REQUEST['pathrun'].'/';

/* formatos de imagem permitidos */ 
$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
 
 if(isset($_POST)){ 
	$nome_imagem = $_FILES['imagem']['name']; 
	$tamanho_imagem = $_FILES['imagem']['size']; 
	
	/* pega a extensão do arquivo */ 
	$ext = strtolower(strrchr($nome_imagem,"."));

/* verifica se a extensão está entre as extensões permitidas */ 
if(in_array($ext,$permitidos)){ 
	/* converte o tamanho para KB */ 
	$tamanho = round($tamanho_imagem / (1024*3)); 
	if($tamanho < (1024 * 3)){ //se imagem for até 3MB envia 
		$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem md5(uniqid(time()))
		$tmp = $_FILES['imagem']['tmp_name']; 
		//caminho temporário da imagem 
		/* se enviar a foto, insere o nome da foto no banco de dados */ 
		if(move_uploaded_file($tmp,$pasta.$nome_atual)){
			echo "<script>getUrlImg('$pasta$nome_atual');</script>";
			
			//imprime a foto na tela 
		}
		else{ echo "Falha ao enviar"; } 
		}
		else{ 
			echo "A imagem deve ser de no máximo 1MB"; } }
		else{ 
			echo "Somente são aceitos arquivos do tipo Imagem"; } 
		}
 ?>
<script>
	
</script>
</body>
</html>	