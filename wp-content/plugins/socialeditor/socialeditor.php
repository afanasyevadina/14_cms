<?php

/*
 * Plugin Name: Social editor
 * Version: 1.0
*/

function my_admin_menu() {
    add_menu_page(
        __( 'Social links'),
        __( 'Social links'),
        'manage_options',
        'social-editor',
        'social_editor_contents',
        'dashicons-share',
        3
    );
}
add_action( 'admin_menu', 'my_admin_menu' );

function social_editor_contents() {
    ?>
    <h1> <?php esc_html_e( 'Edit social links.' ); ?> </h1>
    <form method="POST" action="options.php">
        <?php
        settings_fields( 'social-editor' );
        do_settings_sections( 'social-editor' );
        submit_button();
        ?>
    </form>
    <?php
}


add_action( 'admin_init', 'my_settings_init' );

function my_settings_init() {

    add_settings_section(
        'social_icons_setting_section',
        __( 'Social icons can be edited here'),
        'my_setting_section_callback_function',
        'social-editor'
    );

    add_settings_field(
        'pinterest_field',
        __( 'Pinterest'),
        'pinterest_markup',
        'social-editor',
        'social_icons_setting_section'
    );

    add_settings_field(
        'facebook_field',
        __( 'Facebook'),
        'facebook_markup',
        'social-editor',
        'social_icons_setting_section'
    );

    add_settings_field(
        'twitter_field',
        __( 'Twitter'),
        'twitter_markup',
        'social-editor',
        'social_icons_setting_section'
    );

    add_settings_field(
        'dribble_field',
        __( 'Dribble'),
        'dribble_markup',
        'social-editor',
        'social_icons_setting_section'
    );

    add_settings_field(
        'behance_field',
        __( 'Behance'),
        'behance_markup',
        'social-editor',
        'social_icons_setting_section'
    );

    add_settings_field(
        'linkedin_field',
        __( 'Linkedin'),
        'linkedin_markup',
        'social-editor',
        'social_icons_setting_section'
    );

    register_setting( 'social-editor', 'pinterest_field' );
    register_setting( 'social-editor', 'facebook_field' );
    register_setting( 'social-editor', 'twitter_field' );
    register_setting( 'social-editor', 'dribble_field' );
    register_setting( 'social-editor', 'behance_field' );
    register_setting( 'social-editor', 'linkedin_field' );
}


function my_setting_section_callback_function() {
    echo '';
}

function pinterest_markup() {
    ?>
    <input type="text" placeholder="pinterest" id="pinterest_field" name="pinterest_field" value="<?php echo get_option( 'pinterest_field' ); ?>">
    <?php
}

function facebook_markup() {
    ?>
    <input type="text" placeholder="facebook" id="facebook_field" name="facebook_field" value="<?php echo get_option( 'facebook_field' ); ?>">
    <?php
}

function twitter_markup() {
    ?>
    <input type="text" placeholder="twitter" id="twitter_field" name="twitter_field" value="<?php echo get_option( 'twitter_field' ); ?>">
    <?php
}

function dribble_markup() {
    ?>
    <input type="text" placeholder="dribble" id="dribble_field" name="dribble_field" value="<?php echo get_option( 'dribble_field' ); ?>">
    <?php
}

function behance_markup() {
    ?>
    <input type="text" placeholder="behance" id="behance_field" name="behance_field" value="<?php echo get_option( 'behance_field' ); ?>">
    <?php
}

function linkedin_markup() {
    ?>
    <input type="text" placeholder="linkedin" id="linkedin_field" name="linkedin_field" value="<?php echo get_option( 'linkedin_field' ); ?>">
    <?php
}