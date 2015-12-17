<html>
<head>

<title>Trgovina - unos i pregled podataka</title>
<meta charset="UTF-8">
<meta name="description" content="Unos proizvoda i djelatnika u trgovinu i pregled">
<meta name="keywords" content="Trgovina, djelatnici, proizvodi, pregled">
<meta name="language" content="croatian">

</head>



<body>

<?php

include 'css.php';
include 'connection.php';

?>
  
<br>
<h1>PREGLED DJELATNIKA PO TRGOVINAMA</h1>

<a href="unos.php"><h2>Unos</h2></a>
<br>

<form method="post">

<b>Pretraži:<b/> <br>
  <input type="text" name="trazi">
  <input type="submit" name="dugme" value="Traži">

<br>
</form>

<?php

if (isset($_POST["dugme"])) {
  
  $a=$_POST["trazi"];
  $pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
  $query='SELECT * FROM djelatnici JOIN trgovine ON djelatnici.broj_trgovine
  =trgovine.broj_trgovine WHERE (sifra_djelatnika LIKE :b OR ime LIKE :b
  OR prezime LIKE :b OR telefon LIKE :b OR email LIKE :b OR mjesto LIKE :b OR adresa LIKE :b) ';
  

  
  $stmt=$pdo->prepare($query);
  
  $stmt->bindValue(':b', '%'.$a.'%');
  $stmt->execute();
 
 $rezultat=$stmt->fetchAll(PDO::FETCH_OBJ);

if (empty($rezultat) OR $rezultat== false)
{
  echo "<br><div id='div1'>NIŠTA NIJE PRONAĐENO!</div>";
}

else
{
  echo '<br><div id="div2"><b>PRONAĐENO:</b></div>';
  echo "<div id='div2'>";
  echo '<table border="1">';
  echo '<tr>
  <th>Šifra djelatnika</th>
  <th>Ime</th>
  <th>Prezime</th>
  <th>Telefon</th>
  <th>Email</th>
  <th>Mjesto trgovine</th>
  <th>Adresa</th>
  </tr>';
foreach ($rezultat as $key => $r) {
  
  echo '<tr>';
  echo '<td>'.$r->sifra_djelatnika.'</td>';
  echo '<td>'.$r->ime.'</td>';
  echo '<td>'.$r->prezime.'</td>';
  echo '<td>'.$r->telefon.'</td>';
  echo '<td>'.$r->email.'</td>';
  echo '<td>'.$r->mjesto.'</td>';
  echo '<td>'.$r->adresa.'</td>';
  echo '<tr>';
  

}
echo'</table>';
  echo'</div>';

 }
 unset($pdo);
}

?>

<br>

<form method="post">
<?php
$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query='SELECT sifra_djelatnika, ime, prezime, telefon, email, mjesto,
adresa, postanski_broj FROM djelatnici JOIN trgovine
ON trgovine.broj_trgovine=djelatnici.broj_trgovine';
$result=$pdo->query($query);



echo '<table border="1">';

echo '<th>Šifra djelatnika</th>
       <th>Ime</th>
       <th>Prezime</th>
       <th>Telefon</th>
       <th>Email</th>
       <th>Mjesto trgovine</th>
       <th>Adresa</th>
       
       <th>Obriši djelatnika</th>';


while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
	 
echo '<tr>';
echo '<td>'.$row["sifra_djelatnika"].'</td>';
echo '<td>'.$row["ime"].'</td>';
echo '<td>'.$row["prezime"].'</td>';
echo '<td>'.$row["telefon"].'</td>';
echo '<td>'.$row["email"].'</td>';
echo '<td>'.$row["mjesto"].'</td>';
echo '<td>'.$row["adresa"].'</td>';

echo '<td><button name="brisi" type="submit" value="'.$row["sifra_djelatnika"].'">Obriši</button> </td>';
echo '</tr>';

}

unset($pdo);

if (isset($_POST["brisi"])) {
	

$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query='DELETE  FROM djelatnici WHERE sifra_djelatnika ='.$_POST["brisi"];
$result=$pdo->query($query);
//$stmt->bindParam(1, $_POST["brisi"]);
//$stmt->execute();

}
/*echo' <pre>';
print_r($_POST);
echo '<pre>';
*/
?>

</form>

</body>





</html>