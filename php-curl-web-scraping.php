<?php
//Fetch a Web Page
$url = "https://books.toscrape.com/";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

//echo $response;
//Adding User-Agent (Avoid Basic Blocking)
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
//Handling headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept-Language: en-US,en;q=0.9"
]);
//Extracting Data Using DOM
$dom = new DOMDocument();
@$dom->loadHTML($response);

$xpath = new DOMXPath($dom);
$titles = $xpath->query("//h3/a");

foreach ($titles as $title) {
    echo $title->getAttribute("title") . "<br>";
}
//Handling Errors Properly
if(curl_errno($ch)){
    echo "Error: " . curl_error($ch);
}