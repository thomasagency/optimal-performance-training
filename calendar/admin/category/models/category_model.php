<?php
include_once('../../config/database.php');

class CategoryModel {	
	public function getCategoryList() {
		$pdo = Database::connect();
		if (isset($_GET['keyword'])) {
			$sql = 'SELECT * FROM categories WHERE title LIKE "%' . $_GET['keyword'] . '%" ORDER BY id ASC';
		} else {
			$sql = 'SELECT * FROM categories ORDER BY id ASC';
		}
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
	
	public function updateCategory($id) {
		// update data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "UPDATE categories SET title = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['title'], $id));
		
		Database::disconnect();
	}
	
	public function newCategory() {	
		// Create new category
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO categories (title) values(?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['title']));
		
		Database::disconnect();
		
		return $pdo->lastInsertId();
	}
	
	public function deleteCategory($id) {
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM categories WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		Database::disconnect();
	}
	
	public function statusCategory($id) {
		// update data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE categories SET state = 1 - state WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		Database::disconnect();
	}
}