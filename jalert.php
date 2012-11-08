<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jAlert, substituto del alert(), confirm() y prompt() en jQuery</title>
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.alerts.js"></script>
<link href="includes/jquery.alerts.css" rel="stylesheet" type="text/css" />
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />

<script type="text/javascript"> 
$(document).ready(function(){
	$('#boton_alert').click(function() {
		alert("Actualidad jQuery");
	});
	$('#boton_confirm').click(function() {
		if(confirm("¿Te gusta Actualidad jQuery?")) {
			alert("Te gusta Actualidad jQuery");
		} else {
			alert("No te gusta Actualidad jQuery");
		}
	});
	$('#boton_prompt').click(function() {
		variable = prompt("Introduce tu nombre","");
		alert("Tu nombre es "+variable);
	});
	$('#boton_jalert').click(function() {
		jAlert("Actualidad jQuery", "Actualidad jQuery");
	});
	$('#boton_jconfirm').click(function() {
		jConfirm("¿Te gusta Actualidad jQuery?", "Actualidad jQuery", function(r) {
			if(r) {
				jAlert("Te gusta Actualidad jQuery", "Actualidad jQuery");
			} else {
				jAlert("No te gusta Actualidad jQuery", "Actualidad jQuery");
			}
		});
	});
	$('#boton_jprompt').click(function() {
		jPrompt("Introduce tu nombre", "", "Actualidad jQuery", function(r) {
			if(r) {
				jAlert("Tu nombre es "+r, "Actualidad jQuery");
			}
		});
	});
});
</script>
<style type="text/css">

.html, body {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
}

.inicio {
	width:600px;
	height:100%;
	padding:0px;
	margin:0px auto 0px auto;
}

</style>
</head>
<body>
<div class="inicio">
jAlert, substituto del alert(), confirm() y prompt() en jQuery<br /><br />
Javascript
<br /><br />
<input type="button" id="boton_alert" value="alert()" />
<input type="button" id="boton_confirm" value="confirm()" />
<input type="button" id="boton_prompt" value="prompt()" />
<br /><br />
jQuery + jAlert
<br /><br />
<input type="button" id="boton_jalert" value="jAlert()" />
<input type="button" id="boton_jconfirm" value="jConfirm()" />
<input type="button" id="boton_jprompt" value="jPrompt()" />
</div>
 </body>
</html>