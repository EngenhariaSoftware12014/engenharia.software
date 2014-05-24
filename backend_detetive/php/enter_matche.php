<?php
	include 'conn.php';

	$rs = mysql_query('SELECT idpartida FROM partidas WHERE status = 0') or die(mysql_error());
	$idUsuario = intval($_REQUEST['idUsuario']);

	if (mysql_num_rows($rs) > 0) {
		$row = mysql_fetch_array($rs);
		$idPartida = $row['idpartida'];	

	} else {
		
		if (mysql_query('INSERT INTO  partidas (status) VALUES (0)', $conn)){
			$idPartida = mysql_insert_id($conn);

			$query = "CREATE TABLE IF NOT EXISTS " . $idPartida . "_partidaxusuario (
			`idpartidaxusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`usuario_idusuario` int(10) unsigned NOT NULL,
			`suspeito_idsuspeito` int(10),
			PRIMARY KEY (`idpartidaxusuario`,`usuario_idusuario`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
			mysql_query($query, $conn);

			$query = "CREATE TABLE IF NOT EXISTS " . $idPartida . "_jogadas (
			`idjogadas` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`usuario_idusuario` int(10) unsigned NOT NULL,
			`partida_idpartida` int(10) unsigned NOT NULL,
			`usuarioalvo_idusuario` int(10) DEFAULT NULL,
			`descricaojogada` varchar(255) DEFAULT NULL,
			`acusacao` char(1) DEFAULT NULL,
			PRIMARY KEY (`idjogadas`,`usuario_idusuario`,`partida_idpartida`),
			KEY `jogadas_fkindex1` (`usuario_idusuario`),
			KEY `jogadas_fkindex2` (`partida_idpartida`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
			mysql_query($query, $conn);

			$query = "CREATE TABLE IF NOT EXISTS " . $idPartida . "_comentarios (
			`idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`usuario_idusuario` int(10) unsigned NOT NULL,
			`partida_idpartida` int(10) unsigned NOT NULL,
			`comentario` multilinestring DEFAULT NULL,
			`delete_2` char(1) DEFAULT NULL,
			PRIMARY KEY (`idcomentarios`,`usuario_idusuario`,`partida_idpartida`),
			KEY `comentarios_fkindex1` (`usuario_idusuario`),
			KEY `comentarios_fkindex2` (`partida_idpartida`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
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
		$sql = "UPDATE partidas SET status = 1 ";
		mysql_query($sql, $conn);
		
		$rs = mysql_query('SELECT id_carta FROM ' . $idPartida . '_cartas') or die(mysql_error());

		while ($row = mysql_fetch_array($rs)) {
			$cartas[] = $row['id_carta'];
		}

		shuffle($cartas);

		$rs = mysql_query('SELECT usuario_idusuario FROM ' . $idPartida . '_partidaxusuario') or die(mysql_error());
		while ($row = mysql_fetch_array($rs)) {		
			$usuarios[] = $row['usuario_idusuario'];
		}

		$count = 0;
		foreach ($cartas as $carta) {
			if($count < 3){
				$sql = "INSERT INTO  " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES (0,  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 9){
				$sql = "INSERT INTO  " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[0],  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 15){
				$sql = "INSERT INTO " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[1],  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 21){
				$sql = "INSERT INTO " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[2],  $carta)";
				mysql_query($sql, $conn);
			} else if($count < 27){
				$sql = "INSERT INTO " . $idPartida . "_usuario_cartas (id_usuario, id_carta) VALUES ($usuarios[3],  $carta)";
				mysql_query($sql, $conn);
			}
			$count++;
		}
	}	

	session_start();
	$_SESSION['idPartida'] = $idPartida;

	echo json_encode(array('idPartida' => $idPartida));

?>