<?
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SVI</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/Scripts_Factura.js" type="text/javascript"></script> 
	
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



<div style=" width:800px; margin-left:0px; height:200px; margin-top:5px; float:left;">
  <b class="spiffy">
    <b class="spiffy1"><b></b></b>
    <b class="spiffy2"><b></b></b>
    <b class="spiffy3"></b>
    <b class="spiffy4"></b>
    <b class="spiffy5"></b></b>
  
  <div align="center" class="spiffyfg">
  
  
  <table width="783">
    <tr>
  <td width="552"><div align="right" class="Arial18Azul">
 Ingrese el código y la cantidad</div>  </td> <td width="107"><div align="right" class="Arial8negro">Orden</div></td><td width="61"><div>
    <input class="inputboxPequeno" size="5" id="txt_orden" name="txt_orden" type="text"  />
  </div></td><td width="43"><div>
      <input name="btn_search" id="btn_search" type="image" src="img/search.png" />
    </div></td>
  </tr>
    </table>
    <br />
    <div align="right"><table width="314">
    <tr>
    <td width="86"><div class="Arial14Negro">Contado<input name="rnd_tipoPago" type="radio" value="0" /></div></td><td width="212"><div class="Arial14Negro">Credito<input name="rnd_tipoPago" type="radio" value="1" /></div></td>
    </tr>
    </table></div>
    
    <table>
    <tr>
    <tr>
    <td class="Arial14Negro" >Cliente =</td><td><div >
      <input class="inputbox" id="txt_cliente" name="txt_cliente" type="text" />
    </div></td><td class="Arial14Negro">Placa =</td><td><div  >
      <input class="inputbox" name="txt_placa" id="txt_placa" type="text" />
    </div></td>
    <td class="Arial14Negro">Conductor =</td><td><div ><input class="inputbox" name="txt_conductor" id="txt_conductor" type="text" /></div></td></tr>
    
    <td class="Arial14Negro" >C&oacute;digo =</td><td><div >
      <input class="inputbox" id="txt_codigo" name="txt_codigo" type="text" />
    </div></td><td class="Arial14Negro">Cantidad =</td><td><div >
      <input class="inputbox" name="txt_cantidad" id="txt_cantidad" type="text" />

    </div></td>
    <td><div align="center"><label>
      <input type="image" name="btn_agregar" onclick="consultar()" id="btn_agregar" src="img/agregar.png" />
    </label>
    </div></td>
    <td><label>
      <input type="image" name="btn_imprimir" id="btn_imprimir" src="img/imprimir.png" />
    </label></td>
    </tr>
    </table>
<div align="center" id="resultado" class="Arial20rojo"><?=$_SESSION['resultado'];?></div>
<div id="main">
<table cellpadding="0" cellspacing="0" border="0">
<th>
<tr>
<td><img src="img/azul_izquierda.png" /></td>
<td align="center" class=" Arial14blanco"  style=" height:20px; width:750px;background: #7ac9e9;"> Detalle de la factura # <?=$_SESSION['consecutivo']; ?></td>
<td><img src="img/azul_derecha.png" /></td>
</tr>
</th>
</table>
      <div id="cantidad_items"><input name="txt_items" id="txt_items" type="hidden" value="1" /></div>
<table width="765" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
<tr>
<td width="76"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  >C&oacute;digo</div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Cantidad</div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Detalle</div></td>
<td width="95" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Porcentage</div></td>
<td width="76"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  >Descuento</div></td>
<td width="127" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Precio</div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center">x </div></td>

</tr>
</table>
<div id="recarga"></div>

<table cellpadding="0" width="765" cellspacing="0" border="1" bordercolor="#a6c9e2">
<tr>
<td width="76"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  ></div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
<td width="95"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  ></div></td>
<td width="76" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Sub Total:</div></td>
<td width="127" bordercolor="#CCCCCC" ><div id="subtotal" class="fondoGrid" align="center"  ><?=$_SESSION['montoAI'];?></div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center">
  
</div></td>
</tr>

<tr>
<td width="76"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  ></div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
<td width="95"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  ></div></td>
<td width="76" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Impuesto:</div></td>
<td width="127" bordercolor="#CCCCCC" ><div id="impuesto" class="fondoGrid" align="center"  ><?  
echo $impuesto=($_SESSION['montoAI']*13)/100;?></div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center">
  
</div></td>
</tr>
<tr>
<td width="76"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  ></div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
<td width="95"  bordercolor="#CCCCCC" > <div class="azulColumn" align="center"  ></div></td>
<td width="76" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Total:</div></td>
<td width="127" bordercolor="#CCCCCC" ><div  id="total" class="fondoGrid3" align="center"  ><?=$_SESSION['montoAI']+$impuesto;?></div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"></div></td>
</tr>


</table>

</div>
<div id="detalle" >
  
</div>

<div>
    <table width="246"><tr>
    <td class="Arial14Negro"><div >Descuento=<input class="inputbox" id="txt_descuento" name="txt_descuento" type="text" size="2" />%</div></td><td class="Arial14Negro" > Activar</td>
    
    </tr></table>
    
<br />
  </div>

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
Sistema de ventas e inventario. Desarrollado por &nbsp; 
</div>
<div align="center" style="float:left" class="Arial8azul">
Yamato Tecnología.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
