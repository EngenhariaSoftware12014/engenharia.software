<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$cartas = array();

	$rs = mysql_query("SELECT MAX(idjogadas) AS idJogada, suspeito_suspeita AS idSuspeito, 
		  arma_suspeita AS idArma, comodo_suspeita AS idComodo FROM ".$idPartida."_jogadas ") or die(mysql_error());
	if (mysql_num_rows($rs) > 0) {
		$row = mysql_fetch_array($rs);
		$rs = mysql_query("SELECT id_carta AS idCarta, id_original AS idOriginal, 
		 	 caminho_carta AS caminhoImagem FROM ".$idPartida."_cartas WHERE id_carta IN (".$row['idSuspeito'].", ".$row['idArma'].", ".$row['idComodo'].")") or die(mysql_error());		
		while ($row = mysql_fetch_assoc($rs)) {
			$cartas[] = $row;
		}

		echo json_encode($cartas);
	}

?>