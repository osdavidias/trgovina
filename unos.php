<!Doctype-html>
<html>


<head>

<title>Trgovina - unos i pregled podataka</title>
<link rel="stylesheet" type="text/css" href="css.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8"> 
<meta name="description" content="Unos proizvoda i djelatnika u trgovinu i pregled">
<meta name="keywords" content="Trgovina, djelatnici, proizvodi, pregled">

</head>


<body>

<?php

include 'connection.php';
?>

<br>
<h1> TRGOVINA </h1>


<h3><a href="index1.php">Pregled proizvoda</a></h3>
<h3><a href="index2.php">Pregled djelatnika</a></h3>

<h3><a href="index3.php">Pregled trgovina</a></h3>


<br>
<h3> Unesi podatke za trgovinu:</h3>
<br>
<form method="post" action="">
Broj trgovine:
<input type="text" name="br_trg"> <br>
Mjesto:
<input type="text" name="mjesto"> <br>
Adresa:
<input type="text" name="adresa"> <br>
Poštanski broj:
<input type="text" name="post_br"> <br>
<input type="submit" name="dugme1" value="Pošalji">

<h3>Unesi podatke za djelatnike:</h3>
Šifra djelatnika:
<input type="text" name="sif_djelatnik"> <br>
Ime:
<input type="text" name="ime"> <br>
Prezime: <input type="text" name="prezime"> <br>
Trgovina u kojoj radi:
<select name="trg_rad">
<?php



$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);


$query= "select broj_trgovine, mjesto, adresa FROM trgovine";
if ($result=$pdo->query($query)) {
	while ($row=$result->fetch() ) {
		echo '<option value="'.$row[0].'">'.$row[1].', '.$row[2].'</option>';

	}
}
else {
	echo 'GREŠKA: Ne mogu izvršiti!'.print_r($pdo->errorInfo());
}

unset($pdo);

?>
</select>
<br>
Telefon: <input type="text" name="telefon"> <br>
Email: <input type="text" name="email"> <br>
<input type="submit" name="dugme2" value="Pošalji"> <br>

<h3> Unesi podatke za proizvode: </h3>
Naziv proizvoda: <input type="text" name="naz_proizvod"> <br>
Cijena: <input type="text" name="cijena"> <br>
Trgovina u kojoj se nalazi: 
<select name="trg_proizvod">
<?php



	$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
 
$query= "select broj_trgovine, mjesto, adresa FROM trgovine";
if ($result=$pdo->query($query)) {
	while ($row=$result->fetch() ) {
		echo '<option value="'.$row[0].'">'.$row[1].', '.$row[2].'</option>';

	}
}
else {
	echo 'GREŠKA: Ne mogu izvršiti!'.print_r($pdo->errorInfo());
}

unset($pdo);

?>
<select>
<br>
<input type="submit" name="dugme3" value="Pošalji"> <br>



</select>


</form>


<?php

if (isset($_POST["dugme1"])) {

	
	$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
	$stmt=$pdo->prepare('INSERT INTO trgovine (broj_trgovine, postanski_broj, mjesto, adresa)
	VALUES  (?, ?, ?, ?)');
	
	/*$stmt->bindParam(1, $_POST["br_trg"]);
	$stmt->bindParam(2, $_POST["post_br"]);
    $stmt->bindParam(3, $_POST["mjesto"]);
    $stmt->bindParam(4, $_POST["adresa"]); 
    */
    $stmt->execute(array($_POST["br_trg"], $_POST["post_br"], $_POST["mjesto"], $_POST["adresa"]));
    unset($pdo);
}


if (isset($_POST["dugme2"])) {
	
$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query="INSERT INTO djelatnici VALUES (?, ?, ?, ?, ?, ?)";
$stmt=$pdo->prepare($query);
$stmt->bindParam(1, $_POST["sif_djelatnik"]);
$stmt->bindParam(2, $_POST["ime"]);
$stmt->bindParam(3, $_POST["prezime"]);
$stmt->bindParam(4, $_POST["trg_rad"]);
$stmt->bindParam(5, $_POST["telefon"]);
$stmt->bindParam(6, $_POST["email"]);
$stmt->execute();

unset($pdo);

}


if (isset($_POST["dugme3"])) {
	
$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query="INSERT INTO proizvodi (naziv, cijena, broj_trgovine) VALUES (?, ?, ? )";
$stmt=$pdo->prepare($query);
$stmt->bindParam(1, $_POST["naz_proizvod"]);
$stmt->bindParam(2, $_POST["cijena"]);
$stmt->bindParam(3, $_POST["trg_proizvod"]);

$stmt->execute();

unset($pdo);

}

/*echo "<pre>";

print_r ($_POST); 
echo "</pre>";
*/
?>



</body>




</html>

