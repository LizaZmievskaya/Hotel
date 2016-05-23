<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$pass = $_POST['pass'];
$fam = $_POST['fam'];
$imya = $_POST['imya'];
$ot = $_POST['ot'];
$adres = $_POST['adres'];
$tel = $_POST['tel'];
$stmt = $db->prepare("INSERT INTO client VALUES ('$pass','$fam','$imya','$ot','$adres','$tel')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/clienty.php");