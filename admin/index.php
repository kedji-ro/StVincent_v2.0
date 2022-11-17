<!doctype html>
<html lang="en">

<head>
	<title>Admin | St. Vincent Strambi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="animated fadeIn">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Admin</h2>
					<h5>St. Vincent Strambi</h5>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(assets/img/bg-1.jpg);">
						</div>
						<div class="login-wrap p-4 p-md-5">
							<form action="../includes/actions/login.php" class="signin-form" method="POST">
								<div class="text-center mt-3">
									<?php include '../includes/alert-message.php'; ?>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="name">Username</label>
									<input id="user" name="user" type="text" class="form-control" placeholder="Username" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input id="pass" name="pass" type="password" class="form-control" placeholder="Password" required>
								</div>
								<div class="form-group">
									<button id="a_login" name="a_login" type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>
<script>
	window.history.replaceState({}, document.title, "?" + "");
</script>
</html>