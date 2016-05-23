<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$pass = $_POST['pass'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$nom = $_POST['nom'];
$op = $_POST['oplata'];
$sotr = $_POST['sotr'];
$stmt = $db->prepare("UPDATE registration SET passport = '$pass', data_zas = '$date1', data_vis = '$date2', nom_komnaty = '$nom',
oplata_id = '$op', sotrudnik_id = '$sotr' WHERE registr_id = '$id'");
$stmt->execute();
//var_dump($stmt->execute());die;
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/registration.php");