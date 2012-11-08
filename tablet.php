<?
session_start();
require_once('cnx/conexion.php');
conectar();
//consulto el ultimo numero de consecutivo
$result = mysql_query("select MAX(consecutivo) as cons  from tbl_consfacturas ");
$row = mysql_fetch_assoc($result);
$_SESSION['consecutivo']=$row['cons']+1;
$result = mysql_query("insert into tbl_consfacturas (consecutivo)values('".$_SESSION['consecutivo']."') ");

//mysql_free_result($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SVI</title>
<link type="text/css" rel="stylesheet" href="css/lightbox-form.css">
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/Scripts_Ordenes.js" type="text/javascript"></script> 
<script src="includes/lightbox-form.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.js"></script>
					
	
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:800px;"></div>
<div     class="contenido_gm">
<div style="margin-left:960px;  margin-top:5px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;&nbsp;<a href="login.php">Salir</a></div>
<div  id="mainGrisVentas">

  <div id="shadowing"></div>
<div id="box">
  <span id="boxtitle"></span>

  <table>
  <tr>
  <td class="Arial14Negro">C&oacute;digo</td><td><input type="text" id="txt_codigom" name="codigo"  value="" class="inputbox" size="5" ></td>
  </tr>
  <tr>
  <td class="Arial14Negro">Cantidad</td><td><input type="text" id="txt_cantidadm" name="cantidad"  value="1" class="inputbox" size="5" ></td>
  </tr>
  <tr>
  <td class="Arial14Negro">Nombre</td><td><input type="text" id="txt_nombrem" name="nombre"  value="" class="inputbox" size="50" ></td>
  </tr>
  <tr>
  <td class="Arial14Negro">Precio</td><td><input type="text" id="txt_preciom" name="precio"  value="" class="inputbox" size="10" ></td>
  </tr>
  <tr><td><input name="btn_aceptar" type="button" value="Aceptar" onclick="manual()" /></td><td><input name="btn_cancelar" type="button" value="Cancelar" onclick="closebox()" /></td></tr>
  </table>
       

