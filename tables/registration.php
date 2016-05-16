<?php
namespace lib;
include "../db.php";
class Registr extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `registration` LEFT JOIN `client` ON registration.passport=client.passport
LEFT JOIN `vid_oplaty` ON registration.oplata_id=vid_oplaty.oplata_id
LEFT JOIN `nomer` ON registration.nom_komnaty=nomer.nom_komnaty
LEFT JOIN `sotrudnik` ON registration.sotrudnik_id=sotrudnik.sotrudnik_id
ORDER BY registr_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchNom(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `nomer` ORDER BY nom_komnaty");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchOplata(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `vid_oplaty`");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Registr();
$rows = $out->fetchAll();
$nom = $out->fetchNom();
$oplata = $out->fetchOplata();
//$books = $out->fetchBooks();
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
                    <td width="50">№</td>
                    <td width="120">№ паспорта</td>
                    <td width="120">Дата заселения</td>
                    <td width="120">Дата выселения</td>
                    <td width="100">№ комнаты</td>
                    <td width="150">Оплата</td>
                    <td width="230">Сотрудник</td>
                    <td width="260"></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['registr_id']?>" data-zas="<?= $rows[$i]['data_zas']?>" data-vis="<?= $rows[$i]['data_vis']?>"
                        data-pass="<?= $rows[$i]['passport']?>" data-nom="<?= $rows[$i]['nom_komnaty']?>" data-oplata="<?= $rows[$i]['oplata']?>"
                        data-s-fam="<?= $rows[$i]['s_familia']?>" data-s-imya="<?= $rows[$i]['s_imya']?>">
                        <td width="50"><?= $rows[$i]['registr_id']?></td>
                        <td width="120"><?= $rows[$i]['passport']?></td>
                        <td width="120"><?= date('d.m.Y', strtotime($rows[$i]['data_zas']))?></td>
                        <td width="120"><?= date('d.m.Y', strtotime($rows[$i]['data_vis']))?></td>
                        <td width="100"><?= $rows[$i]['nom_komnaty']?></td>
                        <td width="150"><?= $rows[$i]['oplata']?></td>
                        <td width="115"><?= $rows[$i]['s_familia']?></td>
                        <td width="115"><?= $rows[$i]['s_imya']?></td>
                        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
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
                        <input name="pass" type="text" class="form-control" id="inputPass" placeholder="№ паспорта">
                    </div>
                    <div class="form-horizontal date m">
                        <label>Дата заселения</label>
                        <input name="date1" type="date" class="form-control" id="inputData1" min="<?= date('Y-m-d')?>">
                    </div>
                    <div class="form-horizontal date right m">
                        <label>Дата выселения</label>
                        <input name="date2" type="date" class="form-control" id="inputData2">
                    </div>
                    <div class="form-horizontal m">
                        <select name="room" class="form-control">
                            <?php for ($i = 0; $i < count($nom); $i++) {?>
                                <option><?= $nom[$i]['nom_komnaty']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <select name="oplata" class="form-control">
                            <?php for ($i = 0; $i < count($oplata); $i++) {?>
                                <option><?= $oplata[$i]['oplata']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <input name="sname" type="text" class="form-control" id="inputSname" placeholder="Фамилия сотрудника">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fname" type="text" class="form-control" id="inputFname" placeholder="Имя сотрудника">
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
                        <input name="pass" type="text" class="form-control" id="inputPass" placeholder="№ паспорта">
                    </div>
                    <div class="form-horizontal date m">
                        <label>Дата заселения</label>
                        <input name="date1" type="date" class="form-control" id="inputData1" min="<?= date('Y-m-d')?>">
                    </div>
                    <div class="form-horizontal date right m">
                        <label>Дата выселения</label>
                        <input name="date2" type="date" class="form-control" id="inputData2">
                    </div>
                    <div class="form-horizontal m">
                        <select name="room" class="form-control">
                            <?php for ($i = 0; $i < count($nom); $i++) {?>
                                <option><?= $nom[$i]['nom_komnaty']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <select name="oplata" class="form-control">
                            <?php for ($i = 0; $i < count($oplata); $i++) {?>
                                <option><?= $oplata[$i]['oplata']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <input name="sname" type="text" class="form-control" id="inputSname" placeholder="Фамилия сотрудника">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fname" type="text" class="form-control" id="inputFname" placeholder="Имя сотрудника">
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
<script src="../js/actions_registr.js"></script>
</body>
</html>