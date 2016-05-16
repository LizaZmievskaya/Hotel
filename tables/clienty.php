<?php
namespace lib;
include "../db.php";
class Clienty extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `client` ORDER BY familia");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Clienty();
$rows = $out->fetchAll();

if (isset($_POST['menu'])){
    header("Location: http://localhost/hotel/index.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">
            <table class="title table table-striped">
                <tr>
                    <td width="130">№ Паспорта</td>
                    <td width="120">Фамилия</td>
                    <td width="110">Имя</td>
                    <td width="130">Отчество</td>
                    <td width="250">Адрес</td>
                    <td width="150">Телефон</td>
                    <td width="260"></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="130"><?= $rows[$i]['passport']?></td>
                        <td width="120"><?= $rows[$i]['familia']?></td>
                        <td width="110"><?= $rows[$i]['imya']?></td>
                        <td width="130"><?= $rows[$i]['otchestvo']?></td>
                        <td width="250"><?= $rows[$i]['adres']?></td>
                        <td width="150"><?= $rows[$i]['telephone']?></td>
                        <td><button type="button" class="btn btn-default">Изменить</button>
                            <button type="button" class="btn btn-default">Удалить</button></td>
                    </tr>
                <?php } ?>
            </table>
            <button id="add" type="button" class="btn btn-default">Добавить запись</button>
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: left;">Главное меню</button>
        </div>
    </form>
</div>
<script src="../js/actions_readers.js"></script>
</body>
</html>