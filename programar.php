<?
session_start();
require_once('cnx/conexion.php');
conectar();
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
<title>Untitled Document</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="img/yamato.png" /></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">

<div align="center"></div>

<div style=" width:600px; margin-left:130px; height:200px; margin-top:20px; float:left;">
  <b class="spiffy">
    <b class="spiffy1"><b></b></b>
    <b class="spiffy2"><b></b></b>
    <b class="spiffy3"></b>
    <b class="spiffy4"></b>
    <b class="spiffy5"></b></b>
  
  <div align="center" class="spiffyfg">
  
  
  <table><tr>
  <td><div class="Arial18Azul">
 Indique la informaci&oacute;n del articulo</div>
  </td> 
  </tr>
    </table>
    <br />
<table>
<tr>
<td width="87" class=" Arial14Negro">Factura</td>
<td width="264" class=" Arial14Negro">Nombre</td>
<td width="115" class=" Arial14Negro">Placa</td>
<td width="92" class=" Arial14Negro">% Descuento</td>
<td width="141" class=" Arial14Negro">Monto Descuento</td>
<td width="121" class=" Arial14Negro">Monto Total</td>
<td width="130" class=" Arial14Negro">Fecha</td></tr>
<?
if($_REQUEST['chk_diario']=='on'){
$fecha_ini=$hoy." 00:00:00";
$fecha_fin=$hoy." 23:59:59";
$result = mysql_query("select * from tbl_facturas where fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' ");	
//$row = mysql_fetch_assoc($result);
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 

$num_rows = mysql_num_rows($result);
echo "total".$num_rows;

while ($row = mysql_fetch_assoc($result)) {
?>
<tr>
<td width="87" class=" Arial10gris"><?=$row['consecutivo'];?></td>
<td width="264" class=" Arial10gris"><?=$row['nombre'];?></td>
<td width="115" class="Arial10gris"><?=$row['placa'];?></td>
<td width="92" class=" Arial10gris"><?=$row['descuento'];?></td>
<td width="141" class=" Arial10gris"><?=$row['monto_descuento'];?></td>
<td width="121" class=" Arial10gris"><?=$row['monto_total']?></td>
<td width="130" class=" Arial10gris"><?=$row['fecha'];?></td></tr>
<?
}//end while

}//end if
?>



</table>  
<br />
  </div>

  <b class="spiffy">
  <b class="spiffy5"></b>
  <b class="spiffy4"></b>
  <b class="spiffy3"></b>
  <b class="spiffy2"><b></b></b>
  <b class="spiffy1"><b></b></b></b>
</div>






</div>
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:300px;float:left" class="Arial8negro">
Sistema de recordatorio de citas. Desarrollado por 
</div>
<div align="center" style="float:left" class="Arial8azul">
Yamato Tecnología.
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
