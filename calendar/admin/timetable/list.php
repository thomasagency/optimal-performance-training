<?php
session_start();

include_once('controllers/timetable_controller.php');

// Variables
$relative_url 	= '../../';
$relative_path	= '../';
$page 			= 'timetable';
$page_title 	= 'Timetable';

// Get controller
$timetable = new TimetableController();
?>

<!DOCTYPE html>
<html>
<!-- Header -->
<?php include $relative_path . 'header.php'; ?>
	  
<body>
	<section class="body">
		<!-- Navbar -->
		<?php include $relative_path . 'navbar.php'; ?>
					
		<div class="inner-wrapper">
			<!-- Sidebar -->
			<?php include $relative_path . 'sidebar.php'; ?>

			<section role="main" class="content-body">
				<!-- Sidebar -->
				<?php include $relative_path . 'content_header.php'; ?>

				<!-- Main Content -->
				<div class="main-content">
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="fa fa-caret-down"></a>
								<a href="#" class="fa fa-times"></a>
							</div>
							<div>
								<h2 class="panel-title">Timetables List</h2>
							</div>
						</header>
						<div class="panel-body">								
							<?php $timetable->displayTimetableList(); ?>
						</div>
					</section>
				</div>
			</section>
		</div>
	</section>
</body>
</html>