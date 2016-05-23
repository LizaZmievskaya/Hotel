<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$nom = $_POST['nom'];
$etazh = $_POST['etazh'];
$mest = $_POST['mest'];
$tel = $_POST['tel'];
$vremya = $_POST['vremya'] . ':00'; //WTF?????
$naimenov = $_POST['naimenov'];
$stmt = $db->prepare("INSERT INTO nomer VALUES ('$nom','$etazh','$mest','$tel','$vremya','$naimenov')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/nomera.php");