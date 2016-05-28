<?php
namespace lib;
include "../db.php";
class Popular extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT registration.passport, client.familia, sotrudnik.s_familia
FROM `sotrudnik` INNER JOIN (`client` INNER JOIN `registration` ON client.passport=registration.passport)
ON sotrudnik.sotrudnik_id=registration.sotrudnik_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Popular();
$rows = $out->fetchAll();

/*if (isset($_POST['menu'])){
    header("Location: http://localhost/hotel/index.php");
}*/
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
    <form method="post" action="../print.php">
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">
            <table class="title table table-striped">
                <tr>
                    <td width="200">Серия и № паспорта клиента</td>
                    <td width="450">Фамилия клиента</td>
                    <td width="450">Фамилия сотрудника</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="200"><?= $rows[$i]['passport']?></td>
                        <td width="450"><?= $rows[$i]['familia']?></td>
                        <td width="450"><?= $rows[$i]['s_familia']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <button name="menu" type="button" id="add" class="btn btn-default" style="float: left;" onclick="location.href='http://localhost/hotel/index.php'" id="header" Style="cursor: pointer;"">Главное меню</button>
        <input name="print" type="submit" id="add" class="btn btn-default" style="float: right;" value="PDF">
    </form>
</div>
</body>
</html>