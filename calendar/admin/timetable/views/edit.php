<?php
$id 		= 0;
$title 		= '';
$category 	= '';
$image 		= '';
$date 		= '';
$day 		= '';
$start_time = '';
$end_time 	= '';
$trainer 	= '';
$color 		= '';
$content 	= '';

if (isset($timetable)) {
	if ($timetable) {
		$id 		= $timetable['id'];
		$title 		= $timetable['title'];
		$category 	= $timetable['category'];
		$image 		= $timetable['image'];
		$date 		= $timetable['date'];
		$day 		= $timetable['day'];
		$start_time = $timetable['start_time'];
		$end_time 	= $timetable['end_time'];
		$trainer 	= $timetable['trainer'];
		$color 		= $timetable['color'];
		$content 	= $timetable['content'];
	}
}

if (isset($_POST) && $_POST) {
	$title 		= $_POST['title'];
	$category 	= $_POST['category'];
	if ($_FILES['image']['title']) {
		$image 	= $_FILES['image']['title'];
	}
	$date 		= $_POST['date'];
	$day 		= $_POST['day'];
	$start_time = $_POST['start_time'];
	$end_time 	= $_POST['end_time'];
	$trainer 	= $_POST['trainer'];
	$color 		= $_POST['color'];
	$content 	= $_POST['content'];
}
?>

<?php if (isset($_SESSION['save_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		Timetable successfully saved.
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
		<label class="col-sm-2 control-label padding-cell">Category</label>
		<div class="col-sm-10">
			<select name="category" class="form-control">
				<option value="">---</option>
				<?php if ($categories) { ?>
					<?php foreach ($categories as $cat) { ?>
						<option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $category) ? 'selected' : ''; ?>><?php echo $cat['title']; ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Image</label>
		<div class="col-sm-10">
			<div class="fileupload fileupload-<?php echo ($image) ? 'exists' : 'new'; ?>" data-provides="fileupload">
				<div class="input-append">
					<div class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview"><?php echo ($image) ? $image : ''; ?></span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists">Change</span>
						<span class="fileupload-new">Select file</span>
						<input type="file" name="image">
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Date</label>
		<div class="col-sm-10">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</span>
				<input type="text" name="date" data-plugin-datepicker="" class="form-control" value="<?php echo htmlspecialchars($date); ?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Day</label>
		<div class="col-sm-10">
			<select name="day" class="form-control">
				<option value="">---</option>
				<option value="monday" <?php echo ($day == 'monday') ? 'selected' : ''; ?>>Monday</option>
				<option value="tuesday" <?php echo ($day == 'tuesday') ? 'selected' : ''; ?>>Tuesday</option>
				<option value="wednesday" <?php echo ($day == 'wednesday') ? 'selected' : ''; ?>>Wednesday</option>
				<option value="thursday" <?php echo ($day == 'thursday') ? 'selected' : ''; ?>>Thursday</option>
				<option value="friday" <?php echo ($day == 'friday') ? 'selected' : ''; ?>>Friday</option>
				<option value="saturday" <?php echo ($day == 'saturday') ? 'selected' : ''; ?>>Saturday</option>
				<option value="sunday" <?php echo ($day == 'sunday') ? 'selected' : ''; ?>>Sunday</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Start Time</label>
		<div class="col-sm-10">
			<input type="text" name="start_time" data-plugin-timepicker="" class="form-control" data-plugin-options="{ &quot;showMeridian&quot;: false }" value="<?php echo htmlspecialchars($start_time); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">End Time</label>
		<div class="col-sm-10">
			<input type="text" name="end_time" data-plugin-timepicker="" class="form-control" data-plugin-options="{ &quot;showMeridian&quot;: false }" value="<?php echo htmlspecialchars($end_time); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Trainer</label>
		<div class="col-sm-10">
			<input type="text" name="trainer" class="form-control" value="<?php echo htmlspecialchars($trainer); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Color</label>
		<div class="col-sm-10">
			<select name="color" class="form-control">
				<option value="1" <?php echo ($color == '1') ? 'selected' : ''; ?>>1</option>
				<option value="2" <?php echo ($color == '2') ? 'selected' : ''; ?>>2</option>
				<option value="3" <?php echo ($color == '3') ? 'selected' : ''; ?>>3</option>
				<option value="4" <?php echo ($color == '4') ? 'selected' : ''; ?>>4</option>
				<option value="5" <?php echo ($color == '5') ? 'selected' : ''; ?>>5</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Content</label>
		<div class="col-sm-10">
			<textarea name="content" class="form-control" rows="5" id="textareaDefault"><?php echo htmlspecialchars($content); ?></textarea>
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