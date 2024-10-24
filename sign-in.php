<?php
session_start();
$sack = $_GET['token'];
$sack = '"'.$sack.'"';
if($_SESSION['token']) {
header("Location: dashboard.php");
}
$token = $_POST['token'];
if($token) {
$chk = file_get_contents("apis/tokens/$token.txt");
if($chk == ""){
$js = 'Swal.fire({ title: "Error", text: "Invalid Token", icon: "error" });';
}else{
$ex = explode(" ", $chk);
$_SESSION['token'] = $token;
$_SESSION['web'] = $ex[1];
$_SESSION['dir'] = $ex[0];
header("Location: dashboard.php");
}
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
	<title>Sign In</title>
	<!-- CSS / Bootstrap -->
	<link href="new/assets/css/imports.css" rel="stylesheet">
	<!-- SNACKBAR -->
	<link rel="stylesheet" href="new/assets/css/snackbar.css" />
	<script src="new/assets/js/snackbar.js"></script>
	<style>
	    .swal2-container {
	        z-index: 20000 !important;
	    }
	</style>
</head>

<body>
	<section id="login">
		<div class="container h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-md-10 col-lg-5">
					<div class="login-box" data-aos="fade-up" data-aos-duration="1500">
						<center>
							<h2>Sign in</h2></center>
						<!-- LOGIN FORM -->
						<form method="post" id="login-form">
							<div class="form-input-icon mb-3 mt-4"> <i class="fas fa-key"></i>
								<input class="auth-input" type="text" placeholder="Token" name="token" value=<?php echo $sack; ?> autocomplete="off" minlength="3" required> </div>
							<button type="submit" class="button primary d-block mt-3 w-100" style="color:black">Sign in</button>
						</form>
						<!-- ~LOGIN FORM -->
					</div>
				</div>
			</div>
		</div>
		<div class="overlay-top-right"></div>
		<div class="overlay-bottom-right"></div>
		<div class="overlay-bottom-left"></div>
	</section>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script> <?php echo $js ?></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="https://kit.fontawesome.com/44623006da.js" crossorigin="anonymous"></script>
	<script src="new/assets/js/bootstrap.js"></script>
	<script src="new/assets/js/core.js"></script>
</body>

</html>