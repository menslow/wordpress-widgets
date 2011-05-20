<?php
/*
Widget Name: Internal Ad Widget
Widget URI: 
Description: This widget allow you to put internal ads into the sidebar.
Version: 1.0
Author: Mister Machine
Author URI: http://mistermachine.com
*/

class Widget_Internal_Ad extends WP_Widget {

	// widget actual processes
	function Widget_SMW_Internal_Ad() {
		$widget_ops = array( 'description' => __('Places an internal ad in the sidebar') );
		parent::WP_Widget(false, $name = 'Internal Ad', $widget_ops);
	}

	// outputs the content of the widget
	function widget($args, $instance) {

		extract( $args );
		$ad_title = apply_filters('widget_title', $instance['ad_title']);
		$ad_img_src = apply_filters('widget_title', $instance['ad_img_src']);
		$ad_copy = apply_filters('widget_title', $instance['ad_copy']);
		$ad_href = apply_filters('widget_title', $instance['ad_href']);
		
		?>
		<li class="widget adds">
			<?php if(!empty($ad_img_src)) : ?>
			<a title="<?php echo esc_attr( $ad_title ); ?>" href="<?php echo esc_attr( $ad_href ); ?>"><img src="<?php echo esc_attr( $ad_img_src ); ?>" alt="<?php echo esc_attr( $ad_title ); ?>" /></a>
			<?php endif; ?>
			<?php if(!empty($ad_copy)) : ?>
			<p><a title="<?php echo esc_attr( $ad_title ); ?>" href="<?php echo esc_attr( $ad_href ); ?>"><?php echo esc_html( $ad_copy ); ?></a></p>
			<?php endif; ?>
		</li>
		<?php
	}

	// outputs the options form on admin
	function form($instance) {

		$ad_title = esc_attr($instance['ad_title']);
		$ad_img_src = esc_attr($instance['ad_img_src']);
		$ad_copy = esc_attr($instance['ad_copy']);
		$ad_href = esc_attr($instance['ad_href']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('ad_title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('ad_title'); ?>" name="<?php echo $this->get_field_name('ad_title'); ?>" type="text" value="<?php echo $ad_title ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ad_img_src'); ?>"><?php _e('Image URL:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('ad_img_src'); ?>" name="<?php echo $this->get_field_name('ad_img_src'); ?>" type="text" value="<?php echo $ad_img_src ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ad_copy'); ?>"><?php _e('Copy:'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('ad_copy'); ?>" name="<?php echo $this->get_field_name('ad_copy'); ?>" rows="8" cols="10"><?php echo $ad_copy ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ad_href'); ?>"><?php _e('Link to:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('ad_href'); ?>" name="<?php echo $this->get_field_name('ad_href'); ?>" type="text" value="<?php echo $ad_href ?>" />
		</p>
		<?php 
	}

	// processes widget options to be saved
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['ad_title'] = strip_tags($new_instance['ad_title']);
		$instance['ad_img_src'] = strip_tags($new_instance['ad_img_src']);
		$instance['ad_copy'] = strip_tags($new_instance['ad_copy']);
		$instance['ad_href'] = strip_tags($new_instance['ad_href']);
		return $instance;
	}
	
}
add_action('widgets_init', create_function('', 'return register_widget("Widget_SMW_Internal_Ad");'));
?>