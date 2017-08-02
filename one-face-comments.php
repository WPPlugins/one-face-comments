<?php
/*
Plugin Name: One-Face Comments
Plugin URI: http://wordpress.org/extend/plugins/one-face-comments/
Description: Allows visitors to leave comments via One-Face authorization service.
Version: 1.5
Author: Sergey Biryukov
Author URI: http://sergeybiryukov.ru/
*/

if ( function_exists('load_plugin_textdomain') ) {
	load_plugin_textdomain('one-face', 'wp-content/plugins/one-face-comments');
}

function oneface_display() {
?>
<script type="text/javascript"><!--
function one_face_login(personals)
{
	var commentform = document.getElementById('commentform');
	commentform.author.value = personals.nickname;
	commentform.email.value = personals.email;
	commentform.url.value = personals.site;
}
//-->
</script>
<?
	$options = get_option('oneface_settings');
	if ($options['swfobject']) {
?>
<div id="oneface">&nbsp;</div>
<script type="text/javascript"><!--
var so = new SWFObject("<?php echo $options['oneface_url']; ?>", "", "<?php echo $options['width']; ?>", "<?php echo $options['height']; ?>", "6", "<?php echo $options['background']; ?>");
so.addParam('wmode', 'transparent');
so.addParam('allowScriptAccess', 'always');
so.write("oneface");
//-->
</script>
<?
	} else {
?>
<div id="oneface">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $options['width']; ?>" height="<?php echo $options['height']; ?>" align="middle">
	<param name="allowScriptAccess" value="always" />
	<param name="movie" value="<?php echo $options['oneface_url']; ?>" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
<embed src="<?php echo $options['oneface_url']; ?>" quality="high" width="<?php echo $options['width']; ?>" height="<?php echo $options['height']; ?>" name="loginer" wmode="transparent" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</div>
<?
	}
}
add_action('comment_form', 'oneface_display');

function oneface_head() {
	$options = get_option('oneface_settings');
	if (!$options['swfobject'])
		return;
	print('
	<!-- SWFObject embed by Geoff Stearns geoff@deconcept.com http://blog.deconcept.com/swfobject/ -->
	<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/one-face-comments/swfobject.js"></script>
	');
}
add_filter('wp_head', 'oneface_head');

function oneface_add_default_options() {
	$options = get_option('oneface_settings');
	$options['default_url'] = 'http://core.one-face.ru:8000/one-face/loginer.swf';
	if ( empty($options['oneface_url']) ) {
		$options['oneface_url'] = $options['default_url'];
		$options['width'] = 200;
		$options['height'] = 100;
		$options['background'] = '#FFFFFF';
		$options['swfobject'] = true;
	}
	add_option('oneface_settings', $options);
}
add_action('activate_one-face-comments/one-face-comments.php', 'oneface_add_default_options');

function oneface_remove_default_options() {
	delete_option('oneface_settings');
}
add_action('deactivate_one-face-comments/one-face-comments.php', 'oneface_remove_default_options');

function oneface_show_options_page() {
	require(ABSPATH . 'wp-content/plugins/one-face-comments/options.php');
}

function oneface_add_options_page() {
	add_options_page(__('One-Face Comments', 'one-face'), __('One-Face Comments', 'one-face'), 'administrator', __FILE__, 'oneface_show_options_page');
}
add_action('admin_menu', 'oneface_add_options_page');

?>