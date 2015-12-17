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
<h1>PREGLED TRGOVINA</h1>

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
  =trgovine.broj_trgovine JOIN proizvodi ON
  proizvodi.broj_trgovine=trgovine.broj_trgovine  WHERE (mjesto LIKE :b OR adresa LIKE :b
  OR postanski_broj LIKE :b OR ime LIKE :b OR prezime LIKE :b OR naziv LIKE :b OR cijena LIKE :b) ';
  

  
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
  <th>Mjesto</th>
  <th>Adresa</th>
  <th>Pošt. broj</th>
  <th>Ime</th>
  <th>Prezime</th>
  <th>Naziv proizvoda</th>
  <th>Cijena</th>
  
  </tr>';
foreach ($rezultat as $key => $r) {
  
  echo '<tr>';
  echo '<td>'.$r->mjesto.'</td>';
  echo '<td>'.$r->adresa.'</td>';
  echo '<td>'.$r->postanski_broj.'</td>';
  echo '<td>'.$r->ime.'</td>';
  echo '<td>'.$r->prezime.'</td>';
  echo '<td>'.$r->naziv.'</td>';
  echo '<td>'.$r->cijena.'</td>';
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
$query='SELECT  mjesto, adresa, postanski_broj, ime, prezime, naziv, cijena
 FROM trgovine JOIN djelatnici ON djelatnici.broj_trgovine = trgovine.broj_trgovine
 JOIN proizvodi ON proizvodi.broj_trgovine=trgovine.broj_trgovine
 ORDER BY mjesto';
$result=$pdo->query($query);



echo '<table border="1">';

echo '<th>Mjesto </th>
       <th>Adresa</th>
       <th>Pošt. broj</th>
       <th>ime djelatnika</th>
       <th>prezime</th>
       <th>Naziv prozivoda</th>
       <th>Cijena</th>';


while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
	 
echo '<tr>';
echo '<td>'.$row["mjesto"].'</td>';
echo '<td>'.$row["adresa"].'</td>';
echo '<td>'.$row["postanski_broj"].'</td>';
echo '<td>'.$row["ime"].'</td>';
echo '<td>'.$row["prezime"].'</td>';
echo '<td>'.$row["naziv"].'</td>';
echo '<td>'.$row["cijena"].'</td>';

echo '</tr>';

}

unset($pdo);


?>

</form>

</body>





</html>