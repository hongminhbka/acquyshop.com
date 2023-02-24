<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
	return;
}

$product_attributes = $product->get_attributes();
$shopee = '';
$lazada = '';

foreach($product_attributes as $attribute){	
	switch ($attribute['name']) {
		case 'Shopee':
		  $shopee = $attribute['value'];
		  break;
		case 'Lazada':
		  $lazada = $attribute['value'];
		  break;		
		default:
		  break;
	  }
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php
		do_action('woocommerce_before_add_to_cart_quantity');

		woocommerce_quantity_input(array(
			'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
			'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
			'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		));

		do_action('woocommerce_after_add_to_cart_quantity');
		?>
		<div class="button-group">
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt">Thêm giỏ hàng</button>
			<?php if(isset($shopee) && $shopee!= ''):?>
				<a class="button button-ecommerce" style="background-color: #fd5622;" href="<?php echo $shopee ?>">Mua tại Shopee</a>
			<?php endif; ?>
			<?php if(isset($lazada) && $lazada!= ''):?>
				<a class="button button-ecommerce" style="background-image: linear-gradient(#0100bd, #0d1079);" href="<?php echo $lazada ?>">Mua tại Lazada</a>
			<?php endif; ?>				
		</div>
		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>