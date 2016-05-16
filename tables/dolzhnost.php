<?php
namespace lib;
include "../db.php";
class Dolzhnost extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `dolzhnost` ORDER BY dolzhnost_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Dolzhnost();
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
                    <td width="150">№</td>
                    <td width="700">Должность</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['dolzhnost_id']?>" data-dol="<?= $rows[$i]['dolzhnost']?>">
                        <td width="150"><?= $rows[$i]['dolzhnost_id']?></td>
                        <td width="700"><?= $rows[$i]['dolzhnost']?></td>
                        <td><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                            <input name="del" type="submit" class="btn btn-default" value="Удалить"></td>
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
                <form method="post" action="../add_dol.php">
                    <div class="modal-body">
                        <div class="form-horizontal m">
                            <input name="dolzhnost" type="text" class="form-control" id="inputDol" placeholder="Должность">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button name="add" type="submit" class="btn btn-default">Сохранить</button>
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
                <form method="post">
                    <div class="modal-body">
                        <div class="form-horizontal m">
                            <input name="dolzhnost" type="text" class="form-control" id="inputDol" placeholder="Должность">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button name="add" type="submit" class="btn btn-default">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
</div>
<script src="../js/actions_dolzhnost.js"></script>
</body>
</html>