<?php
session_start();

include_once('controllers/category_controller.php');

$category = new CategoryController();
$category->deleteCategory($_GET['id']);
?>