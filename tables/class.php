<?php
namespace lib;
include "../db.php";
class Classes extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `class_nomera` ORDER BY naimenov_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Classes();
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
                    <td width="90">№</td>
                    <td width="600">Наименование</td>
                    <td width="200">Цена за чел. в сутки</td>
                    <td width="260"></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['naimenov_id']?>">
                        <td width="90"><?= $rows[$i]['naimenov_id']?></td>
                        <td width="600"><?= $rows[$i]['naimenov']?></td>
                        <td width="200"><?= $rows[$i]['cena_chel_sutki']?></td>
                        <td width="260"><button name="change" type="button" class="btn btn-default">Изменить</button>
                            <input name="delete" type="button" class="btn btn-default" value="Удалить"></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <button id="add" type="button" class="btn btn-default">Добавить запись</button>
        <button name="menu" type="submit" id="add" class="btn btn-default" style="float: left;">Главное меню</button>
    </form>
</div>
<script src="../js/actions_registr.js"></script>
</body>
</html>