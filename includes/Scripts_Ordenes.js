// JavaScript Document

var total=0;

$(document).ready(function(){
var montoAi=0;	
$("#subtotal").data("montoAi",0);
$("#impuesto").data("impuesto",0);
//lleva el total de los impuestos
var totImp=0;
//lleva el total de los descuentos
var totDesc=0;
//lleva el monto con que pagan
var paga=0;
//lleva el vuelto
var vuelto=0;






$("#loader").css("display", "none");

$("#various1").fancybox({
										

				'titlePosition'		: 'inside',

				'transitionIn'		: 'none',

				'transitionOut'		: 'none'

});


//**********************************************Calcula*****************************************
//***********************************************************************************************
//***********************************************************************************************

$("#btn_calcula").click(function(event){
event.preventDefault();
				var tot=0;
				var paga=0;
				var items = $('#txt_items').val();
				if (items>1 && items<=20 ){
				tot=parseFloat($("#subtotal").data("montoAi"))+$("#impuesto").data("impuesto");
				tot=parseFloat($('#txt_paga').val())-parseFloat(tot);
				paga=parseFloat($('#txt_paga').val());
				vuelto=parseFloat(tot);
				$('#cambio').html(moneda(tot));
				}else{
				alert("No agrego ningun item a la factura");	
				return;
				}
							   
});		


///**************************************carga info del cliente***********************************
///**************************************carga info del cliente***********************************
///**************************************carga info del cliente***********************************
///**************************************carga info del cliente***********************************
///**************************************carga info del cliente***********************************

$("#txt_cedula").live("focusout", function(event){		
			event.preventDefault();			
			
			$.ajax({
        type: "POST",
		dataType: "json",
		async: false,
        url: "operaciones/opr_clientes.php",
        data: "opcion=5&txt_cedula="+$('#txt_cedula').val(),
        success: function(datos){
			$('#txt_cliente').attr("value",datos.nombre);
			$('#lcliente').html("Lavados cliente= "+datos.lavados);
				
		
		}//end succces function
		});//end ajax function	
		
});
						

//******************************************Completo***********************************************
//***********************************************************************************************
//***********************************************************************************************


$("#btn_completo").click(function(event){
event.preventDefault();								  
				var tot=0;
				var paga=0;
				var items = $('#txt_items').val();
				if (items>1 && items<=20 ){					
				tot=parseFloat($("#subtotal").data("montoAi"))+$("#impuesto").data("impuesto");
				tot=parseFloat(tot)-parseFloat(tot);
				paga=parseFloat($("#subtotal").data("montoAi"))+$("#impuesto").data("impuesto");
				$('#txt_paga').val(paga);
				vuelto=parseFloat(tot);
				$('#cambio').html(moneda(tot));
				
				}else{
				alert("No agrego ningun item a la factura");	
				return;
				}
							   
});							   




$("#btn_nuevo").click(function(event){
		location.reload();
	
});
								

//*********************************************Buscar**********************************************
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************

$("#btn_search").click(function(event){						
		event.preventDefault();	
var montoAi=0;	
$("#subtotal").data("montoAi",0);
$("#impuesto").data("impuesto",0);
//lleva el total de los impuestos
var totImp=0;
//lleva el total de los descuentos
var totDesc=0;
//lleva el monto con que pagan
var paga=0;
//lleva el vuelto
var vuelto=0;
//lleva el total de la factura
total=0;

		if(!$('#txt_orden').val()){
			alert("No Digito una placa");	
		}

		$("#loader").css("display", "inline");

		//consulto el cliente
		$.ajax({
        type: "POST",
		async: false,
        url: "consultas_ordenes.php",
        data: "opcion=1&orden="+$('#txt_orden').val(),
        success: function(datos){
		//desconcateno el resultado la primera posicion me indica si fue exitoso
			var v_cliente=datos.split("|");
			$('#num_factura').html(v_cliente[1]);
			$('#txt_cliente').attr("value",v_cliente[2]);
			$('#txt_placa').attr("value",v_cliente[3]);
			$('#txt_conductor').attr("value",v_cliente[4]);
			$('#txt_contrato').attr("value",v_cliente[5]);
			$('#txt_kilometraje').attr("value",v_cliente[6]);
			$('#txt_vehiculo').attr("value",v_cliente[7]);
			$('#txt_letras').attr("value",v_cliente[8]);
			if (v_cliente[0]==0){
				alert("Placa no encontrada");
				location.reload();
			}
			
		}//end succces function
		});//end ajax function clientes	
		
		
		
		//consulto los ids de la tabla subfacturas
		$.ajax({
        type: "POST",
		async: false,
        url: "consultas_ordenes.php",
        data: "opcion=2&orden="+$('#txt_orden').val(),
        success: function(datos){
		//traigo los ids de las subfacturas
		var v_ids=datos.split("|");
		var total=v_ids[0];
			
			for (x = 1 ;x<=total; x=x+1) {
					
				$.ajax({
		        type: "POST",
				async: false,
        		url: "consultas_ordenes.php",
        		data: "opcion=3&id="+v_ids[x],
        		success: function(datos){

				var v_datos=datos.split("|");
		//formateo el numero a imprimir con puntos y comas
		var formateado=moneda(v_datos[3])+",00";
				
			
			$("#linea"+x).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" title="'+v_datos[5] +'" align="center"  >'+v_datos[1]+'</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_datos[0]+'</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_datos[2]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+x+'" title="'+v_datos[4]+'" name="txt_descuento" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+x+'" align="center"  ><input class="descuento" name="'+x+'" id="'+v_ids[x]+'" type="checkbox" title="'+v_datos[4]+'" value="'+v_datos[3]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+formateado+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+x+'" id="'+v_ids[x]+'" value="'+v_datos[3]+'" title="'+v_datos[4]+'" class="eliminar" src="img/delete.png" /> </div></td>');	
				
				//pregunto si es exonerado
				if(v_datos[4]==0){
					
					montoAi=parseFloat($("#subtotal").data("montoAi"))+parseFloat(v_datos[3]);
					impuesto=(parseFloat(v_datos[3])*0.13).toFixed(2);
					impuesto=redondea(impuesto);
					montoAi=redondea(montoAi); 
					//subImp=parseFloat(subImp)+parseFloat(montoAi);
					totImp=parseFloat(totImp)+parseFloat(impuesto); 
					$("#impuesto").data("impuesto",totImp);
					$("#subtotal").data("montoAi",montoAi);
				}else{
					montoAi=parseFloat(montoAi)+parseFloat(v_datos[3]);	
					$("#subtotal").data("montoAi",montoAi);
				}
				}//end succces function
				});//end ajax function		
			}//end for
		
		}//end succces function
		});//end ajax function		
		

		total=parseFloat(montoAi)+parseFloat(totImp);
		$('#txt_items').attr("value",x);
		$("#subtotal").data("montoAi",montoAi);
		$("#subtotal").html(moneda(montoAi)+",00");			
		$("#impuesto").html(moneda(totImp)+",00");
		//$("#impuesto").html(impuesto);
		$("#total").html(moneda(total)+",00");
		$("#totalPagar").html(moneda(total)+",00");

		$("#loader").css("display", "none");
});

//**********************************************Agregar***************************************
//**********************************************Agregar***************************************
//**********************************************Agregar***************************************

$("#btn_agregar").live("click", function(event){
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
		var pago = $('#cmb_metodo').val();
		var contrato = $('#txt_contrato').val();
		var kilometraje = $('#txt_kilometraje').val();
		var vehiculo = $('#txt_vehiculo').val();		
		var letras = $('#txt_letras').val();		

		if (!(cantidad >= 1)){
			alert("No seleccciono la cantidad de articulos");
			return;
		}
		if (!(placa)){
			alert("No ha ingresado una placa");
			return;
		}

		//consulto el inventario
		$.ajax({
        type: "POST",
		async: false,
        url: "consultas1a1.php",
        data: "codigo="+codigo+"&cantidad="+cantidad+"&items="+items+"&factura="+factura+"&cliente="+cliente+"&placa="+placa+" &pago="+pago+"&conductor="+conductor+"&contrato="+contrato+"&kilometraje="+kilometraje+"&vehiculo="+vehiculo+"&letras="+letras,
        success: function(datos){

		//desconcateno el resultado la primera posicion me indica si fue exitoso
		var v_resultado=datos.split("|");
		//if (datos=='Success'){
		if (v_resultado[0]=='Success'){		
		//formateo el numero a imprimir con puntos y comas
		var formateado=moneda(v_resultado[2])+",00";


			//imprimo la linea en el grid
	$("#linea"+items).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'+codigo+'</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+cantidad+'</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[1]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+items+'" title="'+v_resultado[4]+'" name="txt_descuento" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+items+'" align="center"  ><input class="descuento" name="'+items+'" id="'+v_resultado[3]+'" type="checkbox" title="'+v_resultado[4]+'" value="'+v_resultado[2]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+formateado+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+items+'" id="'+v_resultado[3]+'" value="'+v_resultado[2]+'" title="'+v_resultado[4]+'" class="eliminar" src="img/delete.png" /> </div></td>');
			
			
			if ($("#subtotal").data("montoAi")>0){
				montoAi=parseFloat($("#subtotal").data("montoAi"))+parseFloat(v_resultado[2]);
			}else
			{
				montoAi=parseFloat(montoAi)+parseFloat(v_resultado[2]);
			}
			
			//si el articulo no es exento de impuesto	
			if (v_resultado[4]==1){
				
				total=parseFloat(montoAi)+parseFloat(totImp);
			}else{
				
				
				 
				impuesto=(v_resultado[2]*0.13).toFixed(2);
				impuesto=redondea(impuesto); 
				montoAi=redondea(montoAi); 
				totImp=parseFloat(totImp)+parseFloat(impuesto);
				$("#impuesto").data("impuesto",totImp);				
				
				//impuesto=(montoAi*0.13).toFixed(2);
				
				$("#impuesto").html(moneda(totImp)+",00");
				total=parseFloat(montoAi)+parseFloat(totImp);

			}
			
			//$("#cantidad_items").load("cantidad.php", {items: items});	
			$("#txt_items").attr("value",parseFloat(items)+1);
			$("#subtotal").data("montoAi",montoAi);
			$("#subtotal").html(moneda(montoAi)+",00");						
			$("#total").html(moneda(total)+",00");
			$("#totalPagar").html(moneda(total)+",00");
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
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************

$(".eliminar").live("click", function(event){
  event.preventDefault();
  //en la imagen con la X guardo el id del registro la posicion del registro en el grid y el monto de la ventra de ese item.
  //con esos valores actualizo los id
  var current_id = $(this).attr("id");
  var current_pos= 	$(this).attr("name");
  var current_val= 	$(this).attr("value");
  var current_exen=$(this).attr("title");//en este campo guarde si el articulo es exento o no
 
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
		
  		if(current_exen==0){
			var tot=parseFloat(current_val)-parseFloat(porcentage);
			tot=(parseFloat(tot)*0.13).toFixed(2);	
			tot=redondea(tot); 
			totImp=parseFloat(totImp)-parseFloat(tot);				
			$("#impuesto").data("impuesto",totImp);			
			//Rebajo el monto y le sumo lo que le habia restado por descuento
	  		montoAi=$("#subtotal").data("montoAi")-current_val;
			montoAi=parseFloat(montoAi)+parseFloat(porcentage);
			montoAi=redondea(montoAi); 
			total=parseFloat(montoAi)+parseFloat(totImp);				
			totDesc=parseFloat(totDesc)-parseFloat(porcentage);
		}else{
			//Rebajo el monto y le sumo lo que le habia restado por descuento
	  		montoAi=$("#subtotal").data("montoAi")-current_val;
			montoAi=parseFloat(montoAi)+parseFloat(porcentage);
			montoAi=redondea(montoAi); 
			total=parseFloat(montoAi)+parseFloat(totImp);					
			totDesc=parseFloat(totDesc)-parseFloat(porcentage);
		}


		

		//actualizo el subtotal
		$("#subtotal").data("montoAi",montoAi);
		//actualizo el monto de descuento
		//porcentage=parseFloat(totDesc)-parseFloat(porcentage);
		$("#descuento").data("descuento",totDesc);
		$('#descuento').html(moneda(totDesc)+",00");
  }else{
		if(current_exen==0){
			  montoAi=$("#subtotal").data("montoAi")-current_val;	
			  impuesto=(current_val*0.13).toFixed(2);
			  impuesto=redondea(impuesto); 
			  montoAi=redondea(montoAi); 
			  totImp=parseFloat(totImp)-parseFloat(impuesto);
			  $("#impuesto").data("impuesto",totImp);			  
			  total=parseFloat(montoAi)+parseFloat(totImp);			  
		}else{
			  montoAi=$("#subtotal").data("montoAi")-current_val;	
			  montoAi=redondea(montoAi); 
			  total=parseFloat(montoAi)+parseFloat(totImp);			  				
		}
		
		
  		//montoAi=$("#subtotal").data("montoAi")-current_val;
		$("#subtotal").data("montoAi",montoAi);		
  }//end if
  $("#linea"+current_pos).html('');  
  $("#subtotal").html(moneda(montoAi)+",00");
  //vuelvo a calcular el impuesto

  $("#impuesto").html(moneda(totImp)+",00");
  $("#total").html(moneda(total)+",00");  
  $("#totalPagar").html(moneda(total)+",00");
});

//*********************************************Descuento************************************
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************


$(".descuento").live("click", function(event){
	event.preventDefault();									  
//Al igual que elimar cada chekbox lleva el id del registro, la posicion y el monto. 
	var current_id = $(this).attr("id");
	var current_pos= $(this).attr("name");
	var current_val= $(this).attr("value");
	var current_exen= $(this).attr("title");
	//tiene el porcentage de descuento a aplicar en el txt
	var porcentage= $('#txt_descuento'+current_pos).val();
	//esta variable tiene el porciento de descuento
	if (!(porcentage >= 1)){
			alert("No seleccciono el porcentage de descuento");
			return;
		}
	//calculo el monto de descuento	
	var porciento=porcentage;
	porcentage=parseFloat(porcentage)/100
	porcentage=current_val*porcentage;
	porcentage=parseFloat(porcentage.toFixed(2));
	porcentage=redondea(porcentage);
	
	//actualizo la linea en base de datos
	$.ajax({
        type: "POST",
		async: false,
        url: "descuento1a1.php",
        data: "id="+current_id+"&porciento="+porciento+"&porcentage="+porcentage,
        success: function(datos){	
		}//end succces function
		});//end ajax function		
	//guardo la variable de porcentage en el div del total de descuento global
	if($("#descuento").data("descuento")>0){
			montoAi=$("#subtotal").data("montoAi")-porcentage;
			totDesc=parseFloat(totDesc)+parseFloat(porcentage);			
			 //var porcentagetot=parseFloat($("#descuento").data("descuento"))+parseFloat(porcentage);
			$("#descuento").data("descuento",totDesc);

	}else{
		$("#descuento").data("descuento",porcentage);
		montoAi=$("#subtotal").data("montoAi")-porcentage;
		
		totDesc=parseFloat(porcentage);
	}
	//pongo el monto de descuento en patalla
	
	$('#descuento').html(moneda(totDesc)+",00");
	//actualizo el subtotal
	montoAi=redondea(montoAi); 
	$("#subtotal").data("montoAi",montoAi);
	$("#subtotal").html(moneda(montoAi)+",00");
	//vuelvo a calcular el impuesto y reimprimo los divs
	
	if(current_exen==0){
		//calculo cuanto pagaba de impuestos antes del descuento y despues del descuento luego resto ese valor y lo totalizo
		var impAntes=(parseFloat(current_val)*0.13).toFixed(2);	
			impAntes=redondea(impAntes); 
		var impDesp = parseFloat(current_val)-parseFloat(porcentage);
			 impDesp=(parseFloat(impDesp)*0.13).toFixed(2);
			 impDesp=redondea(impDesp);
		var tot=parseFloat(impAntes)-parseFloat(impDesp);
		totImp=parseFloat(totImp)-parseFloat(tot);
		$("#impuesto").data("impuesto",totImp);
		montoAi=redondea(montoAi); 
		total=parseFloat(montoAi)+parseFloat(totImp);	
	}else{
		montoAi=redondea(montoAi); 
		total=parseFloat(montoAi)+parseFloat(totImp);	
	}
  	
  	
  	$("#impuesto").html(moneda(totImp)+",00");
  	$("#total").html(moneda(total)+",00"); 
	$("#totalPagar").html(moneda(total)+",00");
	$('#area_descuento'+current_pos).html('');
									  
});


//*********************************************imprimir******************************
//*********************************************imprimir******************************
//*********************************************imprimir******************************
//*********************************************imprimir******************************


$("#btn_imprimir").click(function(event){
	event.preventDefault();	
	
	if ($('#txt_paga').val()>0){ 
	var items = $('#txt_items').val();
	if (items>1 && items<=20 ){				
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=3&nombre="+$('#txt_cliente').val()+"&conductor="+$('#txt_conductor').val()+"&placa="+$('#txt_placa').val()+"&impuestos="+totImp+"&paga="+paga+"&vuelto="+vuelto+"&contrato="+$('#txt_contrato').val()+"&vehiculo="+$('#txt_vehiculo').val()+"&kilometraje="+$('#txt_kilometraje').val()+"&letras="+$('#txt_letras').val()+"&tipo_pago="+$('#cmb_metodo').val()+"&total="+total,
        success: function(datos){

	
		}//end succces function
		});//end ajax function		
	location.reload();
	}else{
		alert("No agrego ningun item a la factura");	
		return;
	}
	}else{//else de si paga tiene datos
		alert("Debe seleccionar si paga completo o con un monto");	
		return;		
	}
});

//*************************************** agrego combo aceites ***********************************
//*************************************** agrego combo aceites ***********************************
//*************************************** agrego combo aceites ***********************************
//*************************************** agrego combo aceites ***********************************
$("#btn_aceites").live("click", function(event){
event.preventDefault();										 
		var cliente = $('#txt_cliente').val();
		var placa = $('#txt_placa').val();
		var conductor = $('#txt_conductor').val();
		var pago = $('#cmb_metodo').val();
		var contrato = $('#txt_contrato').val();
		var kilometraje = $('#txt_kilometraje').val();
		var vehiculo = $('#txt_vehiculo').val();
		var letras = $('#txt_letras').val();
		
		var items = $('#txt_items').val();
		if (!(placa)){
			alert("No ha ingresado una placa");
			return;
		}
										 

		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=9&marca="+$('#cmb_marca').val()+"&modelo="+$('#cmb_modelo').val()+"&filtros="+$('#cmb_filtros').val()+"&monto="+$('#precio_aceite').val()+"&cliente="+cliente+"&placa="+placa+" &pago="+pago+"&conductor="+conductor+"&contrato="+contrato+"&kilometraje="+kilometraje+"&vehiculo="+vehiculo+"&letras="+letras,
        success: function(datos){	

		//desconcateno el resultado la primera posicion me indica si fue exitoso
		var v_resultado=datos.split("|");
		//formateo el numero a imprimir con puntos y comas
		var formateado=moneda(v_resultado[2])+",00";
		
		
		$("#linea"+items).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >000</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >1</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[1]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+items+'" title="'+v_resultado[4]+'" name="txt_descuento" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+items+'" align="center"  ><input class="descuento" name="'+items+'" id="'+v_resultado[3]+'" type="checkbox" title="'+v_resultado[4]+'" value="'+v_resultado[2]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+formateado+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+items+'" id="'+v_resultado[3]+'" value="'+v_resultado[2]+'" title="'+v_resultado[4]+'" class="eliminar" src="img/delete.png" /> </div></td>');
		

			

		montoAi=parseFloat($("#subtotal").data("montoAi"))+parseFloat(v_resultado[2]);
		$("#cantidad_items").load("cantidad.php", {items: items});	
		impuesto=(v_resultado[2]*0.13).toFixed(2);
		impuesto=redondea(impuesto);
		totImp=parseFloat(totImp)+parseFloat(impuesto);
		$("#impuesto").data("impuesto",totImp);		
		
				//impuesto=(montoAi*0.13).toFixed(2);
		$("#impuesto").html(moneda(totImp)+",00");		
		montoAi=redondea(montoAi); 
		total=parseFloat(montoAi)+parseFloat(totImp);
		$("#subtotal").data("montoAi",montoAi);
		$("#subtotal").html(moneda(montoAi)+",00");
		$("#total").html(moneda(total)+",00");
		$("#totalPagar").html(moneda(total)+",00");
		$("#resultado").html('');

		
		
		}//end succces function
		});//end ajax function	
		
		//Agrego el lavado gratis
					
		items=parseFloat(items)+1;
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=11&combol=1&tipoVehiculol=Gratis&monto=0&cliente="+cliente+"&placa="+placa+" &pago=5&conductor="+conductor+"&contrato="+contrato+"&kilometraje="+kilometraje+"&vehiculo="+vehiculo,
        success: function(datos){	

		//desconcateno el resultado la primera posicion me indica si fue exitoso
		var v_resultado=datos.split("|");
		
		$("#linea"+items).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >001</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >1</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[1]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+items+'" title="'+v_resultado[4]+'" name="txt_descuento" disabled="disabled" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+items+'" align="center"  ><input class="descuento" name="'+items+'" id="'+v_resultado[3]+'" disabled="disabled" type="checkbox" title="'+v_resultado[4]+'" value="'+v_resultado[2]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[2]+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+items+'" id="'+v_resultado[3]+'" value="'+v_resultado[2]+'" title="'+v_resultado[4]+'" class="eliminar" src="img/delete.png" /> </div></td>');
				}//end succces function
		});//end ajax function	


$("#cantidad_items").load("cantidad.php", {items: items});	
		
														 				
});										 


