<?php
	
	function putpatente() {
	/* 
	E aí,
	No front, é só chamar isso DEPOIS do putscore. */

	$query  = "UPDATE usuario ";
	$query .= "INNER JOIN patente ";
	$query .= "SET usuario.patente = descrpatente ";
	$query .= "WHERE usuario.pontuacao >= patente.scorepatentemin ";
	$query .= "AND usuario.pontuacao <= patente.scorepatentemax;";
	return cmd_input($query);

	} 

	function getpatente($idusuario) {
	/*retorna a patente APENAS do usuario atual*/
	$query = "SELECT patente FROM usuario WHERE idusuario = " . $idusuario;
	return cmd_select($query);
	}
?>
