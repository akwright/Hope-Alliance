<?php
/*-----------------------------------------------------------------------------------*/
/* Custom Theme Options
/*-----------------------------------------------------------------------------------*/

/**
 *	Setup defaults for the Theme Options page variables
 */
function hope_get_default_options() {
	$options = array(
		// 'image' 				=> get_template_directory_uri() . '/images/current-series-bg.jpg',
		// 'image_html'  	=> '',
		// 'btn_text' 			=> 'view the series',
		// 'btn_link'			=> 2,
		// 'featured_link' => '',
		'box_1_img'			=> get_template_directory_uri() . '/images/box-image-1.jpg',
		'box_2_img'			=> get_template_directory_uri() . '/images/box-image-2.jpg',
		'box_3_img'			=> get_template_directory_uri() . '/images/box-image-3.jpg',
		'box_1_title'		=> 'Faith',
		'box_2_title' 	=> 'Prayer',
		'box_3_title' 	=> 'Serve',
		'box_1_text'  	=> 'Learn About What We Believe',
		'box_2_text'  	=> 'Submit Your Prayer Requests',
		'box_3_text'  	=> 'Get Involve In Our Ministries',
		'box_1_link'  	=> '',
		'box_2_link'  	=> '',
		'box_3_link'  	=> ''
	);
	return $options;
}

function hope_options_init() {
	$hope_options = get_option('hope_alliance_options');

	if ( false === $hope_options) {
		$hope_options = hope_get_default_options();
		add_option('hope_alliance_options', $hope_options);
	}
}
add_action('after_setup_theme', 'hope_options_init');

function hope_menu_options() {
	add_theme_page(
		'Hope Alliance Theme Options',	// Theme page title text
		'Theme Options',								// Menu item text,
		'administrator',								// Role privileges
		'hope_theme_options',						// Theme menu item slug
		'hope_theme_options_display'		// Callback function
	);
} // end hope_menu_options
add_action('admin_menu', 'hope_menu_options');

function hope_theme_options_display() {
	?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">

		<!-- Add the icon to the page -->
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Hope Alliance Theme Options', 'hope'); ?></h2>

		<!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
		<?php settings_errors(); ?>

		<!-- Create the form that will be used to render our options -->
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php
				settings_fields( 'hope_alliance_options' );
				do_settings_sections( 'hope' );
			?>
			<p class="submit">
				<input name="hope_alliance_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'hope'); ?>" />
				<input name="hope_alliance_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'hope'); ?>" />
			</p>
		</form>

	</div><!-- /.wrap -->
	<?php
} // end hope_theme_options_display

/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action('admin_init', 'hope_initialize_theme_options');
function hope_initialize_theme_options() {

	/**
	 * Header Image Section
	 */

	// add_settings_section(
	// 	'hope_header_section',
	// 	__( 'Header Image Options', 'hope' ),
	// 	'hope_header_callback',
	// 	'hope'
	// );

	// add_settings_field(
	// 	'hope_header_image_field',
	// 	__( 'Featured Image', 'hope' ),
	// 	'hope_header_image_callback',
	// 	'hope',
	// 	'hope_header_section',
	// 	array(
	// 		'Upload a header image to be displayed on the homepage.'
	// 	)
	// );

	// add_settings_field(
	// 	'hope_header_image_text_field',
	// 	__( 'Featured Image HTML', 'hope' ),
	// 	'hope_header_image_text_callback',
	// 	'hope',
	// 	'hope_header_section',
	// 	array(
	// 		'Add the HTML to be displayed on the header image.'
	// 	)
	// );

	// add_settings_field(
	// 	'hope_header_btn_text_field',
	// 	__( 'Featured Button Text', 'hope' ),
	// 	'hope_header_btn_text_callback',
	// 	'hope',
	// 	'hope_header_section',
	// 	array(
	// 		'Edit the text for the Call To Action button.'
	// 	)
	// );

	// add_settings_field(
	// 	'hope_header_btn_link_field',
	// 	__( 'Featured Button Link', 'hope' ),
	// 	'hope_header_btn_link_callback',
	// 	'hope',
	// 	'hope_header_section',
	// 	array(
	// 		'Set page the Call To Action button links to.'
	// 	)
	// );


	/**
	 * Boxes Section
	 */

	for ($i = 1; $i < 4; $i++) {
		add_settings_section(
			'hope_box_' . $i . '_section',
			__( 'Box ' . $i . ' Options', 'hope' ),
			'hope_box_callback',
			'hope'
		);

		add_settings_field(
			'hope_box_' . $i .'_image_field',
			__( 'Box ' . $i . ' image', 'hope' ),
			'hope_box_image_callback',
			'hope',
			'hope_box_' . $i .'_section',
			array(
				'Set the background image for box ' . $i,
				$i
			)
		);

		add_settings_field(
			'hope_box_' . $i .'_title_field',
			__( 'Box ' . $i . ' title', 'hope' ),
			'hope_box_title_callback',
			'hope',
			'hope_box_' . $i .'_section',
			array(
				'Set the main title for box ' . $i,
				$i
			)
		);

		add_settings_field(
			'hope_box_' . $i .'_text_field',
			__( 'Box ' . $i . ' text', 'hope' ),
			'hope_box_text_callback',
			'hope',
			'hope_box_' . $i .'_section',
			array(
				'Set the link text for box ' . $i,
				$i
			)
		);

		add_settings_field(
			'hope_box_' . $i .'_link_field',
			__( 'Box ' . $i . ' link', 'hope' ),
			'hope_box_link_callback',
			'hope',
			'hope_box_' . $i .'_section',
			array(
				'Set what page box ' . $i . ' links to',
				$i
			)
		);

	}



	/**
	 * Register Settings
	 */

	register_setting(
		'hope_alliance_options',
		'hope_alliance_options',
		'hope_options_validate'
	);
} // end hope_initialize_theme_options

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */

