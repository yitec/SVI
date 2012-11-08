<?php
function conectar()
{
	//mysql_connect("localhost", "sid", "mizard777");
	//mysql_select_db("bdsms");
	
	$_SESSION['connectid'] = mysql_connect("localhost","root","1q2w3e"); 
	//mysql_connect('localhost', 'root', '1q2w3e');
	mysql_select_db("bd_svi2");
	
	
	
	
	//$_SESSION['connectid'] = mysql_connect('192.168.0.2', 'root@SID-LAPTOP', '1q2w3e');
	//mysql_select_db("bd_svi");

}

function desconectar()
{
	mysql_close();
}
?>