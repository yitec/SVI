<?php
session_start();
require_once('cnx/conexion.php');
conectar();

if (isset($_SESSION['consecutivo'])){ 


if($_REQUEST['opcion']==1){
//busco la informacion del cliente
	$result = mysql_query("select consecutivo,cliente,placa,conductor,contrato,kilometraje,vehiculo,monto_letras from tbl_subfacturas where placa='".$_REQUEST['orden']."' and estado =0 LIMIT 1");
	$total=mysql_num_rows($result);
	$row = mysql_fetch_assoc($result);
		if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
	$_SESSION['consecutivo']=$row['consecutivo'];
	$vector=$total."|".$row['consecutivo']."|".$row['cliente']."|".$row['placa']."|".$row['conductor']."|".$row['contrato']."|".$row['kilometraje']."|".$row['vehiculo']."|".$row['monto_letras'];
	echo $vector;
	mysql_free_result($result);
}//end if OPVION1


if($_REQUEST['opcion']==2){
//busco la informacion del cliente
	$result = mysql_query("select id from tbl_subfacturas where placa='".$_REQUEST['orden']."' and estado=0");
	$vector=mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$vector=$vector."|".$row['id']; 
	}//end while*/
	echo $vector;
	mysql_free_result($result);
}//end if OPcion2

if($_REQUEST['opcion']==3){
//busco la informacion del articulo
	$result = mysql_query("select cantidad,codigo,nombre,precio,exento,fecha from tbl_subfacturas where id='".$_REQUEST['id']."'");
	$row = mysql_fetch_assoc($result);
	$vector=$row['cantidad']."|".$row['codigo']."|".$row['nombre']."|".$row['precio']."|".$row['exento']."|".$row['fecha']; 
	echo $vector;
	mysql_free_result($result);
}//end if OPVION3

}else{//end session consecutivo
header("location:login.php");
}



	
	

?>