//*************************************** agrego combo lavado ***********************************
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************
$("#btn_lavado").live("click", function(event){
event.preventDefault();										 
		var cliente = $('#txt_cliente').val();
		var placa = $('#txt_placa').val();
		var conductor = $('#txt_conductor').val();
		var pago = $('#cmb_metodo').val();
		var items = $('#txt_items').val();
		var contrato = $('#txt_contrato').val();
		var kilometraje = $('#txt_kilometraje').val();
		var vehiculo = $('#txt_vehiculo').val();				
		var letras = $('#txt_letras').val();				

		if (!(placa)){
			alert("No ha ingresado una placa");
			return;
		}
		if ($('#cmb_combol').val()=="Seleccione"){
			alert("Debe selecccionar el tipo de lavado");
			return;
		}
		if ($('#cmb_tipoVehiculol').val()=="Seleccione"){
			alert("Debe selecccionar el tipo de vehiculo");
			return;
		}
								 

		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=11&combol="+$('#cmb_combol').val()+'&tipoVehiculol='+$('#cmb_tipoVehiculol').val()+"&monto="+$('#precio_lavado').val()+"&cliente="+cliente+"&placa="+placa+" &pago="+pago+"&conductor="+conductor+"&contrato="+contrato+"&kilometraje="+kilometraje+"&vehiculo="+vehiculo+"&letras="+letras,
        success: function(datos){	

		//desconcateno el resultado la primera posicion me indica si fue exitoso
		var v_resultado=datos.split("|");
//formateo el numero a imprimir con puntos y comas
var formateado=moneda(v_resultado[2])+",00";
		
		$("#linea"+items).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >001</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >1</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[1]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+items+'" title="'+v_resultado[4]+'" name="txt_descuento" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+items+'" align="center"  ><input class="descuento" name="'+items+'" id="'+v_resultado[3]+'" type="checkbox" title="'+v_resultado[4]+'" value="'+v_resultado[2]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+formateado+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+items+'" id="'+v_resultado[3]+'" value="'+v_resultado[2]+'" title="'+v_resultado[4]+'" class="eliminar" src="img/delete.png" /> </div></td>');

		montoAi=parseFloat($("#subtotal").data("montoAi"))+parseFloat(v_resultado[2]);
//		montoAi=parseFloat(montoAi)+parseFloat(v_resultado[2]);
		$("#cantidad_items").load("cantidad.php", {items: items});	

		montoAi=redondea(montoAi); 
		total=parseFloat(montoAi)+parseFloat(totImp);		
		$("#subtotal").data("montoAi",montoAi);
		$("#subtotal").html(moneda(montoAi)+",00");
		$("#total").html(moneda(total)+",00");
		$("#totalPagar").html(moneda(total)+",00");
		$("#resultado").html('');

		
		
		}//end succces function
		});//end ajax function	
		
														 				
});										 



})// JavaScript Document

