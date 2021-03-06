<?php

function arava_admin_attendance_choose_lesson_form($form, &$form_state) {
  $form['#prefix'] ='<div id="form-div">';
  $form['#suffix'] ='</div>';
  $form['#tree'] = true;

  $semester_options = _arava_admin_get_semester_options();
  if (!empty($form_state['values']['semester'])) {
    $default_semester = $form_state['values']['semester'];
  }
  elseif (!empty($_GET['semester'])) {
    $default_semester = $_GET['semester'];
  }
  else {
    $default_semester = _arava_admin_get_default_semester();
  }
  $form['semester'] = array(
    '#title' => t('Semester'),
    '#type' => 'select',
    '#options' => $semester_options,
    '#default_value' => $default_semester,
    '#ajax' => array(
      'callback' => 'attendance_choose_semester',
      'wrapper' => 'form-div',
      'method' => 'replace',
      'effect' => 'none',
    ),
  );

  $course_options = _arava_admin_get_course_options($default_semester);
  $default_course = null;
  if (!empty($form_state['triggering_element']) && $form_state['triggering_element']['#name'] != 'semester' && !empty($form_state['values']['course'])) {
    $default_course = $form_state['values']['course'];
  }
  elseif (!empty($_GET['course'])) {
    $default_course = $_GET['course'];
  }
  $form['course'] = array(
    '#title' => t('Course'),
    '#type' => 'select',
    '#options' => $course_options,
    '#default_value' => $default_course,
    '#prefix' => '<div id="course-div">',
    '#suffix' => '</div>',
    '#ajax' => array(
      'callback' => 'attendance_choose_course',
      'wrapper' => 'form-div',
      'method' => 'replace',
      'effect' => 'none',
    ),
  );

  $lesson_options = _arava_admin_get_lesson_options($default_course);
  $form['lesson'] = array(
    '#title' => t('Lesson'),
    '#type' => 'select',
    '#options' => $lesson_options,
    '#default_value' => !empty($_GET['lesson']) ? $_GET['lesson'] : null,
    '#prefix' => '<div id="lesson-div">',
    '#suffix' => '</div>',
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'go',
  );

  return $form;
}

function arava_admin_attendance_choose_lesson_form_submit($form, &$form_state) {
  drupal_goto('admin/attendance/take', array('query' => array(
    'semester' => $form_state['values']['semester'],
    'course' => $form_state['values']['course'],
    'lesson' => $form_state['values']['lesson'],
  )));
}

