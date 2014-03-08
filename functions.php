<?php

// Define the version so we can easily replace it throughout the theme
define( 'HOPE_VERSION', 1.0 );

// Load Custom Theme Options
include('includes/theme-options.php');


/*-----------------------------------------------------------------------------------*/
/* Include plugins
/*-----------------------------------------------------------------------------------*/
//include('includes/widgets.php');

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

// This theme supports menus
add_theme_support('menus');

// This theme supports featured images
add_theme_support( 'post-thumbnails' );

// Add custom class to menus with children
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
	}

	return $items;
}

// Disable the_content wpautop
//remove_filter( 'the_content', 'wpautop' );

/*
 * This theme supports custom background image, and here
 * we also set up the default background image.
 */
// $args = array(
// 	'default-image' => get_template_directory_uri() . '/images/current-series-bg.jpg'
// );
// add_theme_support( 'custom-background', $args );


/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus(
	array(
		'primary'	=>	__( 'Primary Menu', 'hope' ), // Register the Primary menu
		'mobile'  =>  __( 'Mobile', 'hope' ), // Register the Mobile menu
		// Copy and paste the line above right here if you want to make another menu,
		// just change the 'primary' to another name
	)
);

/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function hope_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar,
		// just change the values of id and name to another word/name
	));

	register_sidebar(array(
		'id' 						=> 'top_links',
		'name' 					=> __('Top Links', 'hope'),
		'description' 	=> __('Widget to display links at top of site.', 'hope'),
		'empty_title'		=> '',
	));

	register_sidebar(array(
		'id'						=> 'contact_widget',
		'name'					=> __('Contact Sidebar', 'hope'),
		'description'		=> __('Widget to display content on the contact page.', 'hope'),
		'empty_title'		=> '',
		'before_widget' => '<div class="contact-widget">',
		'after_widget'  => '</div>',
	));

	register_sidebar(array(
		'id'   					=> 'sermons_sidebar_widgets',
		'name' 					=> __('Sermons Widgets', 'hope'),
		'description' 	=> __('Widgets for the sermons page.', 'hope'),
		'empty_title' 	=> '',
		'before_widget' => '',
		'after_widget' 	=> '',
	));

	register_sidebar(array(
		'id' 						=> 'footer_widget_1',
		'name' 					=> __('Footer first widget area', 'hope'),
		'description' 	=> __('The footer\'s first widget area(1/4)', 'hope'),
		'before_widget' => '<section class="small-6 medium-3 columns">',
		'after_widget' 	=> '</section>',
		'empty_title' 	=> '',
		'before_title' 	=> '<h6>',
		'after_title' 	=> '</h6>',
	));

	register_sidebar(array(
		'id' 						=> 'footer_widget_2',
		'name' 					=> __('Footer second widget area', 'hope'),
		'description' 	=> __('The footer\'s second widget area(1/4)', 'hope'),
		'before_widget' => '<section class="small-6 medium-3 columns">',
		'after_widget' 	=> '</section>',
		'empty_title' 	=> '',
		'before_title' 	=> '<h6>',
		'after_title' 	=> '</h6>',
	));

	register_sidebar(array(
		'id' 						=> 'footer_widget_3',
		'name' 					=> __('Footer third widget area', 'hope'),
		'description' 	=> __('The footer\'s third widget area(1/4)', 'hope'),
		'empty_title' 	=> '',
		'before_widget' => '',
		'after_widget' 	=> '',
		'before_title' 	=> '<h6>',
		'after_title' 	=> '</h6>',
	));

	register_sidebar(array(
		'id' 						=> 'footer_widget_4',
		'name' 					=> __('Footer fourth widget area', 'hope'),
		'description' 	=> __('The footer\'s fourth widget area(1/4)', 'hope'),
		'empty_title' 	=> '',
		'before_widget' => '',
		'after_widget' 	=> '',
		'before_title' 	=> '<h6>',
		'after_title' 	=> '</h6>',
	));

	register_sidebar(array(
		'id' 						=> 'footer_widget_5',
		'name' 					=> __('Footer fifth widget area', 'hope'),
		'description' 	=> __('The footer\'s fifth widget area(1/4)', 'hope'),
		'before_widget' => '<section class="small-6 medium-3 columns">',
		'after_widget' 	=> '</section>',
		'empty_title' 	=> '',
		'before_title' 	=> '<h6>',
		'after_title' 	=> '</h6>',
	));

	register_sidebar(array(
		'id' 						=> 'hope_footer_copyright',
		'name' 					=> 'Footer Copyright',
		'description' 	=> 'Text for the footer copyright at the bottom of the page.',
		'empty_title' 	=> '',
		'before_widget' => '',
		'after_widget' 	=> '',
	));
}
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'hope_register_sidebars' );