function hope_header_callback() {
	echo '<p>Change the options for the header image below.</p>';
} // end hope_header_section_callback

function hope_header_image_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
		<input type="text" id="image_url" name="hope_alliance_options[image]" value="<?php echo esc_url( $hope_options['image'] ); ?>" />
		<input id="upload_image_button" type="button" class="upload-btn button" value="<?php _e( 'Upload Image', 'hope' ); ?>" />
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}

function hope_header_image_text_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
		<textarea id="image_html" name="hope_alliance_options[image_html]"><?php echo $hope_options['image_html']; ?></textarea>
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}

function hope_header_btn_text_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
		<input type="text" id="btn_text" name="hope_alliance_options[btn_text]" value="<?php echo $hope_options['btn_text']; ?>" />
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}

function hope_header_btn_link_callback($args) {
	$hope_options = get_option('hope_alliance_options');

		wp_dropdown_pages(
			array(
				'echo'     => 1,
				'id'			 => 'btn_link',
				'name'		 => 'hope_alliance_options[btn_link]',
				'selected' => $hope_options['btn_link']
			)
		);

		$terms = get_terms('wpfc_sermon_series');
		?>
		<select id="series" name="hope_alliance_options[featured_link]">
		<?php foreach ($terms as $key=>$value) {?>
			<option <?php echo $value->slug == $hope_options['featured_link'] ? ' selected="selected"' : '' ?> value="<?php echo $value->slug ?>"><?php echo $value->name; ?></option>
		<?php } ?>
		</select>
		<p class="description"><?php echo $args[0]; ?></p>
		<?php
}

function hope_box_callback() {
	echo '<p>Change the options for the box below.</p>';
}

function hope_box_image_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
		<input type="text" id="box_url_<?php echo $args[1]; ?>" name="hope_alliance_options[box_<?php echo $args[1]; ?>_img]" value="<?php echo esc_url( $hope_options['box_' . $args[1] . '_img'] ); ?>" />
		<input id="upload_box_<?php echo $args[1]; ?>_button" type="button" class="upload-btn button" value="<?php _e( 'Upload Image', 'hope' ); ?>" />
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}

function hope_box_title_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
		<input type="text" id="box_title_<?php echo $args[1]; ?>" name="hope_alliance_options[box_<?php echo $args[1]; ?>_title]" value="<?php echo $hope_options['box_' . $args[1] . '_title'] ?>" />
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}

function hope_box_text_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
		<input type="text" id="box_text_<?php echo $args[1]; ?>" name="hope_alliance_options[box_<?php echo $args[1]; ?>_text]" value="<?php echo $hope_options['box_' . $args[1] . '_text'] ?>" />
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}

function hope_box_link_callback($args) {
	$hope_options = get_option('hope_alliance_options');
	?>
	<?php
		wp_dropdown_pages(
				array(
					'echo'     => 1,
					'id'			 => 'box_link_' . $args[1],
					'name'		 => 'hope_alliance_options[box_' . $args[1] . '_link]',
					'selected' => $hope_options['box_' . $args[1] . '_link']
				)
			);
		?>
		<p class="description"><?php echo $args[0]; ?></p>
	<?php
}



function hope_options_validate($input) {

	//var_dump($input);

	$default_options = hope_get_default_options();
	$output = array();

	$submit = !empty($input['submit']) ? true : false;
	$reset =  !empty($input['reset'])  ? true : false;

	foreach($input as $key => $val) {
		if(isset($input[$key])) {
			if ($submit)
				$output[$key] = $input[$key];
			else if ($reset)
				$output[$key] = $default_options[$key];
		}
	}

	return apply_filters('hope_options_validate', $output, $input);
} // end hope_options_validate

