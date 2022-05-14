<?php
// Check session login
if (empty($_SESSION['user'])) {
	// If not login, redirect to the index page
	header('Location: ' . $relative_path . 'index.php');
	EXIT;
} else {
	if (isset($_SESSION['login_time'])){
		$login_session_duration = 900; // 15 minutes
		$current_time = time();
		if (((time() - $_SESSION['login_time']) > $login_session_duration)) { // Timeover
			// Unset session
			unset($_SESSION['user']);
			unset($_SESSION['login_time']);
				 
			// Redirect to the index page 
			header('Location: ' . $relative_path . 'index.php');
			EXIT;
		} else {
			$_SESSION['login_time'] = time();
		}
	}
}

?>

<header class="header">
	<div class="logo-container">
		<a href="<?php echo htmlspecialchars($relative_path); ?>timetable/list.php" class="logo">
			<img src="../assets/images/logo.png" alt="Quick Timetable">
		</a>
		<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-timetable="sidebar-left-opened">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<!-- start: search & user box -->
	<div class="header-right">
		<div id="userbox" class="userbox">
			<a href="#" data-toggle="dropdown">
				<figure class="profile-picture">
					<img src="../assets/images/!logged-user.jpg" alt="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : ''; ?>" class="img-circle">
				</figure>
				<div class="profile-info">
					<span class="name"><?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : ''; ?></span>
					<span class="role"><?php echo isset($_SESSION['user']) ? $_SESSION['user']['email'] : ''; ?></span>
				</div>
				<i class="fa custom-caret"></i>
			</a>

			<div class="dropdown-menu">
				<ul class="list-unstyled">
					<li class="divider"></li>
					<li>
						<a role="menuitem" tabindex="-1" href="<?php echo htmlspecialchars($relative_path) . 'logout.php'; ?>"><i class="fa fa-power-off"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- end: search & user box -->
</header>