/**
 * trims text to a maximum length, splitting at last word break, and (optionally) appending ellipses and stripping HTML tags
 * @param string $input text to trim
 * @param int $length maximum number of characters allowed
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string
 */
function trim_better($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //strip leading and trailing whitespace
    $input = trim($input);

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //leave space for the ellipses (...)
    if ($ellipses) {
        $length -= 3;
    }

    //this would be dumb, but I've seen dumber
    if ($length <= 0) {
        return '';
    }

    //find last space within length
    //(add 1 to length to allow space after last character - it may be your lucky day)
    $last_space = strrpos(substr($input, 0, $length + 1), ' ');
    if ($last_space === false) {
        //lame, no spaces - fallback to pure substring
        $trimmed_text = substr($input, 0, $length);
    }
    else {
        //found last space, trim to it
        $trimmed_text = substr($input, 0, $last_space);
    }

    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}


/**
 * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 *
 * @return string Trimmed string.
 */
function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				// if tag is a closing tag
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
					unset($open_tags[$pos]);
					}
				// if tag is an opening tag
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length+$content_length> $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($total_length>= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}





/*-----------------------------------------------------------------------------------*/
/* Shortcodes
/*-----------------------------------------------------------------------------------*/

/* Foundation Grid */

function row_grid_function( $atts, $content = null ) {
	return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode('row', 'row_grid_function');

function one_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-1',
		'medium' => 'medium-1'
	), $atts ) );
	return '<div class="small-1 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('one_columns', 'one_columns_function');

function two_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-2',
		'medium' => 'medium-2'
	), $atts ) );
	return '<div class="small-2 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('two_columns', 'two_columns_function');

function three_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-3',
		'medium' => 'medium-3'
	), $atts ) );
	return '<div class="small-3 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('three_columns', 'three_columns_function');

function four_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-4',
		'medium' => 'medium-4'
	), $atts ) );
	return '<div class="small-4 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('four_columns', 'four_columns_function');

function five_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-5',
		'medium' => 'medium-5'
	), $atts ) );
	return '<div class="small-5 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('five_columns', 'five_columns_function');

function six_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-6',
		'medium' => 'medium-6'
	), $atts ) );
	return '<div class="small-6 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('six_columns', 'six_columns_function');

function seven_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-7',
		'medium' => 'medium-7'
	), $atts ) );
	return '<div class="small-7 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('seven_columns', 'seven_columns_function');

function eight_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-8',
		'medium' => 'medium-8'
	), $atts ) );
	return '<div class="small-8 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('eight_columns', 'eight_columns_function');

function nine_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-9',
		'medium' => 'medium-9'
	), $atts ) );
	return '<div class="small-9 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('nine_columns', 'nine_columns_function');

function ten_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-10',
		'medium' => 'medium-10'
	), $atts ) );
	return '<div class="small-10 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('ten_columns', 'ten_columns_function');

function eleven_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-11',
		'medium' => 'medium-11'
	), $atts ) );
	return '<div class="small-11 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('eleven_columns', 'eleven_columns_function');

function twelve_columns_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'large'  => 'large-12',
		'medium' => 'medium-12'
	), $atts ) );
	return '<div class="small-12 '.$medium.' ' .$large.' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('twelve_columns', 'twelve_columns_function');

/* Page sep */
function page_sep_function( $atts, $content = null ) {
	return '<div class="row"><div class="small-12 columns"><hr class="page-sep" /></div></div>';
}
add_shortcode('page_sep', 'page_sep_function');

/* Vert Spacer */
function vert_spacer_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'height' => '0'
	), $atts ) );
	return '<div style="height:'.$atts["height"].'px;">&nbsp;</div>';
}
add_shortcode('vert_spacer', 'vert_spacer_function');

/* Column Headers */
function column_header_function( $atts, $content = null ) {
	return '<h2 class="column-headers">'.$content.'</h2>';
}
add_shortcode('column_header', 'column_header_function');

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function hope_scripts()  {

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style( 'hope-style', get_template_directory_uri() . '/style.css', '10000', 'all' );

	// add fitvid
	wp_enqueue_script( 'hope-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), HOPE_VERSION, true );

	// add theme scripts
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), HOPE_VERSION, true);
	wp_enqueue_script( 'hope', get_template_directory_uri() . '/js/main.js', array(), HOPE_VERSION, true );

	wp_deregister_script('mediaelement');
	wp_enqueue_script('mediaelement',plugins_url() . '/sermon-manager-for-wordpress/js/mediaelement/mediaelement-and-player.min.js', array( 'jquery' ), '' ,true);
	wp_enqueue_style('mediaelement', plugins_url() . '/sermon-manager-for-wordpress/js/mediaelement/mediaelementplayer.min.css');


}
add_action( 'wp_enqueue_scripts', 'hope_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header