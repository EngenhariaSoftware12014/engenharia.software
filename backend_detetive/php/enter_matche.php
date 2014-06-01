<?php
	include 'conn.php';

	$rs = mysql_query('SELECT idpartida FROM partidas WHERE status = 0') or die(mysql_error());
	$idUsuario = intval($_REQUEST['idUsuario']);

	if (mysql_num_rows($rs) > 0) {
		$row = mysql_fetch_array($rs);
		$idPartida = $row['idpartida'];	

	} else {

		if (mysql_query('INSERT INTO  partidas (status, current_player) VALUES (0, 1)', $conn)){
			$idPartida = mysql_insert_id($conn);

			$query = "CREATE TABLE IF NOT EXISTS " . $idPartida . "_partidaxusuario (
				`idpartidaxusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`usuario_idusuario` int(10) unsigned NOT NULL,
				`suspeito_idsuspeito` int(10),
				`loser` int(1) unsigned NOT NULL,
				PRIMARY KEY (`idpartidaxusuario`,`usuario_idusuario`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
			mysql_query($query, $conn);

			$query = "CREATE TABLE `" . $idPartida . "_jogadas` (
				`idjogadas` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`usuario_idusuario` int(10) unsigned NOT NULL,
				`numero_dado` int(10) NOT NULL DEFAULT '0',
				`suspeito_suspeita` int(10) NOT NULL,
				`arma_suspeita` int(10) NOT NULL,
				`comodo_suspeita` int(10) NOT NULL,
				`resposta_carta` int(10) NOT NULL,
				`resposta_usuario` int(10) NOT NULL,
				PRIMARY KEY (`idjogadas`,`usuario_idusuario`),
				KEY `jogadas_fkindex1` (`usuario_idusuario`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
			mysql_query($query, $conn);

			$query = "CREATE TABLE `" . $idPartida . "_comentarios` (
  				`idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`usuario_idusuario` int(10) unsigned NOT NULL,
				`partida_idpartida` int(10) unsigned NOT NULL,
				`comentario` multilinestring DEFAULT NULL,
				`carta_idcarta` int(10) NOT NULL,
				`carta_tipocarta` varchar(10) NOT NULL,
				`delete_2` char(1) DEFAULT NULL,
				PRIMARY KEY (`idcomentarios`,`usuario_idusuario`,`partida_idpartida`),
				KEY `comentarios_fkindex1` (`usuario_idusuario`),
				KEY `comentarios_fkindex2` (`partida_idpartida`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";
			mysql_query($query, $conn);	

			$query = "CREATE TABLE IF NOT EXISTS " . $idPartida . "_cartas (
				`id_carta` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`id_original` int(10) unsigned NOT NULL,
				`nome_carta` varchar(45)  NOT NULL,
				`caminho_carta` varchar(100)  NOT NULL,
				`tipo_carta` varchar(10) NOT NULL,
				PRIMARY KEY (`id_carta`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
			mysql_query($query, $conn);		 

			$query = "CREATE TABLE `" . $idPartida . "_suspeitosxposicao` (
				`idsuspeito` int(10) NOT NULL,
				`position_x` int(10) NOT NULL,
				`position_y` int(10) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			mysql_query($query);

			$query = "INSERT INTO `" . $idPartida . "_suspeitosxposicao` (`idsuspeito`, `position_x`, `position_y`) VALUES
				(2, 4, 13),
				(3, 13, 13),
				(4, 10, 22),
				(5, 3, 4),
				(6, 16, 23),
				(7, 4, 22),
				(8, 9, 3),
				(9, 23, 3);";
			mysql_query($query);

			$rs = mysql_query("SELECT idarmas as id_original, nome as nome_carta, imagem as caminho_carta, \"arma\" as tipo_carta FROM armas;") or die(mysql_error());
			while ($row = mysql_fetch_object($rs)) {
					$cartas[] = $row;
			}

			$rs = mysql_query("SELECT idcomodos as id_original, nome as nome_carta, imagem as caminho_carta, \"comodo\" as tipo_carta FROM comodos;") or die(mysql_error());
			while ($row = mysql_fetch_object($rs)) {
					$cartas[] = $row;
			}

			$rs = mysql_query("SELECT idsuspeitos as id_original, nome as nome_carta, imagem as caminho_carta, \"suspeito\" as tipo_carta FROM suspeitos;") or die(mysql_error());
			while ($row = mysql_fetch_object($rs)) {
					$cartas[] = $row;
			}

			foreach($cartas as $carta){
				$sql = "INSERT INTO " . $idPartida . "_cartas (id_original, nome_carta, caminho_carta, tipo_carta) VALUES ($carta->id_original,'$carta->nome_carta','$carta->caminho_carta','$carta->tipo_carta');";
				 mysql_query($sql, $conn);
			}

			$query = "CREATE TABLE IF NOT EXISTS " . $idPartida . "_usuario_cartas (
			`id_usuario` int(10) unsigned NOT NULL,
			`id_carta` int(10) unsigned NOT NULL,
			PRIMARY KEY (`id_usuario`,`id_carta`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
			mysql_query($query, $conn);		 
		}		
	}

	$rs = mysql_query("SELECT idpartidaxusuario FROM " . $idPartida . "_partidaxusuario;") or die(mysql_error());
	$qtdeUsuario =  mysql_num_rows($rs);

	if($qtdeUsuario < 4){
		$sql = "INSERT INTO " . $idPartida . "_partidaxusuario (usuario_idusuario) VALUES ('$idUsuario' )";
		mysql_query($sql, $conn);
		$qtdeUsuario++;
	}

	if($qtdeUsuario == 4){
		$sql = "UPDATE partidas SET status = 1 WHERE idpartida = $idPartida";
		mysql_query($sql, $conn);

		$rs = mysql_query('SELECT id_carta, tipo_carta FROM ' . $idPartida . '_cartas') or die(mysql_error());

		while ($row = mysql_fetch_array($rs)) {
			$rowCartas[] = $row;
		}

		shuffle($rowCartas);

		// echo json_encode($rowCartas);

		$arma = false;
		$comodo = false;
		$suspeito = false;
		foreach ($rowCartas as $rowCarta) {
			if(!$arma && $rowCarta['tipo_carta'] == 'arma'){
				$sql = "INSERT INTO  " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES (0,  ".$rowCarta['id_carta'].")";
				mysql_query($sql, $conn);
				$arma = true;
			} else if(!$comodo && $rowCarta['tipo_carta'] == 'comodo'){
				$sql = "INSERT INTO  " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES (0,  ".$rowCarta['id_carta'].")";
				mysql_query($sql, $conn);
				$comodo = true;
			} else if(!$suspeito && $rowCarta['tipo_carta'] == 'suspeito'){
				$sql = "INSERT INTO  " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES (0,  ".$rowCarta['id_carta'].")";
				mysql_query($sql, $conn);
				$suspeito = true;
			} else {
				$cartas[] = $rowCarta['id_carta'];
			}
		}

		$rs = mysql_query('SELECT usuario_idusuario FROM ' . $idPartida . '_partidaxusuario') or die(mysql_error());
		while ($row = mysql_fetch_array($rs)) {		
			$usuarios[] = $row['usuario_idusuario'];
		}

		$count = 0;
		foreach ($cartas as $carta) {
			if($count < 6){
				$sql = "INSERT INTO  " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[0],  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 12){
				$sql = "INSERT INTO " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[1],  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 18){
				$sql = "INSERT INTO " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[2],  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 24){
				$sql = "INSERT INTO " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[3],  $carta)";
				mysql_query($sql, $conn);
			}
			$count++;
		}
	}	

	//Retorna personagens disponíveis

	$rs = mysql_query("SELECT suspeito_idsuspeito FROM " . $idPartida . "_partidaxusuario WHERE suspeito_idsuspeito IS NOT NULL");
	$result = array();

	while($row = mysql_fetch_array($rs)){
		$result[] = $row['suspeito_idsuspeito'];
	}

	$unavailable_suspect = count($result) > 0 ? join(',', $result) : 0;

	$rs2 = mysql_query("SELECT idsuspeitos, nome, imagem, IF(idsuspeitos IN ($unavailable_suspect), 'true', 'false') AS unavailable FROM suspeitos");
	$result2 = array();	
	while($row = mysql_fetch_object($rs2)){
		$result2['suspects'][] = $row;
	}

	$result2['idPartida'] = $idPartida;

	echo json_encode($result2);

?>
