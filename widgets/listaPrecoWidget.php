<?php
use Elementor\Widget_Base;

class listaPrecoWidget extends Widget_Base {
    // private $api_url = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3';
    private $local_url = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3';
    // private $local_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // private $api_url = 'http://localhost:3000/';

    public function get_name() {
        return 'lista-preco-widget';
    }

    public function get_title() {
        return 'Lista Preço';
    }

    public function get_icon() {
        return 'eicon-kit-details';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        // No controlls are needed for this code
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<div id="price-widget"></div>';
    }
}
