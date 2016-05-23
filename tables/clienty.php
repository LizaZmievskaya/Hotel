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
                    <tr data-pass="<?= $rows[$i]['passport']?>" data-fam="<?= $rows[$i]['familia']?>"
                        data-imya="<?= $rows[$i]['imya']?>" data-ot="<?= $rows[$i]['otchestvo']?>"
                        data-adres="<?= $rows[$i]['adres']?>" data-tel="<?= $rows[$i]['telephone']?>">
                        <td width="130"><?= $rows[$i]['passport']?></td>
                        <td width="120"><?= $rows[$i]['familia']?></td>
                        <td width="110"><?= $rows[$i]['imya']?></td>
                        <td width="130"><?= $rows[$i]['otchestvo']?></td>
                        <td width="250"><?= $rows[$i]['adres']?></td>
                        <td width="150"><?= $rows[$i]['telephone']?></td>
                        <td><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                            <input name="delete" type="submit" class="btn btn-default" value="Удалить"></td>
                    </tr>
                <?php } ?>
            </table>
            <button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: left;">Главное меню</button>
        </div>
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
                        <input name="pass" type="tel" pattern="[А-Я]{2}\s[0-9]{7}" class="form-control"
                               required id="inputPass" placeholder="Серия и № паспорта в формате АА 111111">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fam" type="text" class="form-control" id="inputFam" required placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="imya" type="text" class="form-control" id="inputImya" required placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="ot" type="text" class="form-control" id="inputOt" required placeholder="Отчество">
                    </div>
                    <div class="form-horizontal m">
                        <input name="adres" type="text" class="form-control" id="inputAdres" required placeholder="Адрес">
                    </div>
                    <div class="form-horizontal m">
                        <input name="tel" type="tel" pattern="\([0-9]{3}\)[0-9]{7}"
                               required class="form-control" id="inputTel" placeholder="Телефон в формате (xxx)xxхxxxx">
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
            <form method="post" action="../update_client.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="pass" type="tel" pattern="[А-Я]{2}\s[0-9]{7}" class="form-control"
                               required id="inputPass" readonly placeholder="Серия и № паспорта в формате АА 111111">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fam" type="text" class="form-control" id="inputFam" required placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="imya" type="text" class="form-control" id="inputImya" required placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="ot" type="text" class="form-control" id="inputOt" required placeholder="Отчество">
                    </div>
                    <div class="form-horizontal m">
                        <input name="adres" type="text" class="form-control" id="inputAdres" required placeholder="Адрес">
                    </div>
                    <div class="form-horizontal m">
                        <input name="tel" type="tel" pattern="\([0-9]{3}\)[0-9]{7}"
                               required class="form-control" id="inputTel" placeholder="Телефон в формате (xxx)xxхxxxx">
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
<script src="../js/actions_clienty.js"></script>
</body>
</html>