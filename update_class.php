<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$naimenov = $_POST['naimenov'];
$cena = $_POST['cena'];
$stmt = $db->prepare("UPDATE class_nomera SET naimenov = '$naimenov', cena_chel_sutki='$cena' WHERE naimenov_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/class.php");