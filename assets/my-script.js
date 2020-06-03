jQuery(document).ready(function($) {
            $('input.variation_id').change( function(){
                if( '' != $('input.variation_id').val() ) {
                    var var_message = $('#woapp_message').val();
                    var var_name = $('#woapp_name').val();          
                    var var_link = $('#woapp_link').val();
                    var var_phone = $('#woapp_number').val();

                    var variable_price = $('.variations_form.cart .amount').text();
                    var var_href = 'https://wa.me/' + var_phone + '?text=' + var_message + '%0D%0A%0D%0A' + var_name + '%0D%0A' + variable_price + '%0D%0A' + var_link;
                    $(".woowap_btn").attr("href", var_href);   
                }
                if( '' != $('input.variation_id').val() && '' == $('.woocommerce-variation-price').text() ) {
                    var regular_price = $('#woapp_reg_price').val();
                    var var_href2 = 'https://wa.me/' + var_phone + '?text=' + var_message + '%0D%0A%0D%0A' + var_name + '%0D%0A' + regular_price + '%0D%0A' + var_link;
                    $(".woowap_btn").attr("href", var_href2);   
                }               
            });    
});