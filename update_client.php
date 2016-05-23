<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$pass = $_POST['pass'];
$fam = $_POST['fam'];
$imya = $_POST['imya'];
$ot = $_POST['ot'];
$adres = $_POST['adres'];
$tel = $_POST['tel'];
$stmt = $db->prepare("UPDATE `client` SET `familiya` = '$fam', `imya` = '$imya', `otchestvo` = '$ot',
`adres` = '$adres', `telephone` = '$tel' WHERE `passport` = '$pass'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/clienty.php");