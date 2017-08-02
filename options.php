<?php
/*
Author: Sergey Biryukov
Author URI: http://sergeybiryukov.ru/
Description: Administrative options for One-Face Comments
*/

$options = get_option('oneface_settings');
if ( !empty($_POST['submit_oneface_settings']) ) : 
	$options['oneface_url'] = $_POST['oneface_url'];
	$options['width'] = $_POST['width'];
	$options['height'] = $_POST['height'];
	$options['background'] = $_POST['background'];
	$options['swfobject'] = isset($_POST['swfobject']) ? true : false;
	update_option('oneface_settings', $options);
?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.', 'one-face') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
	<h2><?php _e('One-Face Comments Options', 'one-face'); ?></h2>
		<form action="" method="post" id="oneface_conf">

			<p>
				<label for="oneface_url"><?php _e('One-Face block URL:', 'one-face'); ?></label>
				<input type="text" name="oneface_url" id="oneface_url" value="<?php echo $options['oneface_url']; ?>" size="65" /> | <a href="http://one-face.ru/webmaster-reference.htm"><?php _e('Block examples', 'one-face'); ?></a><br />
				<?php printf(__('(Default: %s)', 'one-face'), $options['default_url']); ?>
			</p>

			<p>
				<label for="width"><?php _e('Width:', 'one-face'); ?></label>
				<input type="text" name="width" id="width" value="<?php echo $options['width']; ?>" size="2" />
				<label for="height"><?php _e('Height:', 'one-face'); ?></label>
				<input type="text" name="height" id="height" value="<?php echo $options['height']; ?>" size="2" />
				<label for="background"><?php _e('Background color:', 'one-face'); ?></label>
				<input type="text" name="background" id="background" value="<?php echo $options['background']; ?>" size="7" />
			</p>

			<p>
				<label for="swfobject"><?php _e('Use SWFObject script to insert?', 'one-face'); ?></label>
				<input type="checkbox" name="swfobject" id="swfobject" value="<?php echo $options['swfobject']; ?>" <?php if ($options['swfobject']) echo 'checked="checked"'; ?> /><br />
			</p>
		
			<p class="submit">
				<input type="submit" name="submit_oneface_settings" value="<?php _e('Update Options &raquo;', 'one-face'); ?>" />
			</p>
		</form>
</div>
