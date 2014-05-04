<!DOCTYPE html>
<?php 
require 'php/acesso.php'
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Patentes</title>
	<link rel="stylesheet" type="text/css" href="jquery/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="jquery/demo/demo.css">
	<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
		<script type="text/javascript">
		$(function(){
			$('#container').datagrid({
				url: '../php/pat_get.php',
				saveUrl: '../php/pat_put.php',
				updateUrl: '../php/pat_update.php'
			});
		});
	</script>
</head>
<body>    
    <table id="container" title="Formulário de Patentes" class="easyui-datagrid" style="padding:0px 0px;width:700px;height:250px"
            toolbar="#toolbar" rownumbers="true" fitColumns="true" singleSelect="true"> 
          
        <thead>
            <tr>
				<th field="idpatente" width="10" editor="{type:'validatebox',options:{required:true}}">Id</th>
                <th field="scorepatentemin" width="20" editor="{type:'validatebox',options:{required:true}}">Score Min:</th>
                <th field="scorepatentemax" width="45" editor="{type:'validatebox',options:{required:true}}">Score Max:</th>
             </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newPat()">Novo Patente</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editPat()">Alterar Cadastro</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyPat()">Excluir Patente</a>
    </div>
    
     <div id="dlg_pat" class="easyui-dialog" style="width:450px;height:400px;padding:10px 10px"  closed="true" buttons="#dlg-buttons">
        <form id="form_pat" method="post" novalidate>
          <TABLE border="0">
			<TBODY>
		<TR>
			<TD class="easyui-validatebox" >Desc. Patente:</TD>
			<TD colspan='3' ><INPUT name="descrpatente" class="easyui-validatebox" id="descrpatente"   type="text" size="20" maxlength="70" data-options="required:true"></TD>       
		</TR>
		<TR>
			<TD class="easyui-validatebox">Score Min:</TD>
			<TD><INPUT name="scorepatentemin" class="easyui-validatebox" id="scorepatentemin"    type="text" size="20" maxlength="70" data-options="required:true"></TD> 
			<TD class="easyui-validatebox">Score Max:</TD>
			<TD><INPUT name="scorepatentemax" class="easyui-validatebox"  id="scorepatentemax" data-options="required:true" ></INPUT></TD>
		</TR>
		</TBODY>
	</TABLE>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="savePat()">Salvar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_pat').dialog('close')">Cancelar</a>
    </div>
    <script type="text/javascript">
        var url;
        function newPat(){
            $('#dlg_pat').dialog('open').dialog('setTitle','Cadastro de Patentes');
            $('#form_pat').form('clear');
            url = '../php/pat_put.php';
        }
        function editPat(){
            var row = $('#container').datagrid('getSelected');
            if (row){
                $('#dlg_pat').dialog('open').dialog('setTitle','Editar Patentes');
                $('#form_pat').form('load',row);
                url = '../php/pat_update.php?idpatente='+row.idpatente;
            }
        }
        function savePat(){
            $('#form_pat').form('submit',{
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
                        $('#dlg_pat').dialog('close');        // close the dialog
                        $('#container').datagrid('reload');    // reload the Pat data
                    }
                }
            });
        }
        function destroyPat(){
            var row = $('#container').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Deseja excluir este patente?',function(r){
                    if (r){
                        $.post('../php/pat_exclui.php',{idpatente:row.idpatente},function(result){
                            if (result.success){
                                $('#container').datagrid('reload');    // reload the Pat data
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
        #form_pat{
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