</div><!--fin tabla de lightbox-->

  <div align="center">
  <table width="903">
    <tr>
  <td width="552"><div align="right" class="Arial18Azul">
 Ingrese el código y la cantidad</div>  </td> <td width="107"><div align="right" class="Arial14Negro">Placa:</div></td><td width="61"><div>
    <input class="inputbox" size="8" id="txt_orden" name="txt_orden" type="text"  />
  </div></td><td width="43"><div>
    <input name="btn_search" id="btn_search" type="image" src="img/search.png" />
  </div></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    </table>
    </div>
  <table width="1000">
    <tr></tr>
    <tr>
      <td class="Arial14Negro" >Cliente =</td>
      <td><div >
        <input class="inputbox" id="txt_cliente" name="txt_cliente"  type="text" />
      </div></td>
      <td class="Arial14Negro">Placa =</td>
      <td><div  >
        <input class="inputbox" name="txt_placa" id="txt_placa"  type="text" />
      </div></td>
      <td class="Arial14Negro">Conductor =</td>
      <td><div class="Arial14Negro" >
        <input class="inputbox"  name="txt_conductor" id="txt_conductor" type="text" />
      </div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div class="Arial14Negro">Modo=</div></td>
      <td><select class="combo" name="cmb_metodo" id="cmb_metodo">
      <option value="0">Efectivo</option>
      <option value="1">Tarjeta</option>
      <option value="2">Credito</option>
      <option value="3">Cheque</option>
      
      </select></td>
    </tr>
  </table>
  <table width="998">
    <tr>
      <td width="69" class="Arial14Negro" >C&oacute;digo =</td>
      <td width="161"><div >
        <input class="inputbox" id="txt_codigo" name="txt_codigo" type="text" />
      </div></td>
      <td width="85" class="Arial14Negro">Cantidad =</td>
      <td width="255"><div >
        <input class="inputbox" name="txt_cantidad"  id="txt_cantidad" type="text" />
      </div></td>
      <td width="404"><div align="right">
        <label>
          <input type="image" name="btn_agregar"  id="btn_agregar" src="img/agregar.png" />
          </label>
        <label>
          <input type="image" name="btn_manual" id="btn_manual" onclick="openbox('Indique la informaci&oacute;n', 1)" src="img/manual.png" />
          </label>
        <label>
          <input type="image" name="btn_nuevo" id="btn_nuevo" src="img/nuevo.png" />
          </label>
      </div></td>
      </tr>
    </table>
    <div align="center" class="Arial14Azul">------------------------- Lavado -----------------------------</div>
    <div align="center">
    <table width="700">
    <tr>
      <td width="99"  class="Arial14Negro" >Combo Lavado</td>
      <td width="202" ><select class="combos" style="font-size:40; height:40px;" name="cmb_combol" id="cmb_combol" onchange="actualiza_lavado()">
      <option>Seleccione</option>
      <? $result=mysql_query("Select * from tbl_lavado");
		while($row=mysql_fetch_assoc($result)){
			echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
		}
      	mysql_free_result($result);
	  ?>
    </select></td>
      <td width="108" class="Arial14Negro">Tipo Vehiculo</td>
      <td width="247" ><select class="combos" name="cmb_tipoVehiculol" style="font-size:30; height:40px;" id="cmb_tipoVehiculol" onchange="actualiza_lavado()">
        <option>Seleccione</option>
        <option >Sedan</option>
        <option >4x4</option>
        <option >Pick-up</option>
        <option >Motos</option>
        <option >Microbus 12 a 15 pas</option>
        <option >Microbus 15 a mas pas</option>
        <option >Motos</option>
        <option >Camion 4 ruedas</option>
        <option >Camion 6 ruedas</option>
        <option >Camion 8 ruedas</option>
        <option >Vagoneta</option>
        <option >Chapulin</option>
        <option >Camion peq Stylos</option>
        <option >Camion grande Stylos</option>
        <option >Vagoneta 6 m cubicos</option>
        <option >Vagoneta 12 m cubicos</option>
      </select>
        <input type="hidden"  id="precio_lavado" value="" />
	</td>
      <td width="20"><input id="btn_lavado"    type="image" src="img/add_icon.png" /></td>
      
    </tr>
    </table>
    </div>
    <div align="center" class="Arial14Azul">------------------------- Cambios de Aceite -----------------------------</div>
        <div align="center">
    <table width="865">
    <tr>
      <td width="43" class="Arial14Negro" >Aceite</td>
      <td width="85"><select class="combos" name="cmb_combo" id="cmb_combo">
        <option value="1">Penzoil</option>
        
      </select></td>
      <td width="42" class="Arial14Negro">Marca</td>
      <td width="131"><select class="combos" name="cmb_marca" id="cmb_marca" onchange="actualiza_modelo()">
      <option selected="selected">Seleccione</option>
      <?
	  $result=mysql_query("select id,marca from tbl_marcas");
	  while ($row=mysql_fetch_assoc($result))
	  {
		echo '<option value="'.$row['id'].'">'.$row['marca'].'</option>';
		
	  }
	  ?>
      </select>
      <td width="51" class="Arial14Negro">Modelo</td>
      <td width="81"><select class="combos" name="cmb_modelo" id="cmb_modelo" onchange="actualiza_filtros()">
      </select></td>
      <td width="36" class="Arial14Negro">
      Filtro
      </td>
      <td width="147"><select class="combos" id="cmb_filtros" name="cmb_filtros"></select>
        <input type="hidden"  id="precio_aceite" value="" /></td>
        <td width="193"><div class="Arial14Negro" id="cuartos">Cuartos=</div></td>
        
      <td width="20"><input id="btn_aceites"  vspace=""  name="btn_aceites" type="image" src="img/add_icon.png" /></td>
    </tr>
    
    
    
    </table>
    </div>
    
    
    <div align="center" class="Arial14Azul">------------------------------------------------------</div>
    <div align="center" id="resultado" class="Arial20rojo"></div>
    <div align="center">
    <div  id="main" style=" width:950px;  ">
      <!--cuadro blanco-->
      <table cellpadding="0" cellspacing="0" border="0">
        <th></th>
        <tr>
          <td><img src="img/azul_izquierda.png" /></td>
          <td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:930px;background: #7ac9e9;"> Detalle de la factura=  &nbsp;<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"><?=$_SESSION['consecutivo'];?></div></div>
                                              
          </td>
          <td><img src="img/azul_derecha.png" /></td>
        </tr>
      </table>
      <div id="cantidad_items">
        <input name="txt_items" id="txt_items" type="hidden" value="1" />
      </div>
      <table width="946" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
        <tr>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >C&oacute;digo</div></td>
          <td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Cantidad</div></td>
          <td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Detalle</div></td>          
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Descuento</div></td>
          <td width="95" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Porcentage</div></td>
          <td width="127" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  >Precio</div></td>
          <td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center">x </div></td>
        </tr>
        <tr id="linea1"></tr>
        <tr id="linea2"></tr>
        <tr id="linea3"></tr>
        <tr id="linea4"></tr>
        <tr id="linea5"></tr>
        <tr id="linea6"></tr>
        <tr id="linea7"></tr>
        <tr id="linea8"></tr>
        <tr id="linea9"></tr>
        <tr id="linea10"></tr>
        <tr id="linea11"></tr>
        <tr id="linea12"></tr>
        <tr id="linea13"></tr>
        <tr id="linea14"></tr>
        <tr id="linea15"></tr>
        <tr id="linea16"></tr>
        <tr id="linea17"></tr>
        <tr id="linea18"></tr>
        <tr id="linea19"></tr>
        <tr id="linea20"></tr>
        <tr>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Descuento </div></td>
          <td width="127" bordercolor="#CCCCCC" ><div  id="descuento" class="fondoGrid" align="center"  >0</div></td>
          <td width="32" bordercolor="#CCCCCC" ><div class="eliminar" align="center"></div></td>
        </tr>
        <tr>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>          
          <td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Sub Total </div></td>
          <td width="127" bordercolor="#CCCCCC" ><div  id="subtotal" class="fondoGrid" align="center"  ></div></td>
          <td width="32" bordercolor="#CCCCCC" ><div class="eliminar" align="center"></div></td>
        </tr>
        <tr>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>          
          <td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Impuesto</div></td>
          <td width="127" bordercolor="#CCCCCC" ><div id="impuesto" class="fondoGrid" align="center"  >
            <?  
