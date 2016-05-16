<?php

$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$table = $_POST['table'];
$stmt = $db->prepare("DELETE FROM '$table' WHERE dolzhnost_id = '$id'");
$stmt->execute();
echo json_encode(['status'=>'success']);//NEVEDOMAYA HUJNYA