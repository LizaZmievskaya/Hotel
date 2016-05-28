<?php
if (isset($_POST['registration'])){
    header("Location: tables/registration.php");
} elseif (isset($_POST['clienty'])){
    header("Location: tables/clienty.php");
} elseif (isset($_POST['nomera'])){
    header("Location: tables/nomera.php");
} elseif (isset($_POST['class'])){
    header("Location: tables/class.php");
} elseif (isset($_POST['sotrudniki'])){
    header("Location: tables/sotrudniki.php");
} elseif (isset($_POST['dolzhnost'])){
    header("Location: tables/dolzhnost.php");
} elseif (isset($_POST['svobodnie'])){
    header("Location: tables/kolichestvo.php");
} elseif (isset($_POST['popular'])){
    header("Location: tables/popular.php");
} elseif (isset($_POST['oformlenie'])){
    header("Location: tables/oformlenie.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <form method="post">
        <div class="list">
            <button name="registration" type="submit" class="btn btn-default">Регистрация</button>
            <button name="clienty" type="submit" class="btn btn-default">Клиенты</button>
            <button name="nomera" type="submit" class="btn btn-default">Номера</button>
            <button name="class" type="submit" class="btn btn-default">Классы номеров</button>
            <button name="sotrudniki" type="submit" class="btn btn-default">Сотрудники</button>
            <button name="dolzhnost" type="submit" class="btn btn-default">Должности</button>
            <button name="svobodnie" type="submit"  class="btn btn-default" style="margin-top: 30px;">Кол-во дней проживания</button>
            <button name="oformlenie" type="submit" class="btn btn-default">Оформление</button>
            <button name="popular" type="submit" class="btn btn-default">Популярность номеров</button>
        </div>
    </form>

</div>
</body>
</html>