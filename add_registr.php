<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$pass = $_POST['pass'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$nom = $_POST['nom'];
$op = $_POST['oplata'];
$sotr = $_POST['sotr'];

/*$s = $db->prepare("SELECT s_familia, s_imya FROM sotrudnik WHERE sotrudnik_id='$sotr'");
$s->execute();
$res = $s->fetchAll();
$s_fam = $res['s_familia'];
$s_imya = $res['s_imya'];*/

$stmt = $db->prepare("INSERT INTO registration VALUES ('','$pass','$date1','$date2','$nom','$op','$sotr')");
$stmt->execute();
//var_dump($stmt->execute());die;
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/registration.php");