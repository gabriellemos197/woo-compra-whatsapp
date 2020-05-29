<?php
require_once __DIR__ . '/main.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
} else {
    $active_tab = 'general';
}

$errorMessage = null;
if (count($_POST) > 0) {
    if ( 
        ! isset( $_POST['_token'] ) 
        || ! wp_verify_nonce( $_POST['_token'], 'compra_wa_admin_update' ) 
    ) {
     
       echo 'Desculpe, seu noce não foi verificado.';
       exit;
     
    }
    if (isset($_POST['compra_wa_phone_number']) && is_null($errorMessage)) {
        if (!ctype_digit($_POST['compra_wa_phone_number'])) {
            $errorMessage = 'O número do WhatsApp deve ser numérico.';
        } else {
            $compraWhatsAppObject->setOption('compra_wa_phone_number', sanitize_text_field($_POST['compra_wa_phone_number']));
            $success = true;
        }
    }
    if (isset($_POST['compra_wa_content']) && is_null($errorMessage)) {
        $compraWhatsAppObject->setOption('compra_wa_content', sanitize_text_field($_POST['compra_wa_content']));
        $success = true;
    }
    if (isset($_POST['compra_wa_button']) && is_null($errorMessage)) {
        $compraWhatsAppObject->setOption('compra_wa_button', sanitize_text_field($_POST['compra_wa_button']));
        $success = true;
    }
    if (isset($_POST['compra_wa_button_class']) && is_null($errorMessage)) {
        $compraWhatsAppObject->setOption('compra_wa_button_class', sanitize_text_field($_POST['compra_wa_button_class']));
        $success = true;
    }
    if (isset($_POST['compra_wa_button_id']) && is_null($errorMessage)) {
        $compraWhatsAppObject->setOption('compra_wa_button_id', sanitize_text_field($_POST['compra_wa_button_id']));
        $success = true;
    }
    if (isset($_POST['compra_wa_button_css']) && is_null($errorMessage)) {
        $compraWhatsAppObject->setOption('compra_wa_button_css', stripslashes($_POST['compra_wa_button_css']));
        $success = true;
    }
    if (isset($_POST['compra_wa_button_show_desktop']) && is_null($errorMessage)) {
        if (in_array($_POST['compra_wa_button_show_desktop'], ['yes', 'no'])) {
            $compraWhatsAppObject->setOption('compra_wa_button_show_desktop', sanitize_text_field($_POST['compra_wa_button_show_desktop']));
            $success = true;
        } else {
            $errorMessage = $_POST['compra_wa_button_show_desktop'] . ' valor inválido.';
        }
    }
	
	if (isset($_POST['compra_wa_button_purchase_show']) && is_null($errorMessage)) {
        if (in_array($_POST['compra_wa_button_purchase_show'], ['yes', 'no'])) {
            $compraWhatsAppObject->setOption('compra_wa_button_purchase_show', sanitize_text_field($_POST['compra_button_purchase_show']));
            $success = true;
        } else {
            $errorMessage = $_POST['compra_wa_button_purchase_show'] . ' valor inválido.';
        }
    }
}
?>

