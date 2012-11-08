<?
session_start();

require_once('cnx/conexion.php');
conectar();

$_SESSION['respuesta']="";
$_SESSION['m_total']=0;
$exito=true;
//busco el articulo en el inventario
$result = mysql_query("select * from tbl_inventario where codigo='".$_REQUEST['codigo']."' ");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
$row = mysql_fetch_assoc($result);
$num_rows = mysql_num_rows($result);



if($num_rows<1){
	if($_REQUEST['descuento']>=2){
		$exito=false;
	}else{
	$_SESSION['respuesta']="No se encontro el c&oacute;digo de articulo";
	}
		echo '<table><tr><td><div class="Arial20rojo">'.$_SESSION['respuesta'].'</div></td></tr></table><br />';
		$exito=false;

}
	
if($num_rows==1 && $row['existente']==0){
	$_SESSION['respuesta']="El articulo no tiene existencia";
	echo '<table><tr><td><div class="Arial20rojo">'.$_SESSION['respuesta'].'</div></td></tr></table><br />';
			$exito=false;
}

//si la consulta es exito sumo un articulo al total de la factura
if ($exito==true){
	
++$_SESSION['total'];
//sumo el item
$_SESSION['detalle_'.$_SESSION['total']]=$row['codigo'].",".$_REQUEST['cantidad'].",".$row['nombre'].",".$row['precioVenta'];
; 


}//end if exito



for ($i=1;$i<=$_SESSION['total'];++$i){
$vec_detalle=split(",",$_SESSION['detalle_'.$i]);	

echo '<div class="Arial10gris" style=" position:relative; margin-left:0px; ">-----------------------------------------------------------------------------------------------------------------------------------</div>';
echo '<div class="Arial10gris" style="position:relative; float:left; margin-left:60px;">'.$vec_detalle[0].'</div><div class="Arial10gris"  style="position:relative; margin-left:53px; float:left;">'.$vec_detalle[1].'</div><div class="Arial10gris" style="position:relative; margin-left:40px; float:left;">'.$vec_detalle[2].'</div><div class="Arial10gris" style="position:relative; margin-left:0px; ">'.$vec_detalle[3]*$vec_detalle[1].'<div>';
$_SESSION['m_total']=$_SESSION['m_total']+($vec_detalle[3]*$vec_detalle[1]);
}// end for

if($_REQUEST['descuento']>=2){
	
	$_SESSION['m_descuento']=($_SESSION['m_total']*$_REQUEST['descuento'])/100;
	$descuento=$_SESSION['m_descuento'];
	$_SESSION['m_descuento']=$_SESSION['m_total']-$_SESSION['m_descuento'];
	$_SESSION['m_impuesto']=$_SESSION['m_descuento']*0.13;
	
	$_SESSION['m_total']=($_SESSION['m_total']-$descuento)+$_SESSION['m_impuesto'];
	echo"<br>";
	echo '<div class="Arial18rojo" style="position:relative; margin-left:220px;">Descuento= '.number_format($_SESSION['m_descuento'],2,",",".").'</div>';

echo '<div class="Arial18rojo" style="position:relative; margin-left:220px;">Impuesto= '.number_format($_SESSION['m_impuesto'],2,",",".").'</div>';

echo '<div class="Arial20rojo" style="position:relative; margin-left:220px;">Total Neto= '.number_format($_SESSION['m_total'],2,",",".").'</div>';

}
else
{
	$_SESSION['m_impuesto']=$_SESSION['m_total']*0.13;
	$_SESSION['m_total']=$_SESSION['m_total']+$_SESSION['m_impuesto'];
		echo"<br>";
	echo '<div class="Arial18rojo">Impuesto= '.number_format($_SESSION['m_impuesto'],2,",",".").'</div>';
	echo '<div style="margin-left:280px;">-------------------------------</div>';

echo '<div class="Arial20rojomargin" >Total= '.number_format($_SESSION['m_total'],2,",",".").'</div>';
}


?>