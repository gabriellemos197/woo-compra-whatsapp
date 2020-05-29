<?php
require_once __DIR__ . '/main.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('WooCommerce')) {
	die('Para user este plugin instale o WooCommerce');
}

// Set default value
$compraWhatsAppObject->setDefault();