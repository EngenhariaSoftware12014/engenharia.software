<?php

include 'conn.php';

$sqlArmas 	= "SELECT  * FROM armas";
$sqlCmds 	= "SELECT  * FROM comodos";
$sqlSusp 	= "SELECT  * FROM suspeitos";

$rsArmas = mysql_query($sqlArmas);
$rsCmds = mysql_query($sqlCmds);
$rsSusp = mysql_query($sqlSusp);

$resultArmas = array();
$cont=0;
while($row = mysql_fetch_object($rsArmas)){
    $cont++;
    array_push($resultArmas,$row);
}

$resultCmds = array();
$cont=0;
while($row1 = mysql_fetch_object($rsCmds)){
    $cont++;
    array_push($resultCmds,$row1);
}


$resultSusp = array();
$cont=0;
while($row2 = mysql_fetch_object($rsSusp)){
    $cont++;
    array_push($resultSusp,$row2);
}

echo json_encode(['armas'=>$resultArmas,'comodos'=>$resultCmds,'suspeitos'=>$resultSusp]);

?>