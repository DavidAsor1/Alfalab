<?php

function my_max_image_size($file)
{
    $size = $file['size'];
    $size = $size / 1024;
    $type = $file['type'];
    $is_image = strpos($type, 'image') !== false;
    $limit = 690;
    $limit_output = '750kb';
    if ($is_image && $size > $limit) {
        $file['error'] = 'המשקל של התמונה צריך להיות קטן מ ' . $limit_output;
    }
    return $file;
}

add_filter('wp_handle_upload_prefilter', 'my_max_image_size');



function theme_setup()
{

    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
    add_theme_support('responsive-embeds');
    add_theme_support('menus');

    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'theme'),
            'footer' => __('Footer Menu', 'theme'),
        )
    );

}
add_action('after_setup_theme', 'theme_setup');

function theme_scripts()
{
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), wp_get_theme()->get('Version'), '');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), wp_get_theme()->get('Version'), '');
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;bold;bolder;&display=swap', array(), wp_get_theme()->get('Version'), '');
    wp_enqueue_style('google-font-hebo', 'https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;700;800;900&display=swap', array(), wp_get_theme()->get('Version'), '');
    wp_enqueue_style('style', get_stylesheet_uri(), array(), time());

    // wp_deregister_script('jquery');
    // wp_register_script('jquery', includes_url('/assets/js/jquery/jquery.min.js'), [], NULL, true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', get_theme_file_uri('/assets/js/bootstrap.bundle.min.js'), array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-js', get_theme_file_uri('/assets/js/custom.js'), array(), time(), true);

    //wp_enqueue_script('owl-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), time(), true);
    //wp_enqueue_style('style-owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), time());
    //wp_enqueue_style('style-owl-2', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array(), time());
}

add_action('wp_enqueue_scripts', 'theme_scripts');

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'page_title' => 'Website General Settings',
            'menu_title' => 'Website Settings',
            'menu_slug' => 'website-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );



}

function disable_emojis_tinymce($plugins)
{

    if (is_array($plugins)) {

        return array_diff($plugins, array('wpemoji'));
    } else {

        return array();
    }
}

remove_action('wp_head', 'wp_generator');


add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext' => $filetype['ext'],
        'type' => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function my_acf_block_render_callback($block, $content = '', $is_preview = false)
{
    if ($is_preview && !empty($block['data'])) {
        echo '<img src="' . $block['data']['preview_image_help'] . '" width="300" height="145">';
        return;
    } else {
        $slug = str_replace('acf/', '', $block['name']);
        $file = "/template-parts/block/block-{$slug}.php";
        if (file_exists(get_theme_file_path($file))) {
            include(get_theme_file_path($file));
        } else {
            pre("template not exists:" . $file);
        }
    }
}



