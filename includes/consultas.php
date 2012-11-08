<?php
require_once('../cnx/conexion.php');
conectar();

//consulto el articulo en el inventario
$result = mysql_query("select * from tbl_inventario where codigo='".$_REQUEST['codigo']."' ");
$row = mysql_fetch_assoc($result);
$num_rows = mysql_num_rows($result);

echo '<td width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$_REQUEST['codigo'].'</div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$_REQUEST['cantidad'].'</div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >Descuento</div></td>
<td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputbox" id="txt_descuento" name="txt_descuento" type="text" size="2" /></td>
<td width="127" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['precioVenta'].'</div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center">x </div></td>
';
mysql_free_result($result);



?>