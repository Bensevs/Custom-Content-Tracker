<?php
/*
Plugin Name: Custom Content Ticker for Elementor
Description: A custom Elementor widget for displaying a content ticker.
Version: 1.0.0
Author: Hemin
Text Domain: custom-content-ticker
Domain Path: /languages
*/

defined('ABSPATH') || exit;

// Load plugin text domain
add_action('plugins_loaded', function() {
    load_plugin_textdomain('custom-content-ticker', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

// Register the widget with Elementor
add_action('elementor/widgets/register', function($widgets_manager) {

    // Manually require the widget class file
    require_once plugin_dir_path(__FILE__) . 'src/Widgets/ContentTicker.php';
;

    // Register the widget
    $widgets_manager->register(new \CustomContentTicker\Widget\ContentTicker());
});

// Enqueue frontend assets
add_action('elementor/frontend/after_enqueue_scripts', function() {
    wp_enqueue_script(
        'custom-content-ticker-js',
        plugin_dir_url(__FILE__) . 'assets/dist/js/ticker.min.js',
        ['elementor-frontend', 'jquery'],
        '1.0.0',
        true
    );

    wp_enqueue_style(
        'custom-content-ticker-css',
        plugin_dir_url(__FILE__) . 'assets/dist/css/ticker.min.css',
        [],
        '1.0.0'
    );
});
