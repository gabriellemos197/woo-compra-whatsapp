<?php
function woowap_add_admin_page() {
    //Gerar opagina de configuração no admin
    add_menu_page( 'Compras por WhatsApp', 'Comprar por WhatsApp', 'manage_options', 'woowap_plugin_config', 'woowap_create_admin_page', plugin_dir_url( __FILE__ ) . '/img/whatsapp.png', 56 );

    //chamada para registrar configurações no painel
    add_action( 'admin_init', 'woowap_register_settings' );
}
add_action( 'admin_menu', 'woowap_add_admin_page' );

function woowap_register_settings() {
    ////register our settings
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_phone_number' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_message' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_message_cart' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_text_button' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_text_button_cart' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_target' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_show_cart' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_title' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_price' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_link' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_remove_btn' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_remove_price' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_remove_cart_btn' );
    register_setting( 'woowapp-settings-group', 'woowapp_opiton_remove_btn' );
    register_setting( 'woowapp-settings-group', 'woowapp_tracking_code' );
    add_option( 'woowapp_opiton_title', 'title' );
    add_option( 'woowapp_opiton_price', 'price' );
    add_option( 'woowapp_opiton_link', 'link' );
    add_option( 'woowapp_opiton_phone_number', '' );
    add_option( 'woowapp_opiton_message', '' );
    add_option( 'woowapp_opiton_text_button', '' );
}

