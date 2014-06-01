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
			   SET 
			   acusacao = 0,
			   suspeito_suspeita = $idSuspeito,
			   arma_suspeita = $idArma,
			   comodo_suspeita = $idComodo
			   WHERE idjogadas = ".$idJogada['idJogada'];
		mysql_query($sql) or die (mysql_error());
	}

	$rs = mysql_query('select position_x, position_y from comodos where idcomodos = $idComodo');
	$row = mysql_fetch_assoc($rs);
	mysql_query('update ' . $idPartida . '_suspeitosxposicao set position_x = ' . $row['position_x'] . ', position_y = ' . $row['position_y'] . ' where idsuspeito = 2');

	echo json_encode(array('error' => false));
?>