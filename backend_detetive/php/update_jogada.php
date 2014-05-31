<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$idArma = intval($_REQUEST['idArma']);
	$idComodo = intval($_REQUEST['idComodo']);

	$rs = mysql_query("SELECT MAX(idjogadas) as idJogada FROM ".$idPartida."_jogadas") or die(mysql_error());
	if (mysql_num_rows($rs) > 0) {
		$idJogada = mysql_fetch_array($rs);
		$sql = "UPDATE ".$idPartida."_jogadas 
			   SET suspeito_suspeita = $idSuspeito,
			   arma_suspeita = $idArma,
			   comodo_suspeita = $idComodo
			   WHERE idjogadas = ".$idJogada['idJogada'];
		mysql_query($sql, $conn);
	}

?>