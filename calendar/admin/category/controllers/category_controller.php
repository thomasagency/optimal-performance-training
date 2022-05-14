<?php
include_once('models/category_model.php');

class CategoryController {
    public $model;
	public $items_per_page;
	
	public function __construct() {  
        $this->model = new CategoryModel();
		$this->items_per_page = 20;
    }
	
	public function displayCategoryList() {
		// Show the category list
		$categories = $this->model->getCategoryList();
		include 'views/list.php';
	}
	
	public function editCategory() {
		if (isset($_GET['id']) && $_GET['id']) { // Edit Category
			if (!empty($_POST)) {
				// Update category
				$this->model->updateCategory($_GET['id']);
				
				// Set success flag
				$_SESSION['save_success'] = 1;
						
				if (isset($_POST['save-close'])) {
					header('Location: list.php');
					EXIT;
				} elseif (isset($_POST['save-new'])) {
					header('Location: edit.php');
					EXIT;
				}
			}
			
			// Show category detail
			$category = $this->model->getCategoryDetail($_GET['id']);
		} else { // New Category
			if (!empty($_POST)) {
				// Create new category
				$id = $this->model->newCategory();
				
				// Set success flag
				$_SESSION['save_success'] = 1;
				
				ob_end_clean();
				if (isset($_POST['save-close'])) {
					header('Location: list.php');
					EXIT;
				} elseif (isset($_POST['save-new'])) {
					header('Location: edit.php');
					EXIT;
				} else {
					header('Location: edit.php?id=' . $id);
					EXIT;
				}
			}
		}
		
		include 'views/edit.php';
	}
	
	public function deleteCategory($id) {
		if (isset($_GET['id'])) {
			// Delete category
			$this->model->deleteCategory($id);
			
			// Set success flag
			$_SESSION['delete_success'] = 1;
		}
		
		header('Location: list.php');
		EXIT;
	}
	
	public function statusCategory($id) {
		if (isset($_GET['id'])) {
			// Delete category
			$this->model->statusCategory($id);
		}
		
		ob_end_clean();
		header('Location: list.php');
		EXIT;
	}
}