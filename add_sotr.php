<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$fam = $_POST['fam'];
$imya = $_POST['imya'];
$ot = $_POST['ot'];
$tel = $_POST['tel'];
$dol = $_POST['dolzhnost'];
$stmt = $db->prepare("INSERT INTO sotrudnik VALUES ('','$fam','$imya','$ot','$tel','$dol')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/sotrudniki.php");