<?
session_start();
require_once('cnx/conexion.php');
conectar();
$result = mysql_query("select MAX(consecutivo) as cons  from tbl_consfacturas ");
$row = mysql_fetch_assoc($result);
$_SESSION['consecutivo']=$row['cons']+1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modifica Inventario</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>

<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Inventario.js" type="text/javascript"></script> 
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="img/yamato.png" /></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:700px;"></div>
<div    class="contenido_gm">
<div style="margin-left:700px;" class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>

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
  
  <div id="formulario">
  <table>
  <tr>
  <td><div class="Arial14Negro">Codigo:</div></td>
  <td><input class="inputbox" id="txt_codigo" name="txt_codigo" type="text" />
    <label>
      <input type="image" name="btn_buscar" id="btn_buscar" src="img/search.png" />
    </label></td>
  </tr>
   <tr>
  <td><div class="Arial14Negro">C&oacute;digo Barras:</div></td>
  <td><input class="inputbox" name="txt_codigo_barras" id="txt_codigo_barras" type="text" /></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Categoria:</div></td>
  <td><select name="cmb_categoria" id="cmb_categoria" class="combos">
    <option value="305">Repuestos</option>
    <option value="105">LavaCar</option>
    <option value="405">Cafeteria</option>
    <option value="205">Lubricentro</option>
    <option value="505">Taller</option>
	
  </select></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Nombre:</div></td>
  <td><input class="inputbox" name="txt_nombre" id="txt_nombre" type="text" /></td>
  </tr>
  
  <tr>
  <td><div class="Arial14Negro">Existente:</div></td>
  <td><input class="inputbox" id="txt_existente" name="txt_existente" type="text" /></td>
  </tr>
 
  
  <tr>
  <td></td>
  <td></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Precio Costo:</div></td>
  <td><input class="inputbox" id="txt_precio_costo" name="txt_precio_costo" type="text" /></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Precio Venta:</div></td>
  <td><input class="inputbox" id="txt_precio_venta" name="txt_precio_venta" type="text" /></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Exento Impuestos:</div></td>
  <td><input name="chk_impuestos" id="chk_impuestos" type="checkbox" value="" /></td>
  </tr>
  <tr>
  <td><div class="Arial14Negro">Descripci&oacute;n:</div></td>
  <td><textarea class=" textArea " id="txt_descripcion" name="txt_descripcion" cols="30" rows="5" maxlength="157">
  </textarea><input name="opcion" id="opcion" type="hidden" value="1" /></td>
  </tr>
  <tr>
    <td><div class="Arial14Negro">Combo Aceite</div></td>
    <td><div class="Arial14Negro">Si<input type="radio" name="radio" id="rnd_filtro" value="rnd_filtro" /></div></td>

  </tr>
  
  <tr>
    <td  ><div class="Arial14Negro">Marca</div></td>
    <td  ><select name="cmb_marca" id="cmb_marca" onchange="actualiza_modelo()">
    <? $result=mysql_query("select id,marca from tbl_marcas");
		while ($row=mysql_fetch_assoc($result)){
		?>
        <option value="<?=$row['id']; ?>"><?=$row['marca']; ?></option>
        <?
		}
	?>
    </select></td>
  </tr>
  
  <tr>
    <td ><div class="Arial14Negro">Modelo</div></td>
    <td ><select id="cmb_modelo"></select></td>
  </tr>

  <tr>
    <td ><div class="Arial14Negro">Nombre Filtro</div></td>
    <td ><input id="txt_filtro" class="inputbox" type="text" /></td>
  </tr>
  <tr>
    <td ><div class="Arial14Negro">Combo Lavado</div></td>
    <td ><div class="Arial14Negro">Si<input type="radio" name="radio" id="rnd_lavado" value="rnd_lavado" /></div></td>
  </tr>
  <tr>
    <td ><div class="Arial14Negro">Tipo Combo</div></td>
    <td ><select class="combos" name="cmb_combol" id="cmb_combo">
      <option value="1" selected="selected">Lavado-Encerado</option>
      <option value="2">Lavado-Motor</option>
      <option value="3">Lavado-Encerado-Motor</option>
    </select></td>
  </tr>
  <tr>
    <td ><div class="Arial14Negro">Tipo Vehiculo</div></td>
    <td ><select class="combos" name="cmb_tipoVehiculol" id="cmb_tipoVehiculol">
      <option value="1">Sedan</option>
      <option value="2">4x4</option>
      <option value="3">Pick-up</option>
      <option value="4">Motos</option>
      <option value="5">Microbus 15 pas</option>
      <option value="6">Microbus + 15 pas</option>
      <option value="7">Motos</option>
      <option value="8">Camion peq 4 ruedas</option>
      <option value="9">Camion grande 6 ruedas</option>
      <option value="10">Camion grande 8 ruedas</option>
      <option value="11">Camion grande + 8 ruedas</option>
      <option value="12">Camion peq Stylos</option>
      <option value="13">Camion grande Stylos</option>
      <option value="14">Vagoneta 6 m cubicos</option>
      <option value="15">Vagoneta 12 m cubicos</option>
      
      
      
      
      
            
      </select></td>
  </tr>
  
  
  
  
  </table>
</div>
<table>
<tr><td><label>
  <input type="image" name="btn_guardar" id="btn_guardar" src="img/guardar.png" />
</label>
<label>
  <input type="image" name="btn_eliminar" id="btn_eliminar" src="img/eliminar.png" />
</label>
</tr>
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
<div class="der_lat_g" style="height:700px;"></div>
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
