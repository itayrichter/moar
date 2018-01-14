<?php

function MODULE_NAME_t($mahine_name = '', $text = '', $module_name = 'MODULE_NAME'){
	if(function_exists('drupal_package_text_load')){
		$get_text = drupal_package_text_load($module_name.'_'.$mahine_name);
		if(!empty($get_text)) return $get_text;
	}
	$t = variable_get('drupal_package_text_t', array());
	if(empty($t[$module_name][$mahine_name])){
		$t[$module_name][$mahine_name] = $text;
	}
	variable_set('drupal_package_text_t', $t);
	return $text;
}
// MODULE_NAME - Имя модуля

// MODULE_NAME_t('MODULE_NAME_name', 'ТЕСТ');