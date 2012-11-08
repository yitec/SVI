
$(document).ready(function(){
						   
//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=2&usuario="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			var v_resultado=datos.split("|");
			$('#txt_usuario').attr('value',v_resultado[0]);
			$('#txt_nombre').attr('value',v_resultado[1]);
			$('#txt_apellidos').attr('value',v_resultado[2]);
			$('#txt_cedula').attr('value',v_resultado[3]);
			$('#txt_pass').attr('value',v_resultado[4]);
			$('#txt_fecha').attr('value',v_resultado[5]);
			$('#opcion').attr('value','3');
			//desconcateno el vector de permisos		
			v_resultado=v_resultado[6].split(",");
			if(v_resultado.indexOf("1")>=0){
				$("#chk_ventas").attr("checked","checked");
			}
			if(v_resultado.indexOf("2")>=0){
				$("#chk_ordenes").attr("checked","checked");
			}			
			if(v_resultado.indexOf("3")>=0){
				$("#chk_minventario").attr("checked","checked");
			}
			if(v_resultado.indexOf("4")>=0){
				$("#chk_reportes").attr("checked","checked");
			}
			if(v_resultado.indexOf("5")>=0){
				$("#chk_vinventario").attr("checked","checked");
			}
			if(v_resultado.indexOf("6")>=0){
				$("#chk_mclientes").attr("checked","checked");
			}			
			if(v_resultado.indexOf("7")>=0){
				$("#chk_musuarios").attr("checked","checked");
			}			
			if(v_resultado.indexOf("8")>=0){
				$("#chk_reimprimir").attr("checked","checked");
			}			
			
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		var permisos=null;
		if ($("#chk_ventas").is(":checked")){
			permisos=permisos+","+1;	
		}
		if ($("#chk_ordenes").is(":checked")){
			permisos=permisos+","+2;	
		}		
		if ($("#chk_minventario").is(":checked")){
			permisos=permisos+","+3;	
		}
		if ($("#chk_reportes").is(":checked")){
			permisos=permisos+","+4;	
		}
		if ($("#chk_vinventario").is(":checked")){
			permisos=permisos+","+5;	
		}
		if ($("#chk_mclientes").is(":checked")){
			permisos=permisos+","+6;	
		}
		if ($("#chk_musuarios").is(":checked")){
			permisos=permisos+","+7;	
		}
		if ($("#chk_reimprimir").is(":checked")){
			permisos=permisos+","+8;	
		}

		event.preventDefault();				  				
		if($('#opcion').val()==1){	
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos,        		
		success: function(datos){

		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Usuario!!',
    			pnotify_text: 'El Usuario fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El usuario ya existe',
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
        url: "operaciones/opr_usuarios.php",
        data: "opcion=3&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos+"&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),		
		success: function(datos){
				alert(datos);
				$.pnotify({
			    pnotify_title: 'Usuario Modificado',
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
			    pnotify_title: 'Usuario Eliminado!!',
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
			$('#txt_apellidos').attr('value','');
			$('#txt_cedula').attr('value','');
			$('#txt_usuario').attr('value','');
			$('#txt_pass').attr('value','');
			$('#txt_fecha').attr('value','');
			$('#txt_usuario_buscar').attr('value','');						
			$('#opcion').attr('value','1');
			$(".ck:checkbox:checked").removeAttr("checked");
	
	
}

																   

})// JavaScript Document

					   
