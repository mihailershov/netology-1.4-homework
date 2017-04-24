<?php

error_reporting(E_ALL);

function isCityExist($city) {
    $file = strtolower( file_get_contents('cities/stringCities.txt') );
    $city = strtolower($city);
    if (strpos($file, $city) !== false) {
        return true;
    }
}

if (isset($_GET['cityname'])) {

    // Записываем в переменные api ключ и город, в котором мы хотим узнать погоду
    $appid = '05421c8275f4508a8eb320165d59f42a';
    $cityname = mb_convert_case($_GET['cityname'], MB_CASE_TITLE);

    $result = isCityExist($cityname);

    // Получаем информацию о городе через api запрос
    $weatherData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q={$cityname}&units=metric&APPID={$appid}");

    //
    // На случай недоступности сервера раскомментировать эту строку (только для разработки)
    //$weatherData = file_get_contents('weather.txt');
    //
    //

    // Преобразуем json файл в массив
        $weatherDataArray = json_decode($weatherData, true);
    // Записываем все необходимые данные в переменные
        $coord1 = $weatherDataArray['coord']['lon'];
        $coord2 = $weatherDataArray['coord']['lat'];
        $main = $weatherDataArray['main'];
        $weatherDecription = $weatherDataArray['weather']['0']['description'];
        $cloud = $weatherDataArray['clouds']['all'];
        $windSpeed = $weatherDataArray['wind']['speed'];
        $country = $weatherDataArray['sys']['country'];

    // Здесь мы преобразуем направление ветра из градусов в слова
        if ($weatherDataArray['wind']['deg'] !== null) {
            $windDeg = $weatherDataArray['wind']['deg'];
            $val = ($windDeg/22.5)+.5;
            $arr = array("северный", "северо-восточный", "восточный", "юго-восточный", "южный", "юго-западный", "западный", "северо-западный");
            $windDeg = $arr[($windDeg % 8)];
        }

    //
} else {
    $cityname = '';
    $result = true;
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>1.4-homework</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="wrapper">
    <div class="form">
        <p class="id">Введите название города:</p>
        <p class="example">Например: London, Moscow, San Diego</p>
        <p class="italic">все города, доступные в нашем сервисе,<br> можно посмотреть <a href="cities/cityid.php">здесь</a></p>
        <form action="index.php">
            <input type="text" placeholder="Введите город" value="" name="cityname" required>
            <button type="confirm">Поcмотреть погоду</button>
        </form>
    </div>
    <?php
        if (($result !== true) && ($cityname !== '')){
            echo "<p class='error'>Нет такого города (или вы опечатались). Воспользуйтесь нашим каталогом над формой ввода для проверки города</p>";
        } else if($cityname !== '') {
            include 'weather-block.php';
        }
    ?>
</div>
</body>
</html>