function woowap_create_admin_page(){
?>
<div class="wrap">
    <h1>Woo Compras por WhatsApp</h1>
    <?php settings_errors(); ?>
    <h2 id="tabs" class="nav-tab-wrapper">
        <a href="#tab_basic_settings" id="tab-basic" class="nav-tab nav-tab-active">Básico</a>
        <a href="#tab_advanced_settings" id="tab-advanced" class="nav-tab ">Avançado</a>
    </h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'woowapp-settings-group' ); ?>
    <div id="tab-basic-settings" class="wowapp-settings-form-page wowapp-active">           
        <h2 class="section_wow">Configurações Básicas</h2>
            <table class="form-table">
            <tbody>
                <tr class="woowapp_number">
                    <th scope="row">
                        <label class="woowapp_number_label" for="phone_number"><b>Número do WhatsApp</b></label>
                    </th>
                    <td>
                        <input type="number" name="woowapp_opiton_phone_number" class="woowapp_input" value="<?php echo get_option('woowapp_opiton_phone_number'); ?>" placeholder="Digite seu número"><br>
                        <span class="wow_desc">Inserir número com o código do país: +5551XXXXXXXXX</span>
                    </td>
                </tr>
                <tr class="woowapp_target">
                    <th scope="row">
                        <label class="woowapp_target_label" for="wow_target"><b>Abrir link em nova aba?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="woowapp_opiton_target" class="woowapp_input_check" value="_blank" <?php checked( get_option('woowapp_opiton_target'), '_blank' );?>>Sim, abrir em nova aba.<br>
                    </td>
                </tr>
                </tbody>
                </table>
                <hr>
                <h2 class="section_wow">Configurações página de produto único</h2>
                <span class="wow_desc">Essas configurações são para o botão na página de produto único.</span>
                <table class="form-table">
                <tbody>
                <tr class="woowapp_message">
                    <th scope="row">
                        <label class="woowapp_message_label" for="message_wbw"><b>Mensagem customizada</b></label>
                    </th>
                    <td>
                        <textarea name="woowapp_opiton_message" class="woowapp_input_areatext" rows="5" placeholder="Digite sua mensagem"><?php echo get_option('woowapp_opiton_message'); ?></textarea>
                    </td>
                </tr>
                <tr class="woowapp_btn_text">
                    <th scope="row">
                        <label class="woowapp_btn_txt_label" for="text_button"><b>Texto do Botão</b></label>
                    </th>
                    <td>
                        <input type="text" name="woowapp_opiton_text_button" class="woowapp_input" value="<?php echo get_option('woowapp_opiton_text_button'); ?>" placeholder="Comprar pelo WhatsApp">
                    </td>
                </tr>
                </tbody>
                </table>
                <hr>
                <h2 class="section_wow">Opções da página de carrinho</h2>
                <span class="wow_desc">Essas opções são para o botão na página do carrinho.</span>
                <table class="form-table">
                <tbody>
                    <tr class="woowapp_target">
                    <th scope="row">
                        <label class="woowapp_target_label" for="wow_target"><b>Mostrar botão na página do carrinho?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="woowapp_opiton_show_cart" class="woowapp_input_check" value="yes">Sim, quero mostrar.<br>
                    </td>
                </tr>
                    <tr class="woowapp_message">
                    <th scope="row">
                        <label class="woowapp_message_label" for="message_wbw"><b>Mensagem customizada</b></label>
                    </th>
                    <td>
                        <textarea name="woowapp_opiton_message_cart" class="woowapp_input_areatext" rows="5" placeholder="Digite sua mensagem"></textarea>
                    </td>
                </tr>
                <tr class="woowapp_btn_text">
                    <th scope="row">
                        <label class="woowapp_btn_txt_label" for="text_button"><b>Texto do botão</b></label>
                    </th>
                    <td>
                        <input type="text" name="woowapp_opiton_text_button_cart" class="woowapp_input" value="" placeholder="Fechar compra">
                    </td>
                </tr>
                </tbody>
                </table>
            </div>
            <div id="tab-advanced-settings" class="wowapp-settings-form-page">
            <h2 class="section_wow">Configurações Avançadas</h2>
            <table class="form-table">
            <tbody>
                <tr class="woowapp_info_send">
                    <th scope="row">
                        <label class="woowapp_info_send_label" for="wow_info_send"><b>Quais informações você quer receber?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="woowapp_opiton_title" class="woowapp_input_check" value="title" checked="checked"> Nome do produto<br>

                        <input type="checkbox" name="woowapp_opiton_price" class="woowapp_input_check" value="price" checked="checked"> Preço do produto<br>

                        <input type="checkbox" name="woowapp_opiton_link" class="woowapp_input_check" value="link" checked="checked"> Link do produto
                    </td>
                </tr>
                <tr class="woowapp_remove_add_btn">
                    <th scope="row">
                        <label class="woowapp_remove_btn_label" for="wow_remove_wow_btn"><b>Esconder botão no computador?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="woowapp_opiton_remove_btn" class="woowapp_input_check" value="yes">Sim, quero esconder no computador.<br>
                    </td>
                </tr>
            <tr class="woowapp_remove_price">
                    <th scope="row">
                        <label class="woowapp_price_label" for="wow_remove_price"><b>Ocultar preço na página do produto?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="woowapp_opiton_remove_price" class="woowapp_input_check" value="yes" <?php checked( get_option('woowapp_opiton_remove_price'), 'yes' );?>>Sim, quero ocultar o preço.<br>
                    </td>
                </tr>
            <tr class="woowapp_remove_add_btn">
                    <th scope="row">
                        <label class="woowapp_remove_add_label" for="wow_remove_add_btn"><b>Ocultar botão de compra padrão?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="woowapp_opiton_remove_cart_btn" class="woowapp_input_check" value="yes" <?php checked( get_option('woowapp_opiton_remove_cart_btn'), 'yes' );?>>Sim, quero ocultar o botão de compra padrão.<br>
                    </td>
                </tr>
                <tr class="woowapp_shortcode">
                    <th scope="row">
                        <label class="woowapp_shortcode" for="wow_remove_add_btn"><b>Shortcode</b></label>
                    </th>
                    <td>
                        <input type="text" class="woowapp_input" value="[woo-compra-whatsapp]"><br>
                        <span class="wow_desc">Use este código de acesso em sua página de produto personalizada.</span>
                    </td>
                </tr>
            </tbody>
            </table>
            <hr>
            <h2 class="section_wow">Tracking </h2>
            <span class="wow_desc">Se você já possui o código de acompanhamento do Google Analytics instalado em seu site, pode ignorar este campo de configuração.</span>
            <table class="form-table">
            <tbody>
                <tr class="woowapp_trackingcode">
                    <th scope="row">
                        <label class="woowapp_tracing_code" for="wow_tracking_code"><b>Código Google Analytics</b></label>
                    </th>
                    <td>
                        <input type="text" name="woowapp_tracking_code" class="woowapp_input" value="" placeholder="UA-000000-3"><br>
                        <span class="wow_desc">Insira aqui o código de rastreamento do Google Analytics. Como UA-000000-3.</span><br>                        
                    </td>
                </tr>
            </tbody>
            </table>
            <p class="woowapp_p_desc"><b>Nota: </b>Se você deseja garantir que seus botões sejam rastreados na sua conta do Google Analytics:<br>1. Vá para sua conta do Google Analytics > Clique em Tempo Real > Eventos.<br>2. Abra seu site em outra guia e clique em um botão Woo Comprar por WhatsApp.<br>3. Verifique se o clique é rastreado na página Eventos do Google Analytics.</p>
        </div>
        <br><button type="submit" name="submit_dados_update" id="submit_woowapp" class="button button-primary">Salvar mudanças</button>
    </form>
</div>  
<?php
}