//********************************************* agregar item manual******************************
//********************************************* agregar item manual******************************
//********************************************* agregar item manual******************************
//***********************************************************************************************
//***********************************************************************************************
//***********************************************************************************************


function manual(){

var codigom = $('#txt_codigom').val();	

	var nombrem = $('#txt_nombrem').val();
	var cantidadm = $('#txt_cantidadm').val();
	var preciom = $('#txt_preciom').val();
	
	var nombre = $('#txt_nombre').val();
	var precio = $('#txt_precio').val();
	var cliente = $('#txt_cliente').val();
	var placa = $('#txt_placa').val();
	var conductor = $('#txt_conductor').val();
	var items = $('#txt_items').val();
	var factura = $('#txt_factura').val();
	var pago = $('#cmb_metodo').val();
	var contrato = $('#txt_contrato').val();
	var kilometraje = $('#txt_kilometraje').val();
	var vehiculo = $('#txt_vehiculo').val();			
	var letras = $('#txt_letras').val();			
	
	
		if (!(placa)){
			alert("No ha ingresado una placa");
			return;
		}
		if (!(codigom)){
			alert("No ha ingresado un codigo manual debe poner 0 al menos. ");
			return;
		}
		if (!(cantidadm)){
			alert("No ha ingresado una cantidad manual debe poner 0 al menos. ");
			return;
		}
		
		if (!(nombrem)){
			alert("Debe poner un nombre al articulo. ");
			return;
		}
		if (!(preciom)){
			alert("No ha ingresado un precio debe poner 0 al menos. ");
			return;
		}
		
		if (validarEntero(preciom)=="letras"){
			
			alert("El precio debe ser un numero");
			return;
		}

	
			$.ajax({
        type: "POST",
		async: false,
        url: "manual1a1.php",
        data: "codigom="+codigom+"&cantidadm="+cantidadm+"&items="+items+"&factura="+factura+"&cliente="+cliente+"&placa="+placa+" &pago="+pago+"&conductor="+conductor+"&nombrem="+nombrem+"&preciom="+preciom+"&contrato="+contrato+"&kilometraje="+kilometraje+"&vehiculo="+vehiculo+"&letras="+letras,
        success: function(datos){

		//desconcateno el resultado la primera posicion me indica si fue exitoso
				var v_resultado=datos.split("|");

				if (v_resultado[0]=='Success'){									

//imprimo la linea en el grid
//formateo el numero a imprimir con puntos y comas
var formateado=moneda(v_resultado[2])+",00";

$("#linea"+items).html('<td height="25" width="76"  bordercolor="#CCCCCC" > <div class="fondoGrid" align="center"  >'+codigom+'</div></td><td width="82" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+cantidadm+'</div></td><td width="261" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+v_resultado[1]+'</div></td><td width="95" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  ><input class="inputboxPequeno" id="txt_descuento'+items+'" name="txt_descuento"  title="1" type="text" size="2"  /></td><td width="76"  height="25" bordercolor="#CCCCCC" > <div class="fondoGrid" id="area_descuento'+items+'" align="center"  ><input class="descuento" name="'+items+'" id="'+v_resultado[3]+'" type="checkbox"  title="1" value="'+v_resultado[2]+'" /></div></td><td width="127" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"  >'+formateado+'</div></td><td width="32" height="25" bordercolor="#CCCCCC" ><div class="fondoGrid" align="center"><input type="image" name="'+items+'" id="'+v_resultado[3]+'" value="'+v_resultado[2]+'" class="eliminar" title="1" src="img/delete.png" /> </div></td>');	
						
			montoAi=parseFloat($("#subtotal").data("montoAi"))+parseFloat(preciom);
 
//			impuesto=(montoAi*0.13).toFixed(2);
//			impuesto=redondea(impuesto);
			montoAi=redondea(montoAi); 
			total=parseFloat(montoAi)+parseFloat($("#impuesto").data("impuesto"));
//			total=parseFloat(montoAi);
			
			$("#cantidad_items").load("cantidad.php", {items: items});	
			
			$("#subtotal").data("montoAi",montoAi.toFixed(2));

			$("#subtotal").html(moneda(parseFloat(montoAi))+",00");			
//			$("#impuesto").html(impuesto);
			$("#total").html(moneda(parseFloat(total.toFixed(2)))+",00");
			$("#totalPagar").html(moneda(parseFloat(total.toFixed(2)))+",00");
			$("#resultado").html('');
					}//end if	   
		
		
		}//end succces function
		});//end ajax function		
		
		
		
		$('#txt_codigo').val('');
		$('#txt_cantidad').val('');
		$('#txt_codigo').focus();
		$('#txt_codigom').val('');	
		$('#txt_nombrem').val('');
		$('#txt_cantidadm').val(1);
		$('#txt_preciom').val('');
		closebox();

}

