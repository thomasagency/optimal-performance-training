<?php
// Variables
$relative_url = '../../';
$relative_path = '../';
$list_page = 'admin/timetable/list.php';

// Pagination
$total_items = count($timetables);

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
		Timetable successfully saved.
	</div>
	<?php unset($_SESSION['save_success']); ?>
<?php } ?>

<?php if (isset($_SESSION['delete_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		Timetable successfully deleted.
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
					<th width="110" class="text-center">Image</th>
					<th>Title</th>
					<th width="120">Category</th>
					<th width="90">Date</th>
					<th width="100">Day</th>
					<th width="120">Time</th>
					<th width="60" class="text-center">Status</th>
					<th width="100" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($timetables) { ?>
					<?php $timetables = array_slice($timetables, $offset, $this->items_per_page); ?>
					<?php foreach ($timetables as $i=>$timetable) { ?>
						<tr>
							<td class="text-center"><?php echo htmlspecialchars($i) + 1; ?></td>
							<td class="text-center">
								<?php if ($timetable['image']) { ?>
									<a href="edit.php?id=<?php echo htmlspecialchars($timetable['id']); ?>">
										<img src="../timetable/images/<?php echo htmlspecialchars($timetable['image']); ?>" alt="<?php echo htmlspecialchars($timetable['name']); ?>" width="90" />
									</a>
								<?php } ?>
							</td>
							<td><a href="edit.php?id=<?php echo htmlspecialchars($timetable['id']); ?>"><?php echo htmlspecialchars($timetable['title']); ?></a></td>
							<td><?php echo htmlspecialchars($timetable['cat_name']); ?></td>
							<td><?php echo htmlspecialchars($timetable['date']); ?></td>
							<td><?php echo htmlspecialchars(ucwords($timetable['day'])); ?></td>
							<td>
								<?php echo htmlspecialchars($timetable['start_time']) . ' - ' . htmlspecialchars($timetable['end_time']); ?>
							</td>
							<td class="text-center"><a href="status.php?id=<?php echo htmlspecialchars($timetable['id']); ?>"><img src="<?php echo ($timetable['state'] == 1) ? '../assets/images/tick.png' : '../assets/images/close.png'; ?>" /></a></td>
							<td class="text-center">
								<a class="btn btn-primary btn-delete" href="delete.php?id=<?php echo htmlspecialchars($timetable['id']); ?>"><i class="fa fa-trash-o"></i> Delete</a>
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