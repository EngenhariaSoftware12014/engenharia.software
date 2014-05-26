
<?php


function getjogadores($idpartida) {


$query  = "SELECT usuario.nome, usuario.patente, usuario.imagem  FROM ".$idpartida."_partidaxusuario ";
$query .= "INNER JOIN usuario ON ".$idpartida."_partidaxusuario.usuario_idusuario = usuario.idusuario;";

return cmd_select($query);

}

?>