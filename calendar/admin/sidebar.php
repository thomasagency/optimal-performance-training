<aside id="sidebar-left" class="sidebar-left">		
	<div class="sidebar-header">
		<div class="sidebar-title">
			Menu
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-timetable="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano has-scrollbar">
		<div class="nano-content" tabindex="0" style="right: -15px;">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<li <?php echo ($page == 'timetable') ? 'class="nav-active"' : ''; ?>>
						<a href="<?php echo htmlspecialchars($relative_path); ?>timetable/list.php">
							<i class="fa fa-calendar"></i> <span>Timetable</span>
						</a>
					</li>
					<li <?php echo ($page == 'category') ? 'class="nav-active"' : ''; ?>>
						<a href="<?php echo htmlspecialchars($relative_path); ?>category/list.php">
							<i class="fa fa-list"></i> <span>Category</span>
						</a>
					</li>
					<li <?php echo ($page == 'user') ? 'class="nav-active"' : ''; ?>>
						<a href="<?php echo htmlspecialchars($relative_path); ?>user/list.php">
							<i class="fa fa-user"></i> <span>User</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</aside>