<?php	
/* Tive que quebrar em duas funções:
	Uma para quando você mostra uma carta para alguém (ou mostram para você). Neste caso, a getjogadas() só mostra essa jogada para esses dois jogadores.
	Outra para quando alguém faz uma sugestão. Neste caso, a getjogadas() mostra a jogada para todos
*/
	
	function putjogadaexibir($idTabelas, $usuarioAtual, $usuarioAlvo, $cartaExibida, $idPartida) {		
		$query  =  "INSERT INTO ".$idTabelas."_jogadas (usuario_idusuario, usuarioalvo_idusuario, descricaojogada, partida_idpartida) ";
		$query .=  "VALUES ('$usuarioAtual', '$usuarioAlvo', '$usuarioAtual mostrou a carta $cartaExibida para $usuarioAlvo', '$idPartida');"; //irei acerar a query para mostrar o nome ao invés do id
		return cmd_input($query);
	}
	
	
	function putjogadasugestao($idTabelas, $usuarioAtual, $cartaComodo, $cartaPersonagem, $cartaArma, $idPartida, $acusacao=null) {
		$query  = "INSERT INTO ".$idTabelas."_jogadas(usuario_idusuario, descricaojogada, partida_idpartida, acusacao) ";
		$query .= "VALUES ('$usuarioAtual', '$usuarioAtual sugeriu $cartaPersonagem no $cartaComodo com $cartaArma', '$idPartida', '$acusacao');"; //irei acerar a query para mostrar o nome ao invés do id
		return cmd_input($query);
	}
	
	
	function getjogadas($idTabelas, $usuarioAtual) {	
		$query  = "SELECT descricaojogada, acusacao FROM ".$idTabelas."_jogadas ";
		$query .= "WHERE usuario_idusuario = '$usuarioAtual' ";
		$query .= "OR usuarioalvo_idusuario = '$usuarioAtual' ";
		$query .= "OR usuarioalvo_idusuario = ' '; "; //jogadas de sugestão tem esse campo nulo, já que devem ser visíveis a todos os jogadores                                                                                                                                              
		return cmd_select($query);
	}
	
	
?>