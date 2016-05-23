<?php
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET NAMES utf8");
$nom = $_POST['nom'];
$etazh = $_POST['etazh'];
$mest = $_POST['mest'];
$tel = $_POST['tel'];
$vremya = $_POST['vremya'] . ":00"; //WTF?????
$naimenov = $_POST['naimenov'];
$stmt = $db->prepare("UPDATE nomer SET etazh = '$etazh', kol_mest = '$mest', tel_nomera = '$tel',
vremya_uborki = '$vremya', naimenov_id = '$naimenov' WHERE nom_komnaty = '$nom'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/hotel/tables/nomera.php");