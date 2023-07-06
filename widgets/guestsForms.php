<?php
use Elementor\Widget_Base;

class guestsForms extends Widget_Base {
    private $api_url = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3';
    // private $api_url = 'http://localhost:3000/';

    public function get_name() {
        return 'guests-form';
    }

    public function get_title() {
        return 'Formulário de Alocação';
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

        $priceWidgetLayout = <<<EOT
          <div id="guests-form">
            <h2>Alocação dos hóspedes</h2>
            <div class="fields">
              <div id="adults-number-wrapper">
                <span>Quarto 1 | Superior Solteiro</span>
                <input id="adults-number" type="text" placeholder="Número de Adultos">
                <span class="error">Número de Adultos Inválido</span>
              </div>
              <div id="children-number-wrapper">
                <input id="children-number" type="text" placeholder="Número de Crianças">
                <span class="error">Número de Crianças Inválido</span>
              </div>
              <div id="guest-full-name-wrapper">
                <input id="guest-full-name" type="text" placeholder="Nome Completo">
                <span class="error">Nome inválido</span>
              </div>
              <div id="guest-email-wrapper">
                <input id="guest-email" type="text" placeholder="E-mail">
                <span class="error">E-mail inválido</span>
              </div>
              <div id="visitor-full-name-wrapper">
                <span>Acompanhantes</span>
                <input id="visitor-full-name" type="text" placeholder="Nome Completo">
                <span class="error">Nome inválido</span>
              </div>
              <div id="visitor-age-wrapper">
                <input id="visitor-age" type="text" placeholder="Idade">
                <span class="error">Idade inválida</span>
              </div>
              <div id="visitor-email-wrapper">
                <input id="visitor-email" type="text" placeholder="E-mail">
                <span class="error">E-mail inválido</span>
              </div>
              <div class="error-wrapper">
                <span id="guests-error" class="error">Erro ao enviar dados</span>
              </div>
            </div>
            <div class="buttons-wrapper">
              <button class="send">CONFIRMAR</button>
              <button class="change">ALTERAR</button>
            </div>
          </div>
          EOT;

        echo $priceWidgetLayout;
    }
}
