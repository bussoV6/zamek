<?php
$user = 'zamekutp';
$pass = 'Zamek123';
$db = 'witryny_zslit';

$db = new mysqli('mysql.cba.pl', $user, $pass, $db);

$id_d = $_GET['id_d'];
$sql = "DELETE FROM lista WHERE id=$id_d";

if(!mysqli_query($db,$sql))
{
	echo'Nie usunieto!!';

}
else
{

	echo'Usunieto!!';
}
header("refresh:2;url=index.php");
?>