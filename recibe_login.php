<?
session_start();
require_once('cnx/conexion.php');
conectar();
$hoy = date("Y/m/d H:i:s"); 

$result = mysql_query("select * from tbl_usuarios where usuario='".$_POST['txt_usuario']."' and pass='".$_POST['txt_pass']."'");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 


if(mysql_num_rows($result) >=1){
	$row = mysql_fetch_assoc($result);
	$_SESSION['usuario']=$row['id'];
	$_SESSION['nombre_usuario']=$row['nombre'];
	$v_perfil=array();
	$v_perfil=split(",",$row['id_perfil']);
	$_SESSION['perfil']=$v_perfil;
	

	header("Location:menu.php"); 
	exit();
}else{
	header("Location:login.php"); 
	exit();
}
?>