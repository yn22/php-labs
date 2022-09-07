<?php
class IPInfo
{
    public $ip;
    public $country;
    public $city;
    public $region;
    public $latitude;
    public $longitude;
    public $status;

    public function __construct($ip)
    {
        $this->ip = $ip;
        $ip_info = $this->retrieve_ip_info($this->ip);

        if ($ip_info) {
            $this->country_code = $ip_info["countryCode"];
            $this->image_name = "./data/flags/" . strtolower($this->country_code) . ".png";
            $this->country_name = $ip_info["country"];
            $this->region_name = $ip_info["regionName"];
            $this->region_code = $ip_info["region"];
            $this->city = $ip_info["city"];
            $this->latitude = $ip_info["lat"];
            $this->longitude = $ip_info["lon"];

            $this->status = "success";
        } else {
            $this->status = 'fail';
        }
    }

    private function retrieve_ip_info($ip)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $ip);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}
