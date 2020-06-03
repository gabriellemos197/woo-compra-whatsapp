<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Woowap_add_button_plugin {
	
	public $icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg_wapp_woowap" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 90 90" style="enable-background:new 0 0 90 90;" xml:space="preserve"><path id="WhatsApp" d="M90,43.841c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L0,90l7.975-23.522   c-4.023-6.606-6.34-14.354-6.34-22.637C1.635,19.628,21.416,0,45.818,0C70.223,0,90,19.628,90,43.841z M45.818,6.982   c-20.484,0-37.146,16.535-37.146,36.859c0,8.065,2.629,15.534,7.076,21.61L11.107,79.14l14.275-4.537   c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.857S66.301,6.982,45.818,6.982z M68.129,53.938   c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.495c-0.993-0.358-1.717-0.538-2.438,0.537   c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.333   c-3.219-2.848-5.393-6.364-6.025-7.441c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882   c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.977   c-0.902-2.15-1.803-1.792-2.436-1.792c-0.631,0-1.354-0.09-2.076-0.09c-0.722,0-1.896,0.269-2.889,1.344   c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.113c0.541,0.716,7.49,11.92,18.5,16.223   C58.2,65.771,58.2,64.336,60.186,64.156c1.984-0.179,6.406-2.599,7.312-5.107C68.398,56.537,68.398,54.386,68.129,53.938z" fill="#FFFFFF"/></svg>';

	public function __construct() {
		add_action('woocommerce_after_add_to_cart_form', array($this,'woowap_print_btn'));
		add_shortcode( 'woo-compra-whatsapp', array($this,'woowap_pro_shortcode'));
		add_action('admin_notices', array($this,'woowap_check_input_empty'));
		add_action('wp_head', array($this,'woowap_option_hide_price'));
		add_action('wp_head', array($this,'woowap_option_hide_cart_button'));
		add_action('wp_head', array($this,'woowap_option_hide_button_desktop'));
		add_action('wp_head', array($this,'woowap_get_track_code'));
		add_action('woocommerce_after_shop_loop_item', array($this,'woowap_archive_btn'));
}

	//buscar preço do produto
	public function woowap_get_product_price () {
	global $product;
		$currency = get_woocommerce_currency_symbol();
		$price = wc_get_price_including_tax($product);
		$format_price = number_format($price, 2, ',', '.');
		$final_price = $currency . $format_price;
		return $final_price;
}

	//buscar link do produto
	public function woowap_get_product_link () {
	global $product;
		$link_prod = $product->get_permalink();
		$txt_link = "Link: $link_prod";
		$encode_link = urlencode($txt_link);
		return $encode_link;
}

	//buscar nome do produto
	public function woowap_get_product_name () {
	global $product;
		$p_name = $product->get_name();
		$txt_name = "*$p_name*";
		$encode_name = urlencode($txt_name);
		return $encode_name;
}
	//Opção para desabilitar preço
	public function woowap_option_hide_price () {
	$hide_price = get_option(sanitize_text_field('woowapp_opiton_remove_price'));
	if ($hide_price === 'yes') {
		?>
		<style>
		.price {
			display: none !important;
		}
		</style>
		<?php
	}
}
	//Opção para esconder botão de comprar e quantidade
	public function woowap_option_hide_cart_button () {
	$hide_cart_btn = get_option(sanitize_text_field('woowapp_opiton_remove_cart_btn'));
	if ($hide_cart_btn === 'yes') {
		?>
		<style>
		.product_type_simple, .single_add_to_cart_button, .quantity {
			display: none !important;
		}
		</style>
		<?php
	}
}
	
	//Opção para desabilitar botão no desktop
	public function woowap_option_hide_button_desktop () {
	$hide_btn_desk = get_option(sanitize_text_field('woowapp_opiton_remove_btn'));
	if ($hide_btn_desk === 'yes') {
		?>
		<style>
		@media screen and (min-width: 768px) {	
		.div_woowap_btn {
			display: none !important;
			}
		}
		</style>
		<?php
	}			
}

	//Inserir codigo de trackeamento Google Analytics
	public function woowap_get_track_code () {
	$track_code = get_option(sanitize_text_field('woowapp_tracking_code'));
	if ($track_code !== '') {
		$g_code = "<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '".$track_code."', 'auto');</script>";
		echo $g_code;
	}			
}

	//Criar link e botão
	public function woowap_create_link () {
	global $product;
	$custom_message = get_option(sanitize_text_field('woowapp_opiton_message'));
	$phone = get_option(sanitize_text_field('woowapp_opiton_phone_number'));
	$btn_txt = get_option(sanitize_text_field('woowapp_opiton_text_button'));
	$target = get_option(sanitize_text_field('woowapp_opiton_target'));
	$encode_message = urlencode($custom_message);

	if ($product->is_type( 'variable' )) {
		$txt_final = ''.$encode_message.'%0D%0A%0D%0A'.$this->woowap_get_product_name().'%0D%0A'.$this->woowap_get_product_price().'%0D%0A'.$this->woowap_get_product_link().'';
		$link_btn = 'https://wa.me/'.$phone.'?text='.$txt_final.'';
		
		return '<div class="div_woowap_btn">
				<form id="woapp-fields">
				<input type="hidden" id="woapp_number" value="'.$phone.'"></input>
				<input type="hidden" id="woapp_message" value="'.$encode_message.'"></input>
				<input type="hidden" id="woapp_name" value="'.$this->woowap_get_product_name().'"></input>
				<input type="hidden" id="woapp_reg_price" value="'.$this->woowap_get_product_price().'"></input>
				<input type="hidden" id="woapp_link" value="'.$this->woowap_get_product_link().'"></input>
				</form>
		<a href='.$link_btn.' class="woowap_btn" id="woowap_btn" role="button" target="'.$target.'">'.$this->icon.' '.$btn_txt.'</a>
		</div>';
	}
	else {
		$txt_final = ''.$encode_message.'%0D%0A%0D%0A'.$this->woowap_get_product_name().'%0D%0A'.$this->woowap_get_product_price().'%0D%0A'.$this->woowap_get_product_link().'';
		$link_btn = 'https://wa.me/'.$phone.'?text='.$txt_final.'';
		
		return '<div class="div_woowap_btn"><a href='.$link_btn.' class="woowap_btn" id="woowap_btn" role="button" target="'.$target.'">'.$this->icon.' '.$btn_txt.'</a></div>';
	}
}
	
	///Inserir botão na página do produto
	public function woowap_print_btn(){
		echo $this->woowap_create_link();
	}
	
	///adicionar shortcode
	public function woowap_pro_shortcode(){
	return $this->woowap_create_link();
	}
	
	///solicitar configuração mínima do plugin caso esteja vazio
	public function woowap_check_input_empty(){
	$phone = get_option('woowapp_opiton_phone_number');
	$custom_message = get_option('woowapp_opiton_message');
	$btn_txt = get_option('woowapp_opiton_text_button');
	if ( $phone === '' || $custom_message === '' || $btn_txt === '' ) {
		echo '<div class="error"><p><strong>Compras por WhatsApp</strong> requer uma <strong> configuração mínima!</strong> </p></div>';
	}

}
	
	public function woowap_archive_btn (){
		echo do_shortcode('[woo-compra-whatsapp]');
	}

}

new Woowap_add_button_plugin();