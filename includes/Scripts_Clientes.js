
$(document).ready(function(){
						   
//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_clientes.php",
        data: "opcion=2&cedula="+$('#txt_cedula_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			var v_resultado=datos.split("|");
			$('#txt_nombre').attr('value',v_resultado[0]);
			$('#txt_cedula').attr('value',v_resultado[1]);
			$('#txt_correo').attr('value',v_resultado[2]);
			$('#txt_fax').attr('value',v_resultado[3]);
			$('#txt_direccion').attr('value',v_resultado[4]);
			$('#txt_tel_fijo').attr('value',v_resultado[5]);
			$('#txt_tel_cel').attr('value',v_resultado[6]);
			$('#cmb_tipo').attr('selected',v_resultado[7]);
			$('#txt_consumible').attr('value',v_resultado[9]);
			$('#txt_consumido').attr('value',v_resultado[10]);
			$('#opcion').attr('value','3');
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		event.preventDefault();				  				
		
		if($('#opcion').val()==1){	
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_clientes.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_correo="+$('#txt_correo').val()+"&txt_fax="+$('#txt_fax').val()+"&txt_direccion="+$('#txt_direccion').val()+"&txt_tel_fijo="+$('#txt_tel_fijo').val()+"&txt_tel_cel="+$('#txt_tel_cel').val()+"&cmb_tipo="+$('#cmb_tipo').val()+"&txt_consumible="+$('#txt_consumible').val()+"&txt_consumido="+$('#txt_consumido').val()+"&rnd_credito="+$('#rnd_credito').val(),        		
		success: function(datos){
		

		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Cliente!!',
    			pnotify_text: 'El Cliente fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El Cliente ya existe',
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
        url: "operaciones/opr_clientes.php",
        data: "opcion=3&txt_nombre="+$('#txt_nombre').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_correo="+$('#txt_correo').val()+"&txt_fax="+$('#txt_fax').val()+"&txt_direccion="+$('#txt_direccion').val()+"&txt_tel_fijo="+$('#txt_tel_fijo').val()+"&txt_tel_cel="+$('#txt_tel_cel').val()+"&cmb_tipo="+$('#cmb_tipo').val()+"&txt_consumible="+$('#txt_consumible').val()+"&txt_consumido="+$('#txt_consumido').val()+"&rnd_credito="+$('#rnd_credito').val(),		
		success: function(datos){
				
				$.pnotify({
			    pnotify_title: 'Cliente Modificado',
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
        url: "operaciones/opr_usuarios.php",
        data: "opcion=4&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			alert(datos);
				$.pnotify({
			    pnotify_title: 'Cliente Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar();

});

function limpiar(){
			$('#txt_nombre').attr('value','');
			$('#txt_cedula').attr('value','');
			$('#txt_correo').attr('value','');
			$('#txt_tel_cel').attr('value','');
			$('#txt_tel_fijo').attr('value','');
			$('#txt_fax').attr('value','');
			$('#txt_direccion').attr('value','');
			$('#txt_consumible').attr('value','');
			$('#txt_consumido').attr('value','');			
			$('#txt_usuario_buscar').attr('value','');						
			$('#opcion').attr('value','1');	
}

																   

})// JavaScript Document

					   
