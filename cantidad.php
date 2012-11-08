<?php
//me actualiza el textbox hidden con la cantidad de items de la factura
$var=$_REQUEST['items']+1;

echo '<input name="txt_items" id="txt_items" type="hidden"  value="'.$var.'" />';
?>