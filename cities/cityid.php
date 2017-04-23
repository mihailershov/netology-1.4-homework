<?php

$stringCities = file_get_contents('stringCities.txt');
if (isset($_POST['randomCityButton'])) {
    $cities = glob("cities/*.json");
    $array = ['cities/', '.json'];
    $arrayReplace = ['', ''];
    $randomCity = ucfirst(str_replace($array, $arrayReplace, $cities[mt_rand(0, count($cities)-1)]));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
 	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta charset="UTF-8">
    <link rel="stylesheet" href="../style/cityid.css">
	<title>Каталог городов</title>
</head>
<body>
    <div class="wrapper">
        <div class="allwidth">
            <a href="../index.php"><p class="back">< Вернуться на главную</p></a>
        </div>
        <p>Нажмите сочетание клавиш CTRL + F, чтобы открыть поиск, после введите город и проверьте, существует ли он в нашей базе</p>
        <p>Также вы можете нажать на кнопку и получить абсолютно случайный город, а после использовать его на главной странице, чтобы узнать погоду</p>
        <div class="random">
            <form action="cityid.php" method="POST">
                <button type="submit" name="randomCityButton">Выбрать случайный город</button>
            </form>
            <p><a href="../index.php?cityname=<?= $randomCity ?>"><?php if(isset($randomCity)) echo "$randomCity"; ?></a></p>
        </div>
        <pre><?= $stringCities; ?></pre>
    </div>
</body>
</html>