function actualiza_modelo(){
	
		$("#cmb_modelo").find('option').remove();
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=7&marca="+$('#cmb_marca').val(),
        success: function(datos){
			var v_resultado=datos.split(",");

			for (i=0;i<=v_resultado.length;i++) { 
				$('#cmb_modelo').append('<option value="'+v_resultado[i]+'" >'+v_resultado[i]+'</option>'); 			
			}
		}//end succces function
		});//end ajax function	
}


//*************************************actualiza filtro*********************************************
//***********************************************************************************************
//***********************************************************************************************


function actualiza_filtros(){
		

		$("#cmb_filtros").find('option').remove();
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=8&marca="+$('#cmb_marca').val()+'&modelo='+$('#cmb_modelo').val(),
        success: function(datos){
			var v_resultado=datos.split(",");
			$('#cuartos').html("Cuartos="+v_resultado[1]);

			for (i=2;i<=v_resultado.length;i++) { 
				$('#cmb_filtros').append('<option value="'+v_resultado[i]+'" >'+v_resultado[i]+'</option>'); 			
			}
			$('#precio_aceite').attr("value",v_resultado[0]);
		}//end succces function
		});//end ajax function	
		
}



//*******************************actualiza lavado************************************************
//***********************************************************************************************
//***********************************************************************************************


