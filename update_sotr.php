<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$fam = $_POST['fam'];
$imya = $_POST['imya'];
$ot = $_POST['ot'];
$tel = $_POST['tel'];
$dol = $_POST['dolzhnost'];
$stmt = $db->prepare("UPDATE sotrudnik SET s_familia = '$fam', s_imya = '$imya', s_otchestvo = '$ot', s_tel = '$tel',
dolzhnost_id = '$dol' WHERE sotrudnik_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/sotrudniki.php");