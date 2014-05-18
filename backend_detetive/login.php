
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="jquery/themes/black/easyui.css">
		<link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
		<link rel="stylesheet" type="text/css" href="jquery/demo/demo.css">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<style type="text/css">
			#tabs {
		
				width:1000px; /* Tamanho da Largura da Div */
				height:600px; /* Tamanho da Altura da Div */
				position:absolute; 
				top:40%; 
				margin-top:-100px; /* ou seja ele pega 50% da altura tela e sobe metade do valor da altura no caso 100 */
				left:50%;
				margin-left:-250px; /* ou seja ele pega 50% da largura tela e diminui  metade do valor da largura no caso 250 */
			}
		</style>
	</head>
	<body>
    <div id="tabs" class="easyui-tabs" style="width:440px;height:310px">
        <!-- Login -->
        <div title="Login" style="padding:10px">
           <div class="easyui-panel" title="Acesso" style="width:420px">
				<div style="padding:10px 60px 20px 60px">
					<form id="Login" action="php/valid.php" method="post">
						<table cellpadding="5">
							<tr>														
								<td>E-mail:</td>
								<td><input class="easyui-validatebox textbox" type="text" name="log" id="log" size="20" maxlength="50" data-options="required:true,validType:'email'"></input></td>
								<td><input type="text" name="idlog" id="idlog" value="1" hidden></td>
							</tr>
							<tr>
								<td>Senha:</td>
								<td><input class="easyui-validatebox textbox" type="password" name="pwd" id="pwd" size="20" maxlength="50" data-options="required:true"></input></td>
							</tr>
						</table>
					</form>
				</div>
				 <div style="text-align:center;padding:5px">
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('Login')">Submit</a>
				</div>
			</div>
		</div>
		<!-- Sign in -->
        <div title="Registrar" style="padding:10px">
		   <div class="easyui-panel" title="Registrar" style="width:420px">
				<div style="padding:10px 60px 20px 60px">
					<form action="php/usrc_put.php" method="post" id='Registrar'>
						<table cellpadding="5">
							<tr>
								<td>Nome:</td>
								<td><input name="nome" id="nome" class="easyui-validatebox" type="text" size="20" maxlength="50" data-options="required:true"></td>
								<td><input type="text" name="idlog" value="2" hidden></td>
							</tr>
							<tr>
								<td>Sobrenome:</td>
								<td><input name="sobrenome" id="sobrenome" class="easyui-validatebox" type="text" size="20" maxlength="50" data-options="required:true"></input></td>
							</tr>
							<tr>
								<td>E-mail:</td>
								<td><input class="easyui-validatebox textbox" type="text" name="email" size="20" maxlength="50" data-options="required:true,validType:'email'"></td>
							</tr>
							<tr>
								<td>Senha:</td>
								<td><input name="senha" id="senha" class="easyui-validatebox" type="password" size="20" maxlength="50"data-options="required:true"></td>
							</tr>
							<tr>
								<td>Confirme sua Senha:</td>
								<td><input name="senhaConf" id="senhaConf" class="easyui-validatebox" type="password" size="20" maxlength="50" onblur="validsenha('senhaConf','senha');" data-options="required:true"></td>
							</tr>
						</table>

					</form>
				</div>
				<div style="text-align:center;padding:5px">
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('Registrar')">Enviar</a>
				</div>
			</div>
        </div>
        <!-- Remember -->
        <div title="Lembrar" data-options="iconCls:'icon-help'" style="padding:10px">
		   <div class="easyui-panel" title="Lembrar" style="width:420px">
				<div style="padding:10px 60px 20px 60px">
					<form action="" method="post" id='Lembrar'>
						<table cellpadding="5">
							<tr>
								<td>Email:</td>
								<td><input class="easyui-validatebox textbox" type="text" name="email" size="20" data-options="required:true,validType:'email'"></input></td>
							</tr>
						</table>
					</form>
				</div>
				<div style="text-align:center;padding:5px">
					<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('Lembrar')">Enviar</a>
				</div>		
			</div>
    	</div>
    </div>

	<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
	<script>
		
		function validaform(form){
			for (i=0;i<form.length;i++){
				var nome = form[i].name;
				if (form[i].value == ""){
					alert("O campo '" + nome.toUpperCase() + "' e obrigatorio.");
					form[i].focus();
					return false;
				}		
			}
			return true;
		}

		function validsenha(passconf,pass) {
			var senha = document.getElementById(pass);
			var senhaconf = document.getElementById(passconf);
		   	if (senha.value == "" || senhaconf.value == "") {
				alert("Nao h? nenhuma senha cadastrada para este usuario.");
				senha.focus();
				return false;
		   }
		   	if (senha.value.charCodeAt() != senhaconf.value.charCodeAt() ) {
				alert("Senhas divergentes, favor digitar a mesma senha em ambos os campos");
				senha.focus();
				return false;
		   	}
		   	return true;
	  	}

	  	function submitForm(cForm) {
			url = '..'+eval(cForm+'.action').substring(eval(cForm+'.action').indexOf("/php/"),eval(cForm+'.action').length);
			
			$(function(){
    
	    		$('#'+cForm).form('submit',
	    			{
			        url: 'backend_detetive/' + url ,
			        onSubmit: function(){
			        		return $(this).form('validate');
	        			},
	        		success: function(result) {
	        			console.log(result);
	            		var result = eval('('+result+')');           
			            if (result.errorMsg != undefined && result.errorMsg != "") {
			                $.messager.alert('Alerta:',result.errorMsg,'warning');          
			            } else {
			                $.messager.alert('Info:',result.successMsg,'info');
			                clearForm(cForm);
			            
			                if(result.url != undefined && result.url != ""){
			                    result.url=result.url.replace("*", "/");
			                    eval(result.url);
			                }
	            		}
	        		}
	    		});
			});
		}
        
	    function clearForm(cForm){
	    	$('#'+cForm).form('clear');
	    }
        
	   $('#tabs').tabs( {
	    border:false,
	    onSelect:function(title){
	       var pp = $('#tabs').tabs('getSelected');
	       var form = document.getElementById(pp.panel("options").tab[0].innerText);
	        
	        clearForm(form.id);
	        }
	    });
	</script>
	</body>
</html>