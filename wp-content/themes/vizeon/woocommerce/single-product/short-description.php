<?php

/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $post;

if (!$post->post_excerpt) return;
?>
<div itemprop="description">
	<?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
	<div class="d-flex align-center">
		<div class="font-weight-normal mr-2">Chia sẻ: </div>		
		<div style="background-color: transparent; margin-left: 15px; cursor: pointer">
			<a href="<?php echo $post->get_permalink ?>" data-elementor-open-lightbox="" onclick="copyLink(this);">
				<img width="24" height="24" src="/wp-content/themes/vizeon/images/icon-copy.svg" alt="Sao chép liên kết sản phẩm">
			</a>
			<script>
				function copyLink(el) {					
					navigator.clipboard.writeText(el.getAttribute("href"));
					return false;					
				}	
			</script>
		</div>
	</div>
</div>