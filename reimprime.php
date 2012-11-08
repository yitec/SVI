<?
session_start();
require_once('cnx/conexion.php');
conectar();
$hoy=date("Y-m-d");
$Fecha=getdate(); 
  $Anio=$Fecha["year"]; 
  $Mes=$Fecha["mon"]; 
  $Dia=$Fecha["mday"]; 
//consulto el ultimo numero de consecutivo
$result = mysql_query("select MAX(consecutivo) as cons  from tbl_consfacturas ");
$row = mysql_fetch_assoc($result);
$_SESSION['consecutivo']=$row['cons']+1;

  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<div style="margin-left:860px;  margin-top:5px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>

<div align="center" style="margin-left:150px;" id="mainGris">
<br />
<form action="operaciones.php">
<div align="center" class="Arial14Negro">Factura:
  <select name="cmb_factura"  class=" combos" id="cmb_factura">
  <?
  $fecha_ini=$hoy." 00:00:00";
  $fecha_fin=$hoy." 23:59:59";
  $result=mysql_query("select * from tbl_facturas where  fecha>'".$fecha_ini."' and fecha<'".$fecha_fin."' and impresa=1");
  while($row=mysql_fetch_assoc($result)){
	  
	echo '<option value="'.$row['id'].'">'.$row['placa'].'</option>';  
  }
  ?>
  

  </select>
  <input type="hidden" name="opcion" id="opcion"  value="12" />
</div> 
<br /> 
<div><input name="txt_imprimir" type="image" src="img/imprimir.png" /></div>
</form>
  
</div><!--fin cuadro gris--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Control e Informaci&oacute;n.  
</div>
<div align="center" style="float:left" class="Arial8azul">&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
