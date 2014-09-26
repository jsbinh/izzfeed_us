<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

    // This gets the theme name from the stylesheet
    $themename = wp_get_theme();
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = $themename;
    update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'clonetemplates'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

    // Test data
    $test_array = array(
        'one' => __('One', 'clonetemplates'),
        'two' => __('Two', 'clonetemplates'),
        'three' => __('Three', 'clonetemplates'),
        'four' => __('Four', 'clonetemplates'),
        'five' => __('Five', 'clonetemplates')
    );

    // Multicheck Array
    $multicheck_array = array(
        'one' => __('French Toast', 'clonetemplates'),
        'two' => __('Pancake', 'clonetemplates'),
        'three' => __('Omelette', 'clonetemplates'),
        'four' => __('Crepe', 'clonetemplates'),
        'five' => __('Waffle', 'clonetemplates')
    );

    // Multicheck Defaults
    $multicheck_defaults = array(
        'one' => '1',
        'five' => '1'
    );

    // Background Defaults
    $background_defaults = array(
        'color' => '',
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment'=>'scroll' );

    // Typography Defaults
    $typography_defaults = array(
        'size' => '15px',
        'face' => 'georgia',
        'style' => 'bold',
        'color' => '#bada55' );

    // Typography Options
    $typography_options = array(
        'sizes' => array( '6','12','14','16','20' ),
        'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
        'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
        'color' => false
    );

    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all tags into an array
    $options_tags = array();
    $options_tags_obj = get_tags();
    foreach ( $options_tags_obj as $tag ) {
        $options_tags[$tag->term_id] = $tag->name;
    }


    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // If using image radio buttons, define a directory path
    $imagepath =  get_template_directory_uri() . '/images/';

    $options = array();

    $options[] = array(
        'name' => __('General Settings', 'clonetemplates'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('Favicon', 'clonetemplates'),
        'desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'clonetemplates'),
        'id' => 'favicon',
        'type' => 'upload');

    $options[] = array(
        'name' => __('Apple Touch Icon', 'clonetemplates'),
        'desc' => __('Upload an image, or specify an image URL directly. This image is the favicon of mobile devices and tablets. <b>Size: 152x152</b>', 'clonetemplates'),
        'id' => 'apple_touch_icon',
        'type' => 'upload');

    $options[] = array(
        'name' => __('Logo', 'clonetemplates'),
        'desc' => __('Upload a main logo, or specify an image URL directly. <b>Size: 232x67</b>', 'clonetemplates'),
        'id' => 'logo',
        'type' => 'upload');

    $options[] = array(
        'name' => __('Enable Infinite Scroll', 'clonetemplates'),
        'desc' => __('Check this to enable infinite scroll feature, or it will use numeric pagination instead.', 'clonetemplates'),
        'id' => 'infcr',
        'std' => '1',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('Show Post Meta (Author, Date, Category, etc)', 'clonetemplates'),
        'desc' => __('Check this to show post meta at the footer of post content.', 'clonetemplates'),
        'id' => 'postmeta',
        'std' => '1',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('Admin Bar', 'clonetemplates'),
        'desc' => __('Check this to hide admin bar on all front facing pages on the top', 'clonetemplates'),
        'id' => 'hide_admin_bar',
        'std' => '1',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('Google Analytics', 'clonetemplates'),
        'desc' => __('Please enter in your google analytics tracking code <b>(other tracking codes are also supported)</b> here. Remember to include the entire script from google, if you just enter your tracking ID it won\'t work.', 'clonetemplates'),
        'id' => 'tracking',
        'std' => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('AddThis Script', 'clonetemplates'),
        'desc' => sprintf(__('Please enter in your AddThis script here. <a href="%s" target="_blank">Here is the guide!</a>', 'clonetemplates'), 'http://clonetemplates.com/'),
        'id' => 'addthis',
        'std' => '',
        'type' => 'textarea');

    /**
     * For $settings options see:
     * http://codex.wordpress.org/Function_Reference/wp_editor
     *
     * 'media_buttons' are not supported as there is no post to attach items to
     * 'textarea_name' is set by the 'id' you choose
     */

    $wp_editor_settings = array(
        'wpautop' => true, // Default
        'textarea_rows' => 5,
        'tinymce' => array( 'plugins' => 'wordpress' )
    );

    $options[] = array(
        'name' => __('Footer Copyright Texts', 'clonetemplates'),
        'desc' => sprintf( __( 'You are always welcome to leave a link back to us.  But you can also customize your footer copright texts. <p>Default: Made with &hearts; from <a href="%s" rel="designer" target="_blank">CloneTemplates</a></p>', 'clonetemplates' ), 'http://clonetemplates.com/' ),
        'id' => 'copyright',
        'type' => 'editor',
        'settings' => $wp_editor_settings );

    $options[] = array(
        'name' => __('Social Settings', 'clonetemplates'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('Social Profiles URL', 'clonetemplates'),
        'desc' => __('Appears on the header and footer. Put the full URL in the text input.', 'clonetemplates'),
        'type' => 'info');

    $options[] = array(
        'name' => __('Facebook Page', 'clonetemplates'),
        'desc' => __('Enter in your facebook page URL here', 'clonetemplates'),
        'id' => 'fb',
        'std' => 'https://www.facebook.com/clonetemplates',
        'type' => 'text');

    $options[] = array(
        'name' => __('Twitter Page', 'clonetemplates'),
        'desc' => __('Enter in your Twitter Page URL here', 'clonetemplates'),
        'id' => 'twitter',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Google+ Page', 'clonetemplates'),
        'desc' => __('Enter in your Google+ page URL here', 'clonetemplates'),
        'id' => 'google',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Youtube Page', 'clonetemplates'),
        'desc' => __('Enter in your Youtube page URL here', 'clonetemplates'),
        'id' => 'youtube',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Linkedin Page', 'clonetemplates'),
        'desc' => __('Enter in your Linkedin page URL here', 'clonetemplates'),
        'id' => 'linkedin',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Pinterest Page', 'clonetemplates'),
        'desc' => __('Enter in your Pinterest page URL here', 'clonetemplates'),
        'id' => 'pinterest',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Ad Settings', 'clonetemplates'),
        'type' => 'heading' );

    $options[] = array(
        'name' => __('Settings Guide', 'clonetemplates'),
        'desc' => __('All ad places are defined in the <i><b>Appearance > Widgets</b></i> Panel. Enter your ad codes in the revalent widget area by adding a <i><b>Text</i></b> Widget.', 'clonetemplates'),
        'type' => 'info');

    return $options;
}