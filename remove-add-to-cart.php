<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function remove_add_to_cart_button($product){  
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

// Remover Botão de Adicionar ao Carrinho Padrão

add_action('init','remove_add_to_cart_button');

// Remover Função de Adicionar ao carrinho
add_filter( 'woocommerce_is_purchasable', '__return_false');
