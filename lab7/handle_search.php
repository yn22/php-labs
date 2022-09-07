<?php
$search_term = $_GET["search_term"];
$search_term_encoded = urlencode($search_term);

if (empty($search_term)) {
    echo "Продуктів з назвою $search_term не знайдено";
    return;
}



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://santehtochka.com.ua/ua/site_search?search_term={$search_term_encoded}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$rozetka_html = curl_exec($ch);
curl_close($ch);

// parse the html using regex
preg_match_all(
    "/<ul class=\"b-product-gallery\">(.*)<\/ul>/s",
    $rozetka_html,
    $matches
);

if (!empty($matches[0][0])) {
    echo $matches[0][0];
} else {
    echo "Продуктів з назвою $search_term не знайдено";
}
