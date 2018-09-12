<?php
$user = 'zamekutp';
$pass = 'Zamek123';
$db = 'witryny_zslit';

$log = fopen("display.txt", "w");



$db = new mysqli('mysql.cba.pl', $user, $pass, $db) or die("Unable to connect");
$klucz=$_GET['key'];
$sql = "SELECT imie, nazwisko FROM lista where klucz like '$klucz'";
$res = mysqli_query($db, $sql);
if(mysqli_num_rows($res)>0)
{
	while($row=mysqli_fetch_assoc($res))
	{
		$dane = "Witaj, " . $row["imie"]. " " . $row["nazwisko"];
	}

fputs($log, $dane);
fclose($log);

}



else
{
	echo'0 results';
}
?>