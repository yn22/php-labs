<?php

// import lab5
require_once("../lab5/WeatherInfo.php");

define("IMG_WIDTH", 1000);
define("IMG_HEIGHT", 500);
define("FONT_FILE", './fonts/OpenSans.ttf');

$weather_infos = array(
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-kharkiv-5053/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-kyiv-4944/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-donetsk-5080/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-dnipro-5077/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-moscow-4368/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-tampere-471/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-london-744/"),
    new WeatherInfo("https://www.gismeteo.ua/ua/weather-barcelona-1948/"),
);

function renderWeatherInfoToImg($weather_infos)
{
    foreach ($weather_infos as $weather_info) {
        $im = imagecreatetruecolor(IMG_WIDTH + 100, IMG_HEIGHT);

        $black = imagecolorallocate($im, 0x00, 0x00, 0x00);
        $blue = imagecolorallocate($im, 0x00, 0x00, 0xFF);
        $red = imagecolorallocate($im, 0xFF, 0x00, 0x00);
        $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);

        imagefilledrectangle($im, 0, 0, 499, 199, $black);

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

        imagefttext($im, 20, 0, 82, 55, $white, FONT_FILE, "Погода у м. " . $weather_info->city . " на " . $weather_info->date);

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

        imagepng($im, "./img/" . $weather_info->city . ".png");
        imagedestroy($im);
    }
}

renderWeatherInfoToImg($weather_infos);

foreach ($weather_infos as $weather_info) {
    echo "<img src='./img/" . $weather_info->city . ".png' alt=''>";
    echo "<br><br>";
}
