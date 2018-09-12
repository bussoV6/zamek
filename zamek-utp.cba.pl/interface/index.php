<?php
$user = 'zamekutp';
$pass = 'Zamek123';
$db = 'witryny_zslit';

$db = new mysqli('mysql.cba.pl', $user, $pass, $db);
?>

<html>
<head>
<title> Baza danych</title>
<link rel="Stylesheet" type="text/css" href="style.css" />
</head>
<body>
<table style="width:100%">
<tr>
<td>
<table>
<tr><td colspan="2"><h2>DODAWANIE</h2></td><td></td></tr>
<form action="baza.php" method="get">
<tr><td>ID :</td><td> <input type="text" name="id"></td></tr>
<tr><td>Imie :</td><td><input type="text" name="imie"></td></tr>
<tr><td>Nazwisko : </td><td><input type="text" name="nazwisko"></td></tr>
<tr><td>Klucz :</td><td><input type="text" name="klucz"></td></tr>
<tr><td><input type="submit" value="UMIESC"></td></tr>
</form>
</table>
</td>
<td>
<div id="tt">
<h2 id="hh">USUWANIE</h2>
<form action="baza2.php" method="get">
ID :<input type="text" name="id_d"><br>
<input type="submit" value="USUN">
</form>
</div>
</td>
</tr>
</table>
<center>
<div id="baza">
<h3>Lista osób w bazie:</h3>
<?php
$sql = "SELECT id,imie,nazwisko,klucz FROM lista";
$res = mysqli_query($db,$sql);
	while($row=mysqli_fetch_array($res))
	{echo '<div id="rr"><b>ID: </b>'.$row['id'] . ' <b>Imie: </b>' . $row['imie'] . '<b> Nazwisko: </b>' . $row['nazwisko'] . '<b> Klucz: </b>' . $row['klucz'] .'</div><br>';}
	?>
</center>
</div>
</body>
</html>