<?php
/*
 *
 * Plugin Name: Recipe Star
 * Author: KZ
 * Version: 1.0
 */

add_action('admin_post_rate', 'fn_rate');
add_action('admin_post_nopriv_rate', 'fn_rate');

function fn_rate()
{
    $rates = json_decode(get_post_meta(@$_REQUEST['recipe'], 'rates', true), true);
    if($user_id = get_current_user_id()) {
        $rates['user-' . $user_id] = @$_REQUEST['rate'];
        update_post_meta(@$_REQUEST['recipe'], 'rates', json_encode($rates));
        $avg = count($rates) ? array_sum($rates) / count($rates) : 0;
        update_post_meta(@$_REQUEST['recipe'], 'avg_rate', $avg);
    }
    echo get_post_meta(@$_REQUEST['recipe'], 'avg_rate', true);
}

add_action('wp_enqueue_scripts', 'register_star_script');
function register_star_script()
{
    wp_enqueue_script('recipe-script', plugin_dir_url(__FILE__) . 'js/script.js', [], '1.0', true);
}

add_filter( 'manage_recipe_posts_columns', 'rate_filter_posts_columns' );
function rate_filter_posts_columns( $columns ) {
    $columns['avg_rate'] = __( 'Average rate' );
    return $columns;
}

add_action( 'manage_recipe_posts_custom_column', 'rate_posts_columns', 10, 2);
function rate_posts_columns( $column, $post_id ) {
    // Image column
    if ( $column === 'avg_rate' ) {
        echo number_format((float)get_post_meta( $post_id, 'avg_rate', true ), 2, ',', ' ');
    }
}

