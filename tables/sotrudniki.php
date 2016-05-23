<?php
namespace lib;
include "../db.php";
class Sotrudnik extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `sotrudnik` LEFT JOIN `dolzhnost`
ON sotrudnik.dolzhnost_id=dolzhnost.dolzhnost_id
ORDER BY sotrudnik_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchDol(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `dolzhnost` ORDER BY dolzhnost_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Sotrudnik();
$rows = $out->fetchAll();
$dol = $out->fetchDol();

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
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">
            <table class="title table table-striped">
                <tr>
                    <td width="50">№</td>
                    <td width="150">Фамилия</td>
                    <td width="140">Имя</td>
                    <td width="150">Отчество</td>
                    <td width="150">Телефон</td>
                    <td width="250">Должность</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['sotrudnik_id']?>" data-fam="<?= $rows[$i]['s_familia']?>"
                        data-imya="<?= $rows[$i]['s_imya']?>" data-ot="<?= $rows[$i]['s_otchestvo']?>"
                        data-tel="<?= $rows[$i]['s_tel']?>" data-dol="<?= $rows[$i]['dolzhnost']?>">
                        <td width="50"><?= $rows[$i]['sotrudnik_id']?></td>
                        <td width="150"><?= $rows[$i]['s_familia']?></td>
                        <td width="140"><?= $rows[$i]['s_imya']?></td>
                        <td width="150"><?= $rows[$i]['s_otchestvo']?></td>
                        <td width="150"><?= $rows[$i]['s_tel']?></td>
                        <td width="250"><?= $rows[$i]['dolzhnost']?></td>
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
                        <input name="fam" type="text" class="form-control" id="inputFam" placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="imya" type="text" class="form-control" id="inputImya" placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="ot" type="text" class="form-control" id="inputOt" placeholder="Отчество">
                    </div>
                    <div class="form-horizontal m">
                        <input name="tel" type="tel" pattern="\([0-9]{3}\)[0-9]{2}\-[0-9]{3}\-[0-9]{2}"
                               required class="form-control" id="inputTel" placeholder="Телефон в формате (xxx)xx-хxx-xx">
                    </div>
                    <div class="form-horizontal m">
                        <label>Должность</label>
                        <select name="dolzhnost" class="form-control">
                            <?php for ($i = 0; $i < count($dol); $i++) {?>
                                <option value="<?= $dol[$i]['dolzhnost_id']?>"><?= $dol[$i]['dolzhnost']?></option>
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
            <form method="post" action="../update_sotr.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="fam" type="text" class="form-control" id="inputFam" placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="imya" type="text" class="form-control" id="inputImya" placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="ot" type="text" class="form-control" id="inputOt" placeholder="Отчество">
                    </div>
                    <div class="form-horizontal m">
                        <input name="tel" type="tel" pattern="\([0-9]{3}\)[0-9]{2}\-[0-9]{3}\-[0-9]{2}"
                               required class="form-control" id="inputTel" placeholder="Телефон в формате (xxx)xx-хxx-xx">
                    </div>
                    <div class="form-horizontal m">
                        <label>Должность</label>
                        <select name="dolzhnost" class="form-control">
                            <?php for ($i = 0; $i < count($dol); $i++) {?>
                                <option value="<?= $dol[$i]['dolzhnost_id']?>"><?= $dol[$i]['dolzhnost']?></option>
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
<script src="../js/actions_sotrudnik.js"></script>
</body>
</html>