function hope_header_custom_styles() {
	$options = get_option('hope_alliance_options');
	?>
	<style id="header-styles" type="text/css">
		/* Admin Styles */
		#image_html { width: 320px; min-height: 80px; resize: vertical; }

		/* Front End Styles */
		#slider {
			/*background: url('<?php echo $options['image']; ?>') no-repeat center top;*/
			/*background-size: cover;*/
			max-height: 470px;
		}
			/*#slider h3,
			#slider h1 { color: white; margin: 0; }

			#slider h3 {
				display: block;
				margin-top: 93px;
				font-size: 1.875em;
				font-weight: normal;
			}
			#slider h1 {
				font-size: 11.25em;
				font-weight: normal;
				line-height: .8;
				text-shadow: 15px 20px 5px rgba(155,11,0, .3);
			}*/
			.vollkorn { font-family: 'Vollkorn', Georgia, serif; }

			#slider a.white-outline {
				border: 3px solid white;
				color: white;
				display: inline-block;
				font-size: 1.125em;
				font-weight: bold;
				margin-top: 40px;
				padding: .75em 1.5em;
				text-decoration: none;
				text-transform: uppercase;
				-webkit-transition: background-color 0.3s ease-in-out;
			}
				#slider a.white-outline:hover {
					background-color: rgba(255,255,255,.2);
				}
				#slider a.white-outline span {
					-webkit-transition: left 0.2s ease-in-out;
				}
				#slider a.white-outline:active span {
					position: relative;
					left: 5px;
				}

				@media screen and (max-width: 640px) {
					#slider a.white-outline { display: block; margin: 40px auto 0; text-align: center; }
				}

		.home-box { height: 200px; position: relative; background-size: cover !important; }
			.box-1 { background: url(<?php echo $options['box_1_img']; ?>) no-repeat center bottom; }
			.box-2 { background: url(<?php echo $options['box_2_img']; ?>) no-repeat center; }
			.box-3 { background: url(<?php echo $options['box_3_img']; ?>) no-repeat center top; }

			@media screen and (max-width: 640px) {
				.home-box { margin-bottom: 15px; }
			}

			.box-mask {
				position: absolute;
				top: 0; left: 0;
				height: 100%;
				width: 100%;
			}
				.box-1 .box-mask { background-color: rgba(40,144,210, .3); }
				.box-2 .box-mask { background-color: rgba(54,159,21, .3); }
				.box-3 .box-mask { background-color: rgba(200,85,23, .3); }

			.home-box h1,
			.home-box p {
				margin: 0;
				line-height: 1;
				position: relative;
				z-index: 2;
			}
			.home-box a { text-decoration: none; }

			.home-box h1 {
				color: white;
				font-size: 3em;
				font-weight: normal;
				margin-right: 10px;
				padding-top: 110px;
				text-align: right;
				text-transform: uppercase;
			}

			.home-box p {
				color: white;
				font-size: .875em;
				line-height: 30px;
				min-height: 30px;
				text-align: right;
				position: absolute;
				bottom: 0; left: 0;
				width: 100%;
			}
				.box-1 p { background-color: rgba(22,71,103, .4); }
				.box-2 p { background-color: rgba(30,87,12, .4); }
				.box-3 p { background-color: rgba(91,32,0, .4); }

				.home-box p i {
					margin-right: 4px;
					position: relative;
					top: 2px;
				}

	</style>
	<?php
}
add_action('wp_head', 'hope_header_custom_styles');


/**
 *	Enqueue scripts for media uploader
 */

function hope_theme_enqueue_script(){
	wp_enqueue_media();
	wp_enqueue_script('custom-header');
  wp_enqueue_script('media-upload'); // we need this for WordPress Uploader frame
  wp_enqueue_script('thickbox');
  wp_enqueue_style('thickbox');

}
add_action('admin_enqueue_scripts','hope_theme_enqueue_script');


function hope_header_custom_script() {
?>
	<script type="text/javascript">
		$ = jQuery.noConflict();

		function checkSeriesID(btn_sel, series_sel) {
			if ($(btn_sel).val() == '13') {
				$(series_sel).css('opacity', 0).show().stop().animate({ opacity: 1 }, 500);
			} else {
				$(series_sel).val('');
				$(series_sel).stop().animate({ opacity: 0 }, 300, function() { $(this).hide(); })
			}
		}

		$(document).ready(function() {
			// Show series dropdown if btn link page == Sermons
			var series_sel = $('#series'),
					btn_txt_sel = $('#btn_link');

			checkSeriesID(btn_txt_sel, series_sel);

			btn_txt_sel.on('change', function() {
				checkSeriesID(btn_txt_sel, series_sel);
			});

			// Fire wp media upload
	    $(".upload-btn").click(function(event) {
	    	var $this = $(this);
	      var myUploadFrame = false;
	      event.preventDefault();
	      if (myUploadFrame) {
	        myUploadFrame.open();
	        return
	      }
	      myUploadFrame = wp.media.frames.my_upload_frame = wp.media({
	        frame: "select",
	        title: "Upload an image",
	        library: {
	          type: "image"
	        },
	        button: {
	          text: "Set as Image",
	        },
	        multiple: false
	      });
	      myUploadFrame.on("select", function ()
	      {
	        var selection = myUploadFrame.state().get("selection");
	        selection.map(function (attachment)
	        {
	          attachment = attachment.toJSON();
	          if (attachment.url) {
	            var newImageURL = attachment.url;
	            $this.prev().val(newImageURL);
	          }
	        })
	      });
	      myUploadFrame.open()
	    })
		});
	</script>
	<?php
}
add_action('admin_print_footer_scripts', 'hope_header_custom_script');