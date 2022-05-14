<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Quick Timetable</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic" rel="stylesheet">

		<!-- Include css files -->
		<link rel="stylesheet" href="assets/css/simple-line-icons.css">
		<link rel="stylesheet" href="assets/css/magnific-popup.css">
		<link rel="stylesheet" href="assets/css/quick-timetable.css">

		<!-- Include language file -->
		<script src="languages/lang.js"></script>
		
		<!-- Include js files -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.magnific-popup.js"></script>
		<script src="assets/js/quick-timetable.js"></script>
		
		<!-- Site -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/main.js"></script>
	</head>

	<body>
		<div class="preloader">
		    <div id="circle-square">
		        <span></span>
		        <span></span>
		        <span></span>
		        <span></span>
		    </div>
		</div>

		<header class="header fixed-top">
	        <div class="container">
	            <nav class="navbar navbar-expand-lg navbar-dark">
	                <a class="navbar-brand" href="http://localhost/">
						Quick <span>Timetable.</span>
					</a> 
					<button aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarNavDropdown" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
	                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    	<ul class="navbar-nav ml-auto scrollspy">
							<li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
							<li class="nav-item"><a href="#weekly-view" class="nav-link">Weekly View</a></li>
							<li class="nav-item"><a href="#monthly-view" class="nav-link">Monthly View</a></li>
							<li class="nav-item"><a href="#list-view" class="nav-link">List View</a></li>
						</ul>
					</div>
	            </nav>
	        </div>
    	</header>

    	<main class="padding-top">
			<section class="section" id="weekly-view">
				<div class="container">
					<h2 class="section-title">Weekly View</h2>
					<div class="section-body">
						<div class="quick-timetable" data-source="json" data-view="week" data-mode="day"></div>
					</div>
				</div>
			</section>

			<section class="section" id="monthly-view">
				<div class="container">
					<h2 class="section-title">Monthly View</h2>
					<div class="section-body">
						<div class="quick-timetable" data-source="json" data-view="month" data-mode="day"></div>
					</div>
				</div>
			</section>

			<section class="section" id="list-view">
				<div class="container">
					<h2 class="section-title">List View</h2>
					<div class="section-body">
						<div class="quick-timetable" data-source="json" data-view="list" data-mode="day"></div>
					</div>
				</div>
			</section>
		    
		    <footer class="footer">
		        <div class="container">
		            <span class="copyright">© 2021 by CakeTheme. All rights reserved.</span>
		        </div>
		    </footer>
		</main>

		<a class="back-to-top"><i class="icon-arrow-up"></i></a>
	</body>
</html>