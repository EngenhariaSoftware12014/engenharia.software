<?php	
	function putjogadaexibir($idTabelas, $usuarioAtual, $usuarioAlvo, $cartaExibida, $idPartida) {	
		/* Essa function deve ser usuada para inserir uma jogada do tipo exibir carta */
		$query_nomeatual = "SELECT nome FROM usuario WHERE idusuario = '$usuarioAtual';";
		$query_nomealvo = "SELECT nome FROM usuario WHERE idusuario = '$usuarioAlvo';";
		$rs = mysql_query($query_nomeatual);
		If($rs){
			$nomeAtual = mysql_fetch_row($rs);	
		}
		
		$rs = mysql_query($query_nomealvo);
		If($rs){
			$nomeAlvo = mysql_fetch_row($rs);	
		}
		
		$query  =  "INSERT INTO ".$idTabelas."_jogadas (usuario_idusuario, usuarioalvo_idusuario, descricaojogada, descricaojogadaaux,  partida_idpartida) ";
		$query .=  "VALUES ('$usuarioAtual', '$usuarioAlvo', '$nomeAtual[0] mostrou a carta $cartaExibida para $nomeAlvo[0]', '$nomeAtual[0] mostrou uma carta para $nomeAlvo[0]', '$idPartida');"; 
		return cmd_input($query);

	}
	
	
	function putjogadasugestao($idTabelas, $usuarioAtual, $cartaComodo, $cartaPersonagem, $cartaArma, $idPartida, $acusacao=null) {
	/*Essa function deve ser usuada para inserir uma jogada do tipo sugestão ou acusação */
		$query_nomeatual = "SELECT nome FROM usuario WHERE idusuario = '$usuarioAtual';";
		$rs = mysql_query($query_nomeatual);
		If($rs){
			$nomeAtual = mysql_fetch_row($rs);	
		}
		$query  = "INSERT INTO ".$idTabelas."_jogadas(usuario_idusuario, descricaojogada, partida_idpartida, acusacao) ";
		$query .= "VALUES ('$usuarioAtual', '$nomeAtual[0] sugeriu $cartaPersonagem no $cartaComodo com $cartaArma', '$idPartida', '$acusacao');"; 
		return cmd_input($query);
	}
	
	
	function getjogadas($idTabelas, $usuarioAtual) {
	/* Essa function retorna as jogadas que determinado jogador pode ver. */
 
	$query  = "SELECT acusacao, ";
	$query .= "IF((usuario_idusuario = $usuarioAtual OR usuarioalvo_idusuario = $usuarioAtual OR usuarioalvo_idusuario IS NULL), ";
	$query .= "(descricaojogada), (descricaojogadaaux)) AS descricao ";
	$query .= "FROM ".$idTabelas."_jogadas;";
	return cmd_select($query);
}


?>

