<?php

/**
 * Plugin Name: Woocommerce Compra por WhatsApp
 * Plugin URI: https://github.com/gabriellemos197/woo-order-whastapp
 * Description: Adicionar botão de compra por WhatsApp nos produtos.
 * Author: Gabriel Lemos
 * Author URI: https://gabriellemos.com/
 * Version: 1.0
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/** Incluir CSS e JS no Front **/
function woowap_include_plugin_css () {
    wp_enqueue_style( 'woowapp_style',  plugin_dir_url( __FILE__ ) . 'assets/style.css' );
	wp_enqueue_script( 'woowapp_js',  plugin_dir_url( __FILE__ ) . 'assets/my-script.js', array('jquery'), true);
}

add_action( 'wp_enqueue_scripts', 'woowap_include_plugin_css' );

/**Incluir CSS e JS no Admin**/
function woowap_include_admin_css () {
    wp_enqueue_style( 'woowapp_style_admin',  plugin_dir_url( __FILE__ ) . 'assets/style_admin.css' );
    wp_enqueue_script( 'woowapp_admin_script',  plugin_dir_url( __FILE__ ) . 'assets/my-admin-script.js', array('jquery'), true);
}

add_action( 'admin_enqueue_scripts', 'woowap_include_admin_css' );

/**Incluir Arquivos de Função**/
require dirname(__FILE__).'/functions/btn-compra-whatsapp.php';
require dirname(__FILE__).'/admin/admin-template.php';

/**Verificar se Woocommerce está instalado**/
function woowap_check_woocommece_active(){
if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
  	echo "<div class='error'><p><strong>Compra por WhatsApp</strong> necessita da ativação do <strong> Wooommerce</strong> </p></div>";
	}
}

add_action('admin_notices', 'woowap_check_woocommece_active');
