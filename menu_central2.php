<?
session_start();
?>
<body>

<div id="mainGris" ><!--Cuadro Gris-->
	<? if (in_array(1, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; margin-top:10px;  float:left;">
    <div align="center" class="Arial14Negro"><a href="ordenes.php"><img src="img/add.png" width="48" height="48"></a>Ingresar Ventas</div>
    </div>
    <? } ?>
    <? if (in_array(2, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="tablet.php"><img src="img/add.png" width="48" height="48"></a>Ingresar orden</div>
    </div>
    <? } ?>
    <? if (in_array(3, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="ingresa_inventario.php"><img src="img/edit.png" width="48" height="48"></a>Modificar Inventario</div>
    </div>
    <? } ?>
    
	<? if (in_array(4, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reporte_entreFechas.php"><img src="img/xcel.png" width="48" height="48"></a>Visualizar Reportes</div>
    </div>
    <? } ?>

	<? if (in_array(5, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="buscar_inventario.php"><img src="img/buscar.png" width="48" height="48"></a>Buscar Inventario</div>
    </div>
    <? } ?>
	<? if (in_array(6, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_clientes.php"><img src="img/clientes.png" width="48" height="48"></a>Manteni Clientes</div>
    </div>
    <? } ?>
	<? if (in_array(7, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_usuario.php"><img src="img/usuarios.png" width="48" height="48"></a></a>Manteni Usuarios</div>
    </div>
    <? } ?>
    

	<? if (in_array(8, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reimprime.php"><img src="img/print.png" width="48" height="48"></a>Reimprime Factura</div>
    </div>
    <? } ?>
    <? if (in_array(9, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/resultados.png" width="48" height="48">Resultados Qu&iacute;mica</div>
    </div>
    <? } ?>
    <? if (in_array(10, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/resultados.png" width="48" height="48">Resultados Bromatolog&iacute;a</div>
    </div>
    <? } ?>
	<? if (in_array(11, $_SESSION['perfil'])){	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/xcel.png" width="48" height="48">Visualizar Reportes</div>
    </div>
    <? } ?>
    
    <? if (in_array(12, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_usuario.php"><img src="img/usuarios.png" width="48" height="48"></a>Mantenimiento Usuarios</div>
    </div>
    <? } ?>
    <? if (in_array(13, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/clientes.png" width="48" height="48">Mantenimiento Clientes</div>
    </div>
    <? } ?>
    


</div><!--Fin Cuadro Gris-->

</body>
</html>