function actualiza_lavado(){
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=10&combol="+$('#cmb_combol').val()+'&tipoVehiculol='+$('#cmb_tipoVehiculol').val(),
        success: function(datos){
			
			
			$('#precio_lavado').attr("value",datos);
		}//end succces function
		});//end ajax function	
		
}

function redondea(numero){
var valor = Math.ceil(numero) ;
 var numerico = parseFloat(valor);
 valor = valor.toString();
 var texto=valor.toString();
 
 valor = valor.length;

var numeral= texto.substring(parseFloat(valor)-1,parseFloat(valor)); 

switch(parseFloat(numeral))
{
case 0:
    total=parseFloat(numerico);
break;
case 1:
  total=parseFloat(numerico)-1;
  break;
case 2:
    total=parseFloat(numerico)-2;
  break;
case 3:
    total=parseFloat(numerico)-3;
  break;

case 4:
    total=parseFloat(numerico)-4;
  break;

case 5:
    total=parseFloat(numerico)-5;
  break;

case 6:
    total=parseFloat(numerico)+4;
  break;

case 7:
    total=parseFloat(numerico)+3;
  break;

case 8:
    total=parseFloat(numerico)+2;
  break;
case 9:
    total=parseFloat(numerico)+1;
  break;

  }

	return total;
	
	
	
}

function moneda(input)
{
var num = input;

num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
num = num.split("").reverse().join("").replace(/^[\.]/,"");

return (num);
}


function validarEntero(valor){ 
     	//intento convertir a entero. 
     //si era un entero no le afecta, si no lo era lo intenta convertir 
     valor = parseFloat(valor); 

     	//Compruebo si es un valor numérico 
     	if (isNaN(valor)) { 
           	 //entonces (no es numero) devuelvo el valor cadena vacia 
			
			return "letras";
     	}else{ 
           	 //En caso contrario (Si era un número) devuelvo el valor 
           	 return valor ;
     	} 
}