<?php

include('command.php');

function gerartabelas($Id){
		$tabelas = array();
	// 	$query = "CREATE TABLE IF NOT EXISTS ".$Id."_"."partida (
	// 	  `idpartida` int(10) unsigned NOT NULL AUTO_INCREMENT,
	// 	  `cenarios_idcenarios` int(10) unsigned NOT NULL,
	// 	  `qtdminjogadores` int(10) unsigned DEFAULT NULL,
	// 	  `qtdmaxjogadores` int(10) unsigned DEFAULT NULL,
	// 	  `status_2` char(1) DEFAULT NULL,
	// 	  `delete_2` char(1) DEFAULT NULL,
	// 	  `vencedor` int(10) unsigned DEFAULT NULL,
	// 	  PRIMARY KEY (`idpartida`),
	// 	  KEY `partida_fkindex1` (`cenarios_idcenarios`)
	// 	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;  ";

	// 	array_push($tabelas,array(cmd_input($query)));


	$query = " 
	CREATE TABLE IF NOT EXISTS ".$Id."_"."partidaxusuario (
	  `idpartidaxusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `usuario_idusuario` int(10) unsigned NOT NULL,
	  `partida_idpartida` int(10) unsigned NOT NULL,
	  PRIMARY KEY (`idpartidaxusuario`,`usuario_idusuario`,`partida_idpartida`),
	  KEY `patidaxusuario_fkindex1` (`partida_idpartida`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

	array_push($tabelas,array(cmd_input($query)));

	/*	
		descricaojogada alterada de multilinestring para varchar(255). Alterado por eduardo martins
		Adicionado o campo usuarioalvo_idusuario. Alterado por eduardo martins
	*/
	$query = "
	CREATE TABLE IF NOT EXISTS ".$Id."_"."jogadas (
	  `idjogadas` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `usuario_idusuario` int(10) unsigned NOT NULL,
	  `partida_idpartida` int(10) unsigned NOT NULL,
	  `usuarioalvo_idusuario` int(10) DEFAULT NULL,
	  `descricaojogada` varchar(255) DEFAULT NULL,
	  `descricaojogadaaux` varchar(255) DEFAULT NULL,
	  `acusacao` char(1) DEFAULT NULL,
	  PRIMARY KEY (`idjogadas`,`usuario_idusuario`,`partida_idpartida`),
	  KEY `jogadas_fkindex1` (`usuario_idusuario`),
	  KEY `jogadas_fkindex2` (`partida_idpartida`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

	array_push($tabelas,array(cmd_input($query)));

	$query = "
		CREATE TABLE IF NOT EXISTS ".$Id."_"."comentarios (
	   `idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `usuario_idusuario` int(10) unsigned NOT NULL,
	  `partida_idpartida` int(10) unsigned NOT NULL,
	  `comentario` multilinestring DEFAULT NULL,
	  `delete_2` char(1) DEFAULT NULL,
	  `id_carta` int(10) NOT NULL,
	  `tipocarta` varchar(15) NOT NULL,
	  PRIMARY KEY (`idcomentarios`,`usuario_idusuario`,`partida_idpartida`),
	  KEY `comentarios_fkindex1` (`usuario_idusuario`),
	  KEY `comentarios_fkindex2` (`partida_idpartida`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

	array_push($tabelas,array(cmd_input($query)));

	return json_encode($tabelas);
}

function excluirtabelas($Id){
$tabelas = array();
	$query = "	drop table if exists ".$Id."_"."partida;";
	$tabelas = cmd_input($query);
	$query = "	drop table if exists ".$Id."_"."jogadas;";
	$tabelas = cmd_input($query);
	$query = "  drop table if exists ".$Id."_"."comentarios;";
	$tabelas = cmd_input($query);
	$query = "	drop table if exists ".$Id."_"."partidaxusuario;";
	$tabelas = cmd_input($query);

	return $tabelas;
}
?>