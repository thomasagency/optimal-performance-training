<?php
$id 		= 0;
$name 		= '';
$username 	= '';
$email 		= '';
$role 		= 1;

if (isset($user)) {
	if ($user) {
		$id 		= $user['id'];
		$name 		= $user['name'];
		$username 	= $user['username'];
		$email 		= $user['email'];
		$role 		= $user['role'];
	}
}

if (isset($_POST) && $_POST) {
	$name 		= $_POST['name'];
	$username 	= $_POST['username'];
	$email 		= $_POST['email'];
	$role 		= $_POST['role'];
}
?>

<?php if (isset($_SESSION['save_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		User successfully saved.
	</div>
	<?php unset($_SESSION['save_success']); ?>
<?php } ?>

<form id="form" method="post" action="edit.php<?php echo ($id) ? '?id=' . $id : ''; ?>" class="">	
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Name <span class="required">*</span></label>
		<div class="col-sm-10">
			<input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Username <span class="required">*</span></label>
		<div class="col-sm-10">
			<input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Password <?php echo !isset($user) ? '<span class="required">*</span>' : ''; ?></label>
		<div class="col-sm-10">
			<input type="password" autocomplete="new-password" name="password" class="form-control" <?php echo (!isset($user)) ? 'required=""' : ''; ?> >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Confirm Password <?php echo !isset($user) ? '<span class="required">*</span>' : ''; ?></label>
		<div class="col-sm-10">
			<input type="password" autocomplete="new-password" name="password2" class="form-control" <?php echo (!isset($user)) ? 'required=""' : ''; ?> >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Email</label>
		<div class="col-sm-10">
			<input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell">Role</label>
		<div class="col-sm-10">
			<select name="role" class="form-control">
				<option <?php echo ($role == 1) ? 'selected' : ''; ?> value="1">Admin</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label padding-cell"></label>
		<div class="col-sm-10 padding-cell">
			<button name="save" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Save</button>
			<a class="btn btn-default" href="list.php"><i class="fa fa-times"></i> Cancel</a>
		</div>
	</div>

	<input type="hidden" id="relative_url" value="../../" />
</form>