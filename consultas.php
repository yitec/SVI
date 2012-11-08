<?php
session_start();
?>
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/Scripts_eliminar.js" type="text/javascript"></script> 

<?
require_once('cnx/conexion.php');
conectar();




//busco los articulos de la subfactura
	$result = mysql_query("select * from tbl_subfacturas where placa='".$_REQUEST['orden']."' ");
	while ($row = mysql_fetch_assoc($result)) {
	
		$vector=$vector."|".$row['id']."|".$row['consecutivo']."|".$row['nombre']."|".$row['precio'] ; 
	}//end while
	echo $vector;
	mysql_free_result($result);

?>
