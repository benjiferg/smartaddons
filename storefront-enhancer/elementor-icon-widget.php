<?php
/**
 * Plugin Name: Storefront Enhancer
 * Description: A set of custom widgets for Elementor that interacts with ecwid api to provide a home, search, cart, and account buttons.
 * Version: 1.0.0
 * Author: Benjamin Ferguson
 * Text Domain: storefront-enhancer
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.23.3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Register the custom category
function add_custom_widget_category( $elements_manager ) {
    $elements_manager->add_category(
        'custom-widgets-category',
        [
            'title' => esc_html__( 'Ecwid + Widgets', 'elementor-custom-widgets' ),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'add_custom_widget_category' );

// Register the icon widget
function register_icon_widget( $widgets_manager ) {
    require_once( __DIR__ . '/php/icon-widget.php' );
    $widgets_manager->register( new \Elementor_Icon_Widget() );
}
add_action( 'elementor/widgets/register', 'register_icon_widget' );

// Register the shopping cart widget
function register_shopping_cart_widget( $widgets_manager ) {
    require_once( __DIR__ . '/php/shopping-cart-widget.php' );
    $widgets_manager->register( new \Elementor_Shopping_Cart_Widget() );
}
add_action( 'elementor/widgets/register', 'register_shopping_cart_widget' );

// Register the search button widget
function register_search_button_widget( $widgets_manager ) {
    require_once( __DIR__ . '/php/class-elementor-search-button-widget.php' );
    $widgets_manager->register( new \Elementor_Search_Button_Widget() );
}
add_action( 'elementor/widgets/register', 'register_search_button_widget' );

// Register the account widget
function register_account_widget( $widgets_manager ) {
    require_once( __DIR__ . '/php/class-elementor-account-widget.php' );
    $widgets_manager->register( new \Elementor_Account_Widget() );
}
add_action( 'elementor/widgets/register', 'register_account_widget' );
