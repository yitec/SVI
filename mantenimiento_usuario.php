<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />

<link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/datetimepicker_css.js"></script>


<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Usuarios.js" type="text/javascript"></script> 

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Usuarios</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<div style="margin-left:700px;  margin-top:5px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>


<div id="mainGrisUsuarios" align="center">
	<div class="Arial14Negro" style="margin-left:550px; margin-top:5px;   ">Usuario:
    <input class="inputboxPequeno" size="10" id="txt_usuario_buscar" name="txt_usuario" type="text"  />
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />
  </div>
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General</div>
    
	<table>
    
    <tr>
    	<td class="Arial14Negro">Nombre</td>
    	<td class="Arial14Negro">Apellidos</td> 
        <td class="Arial14Negro">C&eacute;dula</td>               
    </tr>
    <tr>
    	<td height="34" class="Arial14Negro"><input name="txt_nombre" id="txt_nombre" class="inputbox" type="text" /><input id="opcion" name="opcion" type="hidden" value="1" /></td>
    	<td class="Arial14Negro"><input name="txt_apellidos" id="txt_apellidos" class="inputbox" type="text" /></td>        
    	<td class="Arial14Negro"><input name="txt_cedula" id="txt_cedula" class="inputbox" type="text" /></td>                
    </tr>
	<tr>
    	<td class="Arial14Negro">Usuario</td>
    	<td class="Arial14Negro">Password</td> 
        <td class="Arial14Negro">Fecha Caducidad</td>               
    </tr>
    <tr>
    	<td class="Arial14Negro"><input name="txt_usuario" id="txt_usuario" class="inputbox" type="text" /></td>
    	<td class="Arial14Negro"><input name="txt_pass" id="txt_pass" class="inputbox" type="password" /></td>        
        <td class="Arial14Negro"><input name="txt_fecha" id="txt_fecha" class="inputbox" type="text" /><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fecha')" style="cursor:pointer"/></td>        
    </tr>    
    </table>
    
    <table width="714" >
    <th width="110" height="39">
    	<td width="202" align="center" class="Arial18Azul">Permisos</td>
    <td width="194"></th>
    <tr>
    	<td class="Arial14Azul">&nbsp;</td>
        <td height="27" class="Arial14Negro"><input class="ck" name="chk_c_contrato"  id="chk_ventas" type="checkbox" value="" />          
          Ventas</td>
        <td class="Arial14Negro"><input class="ck" name="chk_m_contrato" id="chk_ordenes" type="checkbox" value="" />
        Ordenes</td>
        <td width="188" class="Arial14Negro"><input class="ck" id="chk_minventario" type="checkbox" value="" />        
          Modificar Inventario</td>
    </tr> 
    <tr>
      <td height="27" class=" Arial14Azul">&nbsp;</td>
      <td class="Arial14Negro"><input class="ck" name="chk_microb" id="chk_reportes" type="checkbox" value="" />
        Reportes</td>
      <td class="Arial14Negro"><input class="ck" name="chk_quimica" id="chk_vinventario" type="checkbox" value="" />
        Ver Inventario</td>
      <td class="Arial14Negro"><input class="ck" name="chk_broma" id="chk_mclientes" type="checkbox" value="" />
        Mantenimiento Clientes</td>
    </tr>
    
        <td height="36" class="Arial14Azul">&nbsp;</td>
    	<td class="Arial14Negro"><input class="ck" name="chk_microb" id="chk_musuarios" type="checkbox" value="" />
    	  Mantenimiento Usuarios</td>
        <td class="Arial14Negro"><input class="ck" name="chk_quimica" id="chk_reimprimir" type="checkbox" value="" />
          Reimprime Factura</td>
        <td class="Arial14Negro">&nbsp;</td>
    </tr>         
    </table>
<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="img/eliminar.png" /></div>    

</div><!--fin cuadro gris--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Informaci&oacute;n y Control.  
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
