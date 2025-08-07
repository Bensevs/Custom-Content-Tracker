
<?php
/*
Plugin Name: Custom Content Ticker for Elementor
Description: A custom Elementor widget for displaying a content ticker.
Version: 1.0.0
Author: Hemin
Text Domain: custom-content-ticker
Domain Path: /languages
*/

// Security check: prevent direct file access
defined('ABSPATH') || exit;

// Ensure Composer autoloader is loaded
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Register the widget and enqueue scripts.
 */
add_action('plugins_loaded', function() {
    // Load plugin text domain for translations
    load_plugin_textdomain('custom-content-ticker', false, dirname(plugin_basename(__FILE__)) . '/languages');

    // Register the Elementor widget
    add_action('elementor/widgets/register', function($widgets_manager) {
        $widgets_manager->register(new \CustomContentTicker\Widget\ContentTicker());
    });

    // Enqueue the compiled frontend assets
    add_action('elementor/frontend/after_enqueue_scripts', function() {
        // Our single, compiled JS file which includes Slick Carousel
        wp_enqueue_script(
            'custom-content-ticker-js',
            plugin_dir_url(__FILE__) . 'assets/dist/js/ticker.min.js',
            ['elementor-frontend', 'jquery'], // Correct dependencies
            '1.0.0',
            true
        );

        // Our single, compiled CSS file
        wp_enqueue_style(
            'custom-content-ticker-css',
            plugin_dir_url(__FILE__) . 'assets/dist/css/ticker.min.css',
            [],
            '1.0.0'
        );
    });
});
