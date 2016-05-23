<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$naimenov = $_POST['naimenov'];
$cena = $_POST['cena'];
$stmt = $db->prepare("INSERT INTO class_nomera VALUES ('','$naimenov','$cena')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/class.php");