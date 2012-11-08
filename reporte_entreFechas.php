<?
session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SVI</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<script src="datetimepicker_css.js"></script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm" style="width:1000px;">


<div style=" margin-left:900px;" class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>
<div id="mainGrisUsuarios" style=" width:850px; margin-left:100px; height:400px; ; float:left;">
  <b class="spiffy">
    <b class="spiffy1"><b></b></b>
    <b class="spiffy2"><b></b></b>
    <b class="spiffy3"></b>
    <b class="spiffy4"></b>
    <b class="spiffy5"></b></b>
  
  <div align="center" class="spiffyfg">
  
  
  <table><tr>
  <td><div  align="center" class="Arial18Azul">Reportes</div>
  </td> 
  </tr>
    </table>
    <br />
  <form action="reporte.php" method="get"  enctype="multipart/form-data">
  <table>
    
    <tr>
    <td class="Arial14Negro">Fecha Inicio:</td>
    <td><input type="Text" name="fecha_ini" class="inputbox" id="fecha_ini" maxlength="20" size="20"/>     <img src="images2/cal.gif" onClick="javascript:NewCssCal('fecha_ini')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Fecha Fin:</td>
    <td><input type="Text" class="inputbox" id="fecha_fin" name="fecha_fin" maxlength="20" size="20"/>     <img src="images2/cal.gif" onClick="javascript:NewCssCal('fecha_fin')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Hora Inicio:</td>
    <td><label>
      <select class="combos" name="cmb_ini" id="cmb_ini">
      <option>00:00</option>
      <option>01:00</option>
      <option>02:00</option>
      <option>03:00</option>
      <option>04:00</option>
      <option>05:00</option>
      <option>06:00</option>
      <option>07:00</option>
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>
      
      </select>
    </label></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Hora F&iacute;n:</td>
    <td><label>
      <select class="combos" name="cmb_fin" id="cmb_fin">
      <option>00:00</option>
      <option>01:00</option>
      <option>02:00</option>
      <option>03:00</option>
      <option>04:00</option>
      <option>05:00</option>
      <option>06:00</option>
      <option>07:00</option>
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>
      
      </select>
    </label> <input name="opcion" type="hidden" value="1" /></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Diario</td>
    <td><label>
      <input type="checkbox" name="chk_diario" id="chk_diario" />
    </label></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Tipo</td>
    <td><select name="cmb_tipo" id="cmb_tipo" class="combos">
	<option selected="selected" value="1">Ventas General</option>
    <option value="305">Repuestos</option>
    <option value="105">LavaCar</option>
    <option value="405">Cafeteria</option>
    <option value="205">Lubricentro</option>
    <option value="505">Taller</option>
	      </select></td>
    </tr>
    
    </table>
    <table>
    <tr>
    <td><input name="btn_login" type="image" src="img/generar.png" />
    </td></tr>
    </table>
  
</form>


<form action="reporte_clientes.php">
<br />
<div align="center" class="Arial18Azul">
Clientes Frecuentes
</div>
<div align="center">
<input name="" type="image" src="img/clientes.png" />
</div>

</form>
  </div>

  <b class="spiffy">
  <b class="spiffy5"></b>
  <b class="spiffy4"></b>
  <b class="spiffy3"></b>
  <b class="spiffy2"><b></b></b>
  <b class="spiffy1"><b></b></b></b>
</div>






</div>
</div>

<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:500px;float:left" class="Arial8negro">
Sistema de Ventas e Inventario. Desarrollado por 
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
