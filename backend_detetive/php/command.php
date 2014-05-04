<?php

include 'conn.php';

function cmd_select($sql){
$rs 	= mysql_query($sql);
$result = array();
	if($rs){
		while($row = mysql_fetch_object($rs)){
			array_push($result, $row);
		}
		array_push($result,array('Erro:'=>'false:'.mysql_error(),'Success:'=>'True'));
		return json_encode($result);
	}
	else{
		return json_encode(array('Erro:'=>'Invalid query: '. mysql_error()."\n",'Success:'	=> ''));

	}
}

function cmd_input($sql){
$rs 	= mysql_query($sql);
$result = array();
	if($rs){
		array_push($result,array('Erro:'=>'false:'.mysql_error(),'Success:'=>'True'));
		return json_encode($result);
	}
	else{<?php

include 'conn.php';

function cmd_select($sql){
$rs 	= mysql_query($sql);
$result = array();
	if(mysql_affected_rows() == 0) {
		return json_encode(array('Erro:'=>'No rows selected','Success:'	=> ''));
	}
	
	if($rs){
		while($row = mysql_fetch_object($rs)){
			array_push($result, $row);
		}
		array_push($result,array('Erro:'=>'false:'.mysql_error(),'Success:'=>'True'));
		return json_encode($result);
	}
	else{
		return json_encode(array('Erro:'=>'Invalid query: '. mysql_error()."\n",'Success:'	=> ''));

	}
}

function cmd_input($sql){
$rs 	= mysql_query($sql);
$result = array();
	if(mysql_affected_rows() == 0) {
		return json_encode(array('Erro:'=>'No rows affected','Success:'	=> ''));
	}
	if($rs){
		array_push($result,array('Erro:'=>'false:'.mysql_error(),'Success:'=>'True'));
		return json_encode($result);
	}
	else{
		return json_encode(array('Erro:'=>'Invalid query: '. mysql_error()."\n",'Success:'	=> ''));

	}
}
?>
		return json_encode(array('Erro:'=>'Invalid query: '. mysql_error()."\n",'Success:'	=> ''));

	}
}
?>