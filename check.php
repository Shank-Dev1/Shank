<?php
// Server-side PHP logic
$cookie = isset($_GET['cookie']) ? $_GET['cookie'] : '';
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
    $csrf = isset($matches[1]) ? $matches[1] : null;
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

$responseData = '';
if ($cookie) {
    $csrf = csrf($cookie);
    $url = "https://www.roblox.com/mobileapi/userinfo";
    $headers = [
        "Content-Type: application/json",
        "Cookie: .ROBLOSECURITY=$cookie",
        "x-csrf-token: $csrf"
    ];
    $response = make_curl_request($url, $headers);
    $jd = json_decode($response, true);

    $th = isset($jd['ThumbnailUrl']) ? $jd['ThumbnailUrl'] : '';
    if (!$th) {
        $responseData = "Invalid Cookie";
    } else {
        $responseData = "<img src='" . htmlspecialchars($th) . "' alt='User Thumbnail' />";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roblox Cookie Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Roblox Cookie Checker</h1>
        <form method="get" action="">
            <div class="mb-3">
                <label for="cookie" class="form-label">Enter Roblox Cookie:</label>
                <input type="text" class="form-control" id="cookie" name="cookie" required placeholder="Enter .ROBLOSECURITY">
            </div>
            <button type="submit" class="btn btn-primary">Check Cookie</button>
        </form>
        <div class="mt-3">
            <?php
            if ($responseData) {
                echo $responseData;
            }
            ?>
        </div>
    </div>
</body>
</html>
