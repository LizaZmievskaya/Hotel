<?php
namespace lib;
include "../db.php";
class Svobodnie extends Db {
    /*public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `nomer` LEFT JOIN `registration`
ON nomer.nom_komnaty=registration.nom_komnaty WHERE registr_id=0");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }*/
    public function fetchKol(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT registration.passport, client.familia, client.imya, client.otchestvo,
registration.data_zas, registration.data_vis, registration.nom_komnaty, registration.data_vis-registration.data_zas
AS kol_vo_sutok, cena_chel_sutki*( registration.data_vis-registration.data_zas) AS stoim_chel
FROM ((class_nomera INNER JOIN nomer ON class_nomera.naimenov_id=nomer.naimenov_id)
INNER JOIN registration ON nomer.nom_komnaty=registration.nom_komnaty)
INNER JOIN client ON client.passport=registration.passport");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Svobodnie();
$rows = $out->fetchKol();

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
                    <td width="130">Серия и № паспорта</td>
                    <td width="140">Фамилия</td>
                    <td width="120">Имя</td>
                    <td width="140">Отчество</td>
                    <td width="110">Дата заселения</td>
                    <td width="110">Дата выселения</td>
                    <td width="100">№ комнаты</td>
                    <td width="100">Кол-во дней</td>
                    <td width="120">Стоимость</td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="130"><?= $rows[$i]['passport']?></td>
                        <td width="140"><?= $rows[$i]['familia']?></td>
                        <td width="120"><?= $rows[$i]['imya']?></td>
                        <td width="140"><?= $rows[$i]['otchestvo']?></td>
                        <td width="110"><?= date('d.m.Y', strtotime($rows[$i]['data_zas']))?></td>
                        <td width="110"><?= date('d.m.Y', strtotime($rows[$i]['data_vis']))?></td>
                        <td width="100"><?= $rows[$i]['nom_komnaty']?></td>
                        <td width="100"><?= $rows[$i]['kol_vo_sutok']?></td>
                        <td width="120"><?= $rows[$i]['stoim_chel']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <button name="menu" type="submit" id="add" class="btn btn-default" style="float: left;">Главное меню</button>
    </form>
</div>
</body>
</html>