<?php
session_start();

include_once('controllers/category_controller.php');

// Variables
$relative_url 	= '../../';
$relative_path	= '../';
$page 			= 'category';
$page_title 	= 'Category';

// Get controller
$category = new CategoryController();
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
								<h2 class="panel-title">Categorys List</h2>
							</div>
						</header>
						<div class="panel-body">								
							<?php $category->displayCategoryList(); ?>
						</div>
					</section>
				</div>
			</section>
		</div>
	</section>
</body>
</html>