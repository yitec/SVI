
<?
session_start();
require_once('cnx/conexion.php');
conectar();
$var=51;

$result = mysql_query("select * from tbl_consfacturas ");

$num_rows = mysql_num_rows($result);
echo $num_rows;


/*if($num_rows==1){

echo "fuck";
}else{*/
while ($row = mysql_fetch_array($result)) {
echo "<br>".$row['id'];

}//end while
//echo '</table>';
//}//end if


?>
