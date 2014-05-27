<?php

$idPartida = $_REQUEST['idPartida'];
$currentPlayer = $_REQUEST['currentPlayer'];
$result = array();

include 'conn.php';

$rs = mysql_query("select sxp.position_x as position_x, sxp.position_y as position_y, com.class as comodo_class from 1_partidaxusuario as pxu left join 1_suspeitosxposicao as sxp on sxp.idsuspeito = pxu.suspeito_idsuspeito left join comodos as com on com.position_x = sxp.position_x and com.position_y = sxp.position_y where pxu.usuario_idusuario = 9;
");
$row = mysql_fetch_assoc($rs);

echo json_encode($row);