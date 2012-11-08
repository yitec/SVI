<?php
session_start();
?>
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/scripts.js" type="text/javascript"></script> 

<?
require_once('cnx/conexion.php');
conectar();
$_SESSION['resultado']='';
//primero consulto si me estan pidiendo que imprima una orden de trabajo o un articulo nuevo

if (empty($_REQUEST['orden'])){
	
	//consulto el articulo en el inventario
	$result = mysql_query("select * from tbl_inventario where codigo='".$_REQUEST['codigo']."' ");
	$row = mysql_fetch_assoc($result);

	$num_rows = mysql_num_rows($result);
	//evaluo si el codigo existe
	if($num_rows==0){
		$_SESSION['resultado']='El c&oacute;digo no existe';
	}else{
	
	if($row['existente']>=$_REQUEST['cantidad']){
		$_SESSION['montoAI']=0;

		$monto=$row['precioVenta']*$_REQUEST['cantidad'];
		//$_SESSION['montoAI']=$_SESSION['montoAI']+$monto;

		//inserto los datos en la tabla de facturas temporales
		mysql_query("insert into tbl_subfacturas(consecutivo,cliente,placa,conductor,codigo,cantidad,nombre,precio,estado) values 
('".$_SESSION['consecutivo']."','".$_REQUEST['cliente']."','".$_REQUEST['placa']."','".$_REQUEST['conductor']."','".$_REQUEST['codigo']."','".$_REQUEST['cantidad']."','".$row['nombre']."','".$monto."','"."1"."')");
		
		$result = mysql_query("select * from tbl_subfacturas where consecutivo='".$_SESSION['consecutivo']."' ");
		$num_rows = mysql_num_rows($result);
		$ultimo_id = mysql_insert_id($connectid); 
		
		echo '<table cellpadding="0" width="765" cellspacing="0" border="1" bordercolor="#a6c9e2">';
		
		while ($row = mysql_fetch_assoc($result)) {
			 echo '<tr><td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$row['codigo'].'</div></td>
<td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['cantidad'].'</div></td>
<td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento" name="txt_descuento" type="text" size="2"  /></td>
<td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  ><input name="chk_descuento'.$row['id'].'" id="chk_descuento'.$row['id'].'" type="checkbox" value="" /></div></td>
<td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.number_format($row['precio'],2,",",".").'</div></td>
<td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid"  id="sid" align="center"><input type="image" name="btn_delete'.$row['id'].'" id="'.$row['id'].'"  class="eliminar"  src="img/delete.png" /> </div></td></tr>
';
		$_SESSION['montoAI']=$_SESSION['montoAI']+$row['precio'];
	
		}//end while
		echo '</table>';
		mysql_free_result($result);
		}else{
			$_SESSION['resultado']="El articulo no tiene mas existencia";
			mysql_free_result($result);
			$result = mysql_query("select * from tbl_subfacturas where consecutivo='".$_SESSION['consecutivo']."' ");
			$num_rows = mysql_num_rows($result);
			$_SESSION['montoAI']=0;
			echo '<table cellpadding="0" width="765" cellspacing="0" border="1" bordercolor="#a6c9e2">';
		while ($row = mysql_fetch_assoc($result)) {
			 echo '<tr><td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$row['codigo'].'</div></td>
<td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['cantidad'].'</div></td>
<td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento" name="txt_descuento" type="text" size="2"  /></td>
<td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  ><input name="chk_descuento'.$row['id'].'" id="chk_descuento'.$row['id'].'" type="checkbox" value="" /></div></td>
<td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.number_format($row['precio'],2,",",".").'</div></td>
<td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="btn_delete'.$row['id'].'" id="'.$row['id'].'" class="eliminar" src="img/delete.png" /> </div></td></tr>
';
			$_SESSION['montoAI']=$_SESSION['montoAI']+$row['precio'];
		
			}//end while
			echo '</table>';
			mysql_free_result($result);
		}//end if existencia
		}//end if codigo de articulo

}else{

//busco los articulos de la subfactura
	$result = mysql_query("select * from tbl_subfacturas where numero_orden='".$_REQUEST['orden']."' ");
	$_SESSION['montoAI']=0;
	echo '<table cellpadding="0" width="765" cellspacing="0" border="1" bordercolor="#a6c9e2">';

	while ($row = mysql_fetch_assoc($result)) {
 		echo '<tr><td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$row['codigo'].'</div></td>
<td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['cantidad'].'</div></td>
<td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  ><input name="chk_descuento'.$row['id'].'" id="chk_descuento'.$row['id'].'" type="checkbox" value="" /></div></td>
<td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.number_format($row['precio'],2,",",".").'</div></td>
<td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="btn_delete'.$row['id'].'" id="'.$row['id'].'" class="eliminar" src="img/delete.png" /> </div></td></tr>
';

			$_SESSION['montoAI']=$_SESSION['montoAI']+$row['precio'];
	}//end while
	echo '</table>';
	mysql_free_result($result);
}//end if orden











//mysql_free_result($result);



?>
