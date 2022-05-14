<?php
include_once('../../config/database.php');

class TimetableModel {	
	public function uploadImage() {
		$msg = '';
		if (isset($_FILES['image'])) {
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];
			$file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
			$file_name_pre = reset(explode('.', $_FILES['image']['name']));
			
			$expensions = array('jpeg', 'jpg', 'png', 'gif');
			
			if ($file_ext && in_array($file_ext, $expensions) === false) {
				$msg .= '<p>File not valid. Please upload image (jpg, jpeg, png, gif).</p>';
			}
			
			if ($msg == '') {
				// Upload file
				move_uploaded_file($file_tmp, 'images/' . $file_name);
				$msg .= 'success';
			}
		}
		return $msg;
	}

	public function getCategoryList() {
		$pdo = Database::connect();
		$sql = 'SELECT * FROM categories ORDER BY id ASC';

		$categories  = $pdo->query($sql)
				  ->fetchAll(PDO::FETCH_ASSOC);
		
		Database::disconnect();
		
		return $categories;
	}

	public function getCategoryDetail($id) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM categories where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$category = $q->fetch(PDO::FETCH_ASSOC);
		
		Database::disconnect();
		
		return $category;
	}
	
	public function getTimetableList() {
		$pdo = Database::connect();
		if (isset($_GET['keyword'])) {
			$sql = 'SELECT timetables.*, categories.title AS cat_name FROM timetables LEFT JOIN categories ON timetables.category = categories.id WHERE timetables.title LIKE "%' . $_GET['keyword'] . '%" ORDER BY timetables.id ASC';
		} else {
			$sql = 'SELECT timetables.*, categories.title AS cat_name FROM timetables LEFT JOIN categories ON timetables.category = categories.id ORDER BY timetables.id ASC';
		}
		$timetables  = $pdo->query($sql)
				  ->fetchAll(PDO::FETCH_ASSOC);
		
		Database::disconnect();
		
		return $timetables;
	}
	
	public function getTimetableDetail($id) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM timetables where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$timetable = $q->fetch(PDO::FETCH_ASSOC);
		
		Database::disconnect();
		
		return $timetable;
	}
	
	public function updateTimetable($id) {
		// update data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($_FILES['image']['name']) {
			$sql = "UPDATE timetables SET title = ?, category = ?, image = ?, date = ?, day = ?, start_time = ?, end_time = ?, trainer = ?, color = ?, content = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($_POST['title'], $_POST['category'], $_FILES['image']['name'], $_POST['date'], $_POST['day'], $_POST['start_time'], $_POST['end_time'], $_POST['trainer'], $_POST['color'], $_POST['content'], $id));
		} else {
			$sql = "UPDATE timetables SET title = ?, category = ?, date = ?, day = ?, start_time = ?, end_time = ?, trainer = ?, color = ?, content = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($_POST['title'], $_POST['category'], $_POST['date'], $_POST['day'], $_POST['start_time'], $_POST['end_time'], $_POST['trainer'], $_POST['color'], $_POST['content'], $id));
		}
		
		Database::disconnect();
	}
	
	public function newTimetable() {	
		// Create new timetable
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO timetables (title, category, image, date, day, start_time, end_time, trainer, color, content) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['title'], $_POST['category'], $_FILES['image']['name'], $_POST['date'], $_POST['day'], $_POST['start_time'], $_POST['end_time'], $_POST['trainer'], $_POST['color'], $_POST['content']));
		
		Database::disconnect();
		
		return $pdo->lastInsertId();
	}
	
	public function deleteTimetable($id) {
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM timetables WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		Database::disconnect();
	}
	
	public function statusTimetable($id) {
		// update data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE timetables SET state = 1 - state WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		Database::disconnect();
	}
}