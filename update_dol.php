<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$dolzhnost = $_POST['dolzhnost'];
$stmt = $db->prepare("UPDATE dolzhnost SET dolzhnost = '$dolzhnost' WHERE dolzhnost_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/dolzhnost.php");