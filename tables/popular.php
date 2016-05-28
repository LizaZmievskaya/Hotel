<?php
namespace lib;
include "../db.php";
class Popular extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT COUNT(naimenov) AS num, naimenov
FROM registration LEFT JOIN nomer ON registration.nom_komnaty=nomer.nom_komnaty
LEFT JOIN class_nomera ON nomer.naimenov_id=class_nomera.naimenov_id GROUP BY naimenov");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Popular();
$rows = $out->fetchAll();

?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>

</head>
<body>
<div class="container">
    <form method="post">
        <button name="menu" type="button" id="add" class="btn btn-default" style="float: left;" onclick="location.href='http://localhost/hotel/index.php'" id="header" Style="cursor: pointer;"">Главное меню</button>
    </form>
    <div id="chartdiv" style="width: 100%; height: 500px; float: top;" ></div>
</div>
<!-- amCharts javascript code -->
<script type="text/javascript">
    AmCharts.makeChart("chartdiv",
        {
            "type": "pie",
            "angle": 12,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "depth3D": 15,
            "labelTickColor": "#FFFFFF",
            "titleField": "category",
            "valueField": "column-1",
            "color": "#FFFFFF",
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": true,
                "align": "center",
                "markerType": "circle",
                "color": "#FFFFFF"
            },
            "titles": [
                {
                    "id": "Title-1",
                    "size": 18,
                    "text": "Популярность классов номеров",
                    "color": "white"
                }
            ],
            "dataProvider": [
                <?php for ($i = 0; $i < count($rows); $i++){?>
                {

                    "category": "<?php echo $rows[$i]['naimenov']?>",
                    "column-1": "<?php echo $rows[$i]['num']?>",
                    "color": "white"
                },
                <?php } ?>
            ]
        }
    );
</script>
</body>
</html>