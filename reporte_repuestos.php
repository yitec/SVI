<?
session_start();
require_once('cnx/conexion.php');
conectar();
$monto_total=0;
$hoy=date("Y-m-d");
$Fecha=getdate(); 
  $Anio=$Fecha["year"]; 
  $Mes=$Fecha["mon"]; 
  $Dia=$Fecha["mday"]; 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SVI</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div    class="contenido_gm">

<div style="margin-left:960px;  margin-top:5px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;&nbsp;<a href="login.php">Salir</a></div>

<div id="mainGrisReportes" style=" width:600px; margin-left:200px; height:auto; margin-top:20px; float:left;">
  
  <div align="center"  class="spiffyfg">
  <div align="center" style="width:500px; ">
  
  <table><tr>
  <td><div class="Arial18Azul" align="center">Reporte de Ventas Repuestos</div>
  </td> 
  </tr>
    </table>

  <br />
<table width="508" border="1" cellpadding="0" cellspacing="0" bordercolor="#0099FF">
<tr>
<td width="87" class=" Arial14Negro" align="center">Factura</td>
<td width="264" class=" Arial14Negro" align="center">Nombre</td>
<td width="115" class=" Arial14Negro" align="center">Placa</td>
<td width="141" class=" Arial14Negro" align="center">Monto Descuento</td>
<td width="121" class=" Arial14Negro" align="center">Monto Total</td>
<td width="170" class=" Arial14Negro" align="center">Fecha</td></tr>
<?
if($_REQUEST['chk_diario']=='on'){
$fecha_ini=$hoy." 00:00:00";
$fecha_fin=$hoy." 23:59:59";
$result = mysql_query("select n.numero,f.nombre,f.placa,f.monto_descuento,f.monto_total,f.fecha from tbl_numfacturas as n, tbl_facturas as f where  f.fecha>'".$fecha_ini."' and f.fecha<'".$fecha_fin."' and f.estado=1 and n.consecutivo=f.consecutivo ");	
//$row = mysql_fetch_assoc($result);
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 

$num_rows = mysql_num_rows($result);


while ($row = mysql_fetch_assoc($result)) {
		$monto_total=$monto_total+$row['monto_total'];
?>
<tr>
<td width="87" class=" Arial10gris" align="center"><?=$row['numero'];?></td>
<td width="264" class=" Arial10gris" align="center"><?=$row['nombre'];?></td>
<td width="115" class="Arial10gris" align="center"><?=$row['placa'];?></td>
<td width="141" class=" Arial10gris" align="center"><?=$row['monto_descuento'];?></td>
<td width="121" class=" Arial10gris" align="center"><?=$row['monto_total']?></td>
<td width="130" class=" Arial10gris" align="center"><?=$row['fecha'];?></td></tr>
<?
}//end while

}//end if
else{
//reporte entre fechas
$fecha_ini=$_REQUEST['fecha_ini'];
$fecha_fin=$_REQUEST['fecha_fin'];

$dia=substr($fecha_ini, 3, 2);
$ano=substr($fecha_ini, 6, 4);
$mes=substr($fecha_ini, 0, 2);

$fecha_ini=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";


$fecha_fin=$_GET['fecha_fin'];	
$dia=substr($fecha_fin, 3, 2);
$ano=substr($fecha_fin, 6, 4);
$mes=substr($fecha_fin, 0, 2);
$fecha_fin=$ano."-".$mes."-".$dia." ".$_GET['cmb_fin'].":00";

$result = mysql_query("select * from tbl_facturas where fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' ");	

	
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 

$num_rows = mysql_num_rows($result);


while ($row = mysql_fetch_assoc($result)) {
	$monto_total=$monto_total+$row['monto_total'];
?>
<tr>
<td width="87" class=" Arial10gris" align="center"><?=$row['consecutivo'];?></td>
<td width="264" class=" Arial10gris" align="center"><?=$row['nombre'];?></td>
<td width="115" class="Arial10gris" align="center"><?=$row['placa'];?></td>
<td width="92" class=" Arial10gris" align="center"><?=$row['descuento'];?></td>
<td width="141" class=" Arial10gris" align="center"><?=$row['monto_descuento'];?></td>
<td width="121" class=" Arial10gris" align="center"><?=$row['monto_total'];?></td>
<td width="130" class=" Arial10gris" align="center"><?=$row['fecha'];?></td></tr>
<?
}//end while

}//end if


?>

</table>  
<div align="center">
<table><tr><td class=" Arial18Verde">Total Facturas=</td>
<td ><div class="Arial20rojo"><?=$num_rows;?></div></td>
<td></td>
<td class="Arial18Verde">Total Ventas=</td>
<td ><div class="Arial20rojo"><?=number_format($monto_total,2,",",".");?></div></td>
</tr></table></div>
<br />
    <div class="Arial14Negro">Fecha Inicial=<?=$fecha_ini;?>&nbsp;&nbsp;Fecha Final=<?=$fecha_fin;?> </div>
</div>
  </div>

</div>

</div>




</div>

</td></tr></table>

</div>




</body>

</html>
