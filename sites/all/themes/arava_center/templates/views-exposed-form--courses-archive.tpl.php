<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>
<div class="views-exposed-form">
  <div class="views-exposed-widgets clearfix">
    <?php foreach ($widgets as $id => $widget): ?>
      <div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
        <?php if (!empty($widget->label)): ?>
          <label for="<?php print $widget->id; ?>">
            <?php print $widget->label; ?>
          </label>
        <?php endif; ?>
        <?php if (!empty($widget->operator)): ?>
          <div class="views-operator">
            <?php print $widget->operator; ?>
          </div>
        <?php endif; ?>
        <div class="views-widget">
<?php 
$html = $widget->widget;
$html = str_replace('name="title"', 'name="t"', $html);

$html = str_replace('name="semester"', 'name="s"', $html);
$html = str_replace('class="form-select">', 'class="form-select"><option value="all">'.t('All').'</option>', $html);

$html = str_replace('selected="selected"', '', $html);
if(!isset($_GET['s']) || !$_GET['s'] || $_GET['s'] == 'all'){
	
}else{
	$value = isset($_GET['s']) ? $_GET['s'] : false;
	if($value){
		$html = str_replace('value="'.$value.'"', 'value="'.$value.'" selected="selected"', $html);
	}
}

print $html; ?>
        </div>
        <?php if (!empty($widget->description)): ?>
          <div class="description">
            <?php print $widget->description; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    <?php if (!empty($sort_by)): ?>
      <div class="views-exposed-widget views-widget-sort-by">
        <?php print $sort_by; ?>
      </div>
      <div class="views-exposed-widget views-widget-sort-order">
        <?php print $sort_order; ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($items_per_page)): ?>
      <div class="views-exposed-widget views-widget-per-page">
        <?php print $items_per_page; ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($offset)): ?>
      <div class="views-exposed-widget views-widget-offset">
        <?php print $offset; ?>
      </div>
    <?php endif; ?>
    <div class="views-exposed-widget views-submit-button">
      <?php print $button; ?>
    </div>
    <?php if (!empty($reset_button)): ?>
      <div class="views-exposed-widget views-reset-button">
        <?php print $reset_button; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<input type="hidden" name="title" value="" id="title_hidden">
<input type="hidden" name="s2" value="" id="semester_hidden">
<script>
jQuery("#views-exposed-form-courses-archive-page").submit(function(){
	//if(jQuery("#views-exposed-form-courses-archive-page .form-type-select select").val() != 'all'){
		jQuery("#semester_hidden").val(jQuery("#views-exposed-form-courses-archive-page .form-type-select select").val());
	//}
	
	//if(jQuery("#views-exposed-form-courses-archive-page .form-type-textfield input").val() != ''){
		jQuery("#title_hidden").val(jQuery("#views-exposed-form-courses-archive-page .form-type-textfield input").val());
	//}
	jQuery("#semester_hidden").attr("name", "s");
	
	return true;
});
</script>
