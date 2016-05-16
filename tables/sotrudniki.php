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
}
$out = new Sotrudnik();
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
                    <tr>
                        <td width="50"><?= $rows[$i]['sotrudnik_id']?></td>
                        <td width="150"><?= $rows[$i]['s_familia']?></td>
                        <td width="140"><?= $rows[$i]['s_imya']?></td>
                        <td width="150"><?= $rows[$i]['s_otchestvo']?></td>
                        <td width="150"><?= $rows[$i]['s_tel']?></td>
                        <td width="250"><?= $rows[$i]['dolzhnost']?></td>
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