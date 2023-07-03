<?php
use Elementor\Widget_Base;

class personalDataForm extends Widget_Base {
    private $api_url = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3';
    // private $api_url = 'http://localhost:3000/';

    public function get_name() {
        return 'personal-data-form';
    }

    public function get_title() {
        return 'Formulário de Dados Pessoais';
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
          <div id="personal-data-form">
            <h2>Dados Pessoais</h2>
            <div class="fields">
              <div id="first-name-wrapper">
                <input id="first-name" type="text" placeholder="Primeiro Nome">
                <span class="error">Primero nome deve conter 3 letras.</span>
              </div>
              <div id="last-name-wrapper">
                <input id="last-name" type="text" placeholder="Sobrenome">
                <span class="error">Sobrenome deve conter 2 letras.</span>
              </div>
              <div id="email-wrapper">
                <input id="email" type="text" placeholder="E-mail">
                <span class="error">E-mail inválido.</span>
              </div>
              <div id="cpf-wrapper">
                <span>É estrangeiro?</span>
                <div id="cpf-popup">Faça sua reserva através da Central de Vendas - 0800 333 1900</div>
                <input id="cpf" type="text" placeholder="CPF">
                <span class="error">CPF inválido</span>
              </div>
              <div id="country-code-wrapper">
                <select id="country-code" placeholder="Brasil(+55)">
                  <option value="55">Brasil (+55)</option>
                </select>
              </div>
              <div id="ddd-wrapper">
                <input id="ddd" type="text" placeholder="DDD">
              </div>
              <div id="phone-wrapper">
                <input id="phone" type="text" placeholder="Telefone">
                <span class="error">Telefone não deve incluir o DDD e deve ter entre 8 e 9 digitos.</span>
              </div>
              <div id="address-wrapper">
                <span>O endereço deve ser o mesmo do cartão de crédito</span>
                <input id="address" type="text" placeholder="Endereço">
                <span class="error">Endereço deve conter apenas letras, números e espaços.</span>
              </div>
              <div id="house-number-wrapper">
                <input id="house-number" type="text" placeholder="Número">
              </div>
              <div id="house-info-wrapper">
                <input id="house-info" type="text" placeholder="Complemento">
              </div>
              <div id="country-wrapper">
                <select id="country">
                  <option value="" disabled selected>País</option>
                  <option value="Brasil">Brasil</option>
                </select>
              </div>
              <div id="state-wrapper">
                <select id="state">
                  <option value="" disabled selected>Estado</option>
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                </select>
              </div>
              <div class="error-wrapper">
                <span id="ddd-error" class="error">DDD deve conter apenas números</span>
                <span id="house-number-error" class="error">Número (residência) deve conter apenas números</span>
                <span id="country-error" class="error">Selecione um páis</span>
                <span id="state-error" class="error">Selecione um estado</span>
                <span id="user-data-error" class="error">Erro ao enviar dados do usuário</span>
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
