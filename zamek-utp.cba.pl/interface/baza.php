<?php
$user = 'zamekutp';
$pass = 'Zamek123';
$db = 'witryny_zslit';

$db = new mysqli('mysql.cba.pl', $user, $pass, $db);
$id = $_GET['id'];
$imie = $_GET['imie'];
$nazwisko = $_GET['nazwisko'];
$klucz = $_GET['klucz'];
$sql = "INSERT INTO lista (id,imie,nazwisko,klucz) VALUES ('$id','$imie','$nazwisko','$klucz')";

if(!mysqli_query($db,$sql))
{
	echo'Nie dodano!!';

}
else
{

	echo'Dodano!!';
}
header("refresh:2;url=index.php");
?>