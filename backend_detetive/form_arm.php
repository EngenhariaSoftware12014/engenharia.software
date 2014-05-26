<!DOCTYPE html>
<?php 
require 'php/acesso.php'
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Armas</title>
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
				url: '../php/arm_get.php',
				saveUrl: '../php/arm_put.php',
				updateUrl: '../php/arm_update.php'
			});
		});

	</script>
</head>
<body>    
    <div id="corpo">
	<table id="container" title="Formulário de Armas" class="easyui-datagrid" style="padding:0px 0px;width:700px;height:250px"
            toolbar="#toolbar" rownumbers="true" fitColumns="true" singleSelect="true"> 
        <thead>
            <tr>
				<th field="idarmas" width="10" editor="{type:'validatebox',options:{required:true}}">Id</th>
                <th field="nome" width="20" editor="{type:'validatebox',options:{required:true}}">Arma</th>
                <th field="statusdesc" width="45" editor="{type:'validatebox',options:{required:true}}">Status</th>
             </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newArm()">Novo Arma</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editArm()">Alterar Cadastro</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyArm()">Excluir Arma</a>
    </div>
    
     <div id="dlg_arm" class="easyui-dialog" style="width:450px;height:450;padding:10px 10px"  closed="true" buttons="#dlg-buttons">
        <form id="form_arm" method="post" novalidate>
          <TABLE border="0">
			<TBODY>
			<TR>
				<INPUT name="imagem" class="easyui-validatebox" id="imagem"   type="text" size="20" maxlength="70" hidden value='' data-options="required:true">
				<TD ><img id='figura' src=""  height="200" width="200"></TD>
			</TR>
			<tr>
				<td><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="OpenDlg();">Carregar Nova Imagem</a></td>
			</tr>	
			<TR>
				<TD><div class="ftitle">Dados da Arma</div></TD>
			</TR>
			
		<tr>
			<TD class="easyui-validatebox" >Desc. Arma:</TD>
			<TD><INPUT name="nome" class="easyui-validatebox" id="nome"   type="text" size="20" maxlength="70" data-options="required:true"></TD>  
		</TR>
		<TR>
		<TD class="easyui-validatebox">Status:</TD>
		<TD class="easyui-validatebox"><select class="easyui-combobox" name="delete_2" id='delete_2' style="width:140px;" data-options="required:true">
					<option value="" selected>Status</option>
					<option value="1">Ativo</option>
					<option value="2">Inativo</option>
			</select>
			</TD>   
		</TR>
		</TBODY>
	</TABLE>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveArm()">Salvar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="cancelar()">Cancelar</a>
    </div>
	</div>
    <script type="text/javascript">
        var url;
		var img;
		function OpenDlg(){

			popChama('cargaimg.php?diretorio='+'cartas','jF3','no');
            	}
        function newArm(){
            $('#dlg_arm').dialog('open').dialog('setTitle','Cadastro de Armas');
            $('#form_arm').form('clear');
			document.getElementById("figura").src = "../cartas/interrogacao.jpg";
			url = '../php/arm_put.php';
        }
		function LoadImg(){
			var row = $('#container').datagrid('getSelected');
         	 document.getElementById("figura").src = document.getElementById("imagem").value;            
            if (row){
				row.imagem = document.getElementById("imagem").value  ;
				document.getElementById("figura").src = row.imagem;
                
            }
        }
        function editArm(){
            var row = $('#container').datagrid('getSelected');
            if (row){
				document.getElementById("figura").src = row.imagem;
                $('#dlg_arm').dialog('open').dialog('setTitle','Editar Armas');
                $('#form_arm').form('load',row);
                url = '../php/arm_update.php?idarmas='+row.idarmas;
				
            }
        }
		function cancelar(){
			$('#dlg_arm').dialog('close');
            $('#container').datagrid('reload');    // reload the Arm data
        }
        function saveArm(){
		
            $('#form_arm').form('submit',{
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
                        $('#dlg_arm').dialog('close');        // close the dialog
                        $('#container').datagrid('reload');    // reload the Arm data
                    }
                }
            });
        }
        function destroyArm(){
            var row = $('#container').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Deseja excluir este Arma?',function(r){
                    if (r){
                        $.post('../php/arm_exclui.php',{idarmas:row.idarmas},function(result){
                            if (result.success){
                                $('#container').datagrid('reload');    // reload the Arm data
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
        #form_arm{
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