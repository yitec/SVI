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
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script language="javascript">
$(document).ready(function() {

	$(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});


});
function reimprimir(consecutivo){

	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=13&consecutivo="+consecutivo,
        success: function(datos){
		alert("La factura ha sido enviada a reimpresión");
	
		}//end succces function
		});//end ajax function		
	
}//end function reporte

</script>

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


<div id="mainGrisReportes" style=" width:900px; margin-left:100px; height:auto; margin-top:20px; float:left;">
 <div align="center" id="Exportar_a_Excel"> 
  <div align="center"  class="spiffyfg">
  <div align="center" style="width:750px; ">
  
  <table><tr>
  <td><div class="Arial18Azul" align="center">Reporte de Ventas 
  <?
  switch ($_REQUEST['cmb_tipo']){
  case 1:
  	echo "General";
  	break;
  case 105:
  	echo "LavaCar";
  	break;
  case 205:
  	echo "Lubricentro";
  	break;
  case 305:
  	echo "Repuestos";
  	break;
  case 405:
  	echo "Cafeteria";
  	break;
  case 505:
  	echo "Taller";
  	break;
  }
  
  
  ?>
  
  
  </div>
  </td> 
  </tr>
    </table>

  <br />
<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#0099FF">
<tr>
<td width="87" class=" Arial14Negro" align="center">Factura</td>
<td width="264" class=" Arial14Negro" align="center">Nombre</td>
<td width="115" class=" Arial14Negro" align="center">Placa</td>
<td width="115" class=" Arial14Negro" align="center">Descuento</td>
<td width="141" class=" Arial14Negro" align="center">Monto Descuento</td>
<td width="121" class=" Arial14Negro" align="center">Monto Total</td>
<td width="170" class=" Arial14Negro" align="center">Fecha</td>
<td width="170" class=" Arial14Negro" align="center">Reimprimir</td></tr>

<?



