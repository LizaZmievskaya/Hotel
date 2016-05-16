<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$dol = $_POST['dolzhnost'];
$stmt = $db->prepare("INSERT INTO dolzhnost VALUES ('','$dol')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/dolzhnost.php");