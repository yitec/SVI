// JavaScript Document
$(document).ready(function(){
var montoAi=0;						   
var impuesto=0;

$("#btn_agregar").click(function(event){
				  		
		var codigo = $('#txt_codigo').val();
		var cantidad = $('#txt_cantidad').val();
		var chk_descuento = $('#chk_descuento').val();
		var descuento = $('#txt_descuento').val();
		var factura = $('#txt_factura').val();
		var cliente = $('#txt_cliente').val();
		var placa = $('#txt_placa').val();
		var conductor = $('#txt_conductor').val();
		var items = $('#txt_items').val();
		var pago = $('input:radio[name=rnd_tipoPago]:checked').val();
		if (!(cantidad >= 1)){
			alert("No seleccciono la cantidad de articulos");
			return;
		}

		
		//consulto el inventario
		$.ajax({
        type: "POST",
		async: false,
        url: "consultas1a1.php",
        data: "codigo="+codigo+"&cantidad="+cantidad+"&items="+items+"&factura="+factura+"&cliente="+cliente+"&placa="+placa+" &pago="+pago+"&conductor="+conductor,
        success: function(datos){

		//desconcateno el resultado la primera posicion me indica si fue exitoso
		var v_resultado=datos.split("|");
		//if (datos=='Success'){
		if (v_resultado[0]=='Success'){									
			//imprimo la linea en el grid
	$("#linea"+items).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'+codigo+'</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+cantidad+'</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[1]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+items+'" name="txt_descuento" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+items+'" align="center"  ><input class="descuento" name="'+items+'" id="'+v_resultado[3]+'" type="checkbox" value="'+v_resultado[2]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[2]+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+items+'" id="'+v_resultado[3]+'" value="'+v_resultado[2]+'" class="eliminar" src="img/delete.png" /> </div></td>');	
			montoAi=parseFloat(montoAi)+parseFloat(v_resultado[2]);
			impuesto=(montoAi*0.13).toFixed(2);
			total=parseFloat(montoAi)+parseFloat(impuesto);
			$("#cantidad_items").load("cantidad.php", {items: items});	
			
			$("#subtotal").data("montoAi",montoAi);
			$("#subtotal").html(montoAi);			
			$("#impuesto").html(impuesto);
			$("#total").html(total.toFixed(2));
			$("#resultado").html('');
			
		}else{
			$("#resultado").html('El codigo no existe o ya no hay existencia de ese producto');
		}//end if	   
		}//end succces function
		});//end ajax function		
		$('#txt_codigo').val('');
		$('#txt_cantidad').val('');
		$('#txt_codigo').focus();	
					
});//end function

//*********************************************eliminar************************************
$(".eliminar").live("click", function(event){
  event.preventDefault();
  //en la imagen con la X guardo el id del registro la posicion del registro en el grid y el monto de la ventra de ese item.
  //con esos valores actualizo los id
  var current_id = $(this).attr("id");
  var current_pos= 	$(this).attr("name");
  var current_val= 	$(this).attr("value");
  $.ajax({
        type: "POST",
		async: false,
        url: "elimina1a1.php",
		
        data: "id="+current_id,
        success: function(datos){
		}//end succces function
		});//end ajax function		
  //si esa linea aplicaba descuento rebajo el descuento
  if($('#txt_descuento'+current_pos).val()>=1){		

		porcentage= $('#txt_descuento'+current_pos).val();		
		porcentage=parseFloat(porcentage)/100;
		porcentage=current_val*porcentage;
		porcentage=porcentage.toFixed(2);		
  		montoAi=parseFloat($("#subtotal").data("montoAi"))+parseFloat(porcentage);
		//actualizo el subtotal
		$("#subtotal").data("montoAi",montoAi);
		//actualizo el monto de descuento
		porcentage=parseFloat($("#descuento").data("descuento"))-parseFloat(porcentage);
		$("#descuento").data("descuento",porcentage);
		$('#descuento').html(porcentage);
  }
  $("#linea"+current_pos).html('');
  montoAi=$("#subtotal").data("montoAi")-current_val;
  $("#subtotal").html(montoAi);
  //vuelvo a calcular el impuesto
  impuesto=(montoAi*0.13).toFixed(2);
  total=parseFloat(montoAi)+parseFloat(impuesto);
  $("#impuesto").html(impuesto);
  $("#total").html(total);  
});

//*********************************************Descuento************************************

$(".descuento").live("click", function(event){
	event.preventDefault();									  
//Al igual que elimar cada chekbox lleva el id del registro, la posicion y el monto. 
	var current_id = $(this).attr("id");
	var current_pos= $(this).attr("name");
	var current_val= $(this).attr("value");
	//tiene el porcentage de descuento a aplicar en el txt
	var porcentage= $('#txt_descuento'+current_pos).val();
	//esta variable tiene el porciento de descuento
	if (!(porcentage >= 1)){
			alert("No seleccciono el porcentage de descuento");
			return;
		}
	var porciento=porcentage;
	porcentage=parseFloat(porcentage)/100
	porcentage=current_val*porcentage;
	porcentage=porcentage.toFixed(2);
	$.ajax({
        type: "POST",
		async: false,
        url: "descuento1a1.php",
        data: "id="+current_id+"&porciento="+porciento+"&porcentage="+porcentage,
        success: function(datos){	
		}//end succces function
		});//end ajax function		
	//guardo la variable de porcentaga en el div
	if($("#descuento").data("descuento")>0){
		porcentage=parseFloat($("#descuento").data("descuento"))+parseFloat(porcentage);
		$("#descuento").data("descuento",porcentage);
	}else{
		$("#descuento").data("descuento",porcentage);
	}
	$('#descuento').html(porcentage);
	montoAi=$("#subtotal").data("montoAi")-porcentage;
	$("#subtotal").data("montoAi",montoAi);
	$("#subtotal").html(montoAi);
	//vuelvo a calcular el impuesto y reimprimo los divs
  	impuesto=(montoAi*0.13).toFixed(2);
  	total=parseFloat(montoAi)+parseFloat(impuesto);
  	$("#impuesto").html(impuesto);
  	$("#total").html(total.toFixed(2)); 
	$('#area_descuento'+current_pos).html('');
									  
});

//*********************************************imprimir******************************
$("#btn_imprimir").click(function(event){
	event.preventDefault();						
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=3",
        success: function(datos){

		}//end succces function
		});//end ajax function		
	location.reload();
});

})// JavaScript Document// JavaScript Document