<div class="wrap">
    <h1>Configuração Compra por WhatsApp</h1>

    <!-- Tab navigation start -->
    <h2 class="nav-tab-wrapper">
        <a href="?page=compra_whatsapp_admin&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">Geral</a>
        <a href="?page=compra_whatsapp_admin&tab=advance" class="nav-tab <?php echo $active_tab == 'advance' ? 'nav-tab-active' : ''; ?>">Avançado</a>
    </h2>
    <!-- Tab navigation end -->

    <?php if(isset($success) && $success){ ?>
    <!-- Success message start -->
    <div class="notice notice-success is-dismissible">
        <p>Mudança Salva :)</p>
    </div>
    <!-- Success message end -->
    <?php } ?>

    <?php if(!is_null($errorMessage)){ ?>
    <!-- Error message start -->
    <div class="notice notice-error is-dismissible">
        <p><?php echo $errorMessage; ?></p>
    </div>
    <!-- Error message end -->
    <?php } ?>

    
    <form action="" method="post">
        <?php settings_fields( 'woocommerce-order-whatsapp' ); do_settings_sections( 'woocommerce-order-whatsapp' ); ?>
        <?php wp_nonce_field( 'compra_wa_admin_update', '_token' ); ?>

        <?php if ($active_tab == 'general') { ?>
        <!-- Menu Configurações Gerais -->
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Número de telefone do WhatsApp</th>
            <td>
                <input style="width: 500px;" type="text" name="compra_wa_phone_number" value="<?php echo esc_attr($compraWhatsAppObject->getOption('compra_wa_phone_number')); ?>" placeholder="Exemplo: 55DDDXXXXXXXXX" />
                <br><small>Não se esqueça de adicionar o prefixo do código do país, como 55 para o Brasil.</small>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">Texto do botão de compra</th>
            <td><input style="width: 500px;" type="text" name="compra_wa_button" value="<?php echo esc_attr($compraWhatsAppObject->getOption('compra_wa_button')); ?>" /></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Message</th>
            <td>
                <textarea  style="width: 500px;" rows="8" name="compra_wa_content"><?php echo esc_attr($compraWhatsAppObject->getOption('compra_wa_content')); ?></textarea><br>
                Formatação da Mensagem:
                <ul>
                    <li>Você pode usar <strong>{{nome-produto}}</strong> para inserir o nome do produto.</li>
                    <li>Você pode usar <strong>{{link}}</strong> para inserir a URL do produto.</li>
                </ul>
                Exemplo: <em><?php echo esc_attr($compraWhatsAppObject->default['content']); ?></em> enviará: <strong>Olá, quero comprar este produto https://sualoja.com/produto/nome-do-produto</strong>
            </td>
            </tr>
            
            </tr>
        </table>
        <!-- Menu Configurações Gerais -->
        <?php } elseif ($active_tab == 'advance') { ?>
        <!-- Menu Configurações Avançadas -->
        <h3>Configuração do botão WhatsApp</h3>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Classe de botão
            <td>
                <input style="width: 500px;" type="text" name="compra_wa_button_class" value="<?php echo esc_attr($compraWhatsAppObject->getOption('compra_wa_button_class')); ?>" placeholder="<?php echo esc_attr($compraWhatsAppObject->default['button_class']); ?>" />
                <br><small>Classe padrão: <code>single_add_to_cart_button button</code>, com esta classe, o estilo de botão do WhatsApp seguirá o estilo do botão Adicionar ao carrinho.</small>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">ID do botão</th>
            <td><input style="width: 500px;" type="text" name="compra_wa_button_id" value="<?php echo esc_attr($compraWhatsAppObject->getOption('compra_wa_button_id')); ?>" placeholder="<?php echo esc_attr($compraWhatsAppObject->default['button_id']); ?>" /></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">CSS de estilo de botão personalizado</th>
            <td>
                <textarea  style="width: 500px;" rows="8" name="compra_wa_button_css" placeholder="Exemplo: margin: 0px 2px; border-radius: 5px;"><?php echo $compraWhatsAppObject->getOption('compra_wa_button_css'); ?></textarea><br>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">Mostrar Botão no computador</th>
            <td>
                <input type="radio" name="compra_wa_button_show_desktop" value="yes" <?php echo $compraWhatsAppObject->getOption('compra_wa_button_show_desktop') == 'yes' ? 'checked' : '' ?>> Sim
                <input type="radio" name="compra_wa_button_show_desktop" value="no" <?php echo $compraWhatsAppObject->getOption('compra_wa_button_show_desktop') == 'no' ? 'checked' : '' ?>> Não
            </td>
            </tr>
            
            </tr>
        </table>
        <!-- Advance form menu -->
        <?php } ?>
        <?php submit_button(); ?>
    </form>
</div>