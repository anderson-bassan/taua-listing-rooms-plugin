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

        $pixImgUrl = $icon1Image = plugins_url('/assets/images/logo_pix.png', dirname(__FILE__));

        $priceWidgetLayout = <<<EOT
          <div id="price-widget">
            <h2>Resumo dos preços</h2>
            <div class="iss-tax-wrapper">
              <div class="tax-label">
              Taxa ISS
              </div>
              <div class="price-tax-preview">
                <p class="price-widget-display-price">R$ <span class="price-widget-display-price" id="price-widget-display-price">4.550,40</span></p>
                <p class="iss-tax-preview">R$ <span class="iss-tax-preview" id="iss-tax-price">91,00</span></p>
              </div>
            </div>
            <div class="price-wrapper">
              <div class="total-label">
              TOTAL
              </div>
              <div class="total-price-preview">
                <p class="total-price-widget-display-price">R$ <span class="total-price-widget-display-price" id="total-price-widget-display-price">4.550,40</span></p>
                <p class="credit-card-preview">em até 10x de R$<span class="credit-card-preview" id="credit-card-preview-price">464,14</span></p>
              </div>
            </div>
            <div class="book-button-wrapper">
              <button class="book-button">RESERVAR</button>
            </div>
            <div class="pix-wrapper">
              <img class="pix-img" src="%s">
              <p class="pix-discount">Pague com pix e ganhe mais 5%% de desconto</p>
            </div>
          </div>
          EOT;

          echo sprintf($priceWidgetLayout, $pixImgUrl);
    }
}
