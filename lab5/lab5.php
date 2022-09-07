<?php
include "WeatherInfo.php";

$weather = new WeatherInfo("https://www.gismeteo.ua/ua/weather-kharkiv-5053/");

$weather->print();
