<?php
include_once('controllers/category_controller.php');

$category = new CategoryController();
$category->statusCategory($_GET['id']);
?>