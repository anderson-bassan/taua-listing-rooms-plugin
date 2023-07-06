<?php
use Elementor\Widget_Base;

class purchaseSummary extends Widget_Base {
    private $local_url = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3';
    // private $local_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    public function get_name() {
        return 'resumo-compra-widget';
    }

    public function get_title() {
        return 'Resumo da Compra';
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

        $purchaseSummary = <<<EOT
          <div id="purchase-summary">
            <h2>Resumo da compra</h2>
            <div class="booking-info">
              <p>TAUÁ RESORT & CONVENTION ATIBAIA</p>
              <p><span class="guests"></span> hóspedes - <span class="checkin"></span> - <span class="checkout"></span></p>
            </div>
            <div class="alert-info">
              <p>ATENÇÃO: Em período de baixa temporada, o Tauá Aquapark Indoor fica fechado às segundas e quitas-feiras.</p>
            </div>
          </div>
          EOT;

          echo $purchaseSummary;
    }
}
