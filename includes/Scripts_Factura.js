// JavaScript Document
$(document).ready(function(){
		
$("#btn_agregar").click(function(event){
		event.preventDefault();				  		
		$("#recarga").empty();		
		var codigo = $('#txt_codigo').val();
		var cantidad = $('#txt_cantidad').val();
		var chk_descuento = $('#chk_descuento').val();
		var descuento = $('#txt_descuento').val();
		var factura = $('#txt_factura').val();
		var cliente = $('#txt_cliente').val();
		var placa = $('#txt_placa').val();
		var conductor = $('#txt_conductor').val();
		var items = $('#txt_items').val();
		alert(codigo);
		$("#recarga").load("consultas.php", {codigo: codigo,cantidad: cantidad,items: items, factura: factura,cliente: cliente, placa: placa, conductor: conductor});
		//$("#linea"+items).load("consultas.php", {codigo: codigo,cantidad: cantidad,items: items, factura: factura,cliente: cliente, placa: placa, conductor: conductor});
		//$("#cantidad_items").load("cantidad.php", {items: items});
		$("#subtotal").load(location.href+" #subtotal");
		$("#impuesto").load(location.href+" #impuesto");
		$("#total").load(location.href+" #total");
		$("#resultado").load(location.href+" #resultado");
		$('#txt_codigo').val('');
		$('#txt_cantidad').val('');
		$('#txt_codigo').focus();	
		
	
});						   





});// JavaScript Document