if($_REQUEST['chk_diario']=='on'){
$fecha_ini=$hoy." 00:00:00";
$fecha_fin=$hoy." 23:59:59";


if($_REQUEST['cmb_tipo']==105){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."105"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==205){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."205"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==305){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."305"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==405){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."405"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==505){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."505"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}

	if ($_REQUEST['cmb_tipo']==1){
	$result = mysql_query("select n.id,n.numero,f.nombre,f.placa,f.monto_descuento,f.monto_total,f.fecha, f.consecutivo from tbl_numfacturas as n, tbl_facturas as f where  f.fecha>'".$fecha_ini."' and f.fecha<'".$fecha_fin."' and f.estado=1 and n.consecutivo=f.consecutivo ");	
	}

	$num_rows = mysql_num_rows($result);
	//montos segmentados por codigos
	$r1=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=105 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw1=mysql_fetch_object($r1);


	$r2=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=205 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw2=mysql_fetch_object($r2);

	$r3=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=305 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw3=mysql_fetch_object($r3);

	$r4=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=405 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw4=mysql_fetch_object($r4);

	$r5=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=505 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw5=mysql_fetch_object($r5);
	
	$r6=mysql_query("Select SUM(impuestos) as tot from tbl_facturas where  fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1");
	$rw6=mysql_fetch_object($r6);
	
	


while ($row = mysql_fetch_assoc($result)) {
		
?>
<tr>
<?
	if($_REQUEST['cmb_tipo']==105||$_REQUEST['cmb_tipo']==205||$_REQUEST['cmb_tipo']==305||$_REQUEST['cmb_tipo']==405||$_REQUEST['cmb_tipo']==505) {

	$result2=mysql_query("select id from tbl_numfacturas where consecutivo='".$row['consecutivo']."'");	
	$row2=mysql_fetch_assoc($result2);
	
?>
<td width="87" class=" Arial10gris" align="center"><?=$row2['id'];?></td>
<?
	}else{
?>
<td width="87" class=" Arial10gris" align="center"><?=$row['id'];?></td>
<?
	}
?>
<td width="264" class=" Arial10gris" align="center"><?=$row['nombre'];?></td>
<td width="115" class="Arial10gris" align="center"><?=$row['placa'];?></td>
<td width="115" class="Arial10gris" align="center"><?=$row['descuento'];?></td>
<td width="141" class=" Arial10gris" align="center"><?=$row['monto_descuento'];?></td>
<? 
	if($_REQUEST['cmb_tipo']==105||$_REQUEST['cmb_tipo']==205||$_REQUEST['cmb_tipo']==305||$_REQUEST['cmb_tipo']==405||$_REQUEST['cmb_tipo']==505) {
		$monto_total=$monto_total+$row['precio'];	
?>
<td width="141" class=" Arial10gris" align="center"><?=$row['precio'];?></td>
<?
	}else{
		$monto_total=$monto_total+$row['monto_total'];
?>
<td width="121" class=" Arial10gris" align="center"><?=$row['monto_total']?></td>
<?
	}
?>
<td width="130" class=" Arial10gris" align="center"><?=$row['fecha'];?>
</td>
<td  class=" Arial10gris" align="center"><img onclick="reimprimir(<?=$row['consecutivo'];?>)" src="img/reprint.png" >
</td>


</tr>

<?
}//end while

}//end if si es reporte diario
else{//	//entre fechas

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

	if($_REQUEST['cmb_tipo']==105){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."105"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==205){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."205"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==305){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."305"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==405){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."405"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}
	if($_REQUEST['cmb_tipo']==505){
			$result = mysql_query("select * from tbl_subfacturas  where categoria='"."505"."' and fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1 ");				 
	}

	if ($_REQUEST['cmb_tipo']==1){
	$result = mysql_query("select n.id,n.numero,f.nombre,f.placa,f.monto_descuento,f.monto_total,f.fecha, f.consecutivo from tbl_numfacturas as n, tbl_facturas as f where  f.fecha>'".$fecha_ini."' and f.fecha<'".$fecha_fin."' and f.estado=1 and n.consecutivo=f.consecutivo ");	
	}


$num_rows = mysql_num_rows($result);
		//montos segmentados por codigos
	$r1=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=105 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw1=mysql_fetch_object($r1);


	$r2=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=205 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw2=mysql_fetch_object($r2);

	$r3=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=305 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw3=mysql_fetch_object($r3);

	$r4=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=405 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw4=mysql_fetch_object($r4);

	$r5=mysql_query("Select SUM(precio) as tot from tbl_subfacturas where categoria=505 and fecha_factura>'".$fecha_ini."' and fecha_factura<'".$fecha_fin."' and estado=1");
	$rw5=mysql_fetch_object($r5);
	
	$r6=mysql_query("Select SUM(impuestos) as tot from tbl_facturas where  fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and estado=1");
	$rw6=mysql_fetch_object($r6);


while ($row = mysql_fetch_assoc($result)) {
	
?>
<tr>
<?
	if($_REQUEST['cmb_tipo']==105||$_REQUEST['cmb_tipo']==205||$_REQUEST['cmb_tipo']==305||$_REQUEST['cmb_tipo']==405||$_REQUEST['cmb_tipo']==505) {

	$result2=mysql_query("select id from tbl_numfacturas where consecutivo='".$row['consecutivo']."'");	
	$row2=mysql_fetch_assoc($result2);
	
?>
<td width="87" class=" Arial10gris" align="center"><?=$row2['id'];?></td>
<?
	}else{
?>
<td width="87" class=" Arial10gris" align="center"><?=$row['id'];?></td>
<?
	}
?>
<td width="264" class=" Arial10gris" align="center"><?=$row['nombre'];?></td>
<td width="115" class="Arial10gris" align="center"><?=$row['placa'];?></td>
<td width="115" class="Arial10gris" align="center"><?=$row['descuento'];?></td>
<td width="141" class=" Arial10gris" align="center"><?=$row['monto_descuento'];?></td>
<? 
	if($_REQUEST['cmb_tipo']==105||$_REQUEST['cmb_tipo']==205||$_REQUEST['cmb_tipo']==305||$_REQUEST['cmb_tipo']==405||$_REQUEST['cmb_tipo']==505) {
		$monto_total=$monto_total+$row['precio'];	
?>
<td width="141" class=" Arial10gris" align="center"><?=$row['precio'];?></td>
<?
	}else{
		$monto_total=$monto_total+$row['monto_total'];
?>
<td width="121" class=" Arial10gris" align="center"><?=$row['monto_total']?></td>
<?
	}
?>
<td width="130" class=" Arial10gris" align="center"><?=$row['fecha'];?></td>
<td  class=" Arial10gris" align="center"><img onclick="reimprimir(<?=$row['consecutivo'];?>)" src="img/reprint.png" >
</td>


</tr>

<?
}//end while

}//end if si es reporte diario
?>

</table>  



<div align="center">
<table><tr><td class=" Arial18Verde">Total Facturas=</td>
<td ><div class="Arial20rojo"><?=$num_rows;?></div></td>
<td></td>
<td class="Arial18Verde">Total Ventas=</td>
<td ><div class="Arial20rojo">
<?=number_format($monto_total,2,",",".");?></div></td>
</tr></table></div>
<br />
<div align="center" class="Arial14Azul"> Lavacar = <?=$rw1->tot; ?> Lubricentro = <?=$rw2->tot; ?> Repuestos <?=$rw3->tot; ?> Cafeteria =<?=$rw4->tot; ?> Taller = <?=$rw5->tot; ?> Impuestos = <?=$rw6->tot; ?></div><br />
    <div class="Arial14Negro">Fecha Inicial=<?=$fecha_ini;?>&nbsp;&nbsp;Fecha Final=<?=$fecha_fin;?> </div>
</div>
  </div>
</div>
</div>
<br>
<br>
<br>
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial14Azul" align="right">Exportar a Excel  <img src="img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>      
<br />


</div>






</td></tr></table>



</div>




</body>

</html>
