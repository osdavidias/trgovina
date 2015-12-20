<!Doctype-html>
<html>
<head>

<title>Trgovina - unos i pregled podataka</title>
<meta charset="UTF-8">
<meta name="description" content="Unos proizvoda i djelatnika u trgovinu i pregled">
<meta name="keywords" content="Trgovina, djelatnici, proizvodi, pregled">
<link rel="stylesheet" type="text/css" href="css.css">


</head>






<body>

<?php

include 'connection.php';

?>

<br>
<h1>PREGLED PROIZVODA PO TRGOVINAMA</h1>
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
  $query='SELECT * FROM proizvodi JOIN trgovine ON proizvodi.broj_trgovine
  =trgovine.broj_trgovine WHERE (sifra_proizvoda LIKE :b OR naziv LIKE :b
  OR cijena LIKE :b OR mjesto LIKE :b OR adresa LIKE :b OR postanski_broj LIKE :b) ';
  

  /*'SELECT naziv FROM proizvodi'; JOIN trgovine ON proizvodi.broj_trgovine
  =trgovine.broj_trgovine  WHERE naziv LIKE "%'.$a.'%" OR cijena LIKE "%'.$a.'%"
OR sifra_proizvoda LIKE "%'.$a.'%" OR broj_trgovine LIKE "%'.$a.'%"'; */
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
  <th>Šifra proizvoda</th>
  <th>Naziv</th>
  <th>Cijena</th>
  <th>Mjesto trgovine</th>
  <th>Adresa</th>
  <th>Poštanski broj</th>
  </tr>';
foreach ($rezultat as $key => $r) {
  
  echo '<tr>';
  echo '<td>'.$r->sifra_proizvoda.'</td>';
  echo '<td>'.$r->naziv.'</td>';
  echo '<td>'.$r->cijena.'</td>';
  echo '<td>'.$r->mjesto.'</td>';
  echo '<td>'.$r->adresa.'</td>';
  echo '<td>'.$r->postanski_broj.'</td>';
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
$pdo=new PDO ("mysql:host=$host;dbname=$baza", $user, $pass);
$query='SELECT sifra_proizvoda, naziv, cijena, mjesto,
adresa, postanski_broj FROM proizvodi JOIN trgovine
ON trgovine.broj_trgovine=proizvodi.broj_trgovine';
$result=$pdo->query($query);



echo '<table border="1">';

echo '<th>Šifra proizvoda</th>
       <th>Naziv</th>
       <th>Cijena</th>
       <th>Mjesto trgovine</th>
       <th>Adresa</th>
       <th>Poštanski broj</th>
       <th>Obriši proizvod</th>';


while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
	 
echo '<tr>';
echo '<td>'.$row["sifra_proizvoda"].'</td>';
echo '<td>'.$row["naziv"].'</td>';
echo '<td>'.$row["cijena"].'</td>';
echo '<td>'.$row["mjesto"].'</td>';
echo '<td>'.$row["adresa"].'</td>';
echo '<td>'.$row["postanski_broj"].'</td>';
echo '<td><button name="brisi" type="submit" value="'.$row["sifra_proizvoda"].'">Obriši</button> </td>';
echo '</tr>';

}

unset($pdo);

if (isset($_POST["brisi"])) {
	

$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query='DELETE  FROM proizvodi WHERE sifra_proizvoda ='.$_POST["brisi"];
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