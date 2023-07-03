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
}

function enqueue_plugin_scripts() {
    wp_enqueue_script('lista-quartos-widget-script', plugin_dir_url(__FILE__) . '/assets/scripts/listaQuartosWidgetScript.js', array('jquery'), '1.0', true); // add element scripts
    wp_enqueue_script('personal-data-form-script', plugin_dir_url(__FILE__) . '/assets/scripts/personalDataForm.js', array('jquery'), '1.0', true); // add element scripts
    wp_enqueue_style('lista-quartos-widget-style', plugin_dir_url(__FILE__) . '/assets/styles/listaQuartosWidgetStyles.css', array(), '1.0', 'all'); // add element styles
    wp_enqueue_style('personal-data-form-style', plugin_dir_url(__FILE__) . '/assets/styles/personalDataForm.css', array(), '1.0', 'all'); // add element styles
}

add_action('elementor/widgets/widgets_registered', 'register_custom_widget');
add_action('wp_enqueue_scripts', 'enqueue_plugin_scripts');
