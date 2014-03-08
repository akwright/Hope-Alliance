<?php

//Add an action that will load all widgets
add_action( 'widgets_init', 'hope_load_widgets' );

//Function that registers the widgets
function hope_load_widgets() {
	register_widget('hope_time_widget');
}

/*-----------------------------------------------------------------------------------

	Plugin Name: Hope Time Widget
	Description: A widget that displays your sermon time
	Version: 1.0
	Author: Alex Wright
	Author URI: http://www.akwright.com

-----------------------------------------------------------------------------------*/

class hope_time_widget extends WP_Widget {

	function hope_time_widget (){

		$widget_ops = array( 'classname' => 'time', 'description' => 'A widget that displays your sermon time on Sundays.' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'time-widget' );
		$this->WP_Widget( 'time-widget', 'Hope Time Widget', $widget_ops, $control_ops );

	}

	function widget($args, $instance){

		extract($args);

		$day = $instance['day'];
		$time = $instance['time'];

		echo $before_widget;

		echo '<p id="time">' . $day . ' ' . $phone . '</p>';

		echo $after_widget;

	}

	function update($new_instance, $old_instance){

		$instance = $old_instance;

		$instance['day'] = strip_tags($new_instance['day']);
		$instance['time'] = strip_tags($new_instance['time']);

		return $instance;

	}

	function form($instance){

		$defaults = array( 'day' => '', 'time' => '' );

		$instance = wp_parse_args((array) $instance, $defaults);

		?>


			<p>
				<label for="<?php echo $this->get_field_id( 'day' ); ?>"><?php _e('Day service is on (to display):', 'hope'); ?></label>
				<input id="<?php echo $this->get_field_id( 'day' ); ?>" name="<?php echo $this->get_field_name( 'day' ); ?>" value="<?php echo $instance['day']; ?>" style="width:100%;" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'time' ); ?>"><?php _e('Time service starts (to display):', 'hope'); ?></label>
				<input id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" value="<?php echo $instance['time']; ?>" style="width:100%;" />
			</p>

		<?php

	}

}

?>