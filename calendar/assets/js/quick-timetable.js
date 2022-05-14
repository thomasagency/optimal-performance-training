(function ($) {
    'use strict';

	// Global timetables variables
	var quick_timetables 	= [];
	var timetable_cats 		= [];
	var multi_timetables 	= [];
	var sort_timetables		= [];

	// Global time variables
	var today 			= new Date();
	var today_date_g 	= today.getDate();
	var today_month_g 	= today.getMonth() + 1;
	var today_year_g 	= today.getFullYear();

	// Calculate time
	function calculateTime(time) {
		var t = time.split(':');
		return parseInt(t[0], 10) + (t[1] / 60);
	}

	// Sort timetables by time
	function sortTimetables(a,b) {
		if (a.start_time < b.start_time) {
			return -1;
		} else if (a.start_time > b.start_time) {
			return 1;
		} else {
			return 0;
		}
	}

	// Process timetables source
	function processTimetablesSource() {
		// Sort timetables by time
		quick_timetables.sort(sortTimetables);

		// Add id for timetable
		for (var j = 0; j < quick_timetables.length; j++) {
			quick_timetables[j].id = j;
		}

		// Get timetable categories
		for (var i = 0; i < quick_timetables.length; i++) {
			var check = true;
			for (var j = 0; j < timetable_cats.length; j++) {
				if (timetable_cats[j] == quick_timetables[i].category) {
					check = false;
				}
			}
			if (check) {
				if (quick_timetables[i].category) {
					timetable_cats.push(quick_timetables[i].category);
				}
			}
		}
	} 

	// Get axis time
	function getAxisTime() {
		var axis = [];

		// Min time
		for (var i = 0; i < quick_timetables.length; i++) {
			if (quick_timetables[i].start_time) {
				axis['min'] = parseInt(quick_timetables[i].start_time, 10);
				break;
			}
		}
		axis['min'] = (axis['min'] < 8) ? axis['min'] : 8; 

		// Max time
		for (var i = 0; i < sort_timetables.length; i++) {
			for (var j = i + 1; j < sort_timetables.length; j++) {
				if (sort_timetables[i].end_time < sort_timetables[j].end_time) {	
					// Swap items
					var tmp 			= sort_timetables[j];
					sort_timetables[j] 	= sort_timetables[i];
					sort_timetables[i] 	= tmp;
				}
			}
		}

		for (var i = sort_timetables.length-1; i >= 0; i--) {
			if (sort_timetables[i].end_time) {
				var time = sort_timetables[i].end_time.split(':');
				if (time[1] == '00') {
					axis['max'] = time[0] - 1;
				} else {
					axis['max'] = parseInt(time[0], 10);
				}
			}
		}
		axis['max'] = (axis['max'] > 17) ? axis['max'] : 17;

		return axis;
	}

	// Get timetables
	function getTimetables(timetables, mode, day, date, month, year) {
		var _timetables = [];

		for (var i = 0; i < timetables.length; i++) {
			if (mode == 'day') {
				if (timetables[i].day == day) {
					_timetables.push(timetables[i]);
				}
			} else {
				if ((timetables[i].date == date) && (timetables[i].month == month) && (timetables[i].year == year)) {
					_timetables.push(timetables[i]);
				}
			}
		}
		
		return _timetables;
	}

	function getTimetablesByCategory(category) {
		var timetables = [];

		for (var i = 0; i < quick_timetables.length; i++) {
			if (quick_timetables[i].category) {
				if ((quick_timetables[i].category.toLowerCase().replace(' ', '-') == category) || (category == 'all-category')) {
					timetables.push(quick_timetables[i]);
				}
			} else {
				if (category == 'all-category') {
					timetables.push(quick_timetables[i]);
				}
			}
		}

		return timetables;
	}

	// Get day
	function getDay(day, time, num) {
		var date = new Date();
		if (time == 'before') {
			return new Date(date.setTime(day.getTime() - (num * 24 * 60 * 60 * 1000)));
		} else {
			return new Date(date.setTime(day.getTime() + (num * 24 * 60 * 60 * 1000)));
		}
	}

	// Get postion of timetable on axis
	function getTimetablePosition(min_time, start_time) {
		return parseInt((calculateTime(start_time) - min_time) * 60, 10);
	}

	// Get height of timetable
	function getTimetableHeight(start_time, end_time) {
		return parseInt((calculateTime(end_time) - calculateTime(start_time)) * 60, 10);
	}

	// Group multi timetables on column
	function groupMultiTimetables(timetable, timetables) {
		for (var i = 0; i < timetables.length; i++) {
			if 	(timetable.id != timetables[i].id) {
				if (((calculateTime(timetable.start_time) >= calculateTime(timetables[i].start_time)) && (calculateTime(timetable.start_time) < calculateTime(timetables[i].end_time)))
					|| ((calculateTime(timetables[i].start_time) >= calculateTime(timetable.start_time)) && (calculateTime(timetables[i].start_time) < calculateTime(timetable.end_time)))) {
					if (!multi_timetables.includes(timetable.id)) {
						multi_timetables.push(timetable.id);
					}
					if (!multi_timetables.includes(timetables[i].id)) {
						multi_timetables.push(timetables[i].id);
					}
				}
			}
		}
	}

	// Get order of timetable on column
	function getTimetableOrder(timetable, timetables) {
		var order = 0;
		
		for (var i = 0; i < timetables.length; i++) {
			if 	(timetable.id == timetables[i]) {
				order = i;
			}
		}
		
		return order;
	}

	// Timetable detail
	function timetableDetail(timetable) {
		var timetable_string = '';

		var timetable_image = (timetable.image) ? '<img src="admin/timetable/images/' + timetable.image + '" alt="' + timetable.title + '" />' : '';

		timetable_string += '<div class="timetable-item">'
							+ '<div class="timetable-image">' + timetable_image + '</div>'
							+ '<div class="timetable-info">'
								+ '<div class="timetable-title">' + timetable.title + '</div>'
								+ '<div class="timetable-meta">'
									+ '<div class="timetable-category"><i class="icon-folder"></i>' + timetable.category + '</i></div>'
									+ '<div class="timetable-time"><i class="icon-clock"></i>' + timetable.start_time + ' - ' + timetable.end_time + '</i></div>'
									+ '<div class="timetable-trainer"><i class="icon-user"></i>' + timetable.trainer + '</i></div>'
								+ '</div>'
								+ '<div class="timetable-content">' + timetable.content + '</div>'
							+ '</div>'
						+ '</div>';
		
		return timetable_string;
	}

	// Check day has timetable or not
	function dayHasTimetable(day, month, year) {
		var num_timetables = 0;
		var date_check = new Date(year, Number(month) - 1, day);
		for (var i = 0; i < quick_timetables.length; i++) { 
			var start_date = new Date(quick_timetables[i].year, Number(quick_timetables[i].month) - 1, quick_timetables[i].day); 
			var end_date = new Date(quick_timetables[i].year, Number(quick_timetables[i].month) - 1, Number(quick_timetables[i].day) + Number(quick_timetables[i].duration) - 1);
			if ((start_date.getTime() <= date_check.getTime()) && (date_check.getTime() <= end_date.getTime())) {
				num_timetables++;
			}
		}
		
		if (num_timetables == 0) {
			return false;
		} else {
			return true;
		}
	}

	// Week Timetable
	function weekTimetable(el, _timetables, category, week, nav_time) {
		var show_category 	= (typeof el.attr('data-category') != 'undefined') ? el.attr('data-category') : 'show';
		var show_nav 		= (typeof el.attr('data-nav') != 'undefined') ? el.attr('data-nav') : 'show';
		var show_time 		= (typeof el.attr('data-header-time') != 'undefined') ? el.attr('data-header-time') : 'show';
		var mode 			= (typeof el.attr('data-mode') != 'undefined') ? el.attr('data-mode') : 'date';
		var day_start 		= (typeof el.attr('data-start') != 'undefined') ? el.attr('data-start') : 'monday';
		
		if (day_start == 'sunday') { // Start with sunday
			var word_day = new Array(word_day_sun, word_day_mon, word_day_tue, word_day_wed, word_day_thu, word_day_fri, word_day_sat);
			var week_days = new Array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		} else { // Start with monday
			var word_day = new Array(word_day_mon, word_day_tue, word_day_wed, word_day_thu, word_day_fri, word_day_sat, word_day_sun);
			var week_days = new Array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
		}
		var word_month = new Array(word_month_1, word_month_2, word_month_3, word_month_4, word_month_5, word_month_6, word_month_7, word_month_8, word_month_9, word_month_10, word_month_11, word_month_12);

		var week_time = new Date(week);
		if (nav_time == 'prev-week') {
			week = getDay(week_time, 'before', 7);
		} else if (nav_time == 'next-week') {
			week = getDay(week_time, 'after', 7);
		}

		var week_first 			= new Date(week);
		var week_first_date 	= week_first.getDate();
		var week_first_month 	= week_first.getMonth() + 1;
		var week_first_year 	= week_first.getFullYear();
		
		var week_last 			= getDay(week_first, 'after', 6);
		var week_last_date 		= week_last.getDate();
		var week_last_month 	= week_last.getMonth() + 1;
		var week_last_year 		= week_last.getFullYear();
			
		var week_nav;
		if ((week_first_month != week_last_month) && (week_first_year != week_last_year)) {
			week_nav = word_month[week_first_month - 1].substring(0, 3) + ' ' + week_first_date + ', ' + week_first_year + ' - ' + word_month[week_last_month - 1].substring(0, 3) + ' ' + week_last_date + ', ' + week_last_year;
		} else if (week_first_month != week_last_month) {
			week_nav = word_month[week_first_month - 1].substring(0, 3) + ' ' + week_first_date + ' - ' + word_month[week_last_month - 1].substring(0, 3) + ' ' + week_last_date + ', ' + week_first_year;
		} else {
			week_nav = word_month[week_first_month - 1].substring(0, 3) + ' ' + week_first_date + ' - ' + week_last_date + ', ' + week_first_year;
		}
		
		// Get axis time
		var axis_time = getAxisTime();
		var min_time = axis_time['min'];
		var max_time = axis_time['max'];
		
		var timetable_string = '';

		// Categories
		if (!(show_category == 'hide')) {
			var active = (category == 'all-category') ? 'active' : '';
			
			timetable_string += '<div class="timetable-category">';
			timetable_string += 	'<ul>';
			timetable_string += 		'<li id="all-category" class="category-item ' + active + '">' + all_category + '</li>';
			for (var i = 0; i < timetable_cats.length; i++) {
				var active = (category == timetable_cats[i].toLowerCase().replace(' ', '-')) ? 'active' : '';
				timetable_string += 	'<li id="' + timetable_cats[i].toLowerCase().replace(' ', '-') + '" class="category-item ' + active + '">'
											+ timetable_cats[i]
										+ '</li>';
			}	
			timetable_string += 	'</ul>';
			timetable_string += '</div>';
		}

		// Time navigation
		if (!(show_nav == 'hide') && !(mode == 'day')) {
			timetable_string += '<div class="timetable-navigation">'
									+ '<span id="prev-week" class="nav nav-prev">‹</span>'	
									+ '<span>' + week_nav + '</span>'
									+ '<span id="next-week" class="nav nav-next">›</span>'
								+ '</div>';
		}

		timetable_string += 	'<div class="timetable-week ' + show_time + '-header-time">';

		// Axis column
		timetable_string += 		'<div class="timetable-column">';
		timetable_string += 			'<div class="column-header"></div>';
		timetable_string += 			'<div class="column-content">';
		for (var n = min_time; n <= max_time; n++) {
			var hour = (n < 10) ? '0' + n : n;
			timetable_string += 			'<div class="axis-item">' + hour + ':00</div>';
		}
		timetable_string += 			'</div>';
		timetable_string += 			'<div class="column-grid">';
		for (var n = min_time; n <= max_time; n++) {
			timetable_string += 			'<div class="grid-item"></div>';
		}
		timetable_string += 			'</div>';
		timetable_string += 		'</div>';

		// Timetables column
		for (var m = 0; m < word_day.length; m++) {
			// Caculate date of column
			var time 	= getDay(week_first, 'after', m);
			var date 	= time.getDate();
			var month 	= time.getMonth() + 1;
			var year 	= time.getFullYear();			
			
			var last_column = (m == word_day.length - 1) ? 'last-column' : '';
			timetable_string += 	'<div class="timetable-column ' + last_column + '">';
			
			// Header
			var header_time = (show_time == 'hide') ? '' : '<div class="week-time">' + word_month[month - 1].substring(0, 3) + ' ' + date + ', ' + year + '</div>';
			if (screen.width > 991) {
				timetable_string += 	'<div class="column-header"><div class="header-container"><div class="week-day">' + word_day[m] + '</div>' + header_time + '</div></div>';
			} else {
				timetable_string += 	'<div class="column-header"><div class="header-container"><div class="week-day">' + word_day[m].substring(0, 3) + '</div>' + header_time + '</div></div>';
			}
			
			// Content
			timetable_string += 		'<div class="column-content">';
			
			// Get timetables on column
			var timetables = getTimetables(_timetables, mode, week_days[m], date, month, year);

			// Group multi timetables on column
			multi_timetables = [];
			for (var t = 0; t < timetables.length; t++) {
				groupMultiTimetables(timetables[t], timetables);
			}
			
			for (var t = 0; t < timetables.length; t++) {
				if (timetables[t].start_time && timetables[t].end_time) {	
					// Position
					var position 	= getTimetablePosition(min_time, timetables[t].start_time);
					var height 		= getTimetableHeight(timetables[t].start_time, timetables[t].end_time);
					
					// Width of timetable
					var count_multi = (multi_timetables.includes(timetables[t].id)) ? multi_timetables.length : 1;
					var item_width 	= (count_multi > 1) ? 'width:' + (100 / count_multi) + '%;' : '';
					var item_left 	= (count_multi > 1) ? 'left:' + (getTimetableOrder(timetables[t], multi_timetables) * (100 / count_multi)) + '%' : '';
					
					timetable_string += 	'<div class="timetable-container">'
												+ '<a class="timetable-item color-' + timetables[t].color + '" style="top:' + position + 'px; height:' + height + 'px; ' + item_width + item_left + '" href="#' + el.attr('id') + '-popup-' + timetables[t].id + '">'
													+ '<div class="timetable-title">'
														+ '<h4>' + timetables[t].title + '</h4>'
														+ '<div class="timetable-time">' + timetables[t].start_time + ' - ' + timetables[t].end_time + '</div>'
													+ '</div>'
												+ '</a>'
												+ '<div id="' + el.attr('id') + '-popup-' + timetables[t].id + '" class="timetable-popup zoom-anim-dialog mfp-hide">'
													+ '<div class="popup-body">'
														+ timetableDetail(timetables[t])
													+ '</div>'
												+ '</div>'
											+ '</div>';
				}
			}
			timetable_string += 		'</div>';
			
			// Grid
			timetable_string += 		'<div class="column-grid">';
			for (var n = min_time; n <= max_time; n++) {
				timetable_string += 		'<div class="grid-item"></div>';
			}
			timetable_string += 		'</div>'
									+ '</div>';
		}
		timetable_string += 		'<div id="category" style="display:none">' + category + '</div>';
		timetable_string += 		'<div id="week" style="display:none">' + week + '</div>';
		timetable_string += 	'</div>';

		el.html(timetable_string);
		
		// Popup
		el.find('.timetable-item').magnificPopup({
			type: 'inline',
			removalDelay: 800,
			mainClass: 'my-mfp-zoom-in'
		});
	}

	// Month Timetable
	function monthTimetable(el, _timetables, category, month_num, year_num, nav_time) {
		var show_category 	= (typeof el.attr('data-category') != 'undefined') ? el.attr('data-category') : 'show';
		var show_nav 		= (typeof el.attr('data-nav') != 'undefined') ? el.attr('data-nav') : 'show';
		var mode 			= (typeof el.attr('data-mode') != 'undefined') ? el.attr('data-mode') : 'date';
		var day_start 		= (typeof el.attr('data-start') != 'undefined') ? el.attr('data-start') : 'monday';

		if (day_start == 'sunday') { // Start with sunday
			var word_day = new Array(word_day_sun, word_day_mon, word_day_tue, word_day_wed, word_day_thu, word_day_fri, word_day_sat);
			var week_days = new Array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		} else { // Start with monday
			var word_day = new Array(word_day_mon, word_day_tue, word_day_wed, word_day_thu, word_day_fri, word_day_sat, word_day_sun);
			var week_days = new Array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
		}
		var word_month = new Array(word_month_1, word_month_2, word_month_3, word_month_4, word_month_5, word_month_6, word_month_7, word_month_8, word_month_9, word_month_10, word_month_11, word_month_12);

		if (nav_time == 'prev-year') {
			year_num--;
		} else if (nav_time == 'next-year') {
			year_num++;
		} else if (nav_time == 'prev-month') {
			month_num--;
		} else if (nav_time == 'next-month') {
			month_num++;
		} else if (nav_time == 'current') {
			month_num = today_month_g;
			year_num = today_year_g;
		}

		if (month_num == 0) {
			month_num = 12;
			year_num--;
		} else if (month_num == 13) {
			month_num = 1;
			year_num++;
		}
		
		// Get first day and number days of month
		var first_date_g = new Date(year_num, month_num - 1, 1);
		if (day_start == 'sunday') {
			var first_day_g = first_date_g.getDay() + 1;
		} else {
			var first_day_g = (first_date_g.getDay() == 0) ? 7 : first_date_g.getDay();
		}
		
		var last_date_g = new Date(year_num, month_num, 0);
		var num_days = last_date_g.getDate();
		
		// Create calendar
		var timetable_string = '';
		var date_num = 0;

		// Categories
		if (!(show_category == 'hide')) {
			var active = (category == 'all-category') ? 'active' : '';
			
			timetable_string += '<div class="timetable-category">';
			timetable_string += 	'<ul>';
			timetable_string += 		'<li id="all-category" class="category-item ' + active + '">' + all_category + '</li>';
			for (var i = 0; i < timetable_cats.length; i++) {
				var active = (category == timetable_cats[i].toLowerCase().replace(' ', '-')) ? 'active' : '';
				timetable_string += 	'<li id="' + timetable_cats[i].toLowerCase().replace(' ', '-') + '" class="category-item ' + active + '">'
											+ timetable_cats[i]
										+ '</li>';
			}	
			timetable_string += 	'</ul>';
			timetable_string += '</div>';
		}

		// Time navigation
		if (!(show_nav == 'hide') && !(mode == 'day')) {
			timetable_string += '<div class="timetable-navigation">'
									+ '<span id="prev-year" class="nav nav-prev">«</span>'
									+ '<span id="prev-month" class="nav nav-prev">‹</span>'
									+ '<span>' + word_month[month_num - 1] + ' ' + year_num + '</span>'
									+ '<span id="next-month" class="nav nav-next">›</span>'
									+ '<span id="next-year" class="nav nav-next">»</span>'
								+ '</div>';
		}
		
		timetable_string += 	'<div class="timetable-month">';
		timetable_string += 		'<div class="timetables-calendar">';
		timetable_string += 			'<table class="calendar-table">';
		timetable_string += 				'<tbody>';
				
		timetable_string += 					'<tr>';
		for (var m = 0; m < word_day.length; m++) {
			timetable_string += 					'<th>' + word_day[m] + '</th>';
		}
		timetable_string += 					'</tr>';

		var this_date = 1;
		
		for (var i = 1; i <= 6; i++) {
			var k = (i - 1) * 7 + 1;
			if (k < (first_day_g + num_days)) {
				timetable_string += 			'<tr>';
				for (var x = 1; x <= 7; x++) {
					date_num = (this_date - first_day_g) + 1;
					this_date++;
					if ((date_num > num_days) || (date_num < 1)) {
						timetable_string += 		'<td class="calendar-day blank"></td>';
					} else {			
						// Weekend
						var weekend_class = '';
						if (day_start == 'sunday') {
							if ((x == 1) || (x == 7)) {
								weekend_class = ' weekend';
							}
						} else {
							if ((x == 6) || (x == 7)) {
								weekend_class = ' weekend';
							}
						}

						// Today
						var today_class = '';
						if ((today_date_g == date_num) && (today_month_g == month_num) && (today_year_g == year_num)) {
							today_class = ' today';
						}

						timetable_string += 	'<td class="calendar-day' + weekend_class + today_class + '">';
						timetable_string += 		'<span class="day-num">' + date_num + '</span>';
							
						// Get timetables
						var day = new Date(year_num, month_num - 1, date_num);
						if (day_start == 'sunday') {
							var day_num = day.getDay();
						} else {
							var day_num = (day.getDay() == 0) ? 6 : day.getDay() - 1;
						}
						var timetables = getTimetables(_timetables, mode, week_days[day_num], date_num, month_num, year_num);

						for (var t = 0; t < timetables.length; t++) {
							var color = timetables[t].color ? timetables[t].color : 1;
																	
							timetable_string += 	'<div class="timetable-title color-' + color + '" href="#' + el.attr('id') + '-popup-' + timetables[t].id + '">'
														+ '<div class="timetable-time">' + timetables[t].start_time + ' - ' + timetables[t].end_time + '</div>'
														+ '<div>' + timetables[t].title + '</div>'
													+ '</div>';
							
							// ==== Timetable detail popup ====
							timetable_string += 	'<div id="' + el.attr('id') + '-popup-' + timetables[t].id + '" class="timetable-popup zoom-anim-dialog mfp-hide">'
														+ '<div class="popup-body">'
							 								+ timetableDetail(timetables[t])
							 							+ '</div>'
							 						+ '</div>';
						}
						
						timetable_string += 	'</td>';
					}
				}
				timetable_string += 		'</tr>';
			}
		}
		timetable_string += 			'</tbody>';
		timetable_string += 		'</table>';
		timetable_string += 		'<div id="category" style="display:none">' + category + '</div>';
		timetable_string += 		'<div id="month" style="display:none">' + month_num + '</div>';
		timetable_string += 		'<div id="year" style="display:none">' + year_num + '</div>';
		timetable_string += 	'</div>';
		
		// Create calendar
		el.html(timetable_string);

		// Popup
		el.find('.timetable-title').magnificPopup({
			type: 'inline',
			removalDelay: 800,
			mainClass: 'my-mfp-zoom-in'
		});
		el.find('.timetable-mark').magnificPopup({
			type: 'inline',
			removalDelay: 800,
			mainClass: 'my-mfp-zoom-in'
		});
	}

	// List Timetable
	function listTimetable(el, _timetables, category, week, nav_time) {
		var show_category 	= (typeof el.attr('data-category') != 'undefined') ? el.attr('data-category') : 'show';
		var show_nav 		= (typeof el.attr('data-nav') != 'undefined') ? el.attr('data-nav') : 'show';
		var show_time 		= (typeof el.attr('data-header-time') != 'undefined') ? el.attr('data-header-time') : 'show';
		var mode 			= (typeof el.attr('data-mode') != 'undefined') ? el.attr('data-mode') : 'date';
		var day_start 		= (typeof el.attr('data-start') != 'undefined') ? el.attr('data-start') : 'monday';
		
		if (day_start == 'sunday') { // Start with sunday
			var word_day = new Array(word_day_sun, word_day_mon, word_day_tue, word_day_wed, word_day_thu, word_day_fri, word_day_sat);
			var week_days = new Array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		} else { // Start with monday
			var word_day = new Array(word_day_mon, word_day_tue, word_day_wed, word_day_thu, word_day_fri, word_day_sat, word_day_sun);
			var week_days = new Array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
		}
		var word_month = new Array(word_month_1, word_month_2, word_month_3, word_month_4, word_month_5, word_month_6, word_month_7, word_month_8, word_month_9, word_month_10, word_month_11, word_month_12);

		var week_time = new Date(week);
		if (nav_time == 'prev-week') {
			week = getDay(week_time, 'before', 7);
		} else if (nav_time == 'next-week') {
			week = getDay(week_time, 'after', 7);
		}

		var week_first 			= new Date(week);
		var week_first_date 	= week_first.getDate();
		var week_first_month 	= week_first.getMonth() + 1;
		var week_first_year 	= week_first.getFullYear();
		
		var week_last 			= getDay(week_first, 'after', 6);
		var week_last_date 		= week_last.getDate();
		var week_last_month 	= week_last.getMonth() + 1;
		var week_last_year 		= week_last.getFullYear();
			
		var week_nav;
		if ((week_first_month != week_last_month) && (week_first_year != week_last_year)) {
			week_nav = word_month[week_first_month - 1].substring(0, 3) + ' ' + week_first_date + ', ' + week_first_year + ' - ' + word_month[week_last_month - 1].substring(0, 3) + ' ' + week_last_date + ', ' + week_last_year;
		} else if (week_first_month != week_last_month) {
			week_nav = word_month[week_first_month - 1].substring(0, 3) + ' ' + week_first_date + ' - ' + word_month[week_last_month - 1].substring(0, 3) + ' ' + week_last_date + ', ' + week_first_year;
		} else {
			week_nav = word_month[week_first_month - 1].substring(0, 3) + ' ' + week_first_date + ' - ' + week_last_date + ', ' + week_first_year;
		}
		
		var timetable_string = '';

		// Categories
		if (!(show_category == 'hide')) {
			var active = (category == 'all-category') ? 'active' : '';
			
			timetable_string += '<div class="timetable-category">';
			timetable_string += 	'<ul>';
			timetable_string += 		'<li id="all-category" class="category-item ' + active + '">' + all_category + '</li>';
			for (var i = 0; i < timetable_cats.length; i++) {
				var active = (category == timetable_cats[i].toLowerCase().replace(' ', '-')) ? 'active' : '';
				timetable_string += 	'<li id="' + timetable_cats[i].toLowerCase().replace(' ', '-') + '" class="category-item ' + active + '">'
											+ timetable_cats[i]
										+ '</li>';
			}	
			timetable_string += 	'</ul>';
			timetable_string += '</div>';
		}

		// Time navigation
		if (!(show_nav == 'hide') && !(mode == 'day')) {
			timetable_string += '<div class="timetable-navigation">'
									+ '<span id="prev-week" class="nav nav-prev">‹</span>'	
									+ '<span>' + week_nav + '</span>'
									+ '<span id="next-week" class="nav nav-next">›</span>'
								+ '</div>';
		}

		timetable_string += 	'<div class="timetable-list ' + show_time + '-header-time">';

		// Timetables row
		for (var m = 0; m < word_day.length; m++) {
			// Caculate date of row
			var time 	= getDay(week_first, 'after', m);
			var date 	= time.getDate();
			var month 	= time.getMonth() + 1;
			var year 	= time.getFullYear();

			// Get timetables on row
			var timetables = getTimetables(_timetables, mode, week_days[m], date, month, year);

			if (timetables.length) {		
				timetable_string += '<div class="timetable-row">';
				
				// Header
				var header_time = (show_time == 'hide') ? '' : '<div class="week-time">' + word_month[month - 1].substring(0, 3) + ' ' + date + ', ' + year + '</div>';
				timetable_string += 	'<div class="row-header"><div class="week-day">' + word_day[m] + '</div>' + header_time + '</div>';
				
				// Content
				timetable_string += 	'<div class="row-content">';
				
				for (var t = 0; t < timetables.length; t++) {
					var color = timetables[t].color ? timetables[t].color : 1;
					timetable_string += '<div class="timetable-item">'
											+ '<div class="timetable-title" href="#' + el.attr('id') + '-popup-' + timetables[t].id + '">'
												+ '<span class="timetable-color color-' + color + '"></span>'
												+ '<span class="timetable-time">' + timetables[t].start_time + ' - ' + timetables[t].end_time + '</span>'
												+ timetables[t].title
											+ '</div>'
											+ '<div id="' + el.attr('id') + '-popup-' + timetables[t].id + '" class="timetable-popup zoom-anim-dialog mfp-hide">'
												+ '<div class="popup-body">'
													+ timetableDetail(timetables[t])
												+ '</div>'
											+ '</div>'
										+ '</div>';
				}
				timetable_string += 	'</div>'
									+ '</div>';
			}
		}
		timetable_string += 		'<div id="category" style="display:none">' + category + '</div>';
		timetable_string += 		'<div id="week" style="display:none">' + week + '</div>';
		timetable_string += 	'</div>';

		el.html(timetable_string);
		
		// Popup
		el.find('.timetable-title').magnificPopup({
			type: 'inline',
			removalDelay: 800,
			mainClass: 'my-mfp-zoom-in'
		});
	}


	$(document).ready(function(){
		$('.quick-timetable').each(function(index) {
			// Set id for timetable
			$(this).attr('id', 'timetable-' + (index + 1));

			// Get variables
			var view 		= (typeof $(this).attr('data-view') != 'undefined') ? $(this).attr('data-view') : 'week';
			var day_start 	= (typeof $(this).attr('data-start') != 'undefined') ? $(this).attr('data-start') : 'monday';

			// Automatic switch to list view on small sreen
			if (screen.width < 768) {
				view = 'list';
			}

			var timetable_contain = $(this);

			$.ajax({
				url: 'timetables.php',
				dataType: 'json',
				data: '',
				success: function(data) {
					// Init
					quick_timetables = [];
					sort_timetables = [];

					// Get data
					for (var i = 0; i < data.length; i++) {
						quick_timetables.push(data[i]);
						sort_timetables.push(data[i]);
					}

					// Process data
					processTimetablesSource();
					
					// Show Timetables
					if (view == 'month') { // Month
						monthTimetable(timetable_contain, quick_timetables, 'all-category', today_month_g, today_year_g, 'current');
					} else if (view == 'list') { // List
						var today_date = new Date();
						if (day_start == 'sunday') { // Start with sunday
							var week = new Date(today_date.setDate(today.getDate() - today_date.getDay()));
						} else { // Start with monday
							var today_day = (today_date.getDay() == 0) ? 7 : today_date.getDay();
							var week = new Date(today_date.setDate(today.getDate() - today_day + 1));
						}
						listTimetable(timetable_contain, quick_timetables, 'all-category', week, 'current');
					} else { // Week
						var today_date = new Date();
						if (day_start == 'sunday') { // Start with sunday
							var week = new Date(today_date.setDate(today.getDate() - today_date.getDay()));
						} else { // Start with monday
							var today_day = (today_date.getDay() == 0) ? 7 : today_date.getDay();
							var week = new Date(today_date.setDate(today.getDate() - today_day + 1));
						}
						weekTimetable(timetable_contain, quick_timetables, 'all-category', week, 'current');
					}
				}
			});
		});

		// Filter category
		$('.quick-timetable').on('click', '.timetable-category ul li', function() {
			var timetable_contain = $(this).closest('.quick-timetable');
			
			// Get timetables by category
			var category = $(this).attr('id');
			var timetables = getTimetablesByCategory(category);

			var view = (typeof timetable_contain.attr('data-view') != 'undefined') ? timetable_contain.attr('data-view') : 'week';

            // Automatic switch to list view on small sreen
			if (screen.width < 768) {
				view = 'list';
			}

            if (view == 'month') { // Month
				var month = timetable_contain.find('#month').text();
				var year = timetable_contain.find('#year').text();
	            monthTimetable(timetable_contain, timetables, category, month, year, 'current');
			} else if (view == 'list') { // List
				var week = timetable_contain.find('#week').text();
            	listTimetable(timetable_contain, timetables, category, week, 'current');
			} else { // Week
				var week = timetable_contain.find('#week').text();
            	weekTimetable(timetable_contain, timetables, category, week, 'current');
			}
        });

        // Navigation
		$('.quick-timetable').on('click', '.timetable-navigation .nav', function() {
			var timetable_contain = $(this).closest('.quick-timetable');
			var nav_time = $(this).attr('id');

			// Get timetables by category
			var category = timetable_contain.find('#category').text();
			var timetables = getTimetablesByCategory(category);

			var view = (typeof timetable_contain.attr('data-view') != 'undefined') ? timetable_contain.attr('data-view') : 'week';
			
			// Automatic switch to list view on small sreen
			if (screen.width < 768) {
				view = 'list';
			}

			if (view == 'month') { // Month
				var month = timetable_contain.find('#month').text();
				var year = timetable_contain.find('#year').text();
	            monthTimetable(timetable_contain, timetables, category, month, year, nav_time);
			} else if (view == 'list') { // List
				var week = timetable_contain.find('#week').text();
	            listTimetable(timetable_contain, timetables, category, week, nav_time);
			} else { // Week
				var week = timetable_contain.find('#week').text();
	            weekTimetable(timetable_contain, timetables, category, week, nav_time);
			}
        });
	});
})(jQuery);