function arava_admin_take_attendance_form($form, &$form_state) {

  $path = drupal_get_path('module', 'arava_admin');
  drupal_add_js($path . '/js/arava_admin.js');
  drupal_add_css($path . '/css/arava_admin.css');

  $course = !empty($_GET['course']) ? $_GET['course'] : null;
  $lesson = !empty($_GET['lesson']) ? $_GET['lesson'] : null;

  if ((!$course || !is_numeric($course)) || (!$lesson || !is_numeric($lesson))) {
    $form['attendance'] = array(
      '#markup' => t('Please choose a course and lesson above.'),
    );
  }
  else {

    $form['course'] = array(
      '#type' => 'value',
      '#value' => $course,
    );
    $form['lesson'] = array(
      '#type' => 'value',
      '#value' => $lesson,
    );


    $form['attendance'] = array(
      '#type' => 'fieldset',
      '#prefix' => '<div class="attendance_warning">' .
        t('You have changed the selection of semesters, courses or lessons above.<br> The attendance form has not yet changed.') . '<br><br>' .
        t('To take attendance for the lesson you have selected above, please click the "go" button above.') . "<br>" .
        t('To continue with the attendance you were taking, <a class="discard_attendance_warning">click here</a>') .
        '</div>'
    );

    $students = _arava_admin_get_attendance_list_for_lesson($course, $lesson);

    $course_node = node_load($course);
    $course_name = $course_node->title;
    $attendance_status = '<h3>' . t('@course lesson @lesson.', array('@course' => $course_name, '@lesson' => $lesson)) . '</h1>';
    if ($students['first_time']) {
      $attendance_status .= t('Attendance has not yet been taken for this lesson. All students have been marked as present for your
                              convenience. Please remove any student that was not present.');
    }
    else {
      $attendance_status .= t('Attendance has already been taken for this lesson. This is real data. Edit away!');
    }

    $form['attendance']['header'] = array(
      '#markup' => '<div class="students-header">
                      <div class="attendance_status">' . $attendance_status . '</div>
                      <div class="titles">
                        <span class="present">' . t('Present') . '</span>
                        <span class="made_up">' . t('Made Up') . '</span>
                      </div>
                    </div>',
    );

    foreach ($students['names'] as $uid => $student) {
      $form['attendance']['student_' . $uid] = array(
        '#type' => 'checkboxes',
        '#title' => $student['name'],
        '#options' => array(
          1 => t('Present'),
          2 => t('Made up'),
        ),
        '#default_value' => array($student['status']),
      );
    }

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
  }

  return $form;
}

function attendance_choose_semester($form, $form_state) {
  $form_state['rebuild'] = true;
  return $form;
}
function attendance_choose_course($form, $form_state) {
  $form_state['rebuild'] = true;
  return $form;
}
function attendance_choose_lesson($form, $form_state) {
  $form_state['rebuild'] = true;
  return $form;
}

function _arava_admin_get_course_options($semester_id) {
  $query = db_select('node', 'node');
  $query->join('field_data_field_semester', 'semester', 'node.nid = semester.entity_id');
  $query->condition('type', 'course')
    ->condition('field_semester_target_id', $semester_id)
    ->fields('node', array('nid', 'title'))
    ->orderBy('title');
  $result = $query->execute();

  $courses = array(null => '--');
  foreach ($result as $row) {
    $courses[$row->nid] = $row->title;
  }
  return $courses;
}

function _arava_admin_get_lesson_options($course_id) {
  if ($course_id) {
    $result = db_select('field_data_field_num_lessons', 'lessons')
      ->condition('entity_id', $course_id)
      ->fields('lessons', array('field_num_lessons_value'))
      ->execute();

    $num_lessons = 0;
    foreach ($result as $row) {
      $num_lessons = $row->field_num_lessons_value;
    }
  }
  $empty_text = (empty($num_lessons) && $course_id != null) ? t('No lessons defined for this course.') : '--';
  $lessons = array('null' => $empty_text);
  if (!empty($num_lessons)) {
    for ($i = 1; $i <= $num_lessons; $i++) {
      $lessons[$i] = t('lesson') . ' ' . $i;
    }
  }
  return $lessons;
}

/**
 * Get students list for lesson, and populate it with any existing attendance data
 * @param $default_course
 * @param $default_lesson
 */
function _arava_admin_get_attendance_list_for_lesson($course, $lesson) {
  // get attendance for this lesson
  $result = db_select('attendance')
    ->condition('course_nid', $course)
    ->condition('lesson_num', $lesson)
    ->fields('attendance', array('student_uid', 'attendance_status'))
    ->execute();
  $attendance = array();
  foreach ($result as $row) {
    $attendance[$row->student_uid] = $row->attendance_status;
  }
  $select_all = count($attendance) == 0;


  $view_result = _arava_admin_get_students_per_course_view_results($course);

  // get the uids and names from the results
  $names = array();
  foreach ($view_result as $result) {
    $uid = $result->users_field_data_field_user_uid;
    $names[$uid] = array(
      'name' => $result->field_field_user_name[0]['rendered']['#markup'],
      'status' => $select_all ? 1 : $attendance[$uid],
    );
  }
  return array(
    'first_time' => $select_all,
    'names' => $names,
  );
}

/**
 * we already have a view that gets students per course, so let's use that:
 */
function _arava_admin_get_students_per_course_view_results($course) {
  // we already have a view that gets students per course, so let's use that:
  $view = views_get_view('courses_reports');
  $view->set_display('page_2');
  // disable the pager to get all the results
  $pager = $view->display_handler->get_option('pager');
  $pager['type'] = 'none';
  $view->display_handler->set_option('pager', $pager);
  // execute the view
  $view->pre_execute(array($course));
  $view->execute();
  return $view->result;
}

function arava_admin_take_attendance_form_submit($form, &$form_state) {
  global $user;
  foreach($form_state['values'] as $student => $attendance) {
    if (strpos($student, 'student_') === 0) {
      $uid = str_replace('student_', '', $student);
      $present = !empty($attendance[1]);
      $made_up = !empty($attendance[2]);
      $status = $present ? 1 : ($made_up ? 2 : 0);

      _arava_admin_attendance_save($uid, $form_state['values']['course'], $form_state['values']['lesson'], $user->uid, $status);
    }
  }
  drupal_set_message('The attendance data you submitted has been saved.');
}

function _arava_admin_attendance_save($uid, $course, $lesson, $attendance_taker_uid, $status) {
  db_merge('attendance')
    ->key(array(
      'student_uid' => (int)$uid,
      'course_nid' => (int)$course,
      'lesson_num' => (int)$lesson,
    ))
    ->fields(array(
      'attendance_taker_uid' => (int)$attendance_taker_uid,
      'attendance_status' => (int)$status,
      'updated_date' => time(),
    ))
    ->execute();
}

function arava_admin_change_attendance_status($uid, $course, $lesson, $status) {
  global $user;
  _arava_admin_attendance_save($uid, $course, $lesson, $user->uid, $status);
  print "ok";
}

function arava_admin_attendance_report($course) {

  $path = drupal_get_path('module', 'arava_admin');
  drupal_add_js($path . '/js/arava_admin.js');
  drupal_add_css($path . '/css/arava_admin.css');
  drupal_add_library('system', 'ui.dialog');

  $course = node_load(check_plain($course));

  $intro = '<h3>' . t('Course: @course', array('@course' => $course->title)) . '</h3>';
  $intro .= t('index:') . ' ';
  $intro .= '<span class="int-val int-val-0"></span> ' . t('absent') . ' ... ';
  $intro .= '<span class="int-val int-val-1"></span> ' . t('present') . ' ... ';
  $intro .= '<span class="int-val int-val-2"></span> ' . t('made up');
  $intro .= '<br>' . l(t('Back to courses list'), 'admin/admin-courses');


  if (!empty($course->field_num_lessons)) {

    $num_lessons = $course->field_num_lessons[LANGUAGE_NONE][0]['value'];
    $headers = array(t('Student / Lesson'));
    $rows = array();
    $students = array();

    // table headers
    for ($i = 1; $i <= $num_lessons; $i++) {
      $semester = $course->field_semester[LANGUAGE_NONE][0]['target_id'];
      $headers[] = $i . l(t('edit'), 'admin/attendance/take', array('query' => array(
          'semester' => $semester,
          'course' => $course->nid,
          'lesson' => $i,
          'destination' => current_path())));
    }
	
	$headers[] = 'להדפיס חומרים';

    // get the attendance data
    $attendance_data = db_select('attendance')
      ->condition('attendance.course_nid', $course->nid)
      ->fields('attendance', array('student_uid', 'lesson_num', 'attendance_status'))
      ->execute();

    foreach ($attendance_data as $row) {
      $students[$row->student_uid][$row->lesson_num] = $row->attendance_status;
    }

    // get the done data
    module_load_include('inc', 'arava_assignments', 'AssignmentsAPI.class');
    $assignmentsAPI = new AssignmentsAPI();
    $done_data = $assignmentsAPI->getDoneStatusForCourseReports($course->nid);

    // get list of students from view, and add the attendance data and done data
    $view_result = _arava_admin_get_students_per_course_view_results($course->nid);
    foreach ($view_result as $result) {
      $student_lessons = $students[$result->users_field_data_field_user_uid];
      $student_name = '<span class="student-name">' . $result->field_field_user_name[0]['rendered']['#markup'] . '</span>';
      $student_id = $result->users_field_data_field_user_uid;
      $student_name .= '<span class="hidden student-id">'.$student_id.'</span><span class="hidden course-id">'.$course->nid.'</span>';

      $student_row = array($student_name);
      for ($i = 1; $i <= $num_lessons; $i++) {
        $value = !empty($student_lessons[$i]) ? $student_lessons[$i] : 0;
        $unique_class = 'attendance-' . $student_id . '-' . $i;
        $attendance_value = '<span class="attendance-value int-val int-val-' . $value . ' ' . $unique_class . '">' . $value . '</span><span class="hidden lesson-num">'.$i.'</span>';
        foreach (array('homework', 'quiz') as $type) {
          $uid = $result->users_field_data_field_user_uid;
          if (isset($done_data[$i]) && isset($done_data[$i][$type]) && isset($done_data[$i][$type][$uid])) {
            $assignment_id = $done_data[$i][$type]['assignment_id'];
            $assignment_completion_id = $done_data[$i][$type][$uid];
            $attendance_value .= ' ' . l(t($type),
                                        'assignment/' . $assignment_id . '/check/' . $assignment_completion_id,
                                        array('attributes' => array('target' => '_blank')));
          }
        }
        $student_row[] = $attendance_value;
      }
	  
	  $student_row[] = ((isset($result->field_field_no_printed_materials[0]['raw']['value']) && ($result->field_field_no_printed_materials[0]['raw']['value'] == '0')) ? t('Yes') : t('No'));
	  
      $rows[] = $student_row;
    }

    return $intro . theme('table', array('header' => $headers, 'rows' => $rows));
  }
  else {
    return $intro . '<br><br>' . t('No lessons defined for this course. If you have permissions, you can define them here:') . ' '
           . l(t('edit lesson'), 'node/' . $course->nid . '/edit', array('query' => array('destination' => current_path())));
  }
}