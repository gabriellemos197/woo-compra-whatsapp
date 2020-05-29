<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Plugin Name: Compras por WhatsApp
 * Plugin URI: https://github.com/gabriellemos197/woo-order-whastapp
 * Description: Adicionar botão de compra por WhatsApp nos produtos.
 * Version: 1.0
 * Author: Gabriel Lemos
 * Author URI: https://gabriellemos.com/
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
 
// Remove Botão Padrão 
require_once __DIR__ . '/remove-add-to-cart.php'; 
 
// Verificação da existencia do WooCommerce
function compraWhatsAppActicatePlugin()
{
   require_once __DIR__ . '/includes/activator.php';
}
register_activation_hook( __FILE__, 'compraWhatsAppActicatePlugin');
// Fim da verificação

// Adicionar Opções do Plugin ao Painel
add_action('admin_menu', 'compraWhatsAppAdminMenu');
function compraWhatsAppAdminMenu(){
   add_submenu_page('woocommerce', 'Compra WhatsApp', 'CompraWhatsapp', 'manage_options', 'compra_whatsapp_admin', 'compraWhatsAppAdminPage' );
}
function compraWhatsAppAdminPage()
{
   require_once __DIR__ . '/includes/admin-display.php';
}
// Fim


// Carregar Scripts no Front-End
function plugin_scripts() {
    wp_enqueue_style('font-awesome-pedidos-whatsapp', plugin_dir_url( __FILE__ ).'includes/lib/font-awesome/css/font-awesome.min.css', '', '4.7.0');
}
add_action('wp_enqueue_scripts', 'plugin_scripts');

// Carregar Scripts no Admin
function admin_scripts() {
    wp_enqueue_style('font-awesome', plugin_dir_url( __FILE__ ).'includes/lib/font-awesome/css/font-awesome.min.css', '', '4.7.0');
}
add_action('admin_enqueue_scripts', 'admin_scripts');


// Adicionar Botão ao produtos
function compraWhatsAppButtonAfterAddToCart()
{
	require_once __DIR__ . '/includes/public.php';
}
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
   add_action( 'woocommerce_single_product_summary', 'compraWhatsAppButtonAfterAddToCart', 40 );
}
// Add WA Button after add to cart button end
