<?php
	
	include 'conn.php';

	$rs = mysql_query('SELECT idpartida FROM partidas WHERE status= 0;');
	$idUsuario = intval($_REQUEST['idUsuario']);
	$idPartida;

	if (mysql_num_rows($rs) > 0) {
		$row = mysql_fetch_array($rs);
		$idPartida = $row['idpartida'];	
	} else {
		$sql = "INSERT INTO  partidas (status)VALUES (0 )";
		if(mysql_query($sql, $conn)){
			$idPartida = mysql_insert_id($conn);

			$query = "CREATE TABLE IF NOT EXISTS ".$idPartida."_partidaxusuario (
			`idpartidaxusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`usuario_idusuario` int(10) unsigned NOT NULL,
			PRIMARY KEY (`idpartidaxusuario`,`usuario_idusuario`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

			mysql_query($query);

			$query = "
			CREATE TABLE IF NOT EXISTS ".$idPartida."_jogadas (
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

			mysql_query($query);

			$query = "
			CREATE TABLE IF NOT EXISTS ".$idPartida."_comentarios (
			`idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`usuario_idusuario` int(10) unsigned NOT NULL,
			`partida_idpartida` int(10) unsigned NOT NULL,
			`comentario` multilinestring DEFAULT NULL,
			`delete_2` char(1) DEFAULT NULL,
			PRIMARY KEY (`idcomentarios`,`usuario_idusuario`,`partida_idpartida`),
			KEY `comentarios_fkindex1` (`usuario_idusuario`),
			KEY `comentarios_fkindex2` (`partida_idpartida`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

			mysql_query($query);

		}		
	}

	$rs = mysql_query("SELECT * FROM ".$idPartida."_partidaxusuario;");
	$qtdeUsuario =  mysql_num_rows($rs);

	echo $qtdeUsuario. "  ";

	if($qtdeUsuario < 6){
		$sql = "INSERT INTO  ".$idPartida."_partidaxusuario (usuario_idusuario) VALUES ('$idUsuario' )";
		mysql_query($sql);
		$qtdeUsuario++;
	}
	if($qtdeUsuario == 6){
		$sql = "UPDATE partidas SET status = 1 ";
		mysql_query($sql);
	}	



	echo "Id Partida: ". $idPartida;
?>