<?php

add_action('init', 'register_types_wsk');
function register_types_wsk()
{
    register_post_type('recipe', [
        'label' => 'Recipe',
        'public' => true,
        'supports' => ['editor', 'thumbnail', 'title', 'custom-fields', 'comments'],
    ]);
}

add_action('wp_enqueue_scripts', 'register_scripts_wsk');

function register_scripts_wsk()
{
    wp_enqueue_script('script1', get_stylesheet_directory_uri() . '/js/jquery/jquery-2.2.4.min.js', [], '1.0', true);
    wp_enqueue_script('script2', get_stylesheet_directory_uri() . '/js/bootstrap/popper.min.js', [], '1.0', true);
    wp_enqueue_script('script3', get_stylesheet_directory_uri() . '/js/bootstrap/bootstrap.min.js', [], '1.0', true);
    wp_enqueue_script('script4', get_stylesheet_directory_uri() . '/js/plugins/plugins.js', [], '1.0', true);
    wp_enqueue_script('script5', get_stylesheet_directory_uri() . '/js/active.js', [], '1.0', true);
}

// custom login for theme
function childtheme_custom_login() {
    ?>
    <style>
        .login h1 a {
            background-image: url('<?= get_stylesheet_directory_uri() ?>/logo.png');
        }
    </style>
<?php
}

add_action('login_head', 'childtheme_custom_login');

add_filter('site_url',  'wpadmin_filter', 10, 3);
function wpadmin_filter( $url, $path, $orig_scheme ) {
    $old  = array( "/(wp-admin)/");
    $admin_dir = WP_ADMIN_DIR;
    $new  = array($admin_dir);
    return preg_replace( $old, $new, $url, 1);
}