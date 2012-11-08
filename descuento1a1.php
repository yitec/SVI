<?php
session_start();


require_once('cnx/conexion.php');
conectar();


//modifico el articulo
$result=mysql_query("update tbl_subfacturas set descuento=1,porcentage='".$_REQUEST['porciento']."', monto_descuento='".$_REQUEST['porcentage']."' where id='".$_REQUEST['id']."'");



desconectar();

?>