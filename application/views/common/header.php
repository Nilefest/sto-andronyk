<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">

    <title>
        <?php echo $title ?> |
        <?php echo $description ?>
    </title>

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><!---->
    <link rel="stylesheet" href="/application/public/css/bootstrap.css">
    <link rel="stylesheet" href="/application/public/css/bootstrap.css">
    <link rel="stylesheet" href="/application/public/css/icomoon.css">
    <link rel="stylesheet" href="/application/public/css/all.css">

    <!-- Optional CSS -->
    <?php if(isset($css)): foreach($css as $style):?>
    <link href="/application/public/css/<?php echo $style;?>.css" rel="stylesheet">
    <?php endforeach; endif; ?>

    <!-- jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!---->
    <script src="/application/public/js/jquery.js" type="text/javascript" charset="utf-8"></script>

</head>

<body>
    <header>
        <img class="logo" src="/application/public/img/service.png" alt="Logo">
        <h1>СТО</h1>
        <div class="clear"></div>
        <div class="nav">
            <img class="menu" src="/application/public/img/ico/menu.png" alt="menu">
            <ul>
                <li><a href="/info"><span>Главная</span><img src="/application/public/img/ico/info.png" alt="info"></a></li>
                <li><a href="/clients"><span>Клиент</span><img src="/application/public/img/ico/client.png" alt="client"></a></li>
                <li><a href="/employees"><span>Сотрудники</span><img src="/application/public/img/ico/employee.png" alt="employee"></a></li>
                <li><a href="/stock"><span>Склад</span><img src="/application/public/img/ico/stock.png" alt="stock"></a></li>
                <li><a href="/work"><span>Работы</span><img src="/application/public/img/ico/work.png" alt="work"></a></li>
                <li><a href="/report"><span>Отчёт</span><img src="/application/public/img/ico/report.png" alt="report"></a></li>
                <li><a href="?logout=1"><span>Выйти</span><img src="/application/public/img/ico/logout.png" alt="info"></a></li>
            </ul>
        </div>
    </header>
    <div class="content">
