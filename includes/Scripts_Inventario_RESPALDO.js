
$(document).ready(function(){





//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();				  										
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=4&codigo="+$('#txt_codigo').val(),
        success: function(datos){
			//alert(datos);
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			var v_resultado=datos.split("|");
			$('#txt_codigo').attr('value',v_resultado[0]);
			$('#txt_nombre').attr('value',v_resultado[1]);
			$('#txt_existente').attr('value',parseFloat(v_resultado[2]));
			$('#txt_precio_costo').attr('value',parseFloat(v_resultado[3]));
			$('#txt_precio_venta').attr('value',parseFloat(v_resultado[4]));
			$('#txt_descripcion').attr('value',v_resultado[5]);
			$('#opcion').attr('value','5');
			
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){

		event.preventDefault();				  				
		if($('#opcion').val()==1){	
		if ($("#chk_impuestos").is(":checked")){
			exento=1;	
		}else{exento=0;}
		if($("#rnd_filtro").is(':checked')) {
			alert($('#cmb_modelo').val());
			variables="opcion=1&filtro=1&cmb_categoria="+$('#cmb_categoria').val()+"&txt_codigo="+$('#txt_codigo').val()+"&txt_codigo_barras="+$('#txt_codigo_barras').val()+"&txt_nombre="+$('#txt_nombre').val()+"&txt_existente="+$('#txt_existente').val()+"&exento="+exento+"&txt_precio_costo="+$('#txt_precio_costo').val()+"&txt_precio_venta="+$('#txt_precio_venta').val()+"&txt_descripcion="+$('#txt_descripcion').val()+"&cmb_marca="+$('#cmb_marca').val()+"&cmb_modelo="+$('#cmb_modelo').val()+"&txt_filtro="+$('#txt_filtro').val();	
		}else{
			variables="opcion=1&cmb_categoria="+$('#cmb_categoria').val()+"&txt_codigo="+$('#txt_codigo').val()+"&txt_codigo_barras="+$('#txt_codigo_barras').val()+"&txt_nombre="+$('#txt_nombre').val()+"&txt_existente="+$('#txt_existente').val()+"&exento="+exento+"&txt_precio_costo="+$('#txt_precio_costo').val()+"&txt_precio_venta="+$('#txt_precio_venta').val()+"&txt_descripcion="+$('#txt_descripcion').val();
			
		}
		
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: variables,
        
		
		success: function(datos){
		
		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Producto!!',
    			pnotify_text: 'El producto fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
			alert(datos);
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El código de producto ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_codigo').focus();	
		}else{

		//modifico los datos del producto
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=5&cmb_categoria="+$('#cmb_categoria').val()+"&txt_codigo="+$('#txt_codigo').val()+"&txt_codigo_barras="+$('#txt_codigo_barras').val()+"&txt_nombre="+$('#txt_nombre').val()+"&txt_existente="+$('#txt_existente').val()+"&exento="+exento+"&txt_precio_costo="+$('#txt_precio_costo').val()+"&txt_precio_venta="+$('#txt_precio_venta').val()+"&txt_descripcion="+$('#txt_descripcion').val(),
		success: function(datos){
				$.pnotify({
			    pnotify_title: 'Producto Modificado',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
			});		
		}//end succces function
		});//end ajax function			
		}//end if 
		
limpiar();
});


$("#btn_eliminar").click(function(event){
	event.preventDefault();	
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=6&txt_codigo="+$('#txt_codigo').val(),
        success: function(datos){
			alert(datos);
				$.pnotify({
			    pnotify_title: 'Producto Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar();

});

function limpiar(){
			$('#txt_codigo').attr('value','');
			$('#txt_nombre').attr('value','');
			$('#txt_existente').attr('value','');
			$('#txt_precio_costo').attr('value','');
			$('#txt_precio_venta').attr('value','');
			$('#txt_descripcion').attr('value','');
			$('#opcion').attr('value','1');
	
	
}

																
})// JavaScript Document

function actualiza_modelo(){
	
	
			alert($('#cmb_marca').val());
			$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=7&marca="+$('#cmb_marca').val(),
        success: function(datos){
			alert (datos);
			var v_resultado=datos.split(",");
			alert(v_resultado.length);
			for (i=1;i<=v_resultado.length;i++) { 
				$('#cmb_modelo').append('<option value="'+v_resultado[i]+'" >'+v_resultado[i]+'</option>'); 			
			}
		}//end succces function
		});//end ajax function
			
			
	
	
}

					   
