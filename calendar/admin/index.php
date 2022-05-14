<?php
session_start();

// Variables
$relative_url 	= '../';
$relative_path 	= '';
$page 			= 'homepage';

ob_start();
?>

<!DOCTYPE html>
<html>
<?php
// Header
include $relative_path . 'header.php';

if (empty($_SESSION['user'])) { // Not login
	include $relative_path . 'login.php';
} else { // Already login
	// Redirect to device page
	header('Location: timetable/list.php');
	EXIT;
}
?>
</html>