	<?php

	include 'conn.php';

	$idPartida = intval($_REQUEST['idPartida']);
	$idSuspeito = intval($_REQUEST['idSuspeito']);
	$idArma = intval($_REQUEST['idArma']);
	$idComodo = intval($_REQUEST['idComodo']);
	$idUsuario = intval($_REQUEST['idUsuario']);

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

	// Verifica jogador que possui a carta
	$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario 
					   WHERE idpartidaxusuario = (SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario 
					   WHERE usuario_idusuario = $idUsuario)") or die(mysql_error());
	$idPartUsuCurrent = 0;  

	while ($row = mysql_fetch_assoc($rs)) {
		$idPartUsuCurrent = $row['idpartidaxusuario'];
	}

	$idOutrosUsus = array();
	$menor = array();
	$maior = array();
	$rs = mysql_query("SELECT idpartidaxusuario FROM ".$idPartida."_partidaxusuario 
					   WHERE idpartidaxusuario != (SELECT idpartidaxusuario 
					   FROM ".$idPartida."_partidaxusuario WHERE usuario_idusuario = $idUsuario)") or die(mysql_error());

	while ($row = mysql_fetch_assoc($rs)) {
		if($idPartUsuCurrent > $row['idpartidaxusuario'] ){
			$menor[] = $row['idpartidaxusuario'];
		} else {
			$maior[] = $row['idpartidaxusuario'];
		}
	}

	$idPartOutrosUsus = array_merge($maior, $menor);

	$achei = false;
	foreach ($idPartOutrosUsus as $outroUsu) {
		if($achei == false){
			$rs = mysql_query("SELECT MAX(idjogadas) AS idJogada, suspeito_suspeita AS idSuspeito, 
		  		arma_suspeita AS idArma, comodo_suspeita AS idComodo FROM ".$idPartida."_jogadas ") or die(mysql_error());
			if (mysql_num_rows($rs) > 0) {
				$row = mysql_fetch_array($rs);
				$rs2 = mysql_query("SELECT id_usuario AS idUsuario FROM ".$idPartida."_usuario_cartas 
									LEFT OUTER JOIN ".$idPartida."_partidaxusuario ON ".$idPartida."_partidaxusuario.idpartidaxusuario = $outroUsu
									WHERE ".$idPartida."_partidaxusuario.usuario_idusuario = id_usuario AND id_carta IN 
									( ".$row['idSuspeito']." , ".$row['idArma']." , ".$row['idComodo']." ) ") or die(mysql_error());
				if(mysql_num_rows($rs2) > 0) {
					$achei = true;
					$row2 = mysql_fetch_array($rs2);
					$sql = "UPDATE ".$idPartida."_jogadas 
						   SET 
						   resposta_usuario = ".$row2['idUsuario']."
						   WHERE idjogadas = ".$row['idJogada'];
					mysql_query($sql, $conn) or die(mysql_error());
				}
			}
		}
	}

	echo json_encode(array('error' => false));
?>