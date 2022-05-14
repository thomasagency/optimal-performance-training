<?php
// Variables
$relative_url = '../../';
$relative_path = '../';
$list_page = 'admin/user/list.php';

// Pagination
$total_items = count($users);

$page = ceil($total_items/$this->items_per_page);
if (isset($_SESSION['page'])) {
	if ($_SESSION['page'] > $page) {
		$_SESSION['page'] = 1;
	}
	$cur_page = $_SESSION['page'];
	$offset = ($_SESSION['page'] - 1) * $this->items_per_page;
} else {
	$cur_page = 1;
	$offset = 0;
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

<?php if (isset($_SESSION['delete_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		User successfully deleted.
	</div>
	<?php unset($_SESSION['delete_success']); ?>
<?php } ?>

<div class="topbar">
	<a class="btn btn-primary pull-left" href="edit.php"><i class="fa fa-plus-circle"></i> New</a>
	<form method="get" action="" class="search nav-form pull-right">
		<div class="input-group input-search">
			<input type="text" class="form-control" name="keyword" id="q" placeholder="Search..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form>
</div>

<div class="list">
	<div class="table-responsive">
		<table class="table table-bordered table-striped mb-none">
			<thead>
				<tr>
					<th width="10" class="text-center">No</th>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>
					<th width="110" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($users) { ?>
					<?php $users = array_slice($users, $offset, $this->items_per_page); ?>
					<?php $role = array('1'=>'Admin', '2'=>'User'); ?>
					<?php foreach ($users as $i=>$user) { ?>
						<tr>
							<td class="text-center"><?php echo htmlspecialchars($i) + 1; ?></td>
							<td><a href="edit.php?id=<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['username']); ?></a></td>
							<td><?php echo htmlspecialchars($user['name']); ?></td>
							<td><?php echo htmlspecialchars($user['email']); ?></td>
							<td class="text-center">
								<?php if ($user['id'] == 1) { ?>
									<a class="btn btn-primary btn-delete-admin" href=""><i class="fa fa-trash-o"></i> Delete</a>
								<?php } else { ?>
									<a class="btn btn-primary btn-delete" href="delete.php?id=<?php echo htmlspecialchars($user['id']); ?>"><i class="fa fa-trash-o"></i> Delete</a>
								<?php } ?>
							</td>			
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>

		<!-- Pagination -->
		<div class="pagination">
			<?php include $relative_url . 'admin/pagination.php'; ?>
		</div>
	</div>
</div>