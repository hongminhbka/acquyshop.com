<?php

/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());

$_count = 0;

if (!empty($tabs)) : ?>
	<section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section filter-detail-product">
		<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
				<section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
					<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-row">
						<div class="elementor-element elementor-column elementor-col-100 elementor-inner-column">
						<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-widget">
								<div class="elementor-widget-container">
									<div class="align-left">
										<div class="content-inner">
											<div class="title">Bạn đang tìm sản phẩm cho xe gì</div>
											<div class="title-desc">Raijin có đủ sản phẩm cho tất cả các dòng xe</div>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
						</div>
					</div>
					</div>
				</section>
				<section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
					<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-row">
						<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
						<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
								<div class="elementor-widget-container">
								<div class="elementor-button-wrapper">
									<a href="/danh-muc-san-pham/honda/" class="elementor-button-link elementor-button elementor-size-md">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-text">Honda</span>
									</span>
									</a>
								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
						<div class="elementor-column-wrap  elementor-element-populated">
							<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
								<div class="elementor-widget-container">
								<div class="elementor-button-wrapper">
									<a href="/danh-muc-san-pham/yamaha/" class="elementor-button-link elementor-button elementor-size-md">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-text">Yamaha</span>
									</span>
									</a>
								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
						<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
								<div class="elementor-widget-container">
								<div class="elementor-button-wrapper">
									<a href="/danh-muc-san-pham/piaggio/"
									class="elementor-button-link elementor-button elementor-size-md">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-text">Piaggio</span>
									</span>
									</a>
								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
						<div class="elementor-column-wrap elementor-element-populated">
							<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
								<div class="elementor-widget-container">
								<div class="elementor-button-wrapper">
									<a href="/danh-muc-san-pham/san-pham-khac/" class="elementor-button-link elementor-button elementor-size-md">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-text">Xe hãng khác</span>
									</span>
									</a>
								</div>
								</div>
							</div>
							</div>
						</div>
						</div>
					</div>
					</div>
				</section>
				</div>
			</div>
			</div>
		</div>
		</div>
	</section>
	<div class="container">
		<div class="woocommerce-tabs-inner clear fix container">
			<div class="tab-content col-xs-12 container">
				<?php foreach (array_reverse($tabs) as $key => $tab) : ?>
					<div class="tab-pane<?php echo esc_attr(' active'); ?>" id="tab-<?php echo esc_attr($key); ?>">
						<?php call_user_func($tab['callback'], $key, $tab) ?>
					</div>
				<?php
				endforeach; ?>
			</div>

		</div>
	</div>

<?php endif; ?>