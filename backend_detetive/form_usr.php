<!DOCTYPE html>
<?php 
require 'php/acesso.php'
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuarios</title>
	<link rel="stylesheet" type="text/css" href="jquery/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="jquery/demo/demo.css">
	<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
				<script type="text/javascript">
				function popChama(rotina,tagname,sc) { 
			var horizontal = 500; 
			var vertical   = 250;    
			var res_ver = screen.height;
			var res_hor = screen.width;
			var pos_ver_fin = (res_ver - vertical)/2;
			var pos_hor_fin = (res_hor - horizontal)/2;
			
			//ÚÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄ¿
			//³ Abre a tela															   ³
			//ÀÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÄÙ  
			window.open(rotina,tagname,"width="+horizontal+",height="+vertical+",top="+pos_ver_fin+",left="+pos_hor_fin);
	
			}   
		$(function(){
			$('#container').datagrid({
				url: '../php/usr_get.php',
				saveUrl: '../php/usr_put.php',
				updateUrl: '../php/usr_update.php'
			});
		});
	</script>
</head>
<body>    
    <table id="container" title="Formulário de usuários" class="easyui-datagrid" style="padding:0px 0px;width:740px;height:250px"
            toolbar="#toolbar" rownumbers="true" fitColumns="true" singleSelect="true"> 
          
        <thead>
            <tr>
				<th field="idusuario" width="10" editor="{type:'validatebox',options:{required:true}}">Id</th>
                <th field="nome" width="20" editor="{type:'validatebox',options:{required:true}}">Nome</th>
                <th field="sobrenome" width="45" editor="{type:'validatebox',options:{required:true}}">SobreNome</th>
                <th field="email" width="45" editor="{type:'validatebox',options:{required:true}}">E-mail</th>
				<th field="senha" width="20" editor="{type:'validatebox',options:{required:true}}">Senha</th>
             	<th field="perfildesc" width="25" editor="{type:'validatebox',options:{required:true}}">Perfil</th>
				<th field="statusdesc" width="25" editor="{type:'validatebox',options:{required:true}}">Status</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Novo Usuário</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Alterar Cadastro</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Excluir Usuário</a>
    </div>
    
     <div id="dlg_usr" class="easyui-dialog" style="width:450px;height:400px;padding:10px 10px"  closed="true" buttons="#dlg-buttons">
        <form id="form_usr" method="post" novalidate>
          <TABLE border="0">
			<TBODY>
			<TR>
				<INPUT name="imagem" class="easyui-validatebox" id="imagem"   type="text" size="20" maxlength="70" hidden value=''>
				<TD ><img id='figura' src=""  height="200" width="200"></TD>
			</TR>
			<tr>
				<td><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="OpenDlg();">Carregar Nova Imagem</a></td>
			</tr>	
			<TR>
				<TD><div class="ftitle">Dados do Usuario</div></TD>
			</TR>
			
		<TR>
			<TD class="easyui-validatebox">Nome:</TD>
			<TD><INPUT name="nome" class="easyui-validatebox" id="nome"    type="text" size="20" maxlength="70" data-options="required:true"></TD>       

		</TR>
		<TR>
			<TD class="easyui-validatebox">SobreNome:</TD>
			<TD><INPUT name="sobrenome" class="easyui-validatebox" id="sobrenome"    type="text" size="20" maxlength="70" data-options="required:true"></TD>  
		</TR>
		<TR>
			<TD class="easyui-validatebox">E-mail:</TD>
			<TD><INPUT name="email" class="easyui-validatebox"  id="email" data-options="required:true"></INPUT></TD>
		
		</TR>
		<TR>
			<TD class="easyui-validatebox">Senha:</TD>
			<TD><INPUT name="senha" class="easyui-validatebox" id="senha" type="password" size="20" maxlength="6" data-options="required:true"></INPUT></TD>
		</TR>
<!--		<TR>
			<TD class="easyui-validatebox">Confirme Senha:</TD>
			<TD><INPUT name="senhaconf" class="easyui-validatebox" id="senhaconf"  type="password" size="20" maxlength="6"></TD> 
		</TR>-->
		<TR>	
			<TD class="easyui-validatebox">Perfil de Usuário:</TD>
			<TD class="easyui-validatebox">	<select class="easyui-combobox" name="perfil" id='perfil' style="width:140px;"data-options="required:true">
					<option value="1">Usuário</option>
					<option value="2">Administrador</option>
				</select></TD>
		</TR>
		<TR>
			<TD class="easyui-validatebox">Score:</TD>
			<TD><INPUT name="pontuacao" class="easyui-validatebox" id="senha" type="text" size="20" maxlength="6"></INPUT></TD>
		</TR>
		<TR>
			<TD class="easyui-validatebox">Status:</TD>
			<TD class="easyui-validatebox">	<select class="easyui-combobox" name="status_2" id='status_2' style="width:140px;"data-options="required:true">
					<option value="1">Ativo</option>
					<option value="2">Bloqueado</option>
			</select></TD>        
		</TR>
	</TBODY>
	</TABLE>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Salvar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="cancelar()">Cancelar</a>
    </div>
    <script type="text/javascript">
        var url;
        		var img;
		function OpenDlg(){

			popChama('cargaimg.php?diretorio='+'perfil','jF3','no');
            	}
		function newUser(){
            $('#dlg_usr').dialog('open').dialog('setTitle','Cadastro de Usuarios');
            $('#form_usr').form('clear');
			document.getElementById("figura").src = "../cartas/interrogacao.jpg";
            url = '../php/usr_put.php';
        }
		function LoadImg(){
			var row = $('#container').datagrid('getSelected');
         	            
            if (row){
				row.imagem = document.getElementById("imagem").value  ;
				document.getElementById("figura").src = row.imagem;
                
            }
        }
		function cancelar(){
			$('#dlg_usr').dialog('close');
            $('#container').datagrid('reload');    // reload the Arm data
        }
        function editUser(){
            var row = $('#container').datagrid('getSelected');
            if (row){
				document.getElementById("figura").src = row.imagem;
                $('#dlg_usr').dialog('open').dialog('setTitle','Editar Usuarios');
                $('#form_usr').form('load',row);
                url = '../php/usr_update.php?idusuario='+row.idusuario;
            }
        }
        function saveUser(){
            $('#form_usr').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg_usr').dialog('close');        // close the dialog
                        $('#container').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#container').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Deseja excluir este usuario?',function(r){
                    if (r){
                        $.post('../php/usr_exclui.php',{idusuario:row.idusuario},function(result){
                            if (result.success){
                                $('#container').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
				
    </script>
    <style type="text/css">
        #form_usr{
            margin:0;
            padding:10px 10px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }	
		
    </style>
</body>
</html>