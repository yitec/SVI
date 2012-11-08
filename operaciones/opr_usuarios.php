<?php
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

if($_REQUEST['opcion']==1)
{

//busco si no existe el usuario
$result=mysql_query("select usuario from tbl_usuarios where usuario='".$_REQUEST['txt_usuario']."'");
$total=mysql_num_rows($result);
if($total>0){
	echo "repetido";
}else{
	$query="insert into tbl_usuarios(id_perfil,nombre,apellidos,cedula,usuario,pass,fecha_caducidad,estado)values('".$_REQUEST['id_permisos']."','".$_REQUEST['txt_nombre']."','".$_REQUEST['txt_apellidos']."','".$_REQUEST['txt_cedula']."','".$_REQUEST['txt_usuario']."','".$_REQUEST['txt_pass']."','".$fecha."','"."1"."')";
	$result = mysql_query($query);	
	echo "Success";
}

}//end if opcion 1



//Consultar usuarios
if($_REQUEST['opcion']==2)
{
	
	
	$result=mysql_query("select * from tbl_usuarios where usuario='".$_REQUEST['usuario']."'");
	$row=mysql_fetch_assoc($result);

	echo $row['usuario']."|".$row['nombre']."|".$row['apellidos']."|".$row['cedula']."|".$row['pass']."|".$row['fecha_caducidad']."|".$row['id_perfil'] ; 
	
	desconectar();
}//end if opcion 2


//modificar usuario
if($_REQUEST['opcion']==3)
{		
	$result=mysql_query("update tbl_usuarios set usuario='".$_REQUEST['txt_usuario']."',nombre='".$_REQUEST['txt_nombre']."',apellidos='".$_REQUEST['txt_apellidos']."',cedula='".$_REQUEST['txt_cedula']."',pass='".$_REQUEST['txt_pass']."',fecha_caducidad='".$fecha."',id_perfil='".$_REQUEST['id_permisos']."' where usuario='".$_REQUEST['txt_usuario_buscar']."'");

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
desconectar();
}//end if opcion 3


if($_REQUEST['opcion']==4)
{		
	$result=mysql_query("delete from tbl_usuarios where usuario='".$_REQUEST['txt_usuario_buscar']."'");
	

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
desconectar();
}//end if opcion 4


	

?>