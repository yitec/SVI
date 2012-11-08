
<?
require_once('cnx/conexion.php');
conectar();
$query="select * from tbl_inventario  where codigo ='".$_REQUEST['txt_codigo']."'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

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
  <form action="buscar_inventario.php" method="post" enctype="multipart/form-data">
  <table>
  <tr>
  <td><div class="Arial14Negro">Codigo:</div></td>
  <td><input class="inputbox" name="txt_codigo" value="<?=$_REQUEST['txt_coddigo']; ?>" type="text" /></td>
  </tr>
  <tr>
  <td></td>
  <td><div align="left"><input name="input" type="image" src="img/buscar_verde.png" /></div></td></tr>
  <tr>
  <td><div class="Arial14Negro">Nombre:</div></td>
  <td><input class="inputbox" value="<?=$row['nombre']; ?>" name="txt_nombre" type="text" /></td>
  </tr>
  
  <tr>
  <td><div class="Arial14Negro">Existente:</div></td>
  <td><input class="inputbox" name="txt_existente" value="<?=number_format($row['existente'],0,",",".") ?>" type="text" /></td>
  </tr>
 
  
  <tr>
  <td></td>
  <td></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Precio Costo:</div></td>
  <td><input class="inputbox" name="txt_precio_costo" value="<?=number_format($row['precioCosto'],2,",","."); ?>" type="text" /></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Precio Venta:</div></td>
  <td><input class="inputbox" name="txt_precio_venta" value="<?=number_format($row['precioVenta'],2,",","."); ?>" type="text" /></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Descripci&oacute;n:</div></td>
  <td><textarea class=" textArea " name="txt_descripcion" cols="30"  rows="5" maxlength="157"> <?=$row['descripcion']; ?></textarea><input name="opcion" type="hidden" value="1" /></td>
  </tr>
  
  
  
  
  </table>
 
</form>
<br />
  </div>

  <b class="spiffy">
  <b class="spiffy5"></b>
  <b class="spiffy4"></b>
  <b class="spiffy3"></b>
  <b class="spiffy2"><b></b></b>
  <b class="spiffy1"><b></b></b></b>
</div>




<div style="margin-left:700px;  margin-top:382px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>

</div>
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:300px;float:left" class="Arial8negro">
Sistema de ventas e inventario . Desarrollado por 
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
