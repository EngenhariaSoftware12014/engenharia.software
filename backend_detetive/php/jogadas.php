<?php 

/* 
include("command.php");
echo putjogadaexibir(1,1,"Chapolin",8,"Hanna","Madruguinha");

 ?> <br /> <br />
<?php echo putjogadasugestao(1,8,"Hanna", "Cozinha", "Chaves", "Faca"); ?> <br /> <br />


<?php echo getjogadas(1,1); ?>
*/


<?php

	function putjogadaexibir($idPartida, $idJogador, $nomeJogador, $idJogadorAlvo, $nomeJogadorAlvo, $cartaExibida) {	


		$query  =  "INSERT INTO ".$idPartida."_jogadas (partida_idpartida, usuario_idusuario, usuarioalvo_idusuario, descricaojogada, descricaojogadaaux) ";
		$query .=  "VALUES ( ";
		$query .=  "'$idPartida', ";
		$query .=  "'$idJogador', ";
		$query .=  "'$$idJogadorAlvo', ";
		$query .=  "'$nomeJogador mostrou a carta $cartaExibida para $nomeJogadorAlvo', ";
		$query .=  "'$nomeJogador mostrou uma carta para $nomeJogadorAlvo' ";
		$query .=  ");"; 

		return cmd_input($query);

	}
	
	
	function putjogadasugestao($idPartida, $idJogador, $nomeJogador, $cartaComodo, $cartaPersonagem, $cartaArma, $acusacao=null) {


		$query  = "INSERT INTO ".$idPartida."_jogadas(usuario_idusuario, descricaojogada, partida_idpartida, acusacao) ";
		$query .= "VALUES ('$idJogador', '$nomeJogador sugeriu $cartaPersonagem no $cartaComodo com $cartaArma', '$idPartida', '$acusacao');"; 
		return cmd_input($query);
	}
	
	
	function getjogadas($idPartida, $idJogador) {
	/* Essa function retorna as jogadas que determinado jogador pode ver. */
 
		$query  = "SELECT acusacao, ";
		$query .= "IF((usuario_idusuario = $idJogador OR usuarioalvo_idusuario = $idJogador OR usuarioalvo_idusuario IS NULL), ";
		$query .= "(descricaojogada), (descricaojogadaaux)) AS descricao ";
		$query .= "FROM ".$idPartida."_jogadas;";
		return cmd_select($query);
	}


?>

