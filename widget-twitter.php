<?php
/*
Widget Name: Twitter Widget
Widget URI: 
Description: This widget allows you to add a twitter feed to the sidebar of your site.
Version: 1.0
Author: Mister Machine
Author URI: http://mistermachine.com
*/
class Widget_Twitter extends WP_Widget {

	// widget actual processes
	function Widget_Twitter() {
		$widget_ops = array( 'description' => __('Add a twitter feed to your sidebar') );
		parent::WP_Widget(false, $name = 'Twitter Feed', $widget_ops);
	}

	// outputs the content of the widget
	function widget($args, $instance) {

		extract( $args );
		$handle = apply_filters('widget_title', $instance['handle']);
		$list_name = apply_filters('widget_title', $instance['list_name']);
		$type = apply_filters('widget_title', $instance['type']);
		$search_phrase = apply_filters('widget_title', $instance['search_phrase']);

		?>
		<li class="widget twitter_feed">
			<h3 class="caps">Twitter Updates</h3>
			<script src="http://widgets.twimg.com/j/2/widget.js" type="text/javascript"></script>
			<script type="text/javascript">
			new TWTR.Widget({
				version: 2,
				type: '<?php echo $type ?>',
				search: '<?php echo $search_phrase ?>',
				rpp: 20,
				title: '',
				subject: '',
				interval: 6000,
				width: 210,
				height: 350,
				theme: {
					shell: {
					background: '#ffffff',
					color: '#000000'
				},
				tweets: {
					background: '#ffffff',
					color: '#000000',
					links: '#1b55a8'
					}
				},
				features: {
					scrollbar: false,
					loop: true,
					live: true,
					hashtags: true,
					timestamp: true,
					avatars: false,
					behavior: 'default'
				}
				<?php if ( $type==='list' ) : ?>
				}).render().setList('<?php echo $handle ?>', '<?php echo $list_name ?>').start();
				<?php elseif ( $type==='profile' ) : ?>
				}).render().setUser('<?php echo $handle ?>').start();
				<?php else : ?>
				}).render().start();
				<?php endif; ?>
			</script>
		</li>
		<?php
	}

	// outputs the options form on admin
	function form($instance) {

		$handle = esc_attr($instance['handle']);
		$list_name = esc_attr($instance['list_name']);
		$type = esc_attr($instance['type']);
		$search_phrase = esc_attr($instance['search_phrase']);
		?>
			<p>
				<label for="<?php echo $this->get_field_id('handle'); ?>"><?php _e('Username:'); ?>
					<input class="" id="<?php echo $this->get_field_id('handle'); ?>" name="<?php echo $this->get_field_name('handle'); ?>" type="text" value="<?php echo $handle ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Feed type:'); ?>
					<select class="" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" value="<?php echo $type ?>">
						<option value="profile" <?php if ( $type==='profile' ) : echo 'selected'; endif; ?>>profile</option>
						<option value="list" <?php if ( $type==='list' ) : echo 'selected'; endif; ?>>list</option>
						<option value="search" <?php if ( $type==='search' ) : echo 'selected'; endif; ?>>search</option>
					</select>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('list_name'); ?>"><?php _e('List Name:'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('list_name'); ?>" name="<?php echo $this->get_field_name('list_name'); ?>" type="text" value="<?php echo $list_name; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('search_phrase'); ?>"><?php _e('Search Phrase:'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('search_phrase'); ?>" name="<?php echo $this->get_field_name('search_phrase'); ?>" type="text" value="<?php echo $search_phrase; ?>" />
				</label>
			</p>
		<?php 
	}

	// processes widget options to be saved
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['handle'] = strip_tags($new_instance['handle']);
		$instance['list_name'] = strip_tags($new_instance['list_name']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['search_phrase'] = strip_tags($new_instance['search_phrase']);
		return $instance;
	}
	
}
add_action('widgets_init', create_function('', 'return register_widget("Widget_Twitter");'));
?>