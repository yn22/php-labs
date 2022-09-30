<?php

// import lab5
require_once("../lab5/WeatherInfo.php");

define("IMG_WIDTH", 1000);
define("IMG_HEIGHT", 500);
define("FONT_FILE", './fonts/OpenSans.ttf');

$city = $_GET['city'];

$weather_info = new WeatherInfo("https://www.gismeteo.ua/ua/weather-" . $city . "/");


function renderWeatherInfoToImg($weather_info)
{
    $im = imagecreatetruecolor(IMG_WIDTH + 100, IMG_HEIGHT);
    imageantialias($im, true);

    $black = imagecolorallocate($im, 0x00, 0x00, 0x00);
    $blue = imagecolorallocate($im, 0x00, 0x00, 0xFF);
    $red = imagecolorallocate($im, 0xFF, 0x00, 0x00);
    $light_gray = imagecolorallocate($im, 0x80, 0x80, 0x80);

    imagefilledrectangle($im, 0, 0, 499, 199, $black);

    $left = imagecreatefrompng('./data/left.png');
    $right = imagecreatefrompng('./data/right.png');

    $suncrise = $weather_info->sunrise;
    $sunset = $weather_info->sunset;

    $sunrise_seconds = (int)explode(":", $suncrise)[0] * 3600 + (int)explode(":", $suncrise)[1] * 60;

    $sunset_seconds = (int)explode(":", $sunset)[0] * 3600 + (int)explode(":", $sunset)[1] * 60;

    $left_percent = (int)($sunrise_seconds * 100 / (24 * 3600));
    $left_point = (int)($left_percent * 1000 / 100);

    $right_percent = (int)($sunset_seconds * 100 / (24 * 3600));
    $right_point = (int)($right_percent * 1000 / 100);

    $center = imagecreatefrompng('./data/center.png');

    $center_point = $right_point - $left_point - 50;

    imagecopyresized($im, $left, $left_point, 0, 0, 0, 50, 445, 100, 100);
    imagecopyresized($im, $right, $right_point, 0, 0, 0, 50, 445, 100, 100);
    imagecopyresized($im, $center, $left_point + 50, 0, 0, 0, $center_point, 445, 100, 100);

    $temperature = $weather_info->temperature_during_day_as_array;
    $i = 5;
    $step = IMG_WIDTH / count($temperature);
    $points = array();

    foreach ($temperature as $key => $value) {
        $x = $i;
        $y = (IMG_HEIGHT / 2 - $value * 10) + 100;
        imagefttext($im, 20, 0, $x, $y, $blue, FONT_FILE, $value);
        $i += $step;
        array_push($points, array($x, $y));
    }

    for ($i = 0; $i < count($points) - 1; $i++) {
        $x1 = $points[$i][0] + 10;
        $y1 = $points[$i][1] + 15;
        $x2 = $points[$i + 1][0] + 10;
        $y2 = $points[$i + 1][1] + 15;
        imageline($im, $x1, $y1, $x2, $y2, $red);
    }

    imagefttext($im, 20, 0, 82, 55, $light_gray, FONT_FILE, "Погода у м. " . $weather_info->city . " на " . $weather_info->date);

    $i = 20;

    foreach ($temperature as $key => $value) {
        $x = $i;
        $y = 470;
        imagefttext($im, 20, 0, $x - 5, $y, $blue, FONT_FILE, $key);
        imageline($im, $x, $y - 25, $x + $step, $y - 25, $red);
        imageline($im, $x, $y - 25, $x, $y - 50, $red);
        $i += $step;
    }

    imagefttext($im, 20, 0, $x + $step, $y, $blue, FONT_FILE, "24");
    $x = count($temperature) * $step + 20;

    imageline($im, $x, 470 - 25, $x, 470 - 50, $red);
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
}

renderWeatherInfoToImg($weather_info);
