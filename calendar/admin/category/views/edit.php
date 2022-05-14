<?php
$id 		= 0;
$title 		= '';

if (isset($category)) {
	if ($category) {
		$id 	= $category['id'];
		$title 	= $category['title'];
	}
}

if (isset($_POST) && $_POST) {
	$title 	= $_POST['title'];
}
?>

<?php if (isset($_SESSION['save_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		Category successfully saved.
	</div>
	<?php unset($_SESSION['save_success']); ?>
<?php } ?>

<form id="form" method="post" action="edit.php<?php echo ($id) ? '?id=' . $id : ''; ?>" enctype="multipart/form-data">	
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Title <span class="required">*</span></label>
		<div class="col-sm-10">
			<input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required="">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell"></label>
		<div class="col-sm-10 padding-cell">
			<button name="save" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Save</button>
			<a class="btn btn-default" href="list.php"><i class="fa fa-times"></i> Cancel</a>
		</div>
	</div>
</form>