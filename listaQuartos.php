<?php
/*
Plugin Name: Lista de Quadros Widget
Description: Uma lista com vários items retirados diretamente da API
Version: 1.0
Author: Anderson Bassan
*/


require_once plugin_dir_path(__FILE__) . 'dataProcessingAPI.php';

// Register your custom widget
function register_custom_widget() {
    require_once plugin_dir_path(__FILE__) . '/widgets/listaQuartosWidget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ListaQuartosWidget());

    require_once plugin_dir_path(__FILE__) . '/widgets/listaPrecoWidget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ListaPrecoWidget());

    require_once plugin_dir_path(__FILE__) . '/widgets/personalDataForm.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new personalDataForm());

    require_once plugin_dir_path(__FILE__) . '/widgets/purchaseSummary.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new purchaseSummary());

    require_once plugin_dir_path(__FILE__) . '/widgets/guestsForms.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new guestsForms());
}

function enqueue_plugin_scripts() {
    // Enqueue utils.js first
    wp_enqueue_script('utils-script', plugin_dir_url(__FILE__) . '/assets/scripts/utils.js', array('jquery'), '1.0', true);

    // Enqueue other scripts that depend on utils.js
    wp_enqueue_script('lista-quartos-widget-script', plugin_dir_url(__FILE__) . '/assets/scripts/listaQuartosWidgetScript.js', array('utils-script'), '1.0', true);
    wp_enqueue_script('personal-data-form-script', plugin_dir_url(__FILE__) . '/assets/scripts/personalDataForm.js', array('utils-script'), '1.0', true);

    // Enqueue stylesheets
    wp_enqueue_style('lista-quartos-widget-style', plugin_dir_url(__FILE__) . '/assets/styles/listaQuartosWidgetStyles.css', array(), '1.0', 'all');
    wp_enqueue_style('price-widget-style', plugin_dir_url(__FILE__) . '/assets/styles/priceWidgetStyles.css', array(), '1.0', 'all');
    wp_enqueue_style('personal-data-form-style', plugin_dir_url(__FILE__) . '/assets/styles/personalDataForm.css', array(), '1.0', 'all');
    wp_enqueue_style('guests-form-style', plugin_dir_url(__FILE__) . '/assets/styles/guestsForm.css', array(), '1.0', 'all');
    wp_enqueue_style('purchase-summary-style', plugin_dir_url(__FILE__) . '/assets/styles/purchaseSummary.css', array(), '1.0', 'all');
}

add_action('elementor/widgets/widgets_registered', 'register_custom_widget');
add_action('wp_enqueue_scripts', 'enqueue_plugin_scripts');
