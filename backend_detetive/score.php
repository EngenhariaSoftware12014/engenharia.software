<?php
	
	function putscore($idusuario) {
	$query = "UPDATE usuario SET pontuacao = pontuacao + 1 WHERE idusuario = " . $idusuario;
	return cmd_input($query);
	} 

	function getscore($idusuario) {
	$query = "SELECT pontuacao FROM usuario WHERE idusuario = " . $idusuario;
	return cmd_select($query);
	}
?>