<?php

function arava_registration_semester_timetable_page() {
	global $user;
	if(user_access('access timetable')){
		$output = _arava_registration_generate_all_timetables('page_4');
	}else{
		$output = _arava_registration_generate_all_timetables('page_5');
	}
 return $output;
}
