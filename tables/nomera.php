<?php
namespace lib;
include "../db.php";
class Nomer extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `nomer` LEFT JOIN `class_nomera` ON nomer.naimenov_id=class_nomera.naimenov_id
ORDER BY etazh");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Nomer();
$rows = $out->fetchAll();

if (isset($_POST['menu'])){
    header("Location: http://localhost/hotel/index.php");
}
//var_dump($rows);die;
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">.
            <table class="title table table-striped">
                <tr>
                    <td width="110">№ комнаты</td>
                    <td width="120">Этаж</td>
                    <td width="120">Кол-во мест</td>
                    <td width="120">Телефон номера</td>
                    <td width="120">Время уборки</td>
                    <td width="300">Класс номера</td>
                    <td width="260"></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table" style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="110"><?= $rows[$i]['nom_komnaty']?></td>
                        <td width="120"><?= $rows[$i]['etazh']?></td>
                        <td width="120"><?= $rows[$i]['kol_mest']?></td>
                        <td width="120"><?= $rows[$i]['tel_nomera']?></td>
                        <td width="120"><?= $rows[$i]['vremya_uborki']?></td>
                        <td width="300"><?= $rows[$i]['naimenov']?></td>
                        <td><button type="button" class="btn btn-default">Изменить</button>
                            <button type="button" class="btn btn-default">Удалить</button></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <button id="add" type="button" class="btn btn-default">Добавить запись</button>
        <button name="menu" type="submit" id="add" class="btn btn-default" style="float: left;">Главное меню</button>
    </form>
</div>
</body>
</html>