<div class="weather">
    <h1>Погода в <?= "$cityname ($country)" ?> (coord: <a href="https://www.google.ru/maps/place/@<?= "$coord2,$coord1" ?>,12z" target="_blank"><?= "x:$coord2, y:$coord1" ?></a>):</h1>
    <p>На небе сейчас <?= $weatherDecription ?>, <?= $cloud ?>% облачности</p>
    <p>Температура: <?= $main['temp']; ?> &#8451;, погрешность: верхная граница: <?= $main['temp_max']; ?> &#8451;, нижняя граница: <?= $main['temp_min']?> &#8451;</p>
    <p>Влажность: <?= $main['humidity']; ?>%, давление: <?= $main['pressure']; ?> Pa</p>
    <p>Скорость ветра: <?= $windSpeed; ?> м/c, направление ветра: <?= $windDeg; ?></p>
</div>