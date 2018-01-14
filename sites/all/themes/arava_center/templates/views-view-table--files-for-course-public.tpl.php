<?php
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
 
 global $user;
?>
<table class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <tbody>
    <?php foreach ($rows as $count => $row): 
	
	/*
	if(!user_access('access all course')){
		$nid = $row['nid_1'];
		$field_lesson = $row['field_lesson'];
		
		$node = node_load($nid);
		$field_files_restricted = isset($node->field_files_restricted['und'][0]['value']) ? $node->field_files_restricted['und'][0]['value'] : false; 
		//$field_files_restricted = 1;
		
		if($field_files_restricted && $field_lesson){
			$attened = db_query("select attendance_status from {attendance} where student_uid=:student_uid and course_nid=:course_nid and lesson_num=:lesson_num",
									array(':student_uid' => $user->uid, ':course_nid' => $nid, ':lesson_num' => $field_lesson))->fetchField();
			
			if($attened != '1'){
				// skip
				continue;
			}
		}
	}
*/
	
	unset($row['nid_1']);
	unset($row['field_lesson']);
	?>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <?php foreach ($row as $field => $content): 
		?>
          <td class="<?php print $field_classes[$field][$count]; ?>" <?php print drupal_attributes($field_attributes[$field][$count]); ?>>
            <?php print $content; ?>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
