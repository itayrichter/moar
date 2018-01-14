<?php
	$delta_replace = str_replace("-", "_", $block->delta);
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; print ' block_' . $block->module . '_' . $delta_replace?>"<?php print $attributes; ?>>
		  <?php print render($title_prefix); ?>
		<?php if ($block->subject): ?>
		  <div class="block_title"<?php print $title_attributes; ?>><?php print $block->subject ?></div>
		<?php endif;?>
		  <?php print render($title_suffix); ?>
		 <div class="block_content"<?php print $content_attributes; ?>>
		 <?php 
	 		print $content;
		 ?>
  </div>
</div>
