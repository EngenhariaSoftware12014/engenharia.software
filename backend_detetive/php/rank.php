<?php

include 'conn.php';

$sql = "SELECT  `nome` ,  `pontuacao` FROM USUARIO ORDER BY PONTUACAO ASC";
$rs = mysql_query($sql);
$result = array();
$cont=0;
while($row = mysql_fetch_object($rs)){
    $cont++;
    array_push($result,['posicao:'=>$cont,'nome:'=>$row->nome,'pontuacao:'=>$row->pontuacao])	;
}

echo json_encode($result);

?>