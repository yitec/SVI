<?php
session_start();
require_once('cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
$_SESSION['resultado']='';
//primero consulto si me estan pidiendo que imprima una orden de trabajo o un articulo nuevo
if (isset($_SESSION['consecutivo'])){ 

	
	

		$_SESSION['montoAI']=0;

		$monto=$_REQUEST['preciom'];
		//inserto los datos en la tabla de facturas temporales
		mysql_query("insert into tbl_subfacturas(consecutivo,cliente,contrato,kilometraje,monto_letras,vehiculo,placa,conductor,tipo_pago,categoria,codigo,cantidad,nombre,precio,exento,fecha,estado) values 
('".$_SESSION['consecutivo']."','".$_REQUEST['cliente']."','".$_REQUEST['contrato']."','".$_REQUEST['kilometraje']."','".$_REQUEST['letras']."','".$_REQUEST['vehiculo']."','". trim($_REQUEST['placa'])."','".$_REQUEST['conductor']."','".$_REQUEST['pago']."','".$_REQUEST['codigom']."','".$_REQUEST['codigom']."','".$_REQUEST['cantidadm']."','".$_REQUEST['nombrem']."','".$monto."','"."1"."','".$hoy."','"."0"."')");
		$ultimo_id = mysql_insert_id($_SESSION['connectid']); 
		//echo "Success|".$row['nombre']."|".number_format($monto,2,",",".")."|".$ultimo_id ; 
		echo "Success|".$_REQUEST['nombrem']."|".$monto."|".$ultimo_id ; 

}else{//end session consecutivo
header("location:login.php");
}


?>
