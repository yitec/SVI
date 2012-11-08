
$(document).ready(function(){
						   
//agrega un item a la factura					   
$("#btn_agregar").click(function(event){
		event.preventDefault();				  		
		//$("#recarga").empty();		
		var codigo = $('#txt_codigo').val();
		var cantidad = $('#txt_cantidad').val();
		var chk_descuento = $('#chk_descuento').val();
		var descuento = $('#txt_descuento').val();
		var factura = $('#txt_factura').val();
		var cliente = $('#txt_cliente').val();
		var placa = $('#txt_placa').val();
		var conductor = $('#txt_conductor').val();
		var items = $('#txt_items').val();		
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
	
//recarga la factura cuando se genera una orden de trabajo
$("#btn_search").click(function(event){
		$("#recarga").load("consultas.php", {orden: $('#txt_orden').val()});
});

//elimina un item de la factura 

$(".eliminar").click(function(event){
		//event.preventDefault();				  		
		var current_id = $(this).attr("id");
		$("#recarga").load("eliminar.php", {id: current_id });
		
		$("#impuesto").load(location.href+" #impuesto");
		$("#total").load(location.href+" #total");
		$("#resultado").load(location.href+" #resultado");
		$('#txt_codigo').val('');
		$('#txt_cantidad').val('');
		$('#txt_codigo').focus();	

});



$(".sid2").click(function(event){
		var current_id = $(this).attr("id");
		alert(current_id);					
		//$("#recarga").load("consultas.php", {orden: $('#txt_orden').val()});

});

  $("#chk_descuento").click(function(event){
		event.preventDefault();				  
		$("#detalle").empty();		
		var descuento = $('#txt_descuento').val();								
		$("#detalle").load("detalle.php", {descuento: descuento});
	});
  $("#btn_imprimir").click(function(event){
		var nombre = $('#txt_nombre').val();								
		var placa = $('#txt_placa').val();								
		var descuento = $('#txt_descuento').val();
		
		$.ajax({
        type: "POST",
        url: "operaciones.php",
		
        data: "opcion=2&nombre="+nombre+"&placa="+placa+"&descuento="+descuento,
        success: function(datos){
       alert( datos);
      }
		});
	});
								   
								   

})// JavaScript Document

					   
/*$("#btn_agregar").click(function(event){
		event.preventDefault();				  		
		var codigo = $('#txt_codigo').val();
		var cantidad = $('#txt_cantidad').val();
		var chk_descuento = $('#chk_descuento').val();
		var descuento = $('#txt_descuento').val();
		var factura = $('#txt_factura').val();
		var cliente = $('#txt_cliente').val();
		var placa = $('#txt_placa').val();
		var conductor = $('#txt_conductor').val();
		var items = $('#txt_items').val();		
		$("#linea"+items).load("consultas.php", {codigo: codigo,cantidad: cantidad,items: items, factura: factura,cliente: cliente, placa: placa, conductor: conductor});
		$("#cantidad_items").load("cantidad.php", {items: items});
		$("#impuesto").load(location.href+" #impuesto");
		$("#total").load(location.href+" #total");
		$('#txt_codigo').val('');
		$('#txt_cantidad').val('');
		$('#txt_codigo').focus();	
		
	
});*/