<?php
session_start();
?>
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/scripts.js" type="text/javascript"></script> 

<?


require_once('cnx/conexion.php');
conectar();



//actulizo el monto a pagar
$result=mysql_query("select * from tbl_subfacturas where id='".$_REQUEST['id']."'");
$row=mysql_fetch_assoc($result);

$_SESSION['montoAI']=$_SESSION['montoAI']-$row['precio'];

mysql_free_result($result);
//elimino el articulo
mysql_query("delete from tbl_subfacturas where id='".$_REQUEST['id']."'");

//reimprimo los items de la factura

$result = mysql_query("select * from tbl_subfacturas where consecutivo='".$_SESSION['consecutivo']."' ");
$items=1;
echo '<table cellpadding="0" width="765" cellspacing="0" border="1" bordercolor="#a6c9e2">';

	while ($row = mysql_fetch_assoc($result)) {
 		echo '<tr><td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$row['codigo'].'</div></td>
<td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['cantidad'].'</div></td>
<td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  ><input name="chk_descuento'.$row['id'].'" id="chk_descuento'.$row['id'].'" type="checkbox" value="" /></div></td>
<td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.number_format($row['precio'],2,",",".").'</div></td>
<td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="btn_delete'.$row['id'].'" id="'.$row['id'].'" class="eliminar" src="img/delete.png" /> </div></td></tr>
';

		$items++;
	}//end while
	echo '</table>';
	mysql_free_result($result);



?>