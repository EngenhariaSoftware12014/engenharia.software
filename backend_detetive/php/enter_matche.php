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

		}		
	}

	$rs = mysql_query("SELECT idpartidaxusuario FROM " . $idPartida . "_partidaxusuario;");
	$qtdeUsuario =  mysql_num_rows($rs);

	if($qtdeUsuario < 4){
		$sql = "INSERT INTO " . $idPartida . "_partidaxusuario (usuario_idusuario) VALUES ('$idUsuario' )";
		mysql_query($sql, $conn);
		$qtdeUsuario++;
	}

	if($qtdeUsuario == 4){
		$sql = "UPDATE partidas SET status = 1 ";
		mysql_query($sql, $conn);
	}	

	session_start();
	$_SESSION['idPartida'] = $idPartida;

	echo json_encode(array('idPartida' => $idPartida));

?>