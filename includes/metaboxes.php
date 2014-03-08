<?php
add_action( 'admin_init', 'hope_meta_boxes' );

global $sidebars_array;

function hope_meta_boxes() {

    /*---------------------------------
        INIT SOME USEFUL VARIABLES
    ------------------------------------*/

    $sidebars = ot_get_option('hope_sidebars');
    $sidebars_array = array();
    $sidebars_k = 0;
    if(!empty($sidebars)){
        foreach($sidebars as $sidebar){
            $sidebars_array[$sidebars_k++] = array(
                'label' => $sidebar['title'],
                'value' => $sidebar['id']
            );
        }
    }

    /*---------------------------------
        SIDEBARS - In all kinds of pages
    ------------------------------------*/

    $hope_meta_box_sidebar = array(
        'id'        => 'hope_meta_box_sidebar',
        'title'     => 'Layout',
        'desc'      => 'If you select a layout with a sidebar, please choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Theme Widgets.',
        'pages'     => array( 'page' ),
        'context'   => 'side',
        'priority'  => 'high',
        'fields'    => array(
            array(
                'id'          => 'hope_meta_box_sidebar_layout',
                'label'       => 'Layout type',
                'desc'        => '',
                'std'         => 'full-width',
                'type'        => 'radio_image',
                'class'       => ''
            ),
              array(
                'id'          => 'hope_meta_box_sidebar_set',
                'label'       => 'Select sidebar',
                'desc'        => '',
                'std'         => '',
                'type'        => 'select',
                'class'       => '',
                'choices'     => $sidebars_array
            )
        )
    );

    /*---------------------------------
        INIT METABOXES
    ------------------------------------*/

    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : 'no');
    $template_file = $post_id != 'no' ? get_post_meta($post_id,'_wp_page_template',TRUE) : 'no';

    ot_register_meta_box($hope_meta_box_sidebar);
}
?>