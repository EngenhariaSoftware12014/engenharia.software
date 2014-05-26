<?php
/*
	include("command.php");
	echo getcartas(3, 8);
*/
	function getcartas($idPartida, $idUsuario) {
	$query =  "SELECT 
			  ".$idPartida."_cartas.id_carta AS idNovaCarta, 
			  ".$idPartida."_cartas.id_original AS idRealCarta, 
			  ".$idPartida."_cartas.caminho_carta AS imagemCarta 
			   FROM 
			  ".$idPartida."_usuario_cartas
			   INNER JOIN ".$idPartida."_cartas
			   ON ".$idPartida."_usuario_cartas.id_carta = ".$idPartida."_cartas.id_carta
			   WHERE ".$idPartida."_usuario_cartas.id_usuario = $idUsuario ";

	return cmd_select($query);

	}

?>