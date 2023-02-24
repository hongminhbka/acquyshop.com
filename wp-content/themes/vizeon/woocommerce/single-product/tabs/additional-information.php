<?php
/**
 * Additional Information tab
 * 
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly
	exit;
}

global $product;

?>

<h2 class="tab-title">Thông số kỹ thuật</h2>

<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
