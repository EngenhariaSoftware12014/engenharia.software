<?php
	
	function putscore($idPartida, $idTabelas) {
	/* Quando a partida acabar, o vencedor recebe 3 pontos. Todos os demais jogadores recebem 1 ponto. 
	****IMPORTANTE****: ESSA FUNCTION SÓ DEVE SER CHAMADA POR 1 DOS CLIENTS. SE TODOS CHAMAREM, VAO ENTRAR 4 VEZES MAIS PONTOS. 
	Ou seja, só deve-se chamar essa function a partir do client do jogador que vencer. Se precisar mudar isso dá um toque! */

	$query  = "UPDATE usuario ";
	$query .= "INNER JOIN ".$idTabelas."_partidaxusuario ";
	$query .= "ON usuario.idusuario = ".$idTabelas."_partidaxusuario.usuario_idusuario ";
	$query .= "SET pontuacao = CASE ";
	$query .= "WHEN idusuario = (SELECT vencedor FROM partidas WHERE idpartida = $idPartida and STATUS = '2') THEN pontuacao + 3 ";
	$query .= "ELSE pontuacao + 1 ";
	$query .= "END;";

	return cmd_input($query);

	} 

	function getscore($idusuario) {
	/*retorna a pontuação APENAS do usuario atual*/
	$query = "SELECT pontuacao FROM usuario WHERE idusuario = " . $idusuario;
	return cmd_select($query);
	}
?>
