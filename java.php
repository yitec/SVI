<html>
<title>Formatear Numero</title>
<head>
<script type="text/javascript">
function format(input)
{
var num = input.value.replace(/\./g,"");
if(!isNaN(num)){
num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
num = num.split("").reverse().join("").replace(/^[\.]/,"");
alert(num);
input.value = num;
}
else{ alert("Solo se permiten numeros");
input.value = input.value.replace(/[^\d\.]*/g,"");
}
}
</script>
</head>
<body>
<form>
<input type="text" onkeyup="format(this)" onchange="format(this)">
</form>
</body>
</html>