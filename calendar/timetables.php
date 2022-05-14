<?php
include_once('config/database.php');

// Get timetables
$pdo = Database::connect();
$sql = 'SELECT timetables.*, categories.title AS cat_name FROM timetables LEFT JOIN categories ON timetables.category = categories.id WHERE timetables.state = 1';
$db_timetables  = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

Database::disconnect();


// Adapt data 
$timetables = array();
foreach ($db_timetables as $db_timetable) {
	$timetable = new stdClass();
	$timetable->title 		= $db_timetable['title'];
	$timetable->category 	= $db_timetable['cat_name'];
	$timetable->image 		= $db_timetable['image'];
	$timetable->date 		= date('d', strtotime($db_timetable['date']));
	$timetable->month 		= date('m', strtotime($db_timetable['date']));
	$timetable->year 		= date('Y', strtotime($db_timetable['date']));
	$timetable->day 		= $db_timetable['day'];
	$timetable->start_time 	= $db_timetable['start_time'];
	$timetable->end_time 	= $db_timetable['end_time'];
	$timetable->trainer 	= $db_timetable['trainer'];
	$timetable->color 		= $db_timetable['color'];
	$timetable->content 	= $db_timetable['content'];
	
	array_push($timetables, $timetable);
}

echo json_encode($timetables);
?>