<?php
	// session_start();
	// $idUsuario = $_SESSION['id_usuario'];
	// $idPartida = $_SESSION['id_partida'];
	// echo 'Isto é apenas um teste';

	//Gambiarra para funcionar no mesmo computador :D
	$idUsuario = $_REQUEST['id_usuario'];
	$idPartida = $_REQUEST['id_partida'];

	include 'php/conn.php';

	// Pegar o personagem do jogador
	$rsPersosnagemUsuario = mysql_query("select suspeito_idsuspeito from " . $idPartida . "_partidaxusuario where usuario_idusuario = $idUsuario");
	$p = mysql_fetch_assoc($rsPersosnagemUsuario);
	$idSuspeitoUsuario = $p['suspeito_idsuspeito'];

	// Pegar o jogador corrente
	$rsJogadorCorrente = mysql_query("select par.current_player as current_place, pxu.usuario_idusuario as current_player from partidas as par
		left join " . $idPartida . "_partidaxusuario as pxu on par.current_player = pxu.idpartidaxusuario 
		where par.idpartida = $idPartida");
	$r = mysql_fetch_assoc($rsJogadorCorrente);
	$currentPlace = $r['current_place'];
	$currentPlayer = $r['current_player'];
	$nome_current_player = '';

	// Recuperar jogadores
	$rsJogador = mysql_query("select pxu.usuario_idusuario as usuario_idusuario, pxu.idpartidaxusuario as idpartidaxusuario, pxu.loser as loser, usu.nome as nome, pat.descrpatente as patente, sus.imagem as imagem from " . $idPartida . "_partidaxusuario as pxu
		left join usuario as usu on usu.idusuario = pxu.usuario_idusuario
		left join patente as pat on pat.idpatente = usu.patente
		left join suspeitos as sus on sus.idsuspeitos = pxu.suspeito_idsuspeito") or die(mysql_error());
	$jogadores = '';
	while($row = mysql_fetch_assoc($rsJogador)){
		if ($currentPlayer == $row['usuario_idusuario'])
			$nome_current_player = $row['nome'];

		$jogadores .= '<div class="suspect row' . ($row['idpartidaxusuario'] == $currentPlace ? ' current' : '') . '">' 
			. '<div class="suspect-img col ' . ($row['loser'] == 1 ? 'loser' : '') . '"><img src="images/cards/' . $row['imagem'] . '"></div>'
			. '<div class="suspect-description col"><span><strong>' . $row['nome'] . '</strong><br><small>' . $row['patente'] . '</small></span></div>'
			. '</div>';
	}

	// Recuperar cartas do jogador
	$rsCartas = mysql_query("select caminho_carta from " . $idPartida . "_usuario_cartas as uxc
		left join " . $idPartida . "_cartas as car on uxc.id_carta = car.id_carta where uxc.id_usuario = $idUsuario");
	$cartas = '';
	while($row = mysql_fetch_assoc($rsCartas)){
		$cartas .= '<img src="images/cards/' . $row['caminho_carta'] . '" alt="" class="card col">';
	}

	$auxArray = array();
	$res = mysql_query("select carta_idcarta, carta_tipocarta from " . $idPartida . "_comentarios where usuario_idusuario = $idUsuario") or die(mysql_error());
	while ($row = mysql_fetch_assoc($res)) {
		$auxArray[$row['carta_tipocarta']][] = $row['carta_idcarta'];
	}
	
	// Recuperar cartas para anotações
	$rsSusp = mysql_query("SELECT idsuspeitos, nome FROM suspeitos") or die (mysql_error());
	$anotacoes = '<h2>Suspeitos</h2><ul class="notes-list">';
	while($row = mysql_fetch_assoc($rsSusp)){
		$anotacoes .= '<li><span><input type="checkbox" class="notes-check" data-tipo="suspeito" data-id="' . $row['idsuspeitos'] . '" ' . (in_array($row['idsuspeitos'], $auxArray['suspeito']) ? 'checked' : '') . '> ' . utf8_encode($row['nome']) . '</span></li>';
	}
	$anotacoes .= '</ul>';

	$rsArmas = mysql_query("SELECT idarmas, nome FROM armas") or die (mysql_error());
	$anotacoes .= '<h2>Armas</h2><ul class="notes-list">';
	while($row = mysql_fetch_assoc($rsArmas)){
		$anotacoes .= '<li><span><input type="checkbox" class="notes-check" data-tipo="arma" data-id="' . $row['idarmas'] . '" ' . (in_array($row['idarmas'], $auxArray['arma']) ? 'checked' : '') . '> ' . utf8_encode($row['nome']) . '</span></li>'; 
	}
	$anotacoes .= '</ul>';

	$rsCmds = mysql_query("SELECT idcomodos, nome FROM comodos") or die (mysql_error());
	$anotacoes .= '<h2>Comodos</h2><ul class="notes-list">';
	while($row = mysql_fetch_assoc($rsCmds)){
		$anotacoes .= '<li><span><input type="checkbox" class="notes-check" data-tipo="comodo" data-id="' . $row['idcomodos'] . '" ' . (in_array($row['idcomodos'], $auxArray['comodo']) ? 'checked' : '') . '> ' . utf8_encode($row['nome']) . '</span></li>';
	}
	$anotacoes .= '</ul>';

	// Recuperar a posição dos inicial dos pins
	$rsSuspeitos = mysql_query("select sus.idsuspeitos as idsuspeitos, sus.imagem as imagem, sxp.position_x as position_x, sxp.position_y as position_y from " . $idPartida . "_suspeitosxposicao as sxp left join suspeitos as sus on sus.idsuspeitos = sxp.idsuspeito;");
	$suspeitos = '';
	while($row = mysql_fetch_assoc($rsSuspeitos)) {
		$top = ($row['position_x'] * 22) - 44;
		$left = ($row['position_y'] * 22) - 33.5;
		$suspeitos .= '<img src="images/pins/' . $row['imagem'] . '" id="char_' . $row['idsuspeitos'] . '" class="character" style="position: absolute; top: ' . $top . 'px;
	left: ' . $left . 'px;' . ($row['idsuspeitos'] == $idSuspeitoUsuario ? 'z-index: 101;' : '') . '">';
	}

	// Recuperar posição dos comodos
	$rsComPosicao = mysql_query('select class, position_x, position_y from comodos');
	$arrayComPosicao = array();
	while($row = mysql_fetch_assoc($rsComPosicao)) {
		$auxArray = array();
		$auxArray['top'] = $row['position_x'];
		$auxArray['left'] = $row['position_y'];
		$arrayComPosicao[$row['class']] = $auxArray;
	}
	$comPosicao = json_encode($arrayComPosicao);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detetive</title>
	<!-- <link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'> -->
	<link rel="stylesheet" href="CSS/game_main.css">
</head>
<body>
	<div id="container">

		<!-- Left column -->
		<div id="left" class="col">			

			<!-- Suspeitos -->
			<h1 class="title">Suspeitos</h1>

			<div id="suspects"><?= $jogadores ?></div>

		</div>
		
		<!-- center column -->
		<div id="center" class="col">
			<div id="board-container">
				<div id="board">	
					<?= $suspeitos ?>
					<div class="row">
						<div id="r01c01" class="col restaurant"></div>
						<div id="r01c02" class="col restaurant"></div>
						<div id="r01c03" class="col restaurant"></div>
						<div id="r01c04" class="col restaurant"></div>
						<div id="r01c05" class="col restaurant"></div>
						<div id="r01c06" class="col restaurant"></div>
						<div id="r01c07" class="col restaurant"></div>
						<div id="r01c08" class="col field"></div>
						<div id="r01c09" class="col field"></div>
						<div id="r01c10" class="col field"></div>
						<div id="r01c11" class="col prefecture"></div>
						<div id="r01c12" class="col prefecture"></div>
						<div id="r01c13" class="col prefecture"></div>
						<div id="r01c14" class="col prefecture"></div>
						<div id="r01c15" class="col prefecture"></div>
						<div id="r01c16" class="col prefecture"></div>
						<div id="r01c17" class="col field"></div>
						<div id="r01c18" class="col field"></div>
						<div id="r01c19" class="col field"></div>
						<div id="r01c20" class="col bank"></div>
						<div id="r01c21" class="col bank"></div>
						<div id="r01c22" class="col bank"></div>
						<div id="r01c23" class="col bank"></div>
						<div id="r01c24" class="col bank"></div>
						<div id="r01c25" class="col bank"></div>
					</div>
					<div class="row">
						<div id="r02c01" class="col restaurant"></div>
						<div id="r02c02" class="col restaurant"></div>
						<div id="r02c03" class="col restaurant"></div>
						<div id="r02c04" class="col restaurant"></div>
						<div id="r02c05" class="col restaurant"></div>
						<div id="r02c06" class="col restaurant"></div>
						<div id="r02c07" class="col restaurant"></div>
						<div id="r02c08" class="col field"></div>
						<div id="r02c09" class="col field"></div>
						<div id="r02c10" class="col field"></div>
						<div id="r02c11" class="col prefecture"></div>
						<div id="r02c12" class="col prefecture"></div>
						<div id="r02c13" class="col prefecture"></div>
						<div id="r02c14" class="col prefecture"></div>
						<div id="r02c15" class="col prefecture"></div>
						<div id="r02c16" class="col prefecture"></div>
						<div id="r02c17" class="col field"></div>
						<div id="r02c18" class="col field"></div>
						<div id="r02c19" class="col field"></div>
						<div id="r02c20" class="col bank"></div>
						<div id="r02c21" class="col bank"></div>
						<div id="r02c22" class="col bank"></div>
						<div id="r02c23" class="col bank"></div>
						<div id="r02c24" class="col bank"></div>
						<div id="r02c25" class="col bank"></div>
					</div>
					<div class="row">
						<div id="r03c01" class="col restaurant"></div>
						<div id="r03c02" class="col restaurant"></div>
						<div id="r03c03" class="col restaurant"></div>
						<div id="r03c04" class="col restaurant"></div>
						<div id="r03c05" class="col restaurant"></div>
						<div id="r03c06" class="col restaurant"></div>
						<div id="r03c07" class="col restaurant"></div>
						<div id="r03c08" class="col restaurant-exit field caret caret-left" exit-of="restaurant"></div>
						<div id="r03c09" class="col field"></div>
						<div id="r03c10" class="col field"></div>
						<div id="r03c11" class="col prefecture"></div>
						<div id="r03c12" class="col prefecture"></div>
						<div id="r03c13" class="col prefecture"></div>
						<div id="r03c14" class="col prefecture"></div>
						<div id="r03c15" class="col prefecture"></div>
						<div id="r03c16" class="col prefecture"></div>
						<div id="r03c17" class="col field"></div>
						<div id="r03c18" class="col field"></div>
						<div id="r03c19" class="col field"></div>
						<div id="r03c20" class="col bank"></div>
						<div id="r03c21" class="col bank"></div>
						<div id="r03c22" class="col bank"></div>
						<div id="r03c23" class="col bank"></div>
						<div id="r03c24" class="col bank"></div>
						<div id="r03c25" class="col bank"></div>
					</div>
					<div class="row">
						<div id="r04c01" class="col restaurant"></div>
						<div id="r04c02" class="col restaurant"></div>
						<div id="r04c03" class="col restaurant"></div>
						<div id="r04c04" class="col restaurant"></div>
						<div id="r04c05" class="col restaurant"></div>
						<div id="r04c06" class="col restaurant"></div>
						<div id="r04c07" class="col restaurant"></div>
						<div id="r04c08" class="col field"></div>
						<div id="r04c09" class="col field"></div>
						<div id="r04c10" class="col field"></div>
						<div id="r04c11" class="col prefecture"></div>
						<div id="r04c12" class="col prefecture"></div>
						<div id="r04c13" class="col prefecture"></div>
						<div id="r04c14" class="col prefecture"></div>
						<div id="r04c15" class="col prefecture"></div>
						<div id="r04c16" class="col prefecture"></div>
						<div id="r04c17" class="col field"></div>
						<div id="r04c18" class="col field"></div>
						<div id="r04c19" class="col field"></div>
						<div id="r04c20" class="col bank"></div>
						<div id="r04c21" class="col bank"></div>
						<div id="r04c22" class="col bank"></div>
						<div id="r04c23" class="col bank"></div>
						<div id="r04c24" class="col bank"></div>
						<div id="r04c25" class="col bank"></div>
					</div>
					<div class="row">
						<div id="r05c01" class="col restaurant"></div>
						<div id="r05c02" class="col restaurant"></div>
						<div id="r05c03" class="col restaurant"></div>
						<div id="r05c04" class="col restaurant"></div>
						<div id="r05c05" class="col restaurant"></div>
						<div id="r05c06" class="col restaurant"></div>
						<div id="r05c07" class="col restaurant"></div>
						<div id="r05c08" class="col field"></div>
						<div id="r05c09" class="col field"></div>
						<div id="r05c10" class="col field"></div>
						<div id="r05c11" class="col prefecture"></div>
						<div id="r05c12" class="col prefecture"></div>
						<div id="r05c13" class="col prefecture"></div>
						<div id="r05c14" class="col prefecture"></div>
						<div id="r05c15" class="col prefecture"></div>
						<div id="r05c16" class="col prefecture"></div>
						<div id="r05c17" class="col field"></div>
						<div id="r05c18" class="col field"></div>
						<div id="r05c19" class="col field"></div>
						<div id="r05c20" class="col bank"></div>
						<div id="r05c21" class="col bank"></div>
						<div id="r05c22" class="col bank"></div>
						<div id="r05c23" class="col bank"></div>
						<div id="r05c24" class="col bank"></div>
						<div id="r05c25" class="col bank"></div>
					</div>
					<div class="row">
						<div id="r06c01" class="col field"></div>
						<div id="r06c02" class="col field"></div>
						<div id="r06c03" class="col field"></div>
						<div id="r06c04" class="col field"></div>
						<div id="r06c05" class="col field"></div>
						<div id="r06c06" class="col field"></div>
						<div id="r06c07" class="col field"></div>
						<div id="r06c08" class="col field"></div>
						<div id="r06c09" class="col field"></div>
						<div id="r06c10" class="col field"></div>
						<div id="r06c11" class="col prefecture"></div>
						<div id="r06c12" class="col prefecture"></div>
						<div id="r06c13" class="col prefecture"></div>
						<div id="r06c14" class="col prefecture"></div>
						<div id="r06c15" class="col prefecture"></div>
						<div id="r06c16" class="col prefecture"></div>
						<div id="r06c17" class="col field"></div>
						<div id="r06c18" class="col field"></div>
						<div id="r06c19" class="col field"></div>
						<div id="r06c20" class="col bank"></div>
						<div id="r06c21" class="col bank"></div>
						<div id="r06c22" class="col bank"></div>
						<div id="r06c23" class="col bank"></div>
						<div id="r06c24" class="col bank"></div>
						<div id="r06c25" class="col bank"></div>
					</div>
					<div class="row">
						<div id="r07c01" class="col field"></div>
						<div id="r07c02" class="col field"></div>
						<div id="r07c03" class="col field"></div>
						<div id="r07c04" class="col field"></div>
						<div id="r07c05" class="col field"></div>
						<div id="r07c06" class="col field"></div>
						<div id="r07c07" class="col field"></div>
						<div id="r07c08" class="col field"></div>
						<div id="r07c09" class="col field"></div>
						<div id="r07c10" class="col field"></div>
						<div id="r07c11" class="col field"></div>
						<div id="r07c12" class="col prefecture-exit field caret caret-up" exit-of="prefecture"></div>
						<div id="r07c13" class="col field"></div>
						<div id="r07c14" class="col field"></div>
						<div id="r07c15" class="col field"></div>
						<div id="r07c16" class="col field"></div>
						<div id="r07c17" class="col field"></div>
						<div id="r07c18" class="col field"></div>
						<div id="r07c19" class="col field"></div>
						<div id="r07c20" class="col field"></div>
						<div id="r07c21" class="col field"></div>
						<div id="r07c22" class="col bank-exit field caret caret-up" exit-of="bank"></div>
						<div id="r07c23" class="col field"></div>
						<div id="r07c24" class="col field"></div>
						<div id="r07c25" class="col field"></div>
					</div>
					<div class="row">
						<div id="r08c01" class="col hospital"></div>
						<div id="r08c02" class="col hospital"></div>
						<div id="r08c03" class="col hospital"></div>
						<div id="r08c04" class="col hospital"></div>
						<div id="r08c05" class="col hospital"></div>
						<div id="r08c06" class="col hospital"></div>
						<div id="r08c07" class="col field"></div>
						<div id="r08c08" class="col field"></div>
						<div id="r08c09" class="col field"></div>
						<div id="r08c10" class="col field"></div>
						<div id="r08c11" class="col field"></div>
						<div id="r08c12" class="col field"></div>
						<div id="r08c13" class="col field"></div>
						<div id="r08c14" class="col field"></div>
						<div id="r08c15" class="col field"></div>
						<div id="r08c16" class="col field"></div>
						<div id="r08c17" class="col field"></div>
						<div id="r08c18" class="col field"></div>
						<div id="r08c19" class="col field"></div>
						<div id="r08c20" class="col field"></div>
						<div id="r08c21" class="col field"></div>
						<div id="r08c22" class="col field"></div>
						<div id="r08c23" class="col field"></div>
						<div id="r08c24" class="col office-exit field caret caret-down" exit-of="office"></div>
						<div id="r08c25" class="col field"></div>
					</div>
					<div class="row">
						<div id="r09c01" class="col hospital"></div>
						<div id="r09c02" class="col hospital"></div>
						<div id="r09c03" class="col hospital"></div>
						<div id="r09c04" class="col hospital"></div>
						<div id="r09c05" class="col hospital"></div>
						<div id="r09c06" class="col hospital-exit field caret caret-left" exit-of="hospital"></div>
						<div id="r09c07" class="col field"></div>
						<div id="r09c08" class="col field"></div>
						<div id="r09c09" class="col field"></div>
						<div id="r09c10" class="col square"></div>
						<div id="r09c11" class="col square"></div>
						<div id="r09c12" class="col square"></div>
						<div id="r09c13" class="col square"></div>
						<div id="r09c14" class="col square"></div>
						<div id="r09c15" class="col square"></div>
						<div id="r09c16" class="col square"></div>
						<div id="r09c17" class="col field"></div>
						<div id="r09c18" class="col field"></div>
						<div id="r09c19" class="col field"></div>
						<div id="r09c20" class="col office"></div>
						<div id="r09c21" class="col office"></div>
						<div id="r09c22" class="col office"></div>
						<div id="r09c23" class="col office"></div>
						<div id="r09c24" class="col office"></div>
						<div id="r09c25" class="col office"></div>
					</div>
					<div class="row">
						<div id="r10c01" class="col hospital"></div>
						<div id="r10c02" class="col hospital"></div>
						<div id="r10c03" class="col hospital"></div>
						<div id="r10c04" class="col hospital"></div>
						<div id="r10c05" class="col hospital"></div>
						<div id="r10c06" class="col field"></div>
						<div id="r10c07" class="col field"></div>
						<div id="r10c08" class="col field"></div>
						<div id="r10c09" class="col field"></div>
						<div id="r10c10" class="col square"></div>
						<div id="r10c11" class="col square"></div>
						<div id="r10c12" class="col square"></div>
						<div id="r10c13" class="col square"></div>
						<div id="r10c14" class="col square"></div>
						<div id="r10c15" class="col square"></div>
						<div id="r10c16" class="col square"></div>
						<div id="r10c17" class="col field"></div>
						<div id="r10c18" class="col field"></div>
						<div id="r10c19" class="col office-exit field caret caret-right" exit-of="office"></div>
						<div id="r10c20" class="col office"></div>
						<div id="r10c21" class="col office"></div>
						<div id="r10c22" class="col office"></div>
						<div id="r10c23" class="col office"></div>
						<div id="r10c24" class="col office"></div>
						<div id="r10c25" class="col office"></div>
					</div>
					<div class="row">
						<div id="r11c01" class="col hospital"></div>
						<div id="r11c02" class="col hospital"></div>
						<div id="r11c03" class="col hospital"></div>
						<div id="r11c04" class="col hospital"></div>
						<div id="r11c05" class="col hospital"></div>
						<div id="r11c06" class="col hospital"></div>
						<div id="r11c07" class="col field"></div>
						<div id="r11c08" class="col field"></div>
						<div id="r11c09" class="col field"></div>
						<div id="r11c10" class="col square"></div>
						<div id="r11c11" class="col square"></div>
						<div id="r11c12" class="col square"></div>
						<div id="r11c13" class="col square"></div>
						<div id="r11c14" class="col square"></div>
						<div id="r11c15" class="col square"></div>
						<div id="r11c16" class="col square"></div>
						<div id="r11c17" class="col field"></div>
						<div id="r11c18" class="col field"></div>
						<div id="r11c19" class="col field"></div>
						<div id="r11c20" class="col office"></div>
						<div id="r11c21" class="col office"></div>
						<div id="r11c22" class="col office"></div>
						<div id="r11c23" class="col office"></div>
						<div id="r11c24" class="col office"></div>
						<div id="r11c25" class="col office"></div>
					</div>
					<div class="row">
						<div id="r12c01" class="col field"></div>
						<div id="r12c02" class="col field"></div>
						<div id="r12c03" class="col hospital-exit field caret caret-up" exit-of="hospital"></div>
						<div id="r12c04" class="col field"></div>
						<div id="r12c05" class="col field"></div>
						<div id="r12c06" class="col field"></div>
						<div id="r12c07" class="col field"></div>
						<div id="r12c08" class="col field"></div>
						<div id="r12c09" class="col field"></div>
						<div id="r12c10" class="col square"></div>
						<div id="r12c11" class="col square"></div>
						<div id="r12c12" class="col square"></div>
						<div id="r12c13" class="col square"></div>
						<div id="r12c14" class="col square"></div>
						<div id="r12c15" class="col square"></div>
						<div id="r12c16" class="col square"></div>
						<div id="r12c17" class="col field"></div>
						<div id="r12c18" class="col field"></div>
						<div id="r12c19" class="col field"></div>
						<div id="r12c20" class="col office"></div>
						<div id="r12c21" class="col office"></div>
						<div id="r12c22" class="col office"></div>
						<div id="r12c23" class="col office"></div>
						<div id="r12c24" class="col office"></div>
						<div id="r12c25" class="col office"></div>
					</div>
					<div class="row">
						<div id="r13c01" class="col floriculture"></div>
						<div id="r13c02" class="col floriculture"></div>
						<div id="r13c03" class="col floriculture"></div>
						<div id="r13c04" class="col floriculture"></div>
						<div id="r13c05" class="col floriculture"></div>
						<div id="r13c06" class="col floriculture"></div>
						<div id="r13c07" class="col field"></div>
						<div id="r13c08" class="col field"></div>
						<div id="r13c09" class="col square-exit field caret caret-right" exit-of="square"></div>
						<div id="r13c10" class="col square"></div>
						<div id="r13c11" class="col square"></div>
						<div id="r13c12" class="col square"></div>
						<div id="r13c13" class="col square"></div>
						<div id="r13c14" class="col square"></div>
						<div id="r13c15" class="col square"></div>
						<div id="r13c16" class="col square"></div>
						<div id="r13c17" class="col square-exit field caret caret-left" exit-of="square"></div>
						<div id="r13c18" class="col field"></div>
						<div id="r13c19" class="col field"></div>
						<div id="r13c20" class="col field"></div>
						<div id="r13c21" class="col field"></div>
						<div id="r13c22" class="col field"></div>
						<div id="r13c23" class="col field"></div>
						<div id="r13c24" class="col field"></div>
						<div id="r13c25" class="col mansion-exit field caret caret-down" exit-of="mansion"></div>
					</div>
					<div class="row">
						<div id="r14c01" class="col floriculture"></div>
						<div id="r14c02" class="col floriculture"></div>
						<div id="r14c03" class="col floriculture"></div>
						<div id="r14c04" class="col floriculture"></div>
						<div id="r14c05" class="col floriculture"></div>
						<div id="r14c06" class="col floriculture"></div>
						<div id="r14c07" class="col field"></div>
						<div id="r14c08" class="col field"></div>
						<div id="r14c09" class="col field"></div>
						<div id="r14c10" class="col square"></div>
						<div id="r14c11" class="col square"></div>
						<div id="r14c12" class="col square"></div>
						<div id="r14c13" class="col square"></div>
						<div id="r14c14" class="col square"></div>
						<div id="r14c15" class="col square"></div>
						<div id="r14c16" class="col square"></div>
						<div id="r14c17" class="col field"></div>
						<div id="r14c18" class="col field"></div>
						<div id="r14c19" class="col field"></div>
						<div id="r14c20" class="col field"></div>
						<div id="r14c21" class="col field"></div>
						<div id="r14c22" class="col field"></div>
						<div id="r14c23" class="col mansion"></div>
						<div id="r14c24" class="col mansion"></div>
						<div id="r14c25" class="col mansion"></div>
					</div>
					<div class="row">
						<div id="r15c01" class="col floriculture"></div>
						<div id="r15c02" class="col floriculture"></div>
						<div id="r15c03" class="col floriculture"></div>
						<div id="r15c04" class="col floriculture"></div>
						<div id="r15c05" class="col floriculture"></div>
						<div id="r15c06" class="col floriculture"></div>
						<div id="r15c07" class="col field"></div>
						<div id="r15c08" class="col field"></div>
						<div id="r15c09" class="col field"></div>
						<div id="r15c10" class="col square"></div>
						<div id="r15c11" class="col square"></div>
						<div id="r15c12" class="col square"></div>
						<div id="r15c13" class="col square"></div>
						<div id="r15c14" class="col square"></div>
						<div id="r15c15" class="col square"></div>
						<div id="r15c16" class="col square"></div>
						<div id="r15c17" class="col field"></div>
						<div id="r15c18" class="col field"></div>
						<div id="r15c19" class="col field"></div>
						<div id="r15c20" class="col mansion"></div>
						<div id="r15c21" class="col mansion"></div>
						<div id="r15c22" class="col mansion"></div>
						<div id="r15c23" class="col mansion"></div>
						<div id="r15c24" class="col mansion"></div>
						<div id="r15c25" class="col mansion"></div>
					</div>
					<div class="row">
						<div id="r16c01" class="col floriculture"></div>
						<div id="r16c02" class="col floriculture"></div>
						<div id="r16c03" class="col floriculture"></div>
						<div id="r16c04" class="col floriculture"></div>
						<div id="r16c05" class="col floriculture"></div>
						<div id="r16c06" class="col floriculture"></div>
						<div id="r16c07" class="col floriculture-exit field caret caret-left" exit-of="floriculture"></div>
						<div id="r16c08" class="col field"></div>
						<div id="r16c09" class="col field"></div>
						<div id="r16c10" class="col square"></div>
						<div id="r16c11" class="col square"></div>
						<div id="r16c12" class="col square"></div>
						<div id="r16c13" class="col square"></div>
						<div id="r16c14" class="col square"></div>
						<div id="r16c15" class="col square"></div>
						<div id="r16c16" class="col square"></div>
						<div id="r16c17" class="col field"></div>
						<div id="r16c18" class="col field"></div>
						<div id="r16c19" class="col mansion-exit field caret caret-right" exit-of="mansion"></div>
						<div id="r16c20" class="col mansion"></div>
						<div id="r16c21" class="col mansion"></div>
						<div id="r16c22" class="col mansion"></div>
						<div id="r16c23" class="col mansion"></div>
						<div id="r16c24" class="col mansion"></div>
						<div id="r16c25" class="col mansion"></div>
					</div>
					<div class="row">
						<div id="r17c01" class="col floriculture"></div>
						<div id="r17c02" class="col floriculture"></div>
						<div id="r17c03" class="col floriculture"></div>
						<div id="r17c04" class="col floriculture"></div>
						<div id="r17c05" class="col floriculture"></div>
						<div id="r17c06" class="col floriculture"></div>
						<div id="r17c07" class="col field"></div>
						<div id="r17c08" class="col field"></div>
						<div id="r17c09" class="col field"></div>
						<div id="r17c10" class="col square"></div>
						<div id="r17c11" class="col square"></div>
						<div id="r17c12" class="col square"></div>
						<div id="r17c13" class="col square"></div>
						<div id="r17c14" class="col square"></div>
						<div id="r17c15" class="col square"></div>
						<div id="r17c16" class="col square"></div>
						<div id="r17c17" class="col field"></div>
						<div id="r17c18" class="col field"></div>
						<div id="r17c19" class="col field"></div>
						<div id="r17c20" class="col mansion"></div>
						<div id="r17c21" class="col mansion"></div>
						<div id="r17c22" class="col mansion"></div>
						<div id="r17c23" class="col mansion"></div>
						<div id="r17c24" class="col mansion"></div>
						<div id="r17c25" class="col mansion"></div>
					</div>
					<div class="row">
						<div id="r18c01" class="col floriculture"></div>
						<div id="r18c02" class="col floriculture"></div>
						<div id="r18c03" class="col floriculture"></div>
						<div id="r18c04" class="col floriculture"></div>
						<div id="r18c05" class="col floriculture"></div>
						<div id="r18c06" class="col floriculture"></div>
						<div id="r18c07" class="col field"></div>
						<div id="r18c08" class="col field"></div>
						<div id="r18c09" class="col field"></div>
						<div id="r18c10" class="col field"></div>
						<div id="r18c11" class="col field"></div>
						<div id="r18c12" class="col field"></div>
						<div id="r18c13" class="col field"></div>
						<div id="r18c14" class="col field"></div>
						<div id="r18c15" class="col field"></div>
						<div id="r18c16" class="col field"></div>
						<div id="r18c17" class="col field"></div>
						<div id="r18c18" class="col field"></div>
						<div id="r18c19" class="col field"></div>
						<div id="r18c20" class="col field"></div>
						<div id="r18c21" class="col field"></div>
						<div id="r18c22" class="col field"></div>
						<div id="r18c23" class="col mansion"></div>
						<div id="r18c24" class="col mansion"></div>
						<div id="r18c25" class="col mansion"></div>
					</div>
					<div class="row">
						<div id="r19c01" class="col field"></div>
						<div id="r19c02" class="col field"></div>
						<div id="r19c03" class="col floriculture-exit field caret caret-up" exit-of="floriculture"></div>
						<div id="r19c04" class="col field"></div>
						<div id="r19c05" class="col field"></div>
						<div id="r19c06" class="col field"></div>
						<div id="r19c07" class="col field"></div>
						<div id="r19c08" class="col field"></div>
						<div id="r19c09" class="col field"></div>
						<div id="r19c10" class="col field"></div>
						<div id="r19c11" class="col field"></div>
						<div id="r19c12" class="col field"></div>
						<div id="r19c13" class="col field"></div>
						<div id="r19c14" class="col field"></div>
						<div id="r19c15" class="col field"></div>
						<div id="r19c16" class="col field"></div>
						<div id="r19c17" class="col field"></div>
						<div id="r19c18" class="col field"></div>
						<div id="r19c19" class="col field"></div>
						<div id="r19c20" class="col field"></div>
						<div id="r19c21" class="col field"></div>
						<div id="r19c22" class="col field"></div>
						<div id="r19c23" class="col field"></div>
						<div id="r19c24" class="col field"></div>
						<div id="r19c25" class="col field"></div>
					</div>
					<div class="row">
						<div id="r20c01" class="col field"></div>
						<div id="r20c02" class="col field"></div>
						<div id="r20c03" class="col field"></div>
						<div id="r20c04" class="col graveyard-exit field caret caret-down" exit-of="graveyard"></div>
						<div id="r20c05" class="col field"></div>
						<div id="r20c06" class="col field"></div>
						<div id="r20c07" class="col field"></div>
						<div id="r20c08" class="col field"></div>
						<div id="r20c09" class="col field"></div>
						<div id="r20c10" class="col station"></div>
						<div id="r20c11" class="col station"></div>
						<div id="r20c12" class="col station"></div>
						<div id="r20c13" class="col station"></div>
						<div id="r20c14" class="col station"></div>
						<div id="r20c15" class="col station"></div>
						<div id="r20c16" class="col station"></div>
						<div id="r20c17" class="col field"></div>
						<div id="r20c18" class="col field"></div>
						<div id="r20c19" class="col field"></div>
						<div id="r20c20" class="col field"></div>
						<div id="r20c21" class="col field"></div>
						<div id="r20c22" class="col field"></div>
						<div id="r20c23" class="col field"></div>
						<div id="r20c24" class="col nightclub-exit field caret caret-down" exit-of="nightclub"></div>
						<div id="r20c25" class="col field"></div>
					</div>
					<div class="row">
						<div id="r21c01" class="col graveyard"></div>
						<div id="r21c02" class="col graveyard"></div>
						<div id="r21c03" class="col graveyard"></div>
						<div id="r21c04" class="col graveyard"></div>
						<div id="r21c05" class="col graveyard"></div>
						<div id="r21c06" class="col graveyard"></div>
						<div id="r21c07" class="col field"></div>
						<div id="r21c08" class="col field"></div>
						<div id="r21c09" class="col field"></div>
						<div id="r21c10" class="col station"></div>
						<div id="r21c11" class="col station"></div>
						<div id="r21c12" class="col station"></div>
						<div id="r21c13" class="col station"></div>
						<div id="r21c14" class="col station"></div>
						<div id="r21c15" class="col station"></div>
						<div id="r21c16" class="col station"></div>
						<div id="r21c17" class="col field"></div>
						<div id="r21c18" class="col field"></div>
						<div id="r21c19" class="col field"></div>
						<div id="r21c20" class="col nightclub"></div>
						<div id="r21c21" class="col nightclub"></div>
						<div id="r21c22" class="col nightclub"></div>
						<div id="r21c23" class="col nightclub"></div>
						<div id="r21c24" class="col nightclub"></div>
						<div id="r21c25" class="col nightclub"></div>
					</div>
					<div class="row">
						<div id="r22c01" class="col graveyard"></div>
						<div id="r22c02" class="col graveyard"></div>
						<div id="r22c03" class="col graveyard"></div>
						<div id="r22c04" class="col graveyard"></div>
						<div id="r22c05" class="col graveyard"></div>
						<div id="r22c06" class="col graveyard"></div>
						<div id="r22c07" class="col graveyard-exit field caret caret-left" exit-of="graveyard"></div>
						<div id="r22c08" class="col field"></div>
						<div id="r22c09" class="col field"></div>
						<div id="r22c10" class="col station"></div>
						<div id="r22c11" class="col station"></div>
						<div id="r22c12" class="col station"></div>
						<div id="r22c13" class="col station"></div>
						<div id="r22c14" class="col station"></div>
						<div id="r22c15" class="col station"></div>
						<div id="r22c16" class="col station"></div>
						<div id="r22c17" class="col station-exit field caret caret-left" exit-of="station"></div>
						<div id="r22c18" class="col field"></div>
						<div id="r22c19" class="col field"></div>
						<div id="r22c20" class="col nightclub"></div>
						<div id="r22c21" class="col nightclub"></div>
						<div id="r22c22" class="col nightclub"></div>
						<div id="r22c23" class="col nightclub"></div>
						<div id="r22c24" class="col nightclub"></div>
						<div id="r22c25" class="col nightclub"></div>
					</div>
					<div class="row">
						<div id="r23c01" class="col graveyard"></div>
						<div id="r23c02" class="col graveyard"></div>
						<div id="r23c03" class="col graveyard"></div>
						<div id="r23c04" class="col graveyard"></div>
						<div id="r23c05" class="col graveyard"></div>
						<div id="r23c06" class="col graveyard"></div>
						<div id="r23c07" class="col field"></div>
						<div id="r23c08" class="col field"></div>
						<div id="r23c09" class="col field"></div>
						<div id="r23c10" class="col station"></div>
						<div id="r23c11" class="col station"></div>
						<div id="r23c12" class="col station"></div>
						<div id="r23c13" class="col station"></div>
						<div id="r23c14" class="col station"></div>
						<div id="r23c15" class="col station"></div>
						<div id="r23c16" class="col station"></div>
						<div id="r23c17" class="col field"></div>
						<div id="r23c18" class="col field"></div>
						<div id="r23c19" class="col nightclub-exit field caret caret-right" exit-of="nightclub"></div>
						<div id="r23c20" class="col nightclub"></div>
						<div id="r23c21" class="col nightclub"></div>
						<div id="r23c22" class="col nightclub"></div>
						<div id="r23c23" class="col nightclub"></div>
						<div id="r23c24" class="col nightclub"></div>
						<div id="r23c25" class="col nightclub"></div>
					</div>
					<div class="row">
						<div id="r24c01" class="col graveyard"></div>
						<div id="r24c02" class="col graveyard"></div>
						<div id="r24c03" class="col graveyard"></div>
						<div id="r24c04" class="col graveyard"></div>
						<div id="r24c05" class="col graveyard"></div>
						<div id="r24c06" class="col graveyard"></div>
						<div id="r24c07" class="col field"></div>
						<div id="r24c08" class="col field"></div>
						<div id="r24c09" class="col station-exit field caret caret-right" exit-of="station"></div>
						<div id="r24c10" class="col station"></div>
						<div id="r24c11" class="col station"></div>
						<div id="r24c12" class="col station"></div>
						<div id="r24c13" class="col station"></div>
						<div id="r24c14" class="col station"></div>
						<div id="r24c15" class="col station"></div>
						<div id="r24c16" class="col station"></div>
						<div id="r24c17" class="col field"></div>
						<div id="r24c18" class="col field"></div>
						<div id="r24c19" class="col field"></div>
						<div id="r24c20" class="col nightclub"></div>
						<div id="r24c21" class="col nightclub"></div>
						<div id="r24c22" class="col nightclub"></div>
						<div id="r24c23" class="col nightclub"></div>
						<div id="r24c24" class="col nightclub"></div>
						<div id="r24c25" class="col nightclub"></div>
					</div>
					<div class="row">
						<div id="r25c01" class="col graveyard"></div>
						<div id="r25c02" class="col graveyard"></div>
						<div id="r25c03" class="col graveyard"></div>
						<div id="r25c04" class="col graveyard"></div>
						<div id="r25c05" class="col graveyard"></div>
						<div id="r25c06" class="col graveyard"></div>
						<div id="r25c07" class="col field"></div>
						<div id="r25c08" class="col field"></div>
						<div id="r25c09" class="col field"></div>
						<div id="r25c10" class="col station"></div>
						<div id="r25c11" class="col station"></div>
						<div id="r25c12" class="col station"></div>
						<div id="r25c13" class="col station"></div>
						<div id="r25c14" class="col station"></div>
						<div id="r25c15" class="col station"></div>
						<div id="r25c16" class="col station"></div>
						<div id="r25c17" class="col field"></div>
						<div id="r25c18" class="col field"></div>
						<div id="r25c19" class="col field"></div>
						<div id="r25c20" class="col nightclub"></div>
						<div id="r25c21" class="col nightclub"></div>
						<div id="r25c22" class="col nightclub"></div>
						<div id="r25c23" class="col nightclub"></div>
						<div id="r25c24" class="col nightclub"></div>
						<div id="r25c25" class="col nightclub"></div>
					</div>
				</div>

			</div>
			<div id="bottom">
				<div id="cards" class="row"><?= $cartas ?></div>
			</div>
		</div>

		<!-- right column -->
		<div id="right" class="col">
			
			<!-- Anotações -->
			<h1 class="title">Anotações</h1>

			<div id="notes"><?= $anotacoes ?></div>	
		</div>
	</div>
	<div class="modal">
		<div id="roda_dado"></div>
		<div id="loading-message">
			<h3>Aguardando jogada do jogador <?= $nome_current_player ?>...</h3>
			<img src="images/spinner.GIF">
		</div>
		<div id="loading-result">
			<h3>Aguardando resposta dos jogadores...</h3>
			<img src="images/spinner.GIF">
		</div>
		<div id="cria_suspeita">
			<h2>Quem é o suspeito?</h2>
			<ul id="suspeitoSuspeita"></ul>
			<h2>Qual arma foi usada?</h2>
			<ul id="armaSuspeita"></ul>
			<input type="hidden" name="comodoSuspeita" id="comodoSuspeita"/>
			<div class="buttons">			
				<button id="suspeitar">Suspeitar</a>
				<button id="acusar">Acusar</a>
			</div>
		</div>
		<div id="responde_suspeita">
			<h3>Suspeitas do jogador <?= $nome_current_player ?></h3>
			<div id="showSuspeitas" class="row"></div>
		</div>
		<div id="responde_suspeita_j">
			<h3>Suspeitas do jogador <?= $nome_current_player ?></h3>
			<div id="showSuspeitasJ" class="row"></div>
			<p>Clique sobre a(s) carta(s) abaixo para responder a suspeita do jogador.</p>
			<div id="resultSuspeitaJ" class="row"></div>
		</div>
		<div id="resposta_suspeita">
			<h2>Carta pista</h2>
			<div id="img_resposta_suspeita"></div>
		</div>
	</div>

	<script src="jquery/jquery.min.js"></script>
	<script>
	var numeroDado = 0, numeroJogadas = 0, comPosicao = <?= $comPosicao ?>, 
		idPartida = <?= $idPartida ?>, idUsuario = <?= $idUsuario ?>, 
		currentPlayer = <?= $currentPlayer ?>, idSuspeitoUsuario = <?= $idSuspeitoUsuario ?>, currentPlace = <?= $currentPlace ?>;

	$(document).ready(function() {

		rodaDado(idPartida, idUsuario, currentPlayer);

	    $('.card').hover(function() {
	        $(this).animate({
	            'margin-top': '-25px'
	        }, 200);
	    });

	    $('.card').mouseleave(function() {
	        $(this).animate({
	            'margin-top': '0px'
	        }, 200);
	    });

	    $('.notes-check').change(function() {
	    	var idCarta = $(this).attr('data-id'), tipoCarta = $(this).attr('data-tipo');
	    	$.getJSON('php/put_coment.php', {idPartida: idPartida, idUsuario: idUsuario, idCarta: idCarta, tipoCarta: tipoCarta})
	    		.done(function(data) {
	    			console.log(data);
	    		});
	    });

	    // Movimentação do jogador
	    $(document).on('click', '.available', function() {
	    	$('.available').removeClass('available'); 
	    	$(this).addClass('selected');
	    	
	    	numeroJogadas++;

	    	var id = $(this).attr('id');
	    	var pos = retornarPosicaoPorId(id);

	    	if ($(this).hasClass('caret') && numeroJogadas !== 1) {
	    		var comodo = $(this).attr('exit-of');
	    		var top = comPosicao[comodo].top;
	    		var left = comPosicao[comodo].left;
	    		$('#char_' + idSuspeitoUsuario).css({'top': ((top * 22) - 44) + 'px', 'left': ((left * 22) - 33.5) + 'px'});
	    		moverPosicao(idPartida, idUsuario, idSuspeitoUsuario, top, left);

	    	} else {

	    		$('#char_' + idSuspeitoUsuario).css({'top': ((pos[0] * 22) - 44) + 'px', 'left': ((pos[1] * 22) - 33.5) + 'px'});
	    		if (numeroJogadas < numeroDado) {	
	    			proximoPasso(pos[0], pos[1]);	
	    		} else {
	    			moverPosicao(idPartida, idUsuario, idSuspeitoUsuario, pos[0], pos[1]);
	    		}
	    	} 
	    	
	    });

	    $('#suspeitar').click(function() {
	    	var suspeitoSupeita = $('input[name=suspeitoSuspeita]:checked').val(), 
	    		armaSuspeita = $('input[name=armaSuspeita]:checked').val(), 
	    		comodoSuspeita = $('input[name=comodoSuspeita]').val();
	    	// Enquanto aguarda retorno dos outros usuários (Incompleto)
	    	$('#cria_suspeita').hide();
	    	$('#loading-result').show();
	    	$.getJSON('php/update_jogada.php', {idPartida: idPartida, idSuspeito: suspeitoSupeita, idArma: armaSuspeita, idComodo: comodoSuspeita, idUsuario: idUsuario}).done(function(data) {
	    		//$('.modal').show();
	    		console.log(data);
	    		if (data.message) {
	    			alert(data.message);
	    			location.reload();
	    		} else {
	    			aguardandoRespota(idPartida, idUsuario);
	    		}
	    		
	    	});
	    });

	    $('#acusar').click(function() {
	    	var suspeitoSupeita = $('input[name=suspeitoSuspeita]').val(), armaSuspeita = $('input[name=armaSuspeita]').val(), comodoSuspeita = $('input[name=comodoSuspeita]').val();
	    	$.getJSON('php/retorna_acusacao.php', {idPartida: idPartida, idSuspeito: suspeitoSupeita, idArma: armaSuspeita, idComodo: comodoSuspeita, idUsuario: idUsuario}).done(function(data) {
	    		console.log(data);
	    		if (data.endAll === 'true') {
	    			location.href = "game_fechoupartida.php?idUsuario=" + idUsuario + "&idPartida=" + idPartida;
	    		} else if (data.winner === 'true') {
	    			alert('Parabéns você venceu!');
	    			location.href = "game_fechoupartida.php?idUsuario=" + idUsuario + "&idPartida=" + idPartida;
	    		} else {
	    			alert('Você Perdeu! Melhor sorte na próxima vez!');
	    			location.reload();
	    		}	
	    	});
	    }); 

	    $(document).on('click', '.resultS', function() {
	    	var idCarta = $(this).attr('data-value');
	    	$.getJSON('php/responde_suspeita.php', {idPartida: idPartida, idUsuario: idUsuario, idCarta: idCarta}).done(function() {
	    		$('#responde_suspeita_j').hide();
				$('#loading-message').show();
	    		aguardandoJogada(idUsuario, idPartida, currentPlace, true);
	    	});
	    });

	});

	function rodaDado(idPartida, idUsuario, currentPlayer) {
		if (idUsuario === currentPlayer) {
			$.getJSON('php/roda_dado.php', {idPartida: idPartida, currentPlayer: currentPlayer}).done(function(data) {
				$('#roda_dado').html('<img src="images/dados/dado_' + data.numero_dado + '.gif">');
				$('.modal').show();
				$('#roda_dado').show();
				setTimeout(function() {
					$('.modal').hide();
					$('#roda_dado').hide();
				}, 4000);

				numeroDado = data.numero_dado;
				selectWay(idPartida, idUsuario, currentPlayer);
			});
		} else {
			$('.modal').show();
			$('#loading-message').show();
			
			var check = window.setInterval(function() {
				$.getJSON('php/check_dado_rodado.php', {idPartida: idPartida, currentPlayer: currentPlayer}).done(function(data) {
					if (data.check_dado === 'true') {
						$('#loading-message').hide();
						$('#roda_dado').html('<img src="images/dados/dado_' + data.numero_dado + '.gif">');
						// $('.modal').show();
						$('#roda_dado').show();
						setTimeout(function() {
							//$('.modal').hide();
							$('#roda_dado').hide();
							$('#loading-message').show();
						}, 4000);

						clearInterval(check);
						aguardandoJogada(idUsuario, idPartida, currentPlace);
					} 
				});
			}, 3000);
		}
	}

	function selectWay(idPartida, idUsuario, currentPlayer) {
		if (idUsuario === currentPlayer) {
			$.getJSON('php/get_way.php', {idPartida: idPartida, currentPlayer: currentPlayer}).done(function(data) {
				if (data.comodo_class) {
					$('.' + data.comodo_class + '-exit').addClass('available');
				} else {
					// no caso de não cair em um comodo
					// console.log(data);
					proximoPasso(data.position_x, data.position_y);
				}
			});
		} 
	}

	function inserirZero(numero) {
		if (numero < 10) 
			return '0' + numero; 
		else 
			return numero;
	}

	function proximoPasso (position_x, position_y) {
		var p1 = '.field#r' + inserirZero(parseInt(position_x) + 1) + 'c' + inserirZero(parseInt(position_y));
		var p2 = '.field#r' + inserirZero(parseInt(position_x) - 1) + 'c' + inserirZero(parseInt(position_y));
		var p3 = '.field#r' + inserirZero(parseInt(position_x)) + 'c' + inserirZero(parseInt(position_y) + 1);
		var p4 = '.field#r' + inserirZero(parseInt(position_x)) + 'c' + inserirZero(parseInt(position_y) - 1);
		
		$(p1).addClass('available');
		$(p2).addClass('available');
		$(p3).addClass('available');
		$(p4).addClass('available');
	}

	function retornarPosicaoPorId(id) {
		var position_x = id.substr(1, 2);
		var position_y = id.substr(4, 5);
		return [position_x, position_y];
	}

	function moverPosicao(idPartida, idUsuario, idSuspeito, position_x, position_y) {
		$.getJSON('php/move_position.php', {idPartida: idPartida, idUsuario: idUsuario, idSuspeito: idSuspeito, position_x: position_x, position_y: position_y}).done(function(data) {
			if (data.endAll) {
				location.href = "game_fechoupartida.php?idUsuario=" + idUsuario + "&idPartida=" + idPartida;
			} else if (data.end) {
				// Script quando é encerrada a jogada do jogador (Incompleto)
				location.reload();
			} else {
				$('#comodoSuspeita').val(data.comodo[0].idCarta);
				
				var htmlAux = '';
				for (var i = 0, len = data.arma.length; i < len; i++) {
					var carta = data.arma[i];
					htmlAux += '<li><img src="images/cards/' + carta.caminhoCarta + '" alt=""><input type="radio" name="armaSuspeita" value="' + carta.idCarta + '"></li>';
				}
				$('#armaSuspeita').html(htmlAux);
				
				htmlAux = '';
				for (var i = 0, len = data.suspeito.length; i < len; i++) {
					var carta = data.suspeito[i];
					htmlAux += '<li><img src="images/cards/' + carta.caminhoCarta + '" alt=""><input type="radio" name="suspeitoSuspeita" value="' + carta.idCarta + '"></li>';
				}
				$('#suspeitoSuspeita').html(htmlAux);

				$('.modal').show();
				$('#cria_suspeita').show();
			}
			
		});
	}

	function aguardandoJogada(idUsuario, idPartida, currentPlace, keepAsking) {
		var checkJogada = window.setInterval(function() {
			$.getJSON('php/check_partida.php', {idUsuario: idUsuario, idPartida: idPartida, currentPlace: currentPlace, keepAsking: keepAsking}).done(function(data) {
				console.log(data);
				if (data.endAll === 'true') {
					location.href = "game_fechoupartida.php?idUsuario=" + idUsuario + "&idPartida=" + idPartida;
				} else if (data.nextTurn === 'true') {
					clearInterval(checkJogada);
					location.reload();
				} else { 
					if (data.suspeita) {

						clearInterval(checkJogada);
						if (data.resposta) {
							setTimeout(function() {
								var htmlAux = '';
								for (var i = 0, len = data.resposta.length; i < len; i++) 
									htmlAux += '<img src="images/cards/' + data.resposta[i].caminho_carta + '" alt="" class="col resultS" data-value="' + data.resposta[i].id_carta + '">';

								$('#loading-message').hide();
								$('#showSuspeitasJ').html('<img src="images/cards/' + data.suspeita.arma + '" alt="" class="col"><img src="images/cards/' + data.suspeita.suspeito + '" alt="" class="col"><img src="images/cards/' + data.suspeita.comodo + '" alt="" class="col">');
								$('#resultSuspeitaJ').html(htmlAux);
								$('#responde_suspeita_j').show();
							}, 3000);

						} else {
							
							setTimeout(function() {
								$('#loading-message').hide();
								$('#showSuspeitas').html('<img src="images/cards/' + data.suspeita.arma + '" alt="" class="col"><img src="images/cards/' + data.suspeita.suspeito + '" alt="" class="col"><img src="images/cards/' + data.suspeita.comodo + '" alt="" class="col">');
								$('#responde_suspeita').show();
							}, 3000);	


							setTimeout(function() {
								$('#responde_suspeita').hide();
								$('#loading-message').show();
								aguardandoJogada(idUsuario, idPartida, currentPlace, true);
							}, 7000);						
						}

					} 
				}
			});
		}, 3000);
	}

	function aguardandoRespota(idPartida, idUsuario) {
		var checkResposta = window.setInterval(function() {
			$.getJSON('php/check_resposta.php', {idPartida: idPartida, idUsuario: idUsuario}).done(function(data) {
				console.log(data);
				if (data.find === 'true') {
					$('#img_resposta_suspeita').html("<img src='images/cards/" + data.card + "''>");
					$('#loading-result').hide();
					$('#resposta_suspeita').show();
					clearInterval(checkResposta);

					setTimeout(function() {
						location.reload();
					}, 7000);
				} 
			});
		}, 3000);
	}

	</script>
</body>
</html>
