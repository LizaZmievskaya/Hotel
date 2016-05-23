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
    public function fetchClass(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `class_nomera`");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Nomer();
$rows = $out->fetchAll();
$class = $out->fetchClass();

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
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.js"></script>
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
                    <tr data-nom="<?= $rows[$i]['nom_komnaty']?>" data-etazh="<?= $rows[$i]['etazh']?>"
                        data-mest="<?= $rows[$i]['kol_mest']?>" data-tel="<?= $rows[$i]['tel_nomera']?>"
                        data-vremya="<?= $rows[$i]['vremya_uborki']?>" data-naimenov="<?= $rows[$i]['naimenov']?>">
                        <td width="110"><?= $rows[$i]['nom_komnaty']?></td>
                        <td width="120"><?= $rows[$i]['etazh']?></td>
                        <td width="120"><?= $rows[$i]['kol_mest']?></td>
                        <td width="120"><?= $rows[$i]['tel_nomera']?></td>
                        <td width="120"><?= $rows[$i]['vremya_uborki']?></td>
                        <td width="300"><?= $rows[$i]['naimenov']?></td>
                        <td><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
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
                        <input name="nom" type="number" min="1" class="form-control" id="inputNom" required placeholder="Номер комнаты">
                    </div>
                    <div class="form-horizontal m">
                        <input name="etazh" type="number" min="0" class="form-control" id="inputEtazh" required placeholder="Этаж">
                    </div>
                    <div class="form-horizontal m">
                        <input name="mest" type="number" min="1" class="form-control" id="inputMest" required placeholder="Кол-во мест">
                    </div>
                    <div class="form-horizontal m">
                        <input name="tel" type="tel" pattern="[0-9]{7}"
                               required class="form-control" id="inputTel" placeholder="Телефон в формате xxxxxxx">
                    </div>
                    <div class="form-horizontal m">
                        <label>Время уборки</label>
                        <input name="vremya" type="time" step="1" required class="form-control" id="inputVremya">
                    </div>
                    <div class="form-horizontal m">
                        <label>Класс номера</label>
                        <select name="naimenov" class="form-control">
                            <?php for ($i = 0; $i < count($class); $i++) {?>
                                <option value="<?= $class[$i]['naimenov_id']?>"><?= $class[$i]['naimenov']?></option>
                            <?php } ?>
                        </select>
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
            <form method="post" action="../update_nomer.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="nom" type="number" min="1" class="form-control" id="inputNom" readonly placeholder="Номер комнаты">
                    </div>
                    <div class="form-horizontal m">
                        <input name="etazh" type="number" min="0" class="form-control" id="inputEtazh" required placeholder="Этаж">
                    </div>
                    <div class="form-horizontal m">
                        <input name="mest" type="number" min="1" class="form-control" id="inputMest" required placeholder="Кол-во мест">
                    </div>
                    <div class="form-horizontal m">
                        <input name="tel" type="tel" pattern="[0-9]{7}"
                               required class="form-control" id="inputTel" required placeholder="Телефон в формате xxxxxxx">
                    </div>
                    <div class="form-horizontal m">
                        <label>Время уборки</label>
                        <input name="vremya" type="time" step="1" required class="form-control" required id="inputVremya">
                    </div>
                    <div class="form-horizontal m">
                        <label>Класс номера</label>
                        <select name="naimenov" class="form-control" required>
                            <?php for ($i = 0; $i < count($class); $i++) {?>
                                <option value="<?= $class[$i]['naimenov_id']?>"><?= $class[$i]['naimenov']?></option>
                            <?php } ?>
                        </select>
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
<script src="../js/actions_nomera.js"></script>
</body>
</html>