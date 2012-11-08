// JavaScript Document
$(document).ready(function(){
//recarga la factura cuando se genera una orden de trabajo
$(".eliminar").click(function(event){
		event.preventDefault();
		$("#recarga").empty();		
		var current_id = $(this).attr("id");
		$("#recarga").load("eliminar.php", {id: current_id });
		$("#subtotal").load(location.href+" #subtotal");		
		$("#impuesto").load(location.href+" #impuesto");
		$("#total").load(location.href+" #total");
		$("#resultado").load(location.href+" #resultado");
		$('#txt_codigo').val('');
		$('#txt_cantidad').val('');
		$('#txt_codigo').focus();	

});


})// JavaScript Document// JavaScript Document