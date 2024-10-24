<?php
$cookie = $_GET['cookie'];
error_reporting(0);

function csrf($cookie) {
 $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("{}")));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Cookie: .ROBLOSECURITY=$cookie"
    ));
    $output = curl_exec($ch);
   preg_match('/X-CSRF-TOKEN:\s*(\S+)/i', $output, $matches);
$csrf = $matches[1];
return $csrf;
}

function make_curl_request($url, $headers) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}


$csrf = csrf($cookie);
$url = "https://www.roblox.com/mobileapi/userinfo";
$headers = [
    "Content-Type: application/json",
    "Cookie: .ROBLOSECURITY=$cookie",
    "x-csrf-token: $csrf"
];
$response = make_curl_request($url, $headers);
$jd = json_decode($response, true);

$th = $jd['ThumbnailUrl'];
if(!$th){
  echo "Invalid Cookie";
}