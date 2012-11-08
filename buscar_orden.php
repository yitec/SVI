<?php
session_start();
require_once('cnx/conexion.php');
conectar();
echo $_REQUEST['orden'];
//consulto el articulo en el inventario
$result = mysql_query("select * from tbl_subfacturas where numero_orden='".$_REQUEST['orden']."' ");
$row = mysql_fetch_assoc($result);
$num_rows = mysql_num_rows($result);

//imprimo la tabla
$items=1;
while ($row = mysql_fetch_assoc($result)) {
	if($items==1){
	
echo '<td width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$row['codigo'].'</div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['cantidad'].'</div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  ><input name="chk_descuento'.$items.'" id="chk_descuento'.$items.'" type="checkbox" value="" /></div></td>
<td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento" name="txt_descuento" type="text" size="2"  /></td>
<td width="127" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.number_format($row['precio'],2,",",".").'</div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="btn_delete'.$items.'" id="btn_delete'.$items.'" src="img/delete.png" /> </div></td>';
$items=$items+1;}
else{
echo "entro en 2";

 echo '<tr id="recarga"><td width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'.$row['codigo'].'</div></td>
<td width="82" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['cantidad'].'</div></td>
<td width="261" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.$row['nombre'].'</div></td>
<td width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  ><input name="chk_descuento'.$items.'" id="chk_descuento'.$items.'" type="checkbox" value="" /></div></td>
<td width="95" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento" name="txt_descuento" type="text" size="2"  /></td>
<td width="127" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'.number_format($row['precio'],2,",",".").'</div></td>
<td width="32" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="btn_delete'.$items.'" id="btn_delete'.$items.'" src="img/delete.png" /> </div></td></tr>';
$items=$items+1;}




}//end while
mysql_free_result($result);



?>