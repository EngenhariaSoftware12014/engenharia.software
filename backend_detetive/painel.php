<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detetive</title>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="CSS/detetive.css">
	<link rel="stylesheet" type="text/css" href="jquery/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="jquery/demo/demo.css">
	<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
    <script src="jquery/jquery.js"></script>
	<script src="jquery/detetive.js"></script>
    <title>Cadastro de Usuarios</title>
</head>
<body>
<div id="div" class="easyui-layout" style="height:32px;"align='right'; >
	<div   region="right" style="height:20px;">
			<div style="padding:2px 5px;">
				<a href="#" class="easyui-menubutton" data-options="menu:'#Imagens'">Cartas</a>
				<a href="php/logout.php" class="easyui-linkbutton" data-options="plain:true">Logout</a>
			</div>
			<div id="Imagens" style="width:60px;">
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_cmd.php');">Comodos</div>
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_susp.php');">Suspeitos</div>
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_arm.php');">Evidencias\Armas</div>
				<div data-options="iconCls:'icon-redo'" onclick="getData('form_pat.php');">Patentes</div>
				
			</div>

	</div>
</div>	
	<div class="container">

		<div class="column left-column">

			<div id="anotacoes">

            </div>

			<div id="jogador">
				<div class="carta big-carta">
					<img class="Foto" src="http://placekitten.com/190/190">
					<span class="descricao">Pedro</span>
				</div>
			</div>

		</div>

		<div class="column right-column">

			<div id="jogadores">
				<div class="jogador-carta">	
					<img class="carta mini-carta" src="http://placekitten.com/45/45">
					<div class="jogador-descricao">
						<span class="jogador-nome">Hanna</span>
						<span class="jogador-cartas">6 cartas</span>
					</div>
				</div>

				<div class="jogador-carta">	
					<img class="carta mini-carta" src="http://placekitten.com/45/45">
					<div class="jogador-descricao">
						<span class="jogador-nome">Romulo</span>
						<span class="jogador-cartas">6 cartas</span>
					</div>
				</div>

				<div class="jogador-carta">	
					<img class="carta mini-carta" src="http://placekitten.com/45/45">
					<div class="jogador-descricao">
						<span class="jogador-nome">Vitor</span>
						<span class="jogador-cartas">6 cartas</span>
					</div>
				</div>

			</div>

			<div id="tabuleiro">

			</div>

			<div id="cartas">
				<div class="carta-unidade first">
					<div class="carta medium-carta">
						<img class="Foto" src="http://placekitten.com/100/100">
						<span class="descricao">Seu Madruga</span>
					</div>
				</div>
				<div class="carta-unidade">
					<div class="carta medium-carta">
						<img class="Foto" src="http://placekitten.com/100/100">
						<span class="descricao">Seu Madruga</span>
					</div>
				</div>
				<div class="carta-unidade">
					<div class="carta medium-carta">
						<img class="Foto" src="http://placekitten.com/100/100">
						<span class="descricao">Seu Madruga</span>
					</div>
				</div>
				<div class="carta-unidade">
					<div class="carta medium-carta">
						<img class="Foto" src="http://placekitten.com/100/100">
						<span class="descricao">Seu Madruga</span>
					</div>
				</div>
				<div class="carta-unidade">
					<div class="carta medium-carta">
						<img class="Foto" src="http://placekitten.com/100/100">
						<span class="descricao">Seu Madruga</span>
					</div>
				</div>
				<div class="carta-unidade">
					<div class="carta medium-carta">
						<img class="Foto" src="http://placekitten.com/100/100">
						<span class="descricao">Seu Madruga</span>
					</div>
				</div>
			</div>
		</div>		
	</div>
</body>
</html>