<?php
session_start();


require_once('cnx/conexion.php');
conectar();


//elimino el articulo
mysql_query("delete from tbl_subfacturas where id='".$_REQUEST['id']."'");

desconectar();

?>