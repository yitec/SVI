<?php
session_start();
require_once('cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario

if (isset($_SESSION['consecutivo'])){ 


if($_REQUEST['opcion']==1)
{

	$result=mysql_query("select codigo from tbl_inventario where codigo='".$_REQUEST['txt_codigo']."'");
	$total=mysql_num_rows($result);
	if($total>0){
		echo "repetido";
		die();
	}
	$query="insert into tbl_inventario(categoria,codigo,codigo_barras,nombre,existente,exento,precioCosto,precioVenta,descripcion,estado)values('".$_REQUEST['cmb_categoria']."','".$_REQUEST['txt_codigo']."','".$_REQUEST['txt_codigo_barras']."','".$_REQUEST['txt_nombre']."','".$_REQUEST['txt_existente']."','".$_REQUEST['exento']."','".$_REQUEST['txt_precio_costo']."','".$_REQUEST['txt_precio_venta']."','".$_REQUEST['txt_descripcion']."','"."1"."')";

	$result = mysql_query($query);	
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	} 
	echo ("Success");
	

}//end if opcion 1


//guarda una factura
if($_REQUEST['opcion']==2)
{


$query="insert into tbl_facturas(nombre,placa,descuento,monto_descuento,monto_total,fecha,estado)values('".$_REQUEST['nombre']."','".$_REQUEST['placa']."','".$_REQUEST['descuento']."','".$_SESSION['m_descuento']."','".$_SESSION['m_total']."','".$hoy."','"."1"."')";
$result = mysql_query($query);	
//obtengo el id de factura
$result = mysql_query("select MAX(id) as id from tbl_facturas");	
$row = mysql_fetch_assoc($result);
$id_factura=$row['id'];
mysql_free_result($result);

//guardo el detalle de la factura
for ($i=1;$i<=$_SESSION['total'];++$i){

$vec_detalle=split(",",$_SESSION['detalle_'.$i]);		

$query="insert into tbl_detalleFacturas(id_factura,cod_articulo,cantidad,estado)values('".$id_factura."','".$vec_detalle[0]."','".$vec_detalle[1]."','"."1"."')";
$result = mysql_query($query);	


	
}//end for

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
}

//procedimiento de imprimir factura
if($_REQUEST['opcion']==3)
{
	
	
try {	
	$result=mysql_query("select consecutivo,cliente,placa,conductor,tipo_pago,SUM(precio) as totalP, SUM(monto_descuento) as descuento from tbl_subfacturas where placa='".trim($_REQUEST['placa'])."' and estado='"."0"."' group  by placa");
	$row=mysql_fetch_assoc($result);
	//$total=($row['totalP']-$row['descuento'])+$_REQUEST['impuestos'];
	$total=$_REQUEST['total'];
	
	
	$result2=mysql_query("insert into tbl_facturas (consecutivo,nombre,placa,contrato,vehiculo,kilometraje,monto_letras,conductor,tipo_pago,monto_descuento,impuestos,monto_total,paga,cambio,fecha,impresa,estado)values('".$row['consecutivo']."','".$_REQUEST['nombre']."','". trim($row['placa'])."','".$_REQUEST['contrato']."','".$_REQUEST['vehiculo']."','".$_REQUEST['kilometraje']."','".$_REQUEST['letras']."','".$_REQUEST['conductor']."','".$_REQUEST['tipo_pago']."','".$row['descuento']."','".$_REQUEST['impuestos']."','".$total."','".$_REQUEST['paga']."','".$_REQUEST['vuelto']."','".$hoy."','"."0"."','"."1"."')");
	if (!$result2) {//si da error que me despliegue el error del query
       		echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        	$message .= 'Query ejecutado: ' . $query;
			die("Ups!!!! hubo un error en el sistema");		
		} 

	
	$result3=mysql_query("insert into tbl_numfacturas (placa,consecutivo)values('".trim($row['placa'])."','".$row['consecutivo']."')");
		if (!$result3) {//si da error que me despliegue el error del query
       		echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        	$message .= 'Query ejecutado: ' . $query;
			die();		
		} 

		
	$result4=mysql_query("UPDATE tbl_subfacturas set estado='"."1"."', numero_factura = (Select Max(id) from tbl_numfacturas),fecha_factura='".$hoy."' where placa='".trim($row['placa'])."' and consecutivo='".$row['consecutivo']."'");
	if (!$result4) {//si da error que me despliegue el error del query
       	echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		die();
		
		} 
		echo $result4;
	
      
		
	
	if (isset($_SESSION['frecuente'])&& isset($_SESSION['sumalavado']))
	{

		
		$result4=mysql_query("Update tbl_clientes set lavados=lavados+('"."1"."') where id='".$_SESSION['frecuente']."'");
		unset($_SESSION['frecuente']);
		unset($_SESSION['sumalavado']);
		if (!$result4) {//si da error que me despliegue el error del query
       	echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
	
		
		} 
			
		
	}
	

	$result5=mysql_query('CALL stp_actualizaInv("'.trim($_REQUEST['placa']).'")');
	if (!$result5) {//si da error que me despliegue el error del query
       	echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		die();
		
		} 
	
	
	
		

	desconectar();

} catch (Exception $e) {
    echo 'Ups!!! hubo un error: ',  $e->getMessage(), "\n";
}

	
}//end if opcion 3


//Consultar inventario
if($_REQUEST['opcion']==4)
{
	
	
	$result=mysql_query("select * from tbl_inventario where codigo='".$_REQUEST['codigo']."'");
	$row=mysql_fetch_assoc($result);

	echo $row['codigo']."|".$row['nombre']."|".$row['existente']."|".$row['precioCosto']."|".$row['precioVenta']."|".$row['descripcion']."|"."LavaCar" ; 
	
	desconectar();
}//end if opcion 4


if($_REQUEST['opcion']==5)
{		
	$result=mysql_query("update tbl_inventario set codigo='".$_REQUEST['txt_codigo']."',nombre='".$_REQUEST['txt_nombre']."',existente='".$_REQUEST['txt_existente']."',precioCosto='".$_REQUEST['txt_precio_costo']."',precioVenta='".$_REQUEST['txt_precio_venta']."',descripcion='".$_REQUEST['txt_descripcion']."' where codigo='".$_REQUEST['txt_codigo']."'");

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
desconectar();
}//end if opcion 5


if($_REQUEST['opcion']==6)
{		
	$result=mysql_query("delete from tbl_inventario where codigo='".$_REQUEST['txt_codigo']."'");
	

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
desconectar();
}//end if opcion 6

if($_REQUEST['opcion']==7)
{		
	$v_modelos="Seleccione";
	$result=mysql_query("select * from tbl_modelos where id_marca='".$_REQUEST['marca']."'");
	while($row=mysql_fetch_assoc($result)){
		$v_modelos=$v_modelos.",".$row['modelo'];
	
	}

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
	echo $v_modelos;
desconectar();
}//end if opcion 7

//*************************atualiza combos de filtros*******************************
if($_REQUEST['opcion']==8)
{		
	$contador=0;
	$v_filtros="Seleccione";
	$result=mysql_query("select * from tbl_filtros where id_marca='".$_REQUEST['marca']."' and id_modelo=(select id from tbl_modelos where modelo='".$_REQUEST['modelo']."')");
	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 

	while($row=mysql_fetch_assoc($result)){
		$contador++;
		if ($contador==1){
			$v_filtros=$row['precio'].",".$row['cuartos'].",".$row['nombre'];
		}else{
			$v_filtros=$v_filtros.",".$row['nombre'];
		}
	}

	echo $v_filtros;
desconectar();
}//end if opcion 8

//*************************agrega item de cambio aceite*******************************
if($_REQUEST['opcion']==9)
{		
	$codigo="205";
	$nombre="Cambio Aceite ".$_REQUEST['modelo'];
	$result=mysql_query("insert into tbl_subfacturas(consecutivo,cliente,contrato,kilometraje,monto_letras,vehiculo,placa,conductor,tipo_pago,categoria,codigo,cantidad,nombre,precio,exento,fecha,estado) values 
('".$_SESSION['consecutivo']."','".$_REQUEST['cliente']."','".$_REQUEST['contrato']."','".$_REQUEST['kilometraje']."','".$_REQUEST['letras']."','".$_REQUEST['vehiculo']."','".$_REQUEST['placa']."','".$_REQUEST['conductor']."','".$_REQUEST['pago']."','".$codigo."','".$codigo."','"."1"."','".$nombre."','".$_REQUEST['monto']."','"."0"."','".$hoy."','"."0"."')");
		$ultimo_id = mysql_insert_id($_SESSION['connectid']); 

		echo "Success|".$nombre."|".$_REQUEST['monto']."|".$ultimo_id."|0"; 
	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 

desconectar();
}//end if opcion 9


//*************************atualiza combos de lavado*******************************
if($_REQUEST['opcion']==10)
{		
	$contador=0;

	$result=mysql_query("select * from tbl_tipolavado where id_lavado='".$_REQUEST['combol']."' and tipo_vehiculo='".$_REQUEST['tipoVehiculol']."'");
	$row=mysql_fetch_assoc($result);
	
	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
		echo $v_precio=$row['precio'];
		

	
desconectar();
}//end if opcion 10

//*************************agrega el combo lavado*******************************
if($_REQUEST['opcion']==11)
{	
	$_SESSION['sumalavado']=1;	
	$codigo="105";
	$result=mysql_query("select nombre from tbl_lavado where id='".$_REQUEST['combol']."'");
	$row=mysql_fetch_assoc($result);
	$nombre=$row['nombre']." ".$_REQUEST['tipoVehiculol'];
	$result=mysql_query("insert into tbl_subfacturas(consecutivo,cliente,contrato,kilometraje,monto_letras,vehiculo,placa,conductor,tipo_pago,categoria,codigo,cantidad,nombre,precio,exento,fecha,estado) values 
('".$_SESSION['consecutivo']."','".$_REQUEST['cliente']."','".$_REQUEST['contrato']."','".$_REQUEST['kilometraje']."','".$_REQUEST['letras']."','".$_REQUEST['vehiculo']."','".trim($_REQUEST['placa'])."','".$_REQUEST['conductor']."','".$_REQUEST['pago']."','".$codigo."','".$codigo."','"."1"."','".$nombre."','".$_REQUEST['monto']."','"."1"."','".$hoy."','"."0"."')");
		$ultimo_id = mysql_insert_id($_SESSION['connectid']); 

		echo "Success|".$nombre."|".$_REQUEST['monto']."|".$ultimo_id."|1" ; 
	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 

desconectar();

}//end if opcion 11

if($_REQUEST['opcion']==12)
{		


	$result=mysql_query("update tbl_facturas set impresa=0 where id='".$_REQUEST['cmb_factura']."'");

	
	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 

desconectar();
header("location:menu.php");
}//end if opcion 12

//reimpimrimo una factura
if($_REQUEST['opcion']==13)
{		


	  $result=mysql_query("update tbl_facturas set impresa=0 where consecutivo='".$_REQUEST['consecutivo']."'");

	
	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 

desconectar();

}//end if opcion 13





}else{//end session consecutivo
header("location:login.php");
}

?>
