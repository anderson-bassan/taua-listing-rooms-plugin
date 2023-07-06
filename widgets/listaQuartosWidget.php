<?php
use Elementor\Widget_Base;

class ListaQuartosWidget extends Widget_Base {
    private $api_url = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/?hotel=6&checkin=2023-08-03&checkout=2023-08-10&adults=1&children=2&child_age_1=2&child_age_2=3';
    // private $local_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // private $api_url = 'http://localhost:3000/';

    public function get_name() {
        return 'lista-quartos-widget';
    }

    public function get_title() {
        return 'Lista de Quartos';
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

    public function get_api_data() {
        // funciton to get the data from the API

        $response = wp_remote_get($this->api_url);

        if (is_wp_error($response)) {
            return new WP_Error('api_error', 'Falha ao receber a api: ' . $response->get_error_message());
        }

        $json_data = wp_remote_retrieve_body($response);
        $data = json_decode($json_data, true);

        if (empty($data)) {
            return new WP_Error('json_error', 'falha ao processar a API como JSON');
        }

        // Return the JSON data
        return wp_json_encode($data);
    }

    public function parseUrlParameters($url) {
        $parsedUrl = parse_url($url);
        $query = $parsedUrl['query'];
        parse_str($query, $parameters);
        return $parameters;
    }

    public function generate_item_icons($item) {
        // generate icons

        $icon1Image = plugins_url('/assets/images/pensao.svg', dirname(__FILE__)); // pensao
        $icon2Image = plugins_url('/assets/images/ar-condicionado.svg', dirname(__FILE__)); // ar condicionado e wifi
        $icon3Image = plugins_url('/assets/images/tv.svg', dirname(__FILE__));; // tv e telefone
        $icon4Image = plugins_url('/assets/images/tacas-espumante.svg', dirname(__FILE__));; // espumante lirica com duas taças
        $icon5Image = plugins_url('/assets/images/carta.svg', dirname(__FILE__)); // carta padrão Tauá Momento
        $icon6Image = plugins_url('/assets/images/panela-ganache.svg', dirname(__FILE__));; // panela ganache

        $icon1Class = '';
        $icon2Class = '';
        $icon3Class = '';
        $icon4Class = '';
        $icon5Class = '';
        $icon6Class = '';

        if (true) { // replace true by key or a key exist check
            $icon1Class = 'active';
        }

        if ($item['ar-condicionando']) {
            $icon2Class = 'active';
        }

        if (false) {
            $icon3Class = 'active';
        }

        if (false) {
            $icon4Class = 'active';
        }

        if (false) {
            $icon5Class = 'active';
        }

        if (false) {
            $icon6Class = 'active';
        }

        $iconsTemplate = <<<EOT
            <div class="icon-wrapper %s">
                <div class="icon icon-1">
                    <img src="%s"><span>Pensão completa com café da manhã, almoço e jantar</span>
                </div>
            </div>
            <div class="icon-wrapper %s">
                <div class="icon icon-2">
                    <img src="%s"><span>Ar Condicionado e Wifi</span>
                </div>
            </div>
            <div class="icon-wrapper %s">
                <div class="icon icon-3">
                    <img src="%s"><span>Tv e Telefone</span>
                </div>
            </div>
            <div class="icon-wrapper %s">
                <div class="icon icon-4">
                    <img src="%s"><span>Espumante Lírica com duas taças</span>
                </div>
            </div>
            <div class="icon-wrapper %s">
                <div class="icon icon-5">
                    <img src="%s"><span>Carta padrão Tauá Momento</span>
                </div>
            </div>
            <div class="icon-wrapper" %s>
                <div class="icon icon-6">
                    <img src="%s"><span>Cúpula de ganache com frutas da época e muito mais!</span>
                </div>
            </div>
        EOT;

        $itemIcons = sprintf($iconsTemplate, $icon1Class, $icon1Image, $icon2Class, $icon2Image, $icon3Class, $icon3Image, $icon4Class, $icon4Image, $icon5Class, $icon5Image, $icon6Class, $icon6Image);

        return $itemIcons;
    }


    // Function to generate the item gallery string
    public function generate_gallery_string($photos) {
        $galleryString = '';
        $firstItem = true;

        foreach ($photos as $photo) {
            if ($firstItem) {
                $galleryString .= '<img src="' . $photo['url'] . '" class="slide active" alt="Gallery Image">' . PHP_EOL;
                $firstItem = false;
            } else {
                $galleryString .= '<img src="' . $photo['url'] . '" class="slide" alt="Gallery Image">' . PHP_EOL;
            }
        }

        return $galleryString;
    }

    // Function to generate the item dots string
    public function generate_dots_string($photos) {
        $dotsString = '';
        $firstItem = true;

        foreach ($photos as $photo) {
            if ($firstItem) {
                $dotsString .= '<div class="dot active"></div>' . PHP_EOL;
                $firstItem = false;
            } else {
                $dotsString .= '<div class="dot"></div>' . PHP_EOL;
            }
        }

        return $dotsString;
    }

    // generate pop up
    private function generate_popup_html() {
      $closeButtonImg = plugins_url('/assets/images/close_black_24dp.svg', dirname(__FILE__)); // pensao

        $popupHTML = <<<EOT
          <div class="popup-wrapper">
            <div id="popup" class="popup">
              <div class="popup-content">
                <div class="best-deal">
                  <div class="room-popup-info">
                    <h3>Melhor Tarifa Disponível</h3>
                    <p>Tarifa Não Reembolsável: sem direito a estorno; sem direito a alteração de data. Hospedagem com pensão completa: Check-in de Segunda a Sábado a partir das 15h e aos Domingos a partir das 17h, com direito ao Jantar. Check-out às 12h com direito a café da manhã e almoço. Bebidas: não alcoólicas inclusas apenas nas refeições: água, refrigerante e suco do dia. Demais bebidas devem ser pagas à parte. Em período de baixa temporada, o parque fica fechado às segundas e quintas-feiras (esses dias podem sofrer alteração sem aviso prévio).</p>
                  </div>
                  <div class="room-popup-price">
                    <span class="popup-price">R$<span class="popup-price" id="popup-price-value">2.657,70</span> / noite</span>
                    <select id="number-dropdown">
                      <option value="" disabled selected>ESCOLHER</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <img id="popup-close" src="%s">
                </div>
              </div>
            </div>
          </div>
        EOT;

        return sprintf($popupHTML, $closeButtonImg);
    }


    // Function to generate the item HTML for each data item
    public function generate_item_html_for_data($data) {
        $html = '';

        foreach ($data as $item) {
            $galleryString = '';
            $dotsString = '';

            if (isset($item['galeria-de-fotos']) && is_array($item['galeria-de-fotos'])) {
                $galleryString = $this->generate_gallery_string($item['galeria-de-fotos']);
                $dotsString = $this->generate_dots_string($item['galeria-de-fotos']);
            }

            $itemTitle = $item['title'];
            $itemDescription = str_replace("</p>", "", str_replace("<p>", "", $item['descricao']));
            $itemBonus = str_replace("</p>", "</li>", str_replace("<p class=\"p1\">", "<li><i aria-hidden=\"true\" class=\"fas fa-check\"></i>", $item['hotel_amenties']));
            $itemPrice = number_format($item['price'], 2, ',', '');

            // Get the itemCodigo value from the API response
            $roomCode = 'data-roomCode="' . esc_attr(isset($item['codigo']) ? $item['codigo'] : '') . '" ';

            // Generate the item icons
            $itemIcons = $this->generate_item_icons($item);


            $html .= $this->generate_item_html($galleryString, $dotsString, $itemTitle, $itemDescription, $itemBonus, $itemPrice, $itemIcons, $roomCode);
        }

        return $html;
    }

    // Function to generate the item HTML
    public function generate_item_html($galleryString, $dotsString, $itemTitle, $itemDescription, $itemBonus, $itemPrice, $itemIcons, $dataAttributes) {
        $itemTemplate = <<<EOT
            <div class="item" data-price="%s" $dataAttributes>
                <div class="slider-wrapper" data-active="0">
                    %s
                    <div class="dots-wrapper">
                        %s
                    </div>
                </div>
                <div class="description-wrapper">
                    <div class="room-info">
                        <h2 class="room-name">%s</h2>
                        <p class="room-description">%s</p>
                        <a class="room-details">detalhes do quarto</a>
                    </div>
                    <div class="price-info">
                        <ul class="price-bonus">
                            %s
                        </ul>
                        <button class="price-button">Por R$ %s / Noite</button>
                    </div>
                    <div class="icons">
                        %s
                    </div>
                </div>
            </div>
        EOT;

        return sprintf($itemTemplate, $itemPrice, $galleryString, $dotsString, $itemTitle, $itemDescription, $itemBonus, $itemPrice, $itemIcons);
    }


    protected function render() {
        $settings = $this->get_settings_for_display();

        // Retrieve the data from the API
        $data = json_decode($this->get_api_data(), true);

        if (is_array($data) && !isset($data['message'])) {
            echo "<input id='price-input' type='text' class='hidden' value=''>";
            echo "<div class=\"lista-quartos\">";
            echo $this->generate_item_html_for_data($data);
            echo '</div>';
            echo $this->generate_popup_html();
        }

        if (is_array($data) && isset($data['message'])) {
            // insert popups using the function do_shortcode();

            echo "<div class=\"lista-quartos\">";
            echo '<p>' . $data['message'] . '</p>';
            echo '</div>';
            echo $this->generate_popup_html();
        }
    }
}
