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
                    <tr data-id="<?= $rows[$i]['naimenov_id']?>" data-naim="<?= $rows[$i]['naimenov']?>" data-cena="<?= $rows[$i]['cena_chel_sutki']?>">
                        <td width="90"><?= $rows[$i]['naimenov_id']?></td>
                        <td width="600"><?= $rows[$i]['naimenov']?></td>
                        <td width="200"><?= $rows[$i]['cena_chel_sutki']?></td>
                        <td width="260"><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                            <input name="delete" type="submit" class="btn btn-default" value="Удалить"></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>
        <button name="menu" type="submit" id="add" class="btn btn-default" style="float: left;">Главное меню</button>
    </form>
</div>
<!--ADD MODAL-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Добавление новой записи</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="naimenov" type="text" class="form-control" id="inputNaimenov" placeholder="Наименование класса">
                    </div>
                    <div class="form-horizontal m">
                        <input name="cena" type="number" step="0.01" min="0" class="form-control" id="inputCena" placeholder="Цена за чел. в сутки">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button name="add" type="submit" class="btn btn-default" onclick="location.reload();">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--EDIT MODAL-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Редактирование записи</h4>
            </div>
            <form method="post" action="../update_class.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="naimenov" type="text" class="form-control" id="inputNaimenov" placeholder="Наименование класса">
                    </div>
                    <div class="form-horizontal m">
                        <input name="cena" type="number" step="0.01" min="0" class="form-control" id="inputCena" placeholder="Цена за чел. в сутки">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button name="save" type="submit" class="btn btn-default" onclick="location.reload();">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/actions_class.js"></script>
</body>
</html>