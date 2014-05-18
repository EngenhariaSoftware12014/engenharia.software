<?php 
require 'php/acesso.php'
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Main View</title>
	<link rel="stylesheet" type="text/css" href="jquery/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="jquery/demo/demo.css">
	<title>Untitled Document</title>
     <style type="text/css">
		#div {
	
			width:1003px; /* Tamanho da Largura da Div */
			height:200px; /* Tamanho da Altura da Div */
			position:absolute; 
			top:16%; 
			margin-top:-100px; /* ou seja ele pega 50% da altura tela e sobe metade do valor da altura no caso 100 */
			left:30%;
			margin-left:-250px; /* ou seja ele pega 50% da largura tela e diminui  metade do valor da largura no caso 250 */
		}
		#CONTAINER {
	
			width:1000px; /* Tamanho da Largura da Div */
			height:600px; /* Tamanho da Altura da Div */
			position:absolute; 
			top:20%; 
			margin-top:-100px; /* ou seja ele pega 50% da altura tela e sobe metade do valor da altura no caso 100 */
			left:30%;
			margin-left:-250px; /* ou seja ele pega 50% da largura tela e diminui  metade do valor da largura no caso 250 */
		}
</style>
	<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
<script type="text/javascript">
function getData(pagina){
	document.getElementById("CONTAINER").src = pagina;
	};
	</script>
</script>
</head>
<body BGCOLOR="#ffffff">    
<?php echo "Olá Usuário ".$_SESSION['usuario']." !!!"; ?>
<div id="div" class="easyui-layout" style="height:32px">
	<div   region="center" style="height:20px;">
			<div style="padding:2px 5px;">
				<a href="#" class="easyui-linkbutton" data-options="plain:true">Home</a>
				<a href="#" class="easyui-menubutton" data-options="menu:'#cadastro'">Cadastros</a>
				<a href="#" class="easyui-menubutton" data-options="menu:'#Imagens'">Cartas</a>
				<a href="php/logout.php" class="easyui-linkbutton" data-options="plain:true">Logout</a>
			</div>
			<div id="cadastro" style="width:60px;">
			<div data-options="iconCls:'icon-redo'" onclick="getData('form_usr.php');">Usuários</div>
			</div>
			<div id="Imagens" style="width:60px;">
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_cmd.php');">Comodos</div>
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_susp.php');">Suspeitos</div>
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_arm.php');">Evidencias\Armas</div>
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_pat.php');">Patentes</div>
				
			</div>

	</div>
</div>	
	<div  BGCOLOR="#0000000">
	<IFRAME ID="CONTAINER" width="60.07%" height="80%" frameborder="10"  marginwidth="143" marginheight="100" vspace="10"  hspace="10" scrolling="no" src="fundo.php"> </iframe>
</div>
</body>

</html>