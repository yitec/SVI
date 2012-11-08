<?php
session_start();
require_once('cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
if (isset($_SESSION['consecutivo'])){ 

$_SESSION['resultado']='';
//primero consulto si me estan pidiendo que imprima una orden de trabajo o un articulo nuevo


	
	//consulto el articulo en el inventario
	$result = mysql_query("select categoria,nombre,existente,precioVenta,exento from tbl_inventario where codigo='".$_REQUEST['codigo']."' ");
	$row = mysql_fetch_assoc($result);

	$num_rows = mysql_num_rows($result);
	//evaluo si el codigo existe
	if($num_rows==0){
		$_SESSION['resultado']='El c&oacute;digo no existe';
		echo "error->".$_REQUEST['codigo'];
	}else{
	
	if($row['existente']>=$_REQUEST['cantidad']){
		$_SESSION['montoAI']=0;

		$monto=$row['precioVenta']*$_REQUEST['cantidad'];
		//$_SESSION['montoAI']=$_SESSION['montoAI']+$monto;

		//inserto los datos en la tabla de facturas temporales
		mysql_query("insert into tbl_subfacturas(consecutivo,cliente,contrato,kilometraje,monto_letras,vehiculo,placa,conductor,tipo_pago,categoria,codigo,cantidad,nombre,precio,exento,fecha,estado) values 
('".$_SESSION['consecutivo']."','".$_REQUEST['cliente']."','".$_REQUEST['contrato']."','".$_REQUEST['kilometraje']."','".$_REQUEST['letras']."','".$_REQUEST['vehiculo']."','".trim($_REQUEST['placa'])."','".$_REQUEST['conductor']."','".$_REQUEST['pago']."','".$row['categoria']."','".$_REQUEST['codigo']."','".$_REQUEST['cantidad']."','".$row['nombre']."','".$monto."','".$row['exento']."','".$hoy."','"."0"."')");
		$ultimo_id = mysql_insert_id($_SESSION['connectid']); 
		//echo "Success|".$row['nombre']."|".number_format($monto,2,",",".")."|".$ultimo_id ; 
		echo "Success|".$row['nombre']."|".$monto."|".$ultimo_id."|".$row['exento'] ;  ; 

}else{
			$_SESSION['resultado']="El articulo no tiene mas existencia";
			mysql_free_result($result);
echo "error";
		}//end if existencia
		}//end if codigo de articulo

}else{//end session consecutivo
header("location:login.php");
}



?>
