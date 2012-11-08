<?
session_start();
	mysql_connect('localhost', 'root', '1q2w3e');
	mysql_select_db("bd_svi");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?
$result=mysql_query('CALL P3("Jeffrey Campos","jef","jfc2012","1","1")');
/*$result = mysql_query('CALL P2(8)');
while($row=mysql_fetch_assoc($result)){
	echo $row[0];	
}
*/

?>
</body>
</html>