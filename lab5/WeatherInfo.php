<?php
class WeatherInfo
{
    public $city;
    public $date;
    public $sunrise;
    public $sunset;
    public $day_length;
    public $temperature_during_day;
    public $temperature_during_day_as_array;

    private $weather_info_html;

    public function __construct($website_url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $website_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $this->weather_info_html = curl_exec($ch);
        curl_close($ch);

        $this->city = $this->parse_city($this->weather_info_html);
        $this->date = date("m.d.Y");
        $this->sunrise = $this->parse_sunrise($this->weather_info_html);
        $this->sunset = $this->parse_sunset($this->weather_info_html);
        $this->day_length = $this->parse_day_length($this->weather_info_html);
        $this->temperature_during_day = $this->parse_temperature_during_day($this->weather_info_html);
        $this->temperature_during_day_as_array = $this->parse_temperature_during_day_as_array($this->weather_info_html);
    }

    public function print()
    {
        echo "м. " . $this->city;
        echo "<br>";
        echo $this->date;
        echo "<br>";
        echo "<br>";

        echo "Схід сонця: " . $this->sunrise;
        echo "<br>";
        echo "Захід сонця: " . $this->sunset;
        echo "<br>";
        echo "Тривалість дня: " . $this->day_length;
        echo "<br>";
        echo "<br>";

        echo "Температура протягом дня: " . $this->temperature_during_day;
    }

    function parse_city($weather_info_html): string
    {
        preg_match(
            "/<input type=\"search\" class=\"input js-input\" placeholder=\"(.*)\" autocomplete=\"off\"/",
            $weather_info_html,
            $matches
        );

        return $matches[1];
    }

    function parse_sunrise($weather_info_html): string
    {
        preg_match(
            "/<div>Схід — (.*?)<\/div>/",
            $weather_info_html,
            $matches
        );

        return $matches[1];
    }

    function parse_sunset($weather_info_html): string
    {
        preg_match(
            "/<div>Захід — (.*?)<\/div>/",
            $weather_info_html,
            $matches
        );

        return $matches[1];
    }

    function parse_day_length($weather_info_html): string
    {
        preg_match(
            "/<div class=\"astro-progress\">Тривалість дня: (.*?)<\/div>/",
            $weather_info_html,
            $matches
        );

        return $this->display_day_length($matches[1]);
    }

    function display_day_length($day_length): string
    {
        //    format "x год y хв"
        // extract hours and minutes
        $hours = (int)explode(" ", $day_length)[0];
        $minutes = (int)explode(" ", $day_length)[2];

        if ($minutes == 0) {
            return "рівно " . $this->format_hours($hours);
        }
        return $this->format_hours($hours) . " " . $this->format_minutes($minutes);
    }

    // if hours ends with 1 then add "година"
    // if hours ends with 2, 3, 4, but not 12, 13, 14 then add "години"
    // else add "годин"
    function format_hours($hours): string
    {
        $last_digit = $hours % 10;
        $last_two_digits = $hours % 100;

        if ($last_digit == 1 && $last_two_digits != 11) {
            return $hours . " година";
        }
        if ($last_digit >= 2 && $last_digit <= 4 && ($last_two_digits < 12 || $last_two_digits > 14)) {
            return $hours . " години";
        }
        return $hours . " годин";
    }

    // if minutes ends with 1 then add "хвилина"
    // if minutes ends with 2, 3, 4, but not 12, 13, 14 then add "хвилини"
    // else add "хвилин"
    function format_minutes($minutes): string
    {
        $last_digit = $minutes % 10;
        $last_two_digits = $minutes % 100;

        if ($last_digit == 1 && $last_two_digits != 11) {
            return $minutes . " хвилина";
        }
        if ($last_digit >= 2 && $last_digit <= 4 && ($last_two_digits < 12 || $last_two_digits > 14)) {
            return $minutes . " хвилини";
        }
        return $minutes . " хвилин";
    }

    function parse_temperature_during_day($weather_info_html): string
    {
        preg_match_all(
            "/<span class=\"unit unit_temperature_c\">(.*?)<\/span>/",
            $weather_info_html,
            $matches
        );

        $temperatures = array_slice($matches[1], 6);
        $result = "";
        $time = 0;

        foreach ($temperatures as $temperature) {
            $result .= "$time" . "г." . " - $temperature" . "° ";
            $time += 3;
        }

        return $result;
    }

    function parse_temperature_during_day_as_array($weather_info_html): array
    {
        preg_match_all(
            "/<span class=\"unit unit_temperature_c\">(.*?)<\/span>/",
            $weather_info_html,
            $matches
        );

        $temperatures = array_slice($matches[1], 6);
        $result = array();
        $time = 0;

        foreach ($temperatures as $temperature) {
            $result[$time] = $temperature;
            $time += 3;
        }

        return $result;
    }
}