echo $impuesto=($_SESSION['montoAI']*13)/100;?>
          </div></td>
          <td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"></div></td>
        </tr>
        <tr>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="82" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="261" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>
          <td width="76"  bordercolor="#CCCCCC" ><div class="azulColumn" align="center"  ></div></td>          
          <td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid3" align="center"  >Total</div></td>
          <td width="127" bordercolor="#CCCCCC" ><div  id="total" class="fondoGrid3" align="center"  >
            <?=$_SESSION['montoAI']+$impuesto;?>
          </div></td>
          <td width="32" bordercolor="#CCCCCC" ><div class="azulColumn" align="center"></div></td>
        </tr>
      </table>
      <div id="loader" ><img src="img/loader.gif" width="16" height="16" /></div>
    </div>    <!--end div color blanco-->
    </div><!--end align center cuadro blanco-->
<div><br />
  </div>
  
</div>  <!--end div cuadro gris-->


  





<div style="margin-left:700px;  margin-top:382px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>
</div>
<div class="der_lat_g" style="height:800px;"></div>
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


<div style="display: none;">

		<div id="inline1" style="width:600px;height:500px;overflow:auto;">
			<br />
            <div align="center">
			<div    class=" Arial30Verde">Total:</div>            
            <div  class="Arial30Verde" id="totalPagar"></div>
            </div>                       
            <br /> 
            <div align="center"  class="Arial20rojo">Paga con:</div>
            <div align="center" >
            <input id="txt_paga" class=" inputboxGrande" type="text" size="3" /></div>
            <br />
            <div align="center">
	        <input type="image" name="btn_calcula" id="btn_calcula" src="img/calcular.png" />
            </div>
            <br />
            <div align="center" class="Arial80azul">Su cambio:</div>
            <div align="center" id="cambio" class="Arial80azul"></div>
            <div align="center" class="Arial80azul"><label>
        <input type="image" name="btn_imprimir" id="btn_imprimir" src="img/imprimir.png" />
        </label></div>
            
		</div>

	</div>


</body>

</html>
