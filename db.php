<?php
namespace lib;
use \PDO;
use \Exception;
class Db
{
    protected $db;

    public function connectDB()
    {
        $db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '123kjubrf');
        $db->exec("SET NAMES utf8");
        if (!$db) {
            throw new Exception('Не удалось подключиться к базе данных.');
        } else {
            return $db;
        }
    }
}