<?php
include_once('../config/database.php');

$submitted_username = '';
$alert_message = '';

if (!empty($_POST)) {
	$login_ok = false;
	
	// Get user by username
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT id, name, username, password, salt, email FROM users WHERE username = ? AND role = 1 AND state = 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($_POST['username']));
	$row = $q->fetch(PDO::FETCH_ASSOC);
	
	Database::disconnect();
	
	// Check password
	if ($row) { 
		$check_password = hash('sha256', $_POST['password'] . $row['salt']); 
		for ($round = 0; $round < 65536; $round++) { 
			$check_password = hash('sha256', $check_password . $row['salt']); 
		} 

		if ($check_password === $row['password']) { 
			$login_ok = true; 
		} 
	} 
         
	if ($login_ok) { // If the user logged in successfully
		// Unset password and salt
		unset($row['salt']);
		unset($row['password']);
		 
		// Store user info in session
		$_SESSION['user'] = $row;
		$_SESSION['login_time'] = time();
		 
		// Redirect the user to the index page.
		ob_end_clean();
		header('Location: timetable/list.php');
		EXIT;
	} else { // Login failed
		// Alert message
		$alert_message = 'Login Failed. Please try again.';
		 
		// Keep the username in login form
		$submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
	} 
}     
?>

<body>
	<section class="body-sign">
		<div class="center-sign">
			<a href="/" class="logo pull-left">
				<img src="assets/images/logo_login.png" alt="Quick Timetable" />
			</a>

			<div class="panel panel-sign">
				<div class="panel-title-sign mt-sm text-right">
					<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Đăng nhập</h2>
				</div>
				<div class="panel-body">
					<?php if ($alert_message) { ?>
						<div class="alert alert-block alert-danger"><?php echo htmlspecialchars($alert_message); ?></div>
					<?php } ?>
					
					<form method="post" action="index.php" role="form">
						<div class="form-group mb-lg">
							<label>Username</label>
							<div class="input-group input-group-icon">
								<input type="text" name="username" class="form-control input-lg" id="username" value="<?php echo htmlspecialchars($submitted_username); ?>" required />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-lg">
							<div class="clearfix">
								<label class="pull-left">Password</label>
							</div>
							<div class="input-group input-group-icon">
								<input type="password" name="password" class="form-control input-lg" id="password" required />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 mt-xs">
								<button type="submit" class="btn btn-primary hidden-xs">Login</button>
								<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<p class="text-center text-muted mt-md mb-md">Copyrights © 2021 by CakeTheme</p>
		</div>
	</section>
</body>