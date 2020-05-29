<?php
require_once __DIR__ . '/main.php'; 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if (wp_is_mobile() || $compraWhatsAppObject->getOption('compra_wa_button_show_desktop', 'yes') == 'yes') {
	
	global $product;

	$phoneNumber = esc_attr($compraWhatsAppObject->getOption('compra_wa_phone_number'));
	$content = esc_attr($compraWhatsAppObject->getOption('compra_wa_content'));
	$button = esc_attr($compraWhatsAppObject->getOption('compra_wa_button'));
	$opcaoEscolhida = esc_attr($compraWhatsAppObject->getOption('compra_wa_button_show_desktop'));
	?>
	<button class="<?php echo $compraWhatsAppObject->getOption('compra_wa_button_class', $compraWhatsAppObject->default['']) ?> <?php echo $opcaoEscolhida ?>" id="<?php echo $compraWhatsAppObject->getOption('compra_wa_button_id', 'comprawhatsapp-button') ?>" style="<?php echo $compraWhatsAppObject->getOption('compra_wa_button_css') ?>" type="button" onclick="openWA()"><i class="fa fa-whatsapp"></i><span> <?php echo $button ?></button>
	<script>
		
		function openWA(){
			var isMobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i);
			
			var phoneNumber = "<?php echo esc_attr($phoneNumber); ?>",
				content = "<?php echo esc_attr($compraWhatsAppObject->getContent($content, $product)) ?>";
				link = "";
			if (isMobile) {
				link = "https://wa.me/" + phoneNumber + "?text=" + content;
			} else {
				link = "https://web.whatsapp.com/send?phone=" + phoneNumber + "&text=" + content;
			}
			var n = window.open(link, "_blank");
			n ? n.focus() : alert("Por favor habilite o pop-up do navegador")
		}
	</script>
	<?php
}
?>