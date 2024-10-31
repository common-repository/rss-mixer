<?php
/*
Plugin Name: RSS Mixer
Plugin URI: http://www.rssmixer.com/wordpress
Description: Display an RSS Mixer mix on your wordpress blog.
Version: 1.0
Licence: GPL
Author: Ideum
Author URI: http://www.ideum.com/
*/

function rssmixer_widget_settings($widget_args=1){
	// SETTINGS PANEL

	global $wp_registered_widgets;
	static $updated = false;

	if(is_numeric($widget_args))
		$widget_args=array('number' => -1);
	$widget_args = wp_parse_args($widget_args, array('number' => -1));
	extract($widget_args, EXTR_SKIP);

	$options = get_option('rssmixer_widget');
	if(!is_array($options))
		$options = array();

	if(!$updated && !empty($_POST['sidebar'])){
		$sidebar = (string) $_POST['sidebar'];
		$sidebars_widgets = wp_get_sidebars_widgets();

		if(isset($sidebar_widgets[$sidebar]))
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach($this_sidebar as $_widget_id){
			if ($wp_registered_widgets[$_widget_id]['callback'] == 'rssmixer_widget_show' && isset($wp_registered_widgets[$_widget_id]['params'][0]['number'])){
				$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
				if (!in_array("rssmixer-$widget_number", $_POST['widget-id']))
					unset($options[$widget_number]);
			}
		}

		foreach((array) $_POST['rssmixer_widget'] as $widgetInstance => $widgetOptions){
			if (!isset($widget_many_instance['mixURL']) && isset($options[$widget_number]) ) // user clicked cancel
				continue;

			$options[$widgetInstance] = $widgetOptions;
		}

		update_option('rssmixer_widget', $options);
		$updated = true; // So that we don't go through this more than once
	}

	if($number == -1){
		$mixURL = '';
		$limit = 5;
		$optStripDescriptionTags = 1;

		$optPostListShow = 1;
		$optPostListShowTitle = 1;
		$optPostListShowFeed = 1;
		$optPostListShowPubDate = 1;
		$optPostListShowDescription = 1;

		$optFeedListShow = 1;
		$optFeedListShowTitle = 1;
		$optFeedListShowDescription = 1;

		$number ='%i%';

	}else{
		extract($options[$number]);
	}

	?>
		<p>
			<label for="rssmixer<?php echo $number; ?>_MixURL">Mix URL
				<input id="rssmixer<?php echo $number; ?>_MixURL" class="widefat" name="rssmixer_widget[<?php echo $number; ?>][mixURL]" type="text" value="<?php echo $mixURL; ?>" />
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_StripDescriptionTags">
				<input id="rssmixer<?php echo $number; ?>_StripDescriptionTags" name="rssmixer_widget[<?php echo $number; ?>][optStripDescriptionTags]" type="checkbox" value="1" <?php if ( $optStripDescriptionTags ) echo 'checked="checked"'; ?>/>
				<?php _e('Strip HTML from description tags?'); ?>
			</label>
		</p>

<h3>Posts Tab</h3>
		<p>
			<label for="rssmixer<?php echo $number; ?>_limit"><?php _e("How many posts would you like to display?"); ?>
				<select id="rssmixer<?php echo $number; ?>_limit" name="rssmixer_widget[<?php echo $number; ?>][limit]">
					<?php
						for($i = 1; $i <= 20; ++$i)
							echo "<option value='$i' " . ( $limit == $i ? "selected='selected'" : '' ) . ">$i</option>";
					?>
				</select>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListShow">
				<input id="rssmixer<?php echo $number; ?>_PostListShow" name="rssmixer_widget[<?php echo $number; ?>][optPostListShow]" type="checkbox" value="1" <?php if ( $optPostListShow ) echo 'checked="checked"'; ?>/>
				<?php _e('Display post list tab?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListShowTitle">
				<input id="rssmixer<?php echo $number; ?>_PostListShowTitle" name="rssmixer_widget[<?php echo $number; ?>][optPostListShowTitle]" type="checkbox" value="1" <?php if ( $optPostListShowTitle ) echo 'checked="checked"'; ?>/>
				<?php _e('Display post title?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListTruncateTitle"><?php _e('Truncate title if it exceeds this length:'); ?>
				<input id="rssmixer<?php echo $number; ?>_PostListTruncateTitle" name="rssmixer_widget[<?php echo $number; ?>][optPostListTruncateTitle]" type="text" value="<?php echo $optPostListTruncateTitle; ?>" />
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListShowFeed">
				<input id="rssmixer<?php echo $number; ?>_PostListShowFeed" name="rssmixer_widget[<?php echo $number; ?>][optPostListShowFeed]" type="checkbox" value="1" <?php if ( $optPostListShowFeed ) echo 'checked="checked"'; ?>/>
				<?php _e('Display feed title?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListShowPubDate">
				<input id="rssmixer<?php echo $number; ?>_PostListShowPubDate" name="rssmixer_widget[<?php echo $number; ?>][optPostListShowPubDate]" type="checkbox" value="1" <?php if ( $optPostListShowPubDate ) echo 'checked="checked"'; ?>/>
				<?php _e('Display post pubdate?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListShowDescription">
				<input id="rssmixer<?php echo $number; ?>_PostListShowDescription" name="rssmixer_widget[<?php echo $number; ?>][optPostListShowDescription]" type="checkbox" value="1" <?php if ( $optPostListShowDescription ) echo 'checked="checked"'; ?>/>
				<?php _e('Display post description?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_PostListTruncateDescription"><?php _e('Truncate description if it exceeds this length:'); ?>
				<input id="rssmixer<?php echo $number; ?>_PostListTruncateDescription" name="rssmixer_widget[<?php echo $number; ?>][optPostListTruncateDescription]" type="text" value="<?php echo $optPostListTruncateDescription; ?>" />
			</label>
		</p>


<h3>Feeds Tab</h3>
		<p>
			<label for="rssmixer<?php echo $number; ?>_FeedListShow">
				<input id="rssmixer<?php echo $number; ?>_FeedListShow" name="rssmixer_widget[<?php echo $number; ?>][optFeedListShow]" type="checkbox" value="1" <?php if ( $optFeedListShow ) echo 'checked="checked"'; ?>/>
				<?php _e('Display feed list tab?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_FeedListShowTitle">
				<input id="rssmixer<?php echo $number; ?>_FeedListShowTitle" name="rssmixer_widget[<?php echo $number; ?>][optFeedListShowTitle]" type="checkbox" value="1" <?php if ( $optFeedListShowTitle ) echo 'checked="checked"'; ?>/>
				<?php _e('Display feed title?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_FeedListTruncateTitle"><?php _e('Truncate title if it exceeds this length:'); ?>
				<input id="rssmixer<?php echo $number; ?>_FeedListTruncateTitle" name="rssmixer_widget[<?php echo $number; ?>][optFeedListTruncateTitle]" type="text" value="<?php echo $optFeedListTruncateTitle; ?>" />
			</label>
		</p>


		<p>
			<label for="rssmixer<?php echo $number; ?>_FeedListShowDescription">
				<input id="rssmixer<?php echo $number; ?>_FeedListShowDescription" name="rssmixer_widget[<?php echo $number; ?>][optFeedListShowDescription]" type="checkbox" value="1" <?php if ( $optFeedListShowDescription ) echo 'checked="checked"'; ?>/>
				<?php _e('Display feed title?'); ?>
			</label>
		</p>

		<p>
			<label for="rssmixer<?php echo $number; ?>_FeedListTruncateDescription"><?php _e('Truncate description if it exceeds this length:'); ?>
				<input id="rssmixer<?php echo $number; ?>_FeedListTruncateDescription" name="rssmixer_widget[<?php echo $number; ?>][optFeedListTruncateDescription]" type="text" value="<?php echo $optFeedListTruncateDescription; ?>" />
			</label>
		</p>


		<input type="hidden" name="rssmixer_widget[<?php echo $number; ?>][submit]" value="1" />
	<?php
}

function rssmixer_widget_show($args, $widget_args=1){
	// WIDET DISPLAY
	extract($args, EXTR_SKIP);
	if(is_numeric($widget_args))
		$widget_args = array('number' => $widget_args);
	$widget_args = wp_parse_args($widget_args, array('number' => -1));
	extract($widget_args, EXTR_SKIP);

	$options = get_option('rssmixer_widget');
	if (!isset($options[$number]))
		return;

	$queryString = "";
	foreach($options[$number] as $name => $value){
		if($name != "mixURL" && $name != "_cache" && $name != "submit")
		   	$queryString .= "&$name=$value";
	}

	$mixURL = $options[$number]["mixURL"]."?basic=1&optNoContainer=1$queryString";
	echo $before_widget;

	$cache = $options[$number]["_cache"];
	if($cache["expires"] - time() < 0){
		$data = file_get_contents($mixURL);
		$options[$number]["_cache"] = array("expires" => (time() + 300), "data" => $data);
		update_option('rssmixer_widget', $options);
	}else{
		$data = $cache["data"];
	}

	echo $data;

	echo $after_widget;
}

function rssmixer_widget_init(){
	if(!$options = get_option('rssmixer_widget'))
		$options = array();

	foreach(array_keys($options) as $instanceIndex){
		if(!isset($options[$instanceIndex]["mixURL"]))
			continue;

		$id = "rssmixer-$instanceIndex";
		$registered = true;

		wp_register_sidebar_widget($id, 'RSS Mixer Widget', 'rssmixer_widget_show', $widget_opts, array('number' => $instanceIndex));
		wp_register_widget_control($id, 'RSS Mixer Widget', 'rssmixer_widget_settings', $control_opts, array('number' => $instanceIndex));
	}

	if(!$registered){
		$id = "rssmixer-1";
		$instanceIndex = -1;

		wp_register_sidebar_widget($id, 'RSS Mixer Widget', 'rssmixer_widget_show', $widget_opts, array('number' => $instanceIndex));
		wp_register_widget_control($id, 'RSS Mixer Widget', 'rssmixer_widget_settings', $control_opts, array('number' => $instanceIndex));
	}

}

add_action('widgets_init', 'rssmixer_widget_init');

?>
