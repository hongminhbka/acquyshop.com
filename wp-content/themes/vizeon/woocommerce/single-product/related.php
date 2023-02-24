<?php

/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
$posts_per_page = 5;
$related = wc_get_related_products($product->get_id(), $posts_per_page);
$attributes = $product->get_attributes();
$questions = [];
$postRelatedIDs = [];

foreach ($attributes as $key => $attribute) {
	if ( is_object($attribute) ) {
		$name = $attribute->get_name();
		if(strpos($name, 'Câu hỏi')!==false){
			$value = explode("|", $attribute['value']);
			if(count($value)==2){
				$attribute->question = $value[0];
				$attribute->answer = $value[1];
				array_push($questions, $attribute);
			}
		}
		else if($name=='Bài viết liên quan'){
			$value = explode("|", str_replace(" ","",$attribute['value']));
			foreach($value as $index => $postId){
				if(is_numeric($postId)){
					array_push($postRelatedIDs, $postId);
				}
			}
		}
	}
}
if(count($postRelatedIDs) > 0){
	$argPostRelated = array(
		'post__in' => $postRelatedIDs
	);
	$posts = new WP_Query($argPostRelated);
}

if (sizeof($related) == 0) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->get_id())
));
$show = 4;
$products = new WP_Query($args);

$woocommerce_loop['columns'] = $columns;
?>

<section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section product-guaranteed">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
				<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
						<section
							class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
							<div class="elementor-container elementor-column-gap-default">
								<div class="elementor-row">
									<div class="elementor-element elementor-column elementor-col-100 elementor-inner-column">
										<div class="elementor-column-wrap  elementor-element-populated">
											<div class="elementor-widget-wrap text-center">
												<div class="elementor-element elementor-widget elementor-widget-heading">
													<div class="elementor-widget-container">
														<p class="elementor-heading-title elementor-size-default">
															<span class="ez-toc-section"></span>Hệ sản phẩm được kiểm nghiệm và bảo chứng chất lượng
															<span class="ez-toc-section-end"></span>
														</p>
													</div>
												</div>
												<div class="elementor-element elementor-widget elementor-widget-text-editor">
													<div class="elementor-widget-container">
														<div class="elementor-text-editor elementor-clearfix">
															<p>Consectetur adipisicing elit sed do eiusmod tempor
																incididunt ut labore et dolore magna aliqua. Ut enim ad
																minim Consectetur adipisicing elit sed do eiusmod tempor
																incididunt ut labore et dolore magna aliqua. Ut enim ad
																minim incidi</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						<section
							class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
							<div class="elementor-container elementor-column-gap-default">
								<div class="elementor-row">
									<div class="elementor-element elementor-column elementor-col-33 elementor-inner-column">
										<div class="elementor-column-wrap elementor-element-populated">
											<div class="elementor-widget-wrap">
												<div class="elementor-element elementor-view-default elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box">
													<div class="elementor-widget-container">
														<div class="elementor-icon-box-wrapper">
															<div class="elementor-icon-box-icon">
																<span class="elementor-icon elementor-animation-">
																	<svg xmlns="http://www.w3.org/2000/svg" width="80"
																		height="80" viewBox="0 0 80 80" fill="none">
																		<path
																			d="M58.0638 30.9694C58.0638 14.1489 41.5055 0.839575 40.8011 0.28074C40.3317 -0.090976 39.6683 -0.090976 39.1983 0.28074C38.4939 0.839575 21.9355 14.1489 21.9355 30.9694C21.9355 46.4026 35.8711 58.8708 38.7094 61.2549V74.8395C38.7094 75.5521 39.2871 76.1298 39.9997 76.1298C40.7123 76.1298 41.29 75.5521 41.29 74.8395V61.2549C44.1289 58.8708 58.0638 46.4026 58.0638 30.9694ZM41.29 57.7815V43.1793L48.5674 37.1229C49.1156 36.6667 49.1899 35.8528 48.7338 35.3046C48.2776 34.7565 47.4636 34.6822 46.9161 35.1383L41.29 39.8219V35.435L48.5674 29.378C49.1156 28.9224 49.1899 28.1084 48.7338 27.5603C48.2776 27.0122 47.4636 26.9379 46.9161 27.394L41.29 32.0801V26.403L48.5674 20.3459C49.1156 19.8904 49.1899 19.0764 48.7338 18.5282C48.2776 17.9801 47.4636 17.9058 46.9161 18.3619L41.29 23.0481V12.9052C41.29 12.1927 40.7123 11.6149 39.9997 11.6149C39.2871 11.6149 38.7094 12.1927 38.7094 12.9052V23.0481L33.0839 18.3644C32.5358 17.9083 31.7218 17.9826 31.2656 18.5308C30.8095 19.0789 30.8845 19.8929 31.4326 20.349L38.7094 26.4055V32.0827L33.0839 27.399C32.5358 26.9429 31.7218 27.0172 31.2656 27.5654C30.8095 28.1135 30.8845 28.9275 31.4326 29.3836L38.7094 35.4376V39.8244L33.0839 35.1408C32.5358 34.6847 31.7218 34.759 31.2656 35.3071C30.8095 35.8553 30.8845 36.6693 31.4326 37.1254L38.7094 43.1793V57.7815C34.3225 53.6655 24.5161 43.1163 24.5161 30.9694C24.5161 17.4288 36.721 5.8483 39.9997 2.98293C43.2784 5.8483 55.4832 17.4288 55.4832 30.9694C55.4832 43.1163 45.6769 53.6655 41.29 57.7815Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M30.9679 68.3879H29.6776V58.9129C29.682 57.2012 29.0016 55.5587 27.7876 54.3522L16.9259 43.4848C15.4157 41.981 12.9731 41.981 11.4629 43.4848L10.3232 44.6283V30.9693C10.3219 29.5354 9.72466 28.167 8.6744 27.1911C7.62477 26.2145 6.21666 25.7187 4.7865 25.8208C2.03643 26.0885 -0.0470733 28.424 0.000808853 31.1873V49.6188C0.000178825 51.2241 0.598075 52.7714 1.67857 53.9584L12.9038 66.3063V68.3879H11.6135C10.9009 68.3879 10.3232 68.9657 10.3232 69.6782V78.7103C10.3232 79.4229 10.9009 80.0006 11.6135 80.0006H30.9679C31.6805 80.0006 32.2582 79.4229 32.2582 78.7103V69.6782C32.2582 68.9657 31.6805 68.3879 30.9679 68.3879V68.3879ZM3.58819 52.2214C2.93989 51.5101 2.58077 50.5815 2.5814 49.6188V31.1873C2.54675 29.7824 3.57748 28.5771 4.9711 28.395C5.71957 28.3415 6.45481 28.6156 6.9853 29.146C7.47168 29.628 7.74448 30.2845 7.74259 30.9693V46.6734C7.73944 47.701 8.1477 48.687 8.87664 49.4115L15.8624 56.3972C16.3689 56.8861 17.1735 56.8792 17.6712 56.3815C18.1689 55.8838 18.1758 55.0786 17.6869 54.5727L11.7647 48.6498C11.5234 48.4098 11.3879 48.0834 11.3879 47.7432C11.3879 47.4023 11.5234 47.076 11.7647 46.836L13.2875 45.3144C13.7896 44.818 14.5986 44.818 15.1013 45.3144L25.963 56.1774C26.6869 56.9044 27.0945 57.8873 27.097 58.9129V68.3879H15.4844V65.3077L3.58819 52.2214ZM29.6776 77.42H12.9038V70.9685H29.6776V77.42Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M75.2129 25.8208C73.7834 25.7187 72.3747 26.2145 71.325 27.1911C70.2754 28.167 69.6781 29.5354 69.6762 30.9693V44.6283L68.5372 43.4886C67.027 41.9847 64.5844 41.9847 63.0742 43.4886L52.2125 54.3522C50.9985 55.5587 50.318 57.2012 50.3218 58.9129V68.3879H49.0315C48.3189 68.3879 47.7412 68.9657 47.7412 69.6782V78.7103C47.7412 79.4229 48.3189 80.0006 49.0315 80.0006H68.3859C69.0985 80.0006 69.6762 79.4229 69.6762 78.7103V69.6782C69.6762 68.9657 69.0985 68.3879 68.3859 68.3879H67.0957V66.3063L78.3215 53.9584C79.402 52.7714 79.9999 51.2241 79.9986 49.6188V31.1873C80.0465 28.424 77.9636 26.0885 75.2129 25.8208V25.8208ZM67.0957 77.42H50.3218V70.9685H67.0957V77.42ZM77.418 49.6188C77.4193 50.5815 77.0602 51.5101 76.4119 52.2214L64.5151 65.3077V68.3879H52.9024V58.9129C52.9049 57.8873 53.3125 56.9032 54.0364 56.1761L64.9025 45.3144C65.4047 44.818 66.2136 44.818 66.7164 45.3144L68.2392 46.8372C68.7362 47.3368 68.7362 48.1439 68.2392 48.6435L62.3137 54.5689C61.9786 54.8927 61.8437 55.3722 61.9622 55.8233C62.08 56.2744 62.4328 56.6272 62.8839 56.745C63.335 56.8628 63.8145 56.7286 64.1383 56.3928L71.124 49.4077C71.8511 48.6832 72.2587 47.6991 72.2568 46.6734V30.9693C72.2556 30.2845 72.5284 29.628 73.0141 29.146C73.5452 28.6156 74.2799 28.3421 75.0283 28.395C76.4219 28.5771 77.4533 29.7824 77.418 31.1873V49.6188Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M39.0842 77.7942C38.8479 78.0412 38.7144 78.3682 38.71 78.7103C38.7125 78.7966 38.7207 78.8829 38.7358 78.968C38.7503 79.0492 38.7761 79.1274 38.8133 79.2004C38.8416 79.2824 38.8807 79.3605 38.9292 79.4329C38.9771 79.5003 39.0288 79.5646 39.0842 79.6264C39.5933 80.1253 40.4079 80.1253 40.9164 79.6264L41.0714 79.4329C41.1199 79.3605 41.1589 79.2824 41.1873 79.2004C41.2251 79.1274 41.2509 79.0492 41.2635 78.968C41.2799 78.8829 41.2887 78.7966 41.2906 78.7103C41.2938 78.1861 40.9794 77.7117 40.4955 77.5107C40.011 77.3097 39.4534 77.4218 39.0842 77.7942V77.7942Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M15.4847 74.8394H20.646C21.3585 74.8394 21.9363 74.2617 21.9363 73.5491C21.9363 72.8365 21.3585 72.2588 20.646 72.2588H15.4847C14.7721 72.2588 14.1943 72.8365 14.1943 73.5491C14.1943 74.2617 14.7721 74.8394 15.4847 74.8394Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M24.0261 74.736C24.181 74.8022 24.348 74.8369 24.5162 74.8394C25.0404 74.8419 25.5148 74.5275 25.7158 74.0436C25.9168 73.5598 25.8047 73.0016 25.4323 72.633C25.0612 72.2663 24.5068 72.1598 24.0261 72.3614C23.8679 72.4238 23.7236 72.5158 23.6002 72.633C23.3639 72.88 23.2303 73.2069 23.2259 73.5491C23.2139 74.0739 23.5346 74.5502 24.0261 74.736Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M52.8759 33.2916C52.8633 33.2109 52.8374 33.1322 52.7996 33.0591C52.7713 32.9772 52.7322 32.8991 52.6837 32.8272L52.5287 32.6338C52.0114 32.1562 51.2138 32.1562 50.6965 32.6338C50.6411 32.6949 50.5894 32.7592 50.5415 32.8272C50.493 32.8991 50.4539 32.9772 50.4256 33.0591C50.3884 33.1322 50.3626 33.2109 50.3481 33.2916C50.3336 33.3773 50.3254 33.4629 50.3223 33.5499C50.3267 33.8914 50.4602 34.219 50.6965 34.466C50.9422 34.7041 51.2705 34.8377 51.6126 34.8402C51.956 34.8434 52.2861 34.7085 52.5293 34.466C52.7719 34.2234 52.9067 33.8926 52.9029 33.5499C52.9004 33.4629 52.8916 33.3766 52.8759 33.2916Z"
																			fill="#2E3A5B"></path>
																	</svg> </span>
															</div>
															<div class="elementor-icon-box-content">
																<p class="elementor-icon-box-title">
																	<span>Cục đăng kiểm Việt Nam</span>
																</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="elementor-element elementor-element-dfc1efe elementor-column elementor-col-33 elementor-inner-column">
										<div class="elementor-column-wrap  elementor-element-populated">
											<div class="elementor-widget-wrap">
												<div class="elementor-element elementor-view-default elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box">
													<div class="elementor-widget-container">
														<div class="elementor-icon-box-wrapper">
															<div class="elementor-icon-box-icon">
																<span class="elementor-icon elementor-animation-">
																	<svg xmlns="http://www.w3.org/2000/svg" width="80"
																		height="80" viewBox="0 0 80 80" fill="none">
																		<path
																			d="M58.0638 30.9694C58.0638 14.1489 41.5055 0.839575 40.8011 0.28074C40.3317 -0.090976 39.6683 -0.090976 39.1983 0.28074C38.4939 0.839575 21.9355 14.1489 21.9355 30.9694C21.9355 46.4026 35.8711 58.8708 38.7094 61.2549V74.8395C38.7094 75.5521 39.2871 76.1298 39.9997 76.1298C40.7123 76.1298 41.29 75.5521 41.29 74.8395V61.2549C44.1289 58.8708 58.0638 46.4026 58.0638 30.9694ZM41.29 57.7815V43.1793L48.5674 37.1229C49.1156 36.6667 49.1899 35.8528 48.7338 35.3046C48.2776 34.7565 47.4636 34.6822 46.9161 35.1383L41.29 39.8219V35.435L48.5674 29.378C49.1156 28.9224 49.1899 28.1084 48.7338 27.5603C48.2776 27.0122 47.4636 26.9379 46.9161 27.394L41.29 32.0801V26.403L48.5674 20.3459C49.1156 19.8904 49.1899 19.0764 48.7338 18.5282C48.2776 17.9801 47.4636 17.9058 46.9161 18.3619L41.29 23.0481V12.9052C41.29 12.1927 40.7123 11.6149 39.9997 11.6149C39.2871 11.6149 38.7094 12.1927 38.7094 12.9052V23.0481L33.0839 18.3644C32.5358 17.9083 31.7218 17.9826 31.2656 18.5308C30.8095 19.0789 30.8845 19.8929 31.4326 20.349L38.7094 26.4055V32.0827L33.0839 27.399C32.5358 26.9429 31.7218 27.0172 31.2656 27.5654C30.8095 28.1135 30.8845 28.9275 31.4326 29.3836L38.7094 35.4376V39.8244L33.0839 35.1408C32.5358 34.6847 31.7218 34.759 31.2656 35.3071C30.8095 35.8553 30.8845 36.6693 31.4326 37.1254L38.7094 43.1793V57.7815C34.3225 53.6655 24.5161 43.1163 24.5161 30.9694C24.5161 17.4288 36.721 5.8483 39.9997 2.98293C43.2784 5.8483 55.4832 17.4288 55.4832 30.9694C55.4832 43.1163 45.6769 53.6655 41.29 57.7815Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M30.9679 68.3879H29.6776V58.9129C29.682 57.2012 29.0016 55.5587 27.7876 54.3522L16.9259 43.4848C15.4157 41.981 12.9731 41.981 11.4629 43.4848L10.3232 44.6283V30.9693C10.3219 29.5354 9.72466 28.167 8.6744 27.1911C7.62477 26.2145 6.21666 25.7187 4.7865 25.8208C2.03643 26.0885 -0.0470733 28.424 0.000808853 31.1873V49.6188C0.000178825 51.2241 0.598075 52.7714 1.67857 53.9584L12.9038 66.3063V68.3879H11.6135C10.9009 68.3879 10.3232 68.9657 10.3232 69.6782V78.7103C10.3232 79.4229 10.9009 80.0006 11.6135 80.0006H30.9679C31.6805 80.0006 32.2582 79.4229 32.2582 78.7103V69.6782C32.2582 68.9657 31.6805 68.3879 30.9679 68.3879V68.3879ZM3.58819 52.2214C2.93989 51.5101 2.58077 50.5815 2.5814 49.6188V31.1873C2.54675 29.7824 3.57748 28.5771 4.9711 28.395C5.71957 28.3415 6.45481 28.6156 6.9853 29.146C7.47168 29.628 7.74448 30.2845 7.74259 30.9693V46.6734C7.73944 47.701 8.1477 48.687 8.87664 49.4115L15.8624 56.3972C16.3689 56.8861 17.1735 56.8792 17.6712 56.3815C18.1689 55.8838 18.1758 55.0786 17.6869 54.5727L11.7647 48.6498C11.5234 48.4098 11.3879 48.0834 11.3879 47.7432C11.3879 47.4023 11.5234 47.076 11.7647 46.836L13.2875 45.3144C13.7896 44.818 14.5986 44.818 15.1013 45.3144L25.963 56.1774C26.6869 56.9044 27.0945 57.8873 27.097 58.9129V68.3879H15.4844V65.3077L3.58819 52.2214ZM29.6776 77.42H12.9038V70.9685H29.6776V77.42Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M75.2129 25.8208C73.7834 25.7187 72.3747 26.2145 71.325 27.1911C70.2754 28.167 69.6781 29.5354 69.6762 30.9693V44.6283L68.5372 43.4886C67.027 41.9847 64.5844 41.9847 63.0742 43.4886L52.2125 54.3522C50.9985 55.5587 50.318 57.2012 50.3218 58.9129V68.3879H49.0315C48.3189 68.3879 47.7412 68.9657 47.7412 69.6782V78.7103C47.7412 79.4229 48.3189 80.0006 49.0315 80.0006H68.3859C69.0985 80.0006 69.6762 79.4229 69.6762 78.7103V69.6782C69.6762 68.9657 69.0985 68.3879 68.3859 68.3879H67.0957V66.3063L78.3215 53.9584C79.402 52.7714 79.9999 51.2241 79.9986 49.6188V31.1873C80.0465 28.424 77.9636 26.0885 75.2129 25.8208V25.8208ZM67.0957 77.42H50.3218V70.9685H67.0957V77.42ZM77.418 49.6188C77.4193 50.5815 77.0602 51.5101 76.4119 52.2214L64.5151 65.3077V68.3879H52.9024V58.9129C52.9049 57.8873 53.3125 56.9032 54.0364 56.1761L64.9025 45.3144C65.4047 44.818 66.2136 44.818 66.7164 45.3144L68.2392 46.8372C68.7362 47.3368 68.7362 48.1439 68.2392 48.6435L62.3137 54.5689C61.9786 54.8927 61.8437 55.3722 61.9622 55.8233C62.08 56.2744 62.4328 56.6272 62.8839 56.745C63.335 56.8628 63.8145 56.7286 64.1383 56.3928L71.124 49.4077C71.8511 48.6832 72.2587 47.6991 72.2568 46.6734V30.9693C72.2556 30.2845 72.5284 29.628 73.0141 29.146C73.5452 28.6156 74.2799 28.3421 75.0283 28.395C76.4219 28.5771 77.4533 29.7824 77.418 31.1873V49.6188Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M39.0842 77.7942C38.8479 78.0412 38.7144 78.3682 38.71 78.7103C38.7125 78.7966 38.7207 78.8829 38.7358 78.968C38.7503 79.0492 38.7761 79.1274 38.8133 79.2004C38.8416 79.2824 38.8807 79.3605 38.9292 79.4329C38.9771 79.5003 39.0288 79.5646 39.0842 79.6264C39.5933 80.1253 40.4079 80.1253 40.9164 79.6264L41.0714 79.4329C41.1199 79.3605 41.1589 79.2824 41.1873 79.2004C41.2251 79.1274 41.2509 79.0492 41.2635 78.968C41.2799 78.8829 41.2887 78.7966 41.2906 78.7103C41.2938 78.1861 40.9794 77.7117 40.4955 77.5107C40.011 77.3097 39.4534 77.4218 39.0842 77.7942V77.7942Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M15.4847 74.8394H20.646C21.3585 74.8394 21.9363 74.2617 21.9363 73.5491C21.9363 72.8365 21.3585 72.2588 20.646 72.2588H15.4847C14.7721 72.2588 14.1943 72.8365 14.1943 73.5491C14.1943 74.2617 14.7721 74.8394 15.4847 74.8394Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M24.0261 74.736C24.181 74.8022 24.348 74.8369 24.5162 74.8394C25.0404 74.8419 25.5148 74.5275 25.7158 74.0436C25.9168 73.5598 25.8047 73.0016 25.4323 72.633C25.0612 72.2663 24.5068 72.1598 24.0261 72.3614C23.8679 72.4238 23.7236 72.5158 23.6002 72.633C23.3639 72.88 23.2303 73.2069 23.2259 73.5491C23.2139 74.0739 23.5346 74.5502 24.0261 74.736Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M52.8759 33.2916C52.8633 33.2109 52.8374 33.1322 52.7996 33.0591C52.7713 32.9772 52.7322 32.8991 52.6837 32.8272L52.5287 32.6338C52.0114 32.1562 51.2138 32.1562 50.6965 32.6338C50.6411 32.6949 50.5894 32.7592 50.5415 32.8272C50.493 32.8991 50.4539 32.9772 50.4256 33.0591C50.3884 33.1322 50.3626 33.2109 50.3481 33.2916C50.3336 33.3773 50.3254 33.4629 50.3223 33.5499C50.3267 33.8914 50.4602 34.219 50.6965 34.466C50.9422 34.7041 51.2705 34.8377 51.6126 34.8402C51.956 34.8434 52.2861 34.7085 52.5293 34.466C52.7719 34.2234 52.9067 33.8926 52.9029 33.5499C52.9004 33.4629 52.8916 33.3766 52.8759 33.2916Z"
																			fill="#2E3A5B"></path>
																	</svg> </span>
															</div>
															<div class="elementor-icon-box-content">
																<p class="elementor-icon-box-title">
																	<span>Hiệp hội</span>
																</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="elementor-element elementor-column elementor-col-33 elementor-inner-column"
										data-id="4e05ed0" data-element_type="column">
										<div class="elementor-column-wrap  elementor-element-populated">
											<div class="elementor-widget-wrap">
												<div class="elementor-element elementor-view-default elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box">
													<div class="elementor-widget-container">
														<div class="elementor-icon-box-wrapper">
															<div class="elementor-icon-box-icon">
																<span class="elementor-icon elementor-animation-">
																	<svg xmlns="http://www.w3.org/2000/svg" width="80"
																		height="80" viewBox="0 0 80 80" fill="none">
																		<path
																			d="M58.0638 30.9694C58.0638 14.1489 41.5055 0.839575 40.8011 0.28074C40.3317 -0.090976 39.6683 -0.090976 39.1983 0.28074C38.4939 0.839575 21.9355 14.1489 21.9355 30.9694C21.9355 46.4026 35.8711 58.8708 38.7094 61.2549V74.8395C38.7094 75.5521 39.2871 76.1298 39.9997 76.1298C40.7123 76.1298 41.29 75.5521 41.29 74.8395V61.2549C44.1289 58.8708 58.0638 46.4026 58.0638 30.9694ZM41.29 57.7815V43.1793L48.5674 37.1229C49.1156 36.6667 49.1899 35.8528 48.7338 35.3046C48.2776 34.7565 47.4636 34.6822 46.9161 35.1383L41.29 39.8219V35.435L48.5674 29.378C49.1156 28.9224 49.1899 28.1084 48.7338 27.5603C48.2776 27.0122 47.4636 26.9379 46.9161 27.394L41.29 32.0801V26.403L48.5674 20.3459C49.1156 19.8904 49.1899 19.0764 48.7338 18.5282C48.2776 17.9801 47.4636 17.9058 46.9161 18.3619L41.29 23.0481V12.9052C41.29 12.1927 40.7123 11.6149 39.9997 11.6149C39.2871 11.6149 38.7094 12.1927 38.7094 12.9052V23.0481L33.0839 18.3644C32.5358 17.9083 31.7218 17.9826 31.2656 18.5308C30.8095 19.0789 30.8845 19.8929 31.4326 20.349L38.7094 26.4055V32.0827L33.0839 27.399C32.5358 26.9429 31.7218 27.0172 31.2656 27.5654C30.8095 28.1135 30.8845 28.9275 31.4326 29.3836L38.7094 35.4376V39.8244L33.0839 35.1408C32.5358 34.6847 31.7218 34.759 31.2656 35.3071C30.8095 35.8553 30.8845 36.6693 31.4326 37.1254L38.7094 43.1793V57.7815C34.3225 53.6655 24.5161 43.1163 24.5161 30.9694C24.5161 17.4288 36.721 5.8483 39.9997 2.98293C43.2784 5.8483 55.4832 17.4288 55.4832 30.9694C55.4832 43.1163 45.6769 53.6655 41.29 57.7815Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M30.9679 68.3879H29.6776V58.9129C29.682 57.2012 29.0016 55.5587 27.7876 54.3522L16.9259 43.4848C15.4157 41.981 12.9731 41.981 11.4629 43.4848L10.3232 44.6283V30.9693C10.3219 29.5354 9.72466 28.167 8.6744 27.1911C7.62477 26.2145 6.21666 25.7187 4.7865 25.8208C2.03643 26.0885 -0.0470733 28.424 0.000808853 31.1873V49.6188C0.000178825 51.2241 0.598075 52.7714 1.67857 53.9584L12.9038 66.3063V68.3879H11.6135C10.9009 68.3879 10.3232 68.9657 10.3232 69.6782V78.7103C10.3232 79.4229 10.9009 80.0006 11.6135 80.0006H30.9679C31.6805 80.0006 32.2582 79.4229 32.2582 78.7103V69.6782C32.2582 68.9657 31.6805 68.3879 30.9679 68.3879V68.3879ZM3.58819 52.2214C2.93989 51.5101 2.58077 50.5815 2.5814 49.6188V31.1873C2.54675 29.7824 3.57748 28.5771 4.9711 28.395C5.71957 28.3415 6.45481 28.6156 6.9853 29.146C7.47168 29.628 7.74448 30.2845 7.74259 30.9693V46.6734C7.73944 47.701 8.1477 48.687 8.87664 49.4115L15.8624 56.3972C16.3689 56.8861 17.1735 56.8792 17.6712 56.3815C18.1689 55.8838 18.1758 55.0786 17.6869 54.5727L11.7647 48.6498C11.5234 48.4098 11.3879 48.0834 11.3879 47.7432C11.3879 47.4023 11.5234 47.076 11.7647 46.836L13.2875 45.3144C13.7896 44.818 14.5986 44.818 15.1013 45.3144L25.963 56.1774C26.6869 56.9044 27.0945 57.8873 27.097 58.9129V68.3879H15.4844V65.3077L3.58819 52.2214ZM29.6776 77.42H12.9038V70.9685H29.6776V77.42Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M75.2129 25.8208C73.7834 25.7187 72.3747 26.2145 71.325 27.1911C70.2754 28.167 69.6781 29.5354 69.6762 30.9693V44.6283L68.5372 43.4886C67.027 41.9847 64.5844 41.9847 63.0742 43.4886L52.2125 54.3522C50.9985 55.5587 50.318 57.2012 50.3218 58.9129V68.3879H49.0315C48.3189 68.3879 47.7412 68.9657 47.7412 69.6782V78.7103C47.7412 79.4229 48.3189 80.0006 49.0315 80.0006H68.3859C69.0985 80.0006 69.6762 79.4229 69.6762 78.7103V69.6782C69.6762 68.9657 69.0985 68.3879 68.3859 68.3879H67.0957V66.3063L78.3215 53.9584C79.402 52.7714 79.9999 51.2241 79.9986 49.6188V31.1873C80.0465 28.424 77.9636 26.0885 75.2129 25.8208V25.8208ZM67.0957 77.42H50.3218V70.9685H67.0957V77.42ZM77.418 49.6188C77.4193 50.5815 77.0602 51.5101 76.4119 52.2214L64.5151 65.3077V68.3879H52.9024V58.9129C52.9049 57.8873 53.3125 56.9032 54.0364 56.1761L64.9025 45.3144C65.4047 44.818 66.2136 44.818 66.7164 45.3144L68.2392 46.8372C68.7362 47.3368 68.7362 48.1439 68.2392 48.6435L62.3137 54.5689C61.9786 54.8927 61.8437 55.3722 61.9622 55.8233C62.08 56.2744 62.4328 56.6272 62.8839 56.745C63.335 56.8628 63.8145 56.7286 64.1383 56.3928L71.124 49.4077C71.8511 48.6832 72.2587 47.6991 72.2568 46.6734V30.9693C72.2556 30.2845 72.5284 29.628 73.0141 29.146C73.5452 28.6156 74.2799 28.3421 75.0283 28.395C76.4219 28.5771 77.4533 29.7824 77.418 31.1873V49.6188Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M39.0842 77.7942C38.8479 78.0412 38.7144 78.3682 38.71 78.7103C38.7125 78.7966 38.7207 78.8829 38.7358 78.968C38.7503 79.0492 38.7761 79.1274 38.8133 79.2004C38.8416 79.2824 38.8807 79.3605 38.9292 79.4329C38.9771 79.5003 39.0288 79.5646 39.0842 79.6264C39.5933 80.1253 40.4079 80.1253 40.9164 79.6264L41.0714 79.4329C41.1199 79.3605 41.1589 79.2824 41.1873 79.2004C41.2251 79.1274 41.2509 79.0492 41.2635 78.968C41.2799 78.8829 41.2887 78.7966 41.2906 78.7103C41.2938 78.1861 40.9794 77.7117 40.4955 77.5107C40.011 77.3097 39.4534 77.4218 39.0842 77.7942V77.7942Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M15.4847 74.8394H20.646C21.3585 74.8394 21.9363 74.2617 21.9363 73.5491C21.9363 72.8365 21.3585 72.2588 20.646 72.2588H15.4847C14.7721 72.2588 14.1943 72.8365 14.1943 73.5491C14.1943 74.2617 14.7721 74.8394 15.4847 74.8394Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M24.0261 74.736C24.181 74.8022 24.348 74.8369 24.5162 74.8394C25.0404 74.8419 25.5148 74.5275 25.7158 74.0436C25.9168 73.5598 25.8047 73.0016 25.4323 72.633C25.0612 72.2663 24.5068 72.1598 24.0261 72.3614C23.8679 72.4238 23.7236 72.5158 23.6002 72.633C23.3639 72.88 23.2303 73.2069 23.2259 73.5491C23.2139 74.0739 23.5346 74.5502 24.0261 74.736Z"
																			fill="#2E3A5B"></path>
																		<path
																			d="M52.8759 33.2916C52.8633 33.2109 52.8374 33.1322 52.7996 33.0591C52.7713 32.9772 52.7322 32.8991 52.6837 32.8272L52.5287 32.6338C52.0114 32.1562 51.2138 32.1562 50.6965 32.6338C50.6411 32.6949 50.5894 32.7592 50.5415 32.8272C50.493 32.8991 50.4539 32.9772 50.4256 33.0591C50.3884 33.1322 50.3626 33.2109 50.3481 33.2916C50.3336 33.3773 50.3254 33.4629 50.3223 33.5499C50.3267 33.8914 50.4602 34.219 50.6965 34.466C50.9422 34.7041 51.2705 34.8377 51.6126 34.8402C51.956 34.8434 52.2861 34.7085 52.5293 34.466C52.7719 34.2234 52.9067 33.8926 52.9029 33.5499C52.9004 33.4629 52.8916 33.3766 52.8759 33.2916Z"
																			fill="#2E3A5B"></path>
																	</svg> </span>
															</div>
															<div class="elementor-icon-box-content">
																<p class="elementor-icon-box-title">
																	<span>Tiêu chuẩn</span>
																</p>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if ($questions):?>
	<section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section product-questions">
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-row">
				<div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-widget elementor-widget-heading">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default">Câu hỏi thường gặp</p>
								</div>
							</div>
							<div class="elementor-element elementor-widget elementor-widget-toggle">
								<div class="elementor-widget-container">
									<div class="elementor-toggle" role="tablist">
										<script>
											function openQuestion(index){
												document.getElementById("open-icon-" + index).style.display = 'none';
												document.getElementById("close-icon-" + index).style.display = 'block';
												document.getElementById("elementor-tab-content-" + index).style.display = 'block';
												document.getElementById("elementor-tab-title-" + index).classList.add('elementor-active');
												console.log(0);
											}
											function closeQuestion(index){
												document.getElementById("open-icon-" + index).style.display = 'block';
												document.getElementById("close-icon-" + index).style.display = 'none';
												document.getElementById("elementor-tab-content-" + index).style.display = 'none';
												document.getElementById("elementor-tab-title-" + index).classList.remove('elementor-active');
												console.log(1);
											}
										</script>
										<?php foreach ($questions as $question_key => $question) : ?>
											<div class="elementor-toggle-item">
												<?php if($question_key==0):?>
													<div id="elementor-tab-title-<?php echo esc_attr($question_key); ?>" class="elementor-tab-title elementor-active"
														data-tab="<?php echo esc_attr($question_key); ?>" role="tab" aria-controls="elementor-tab-content-<?php echo esc_attr($question_key); ?>">
														<span class="elementor-toggle-icon elementor-toggle-icon-right">
															<span class="elementor-toggle-icon-closed" onclick="openQuestion(<?php echo esc_attr($question_key); ?>)" id="open-icon-<?php echo esc_attr($question_key); ?>">
																<i class="fas fa-plus"></i>
															</span>
															<span class="elementor-toggle-icon-opened" onclick="closeQuestion(<?php echo esc_attr($question_key); ?>)" id="close-icon-<?php echo esc_attr($question_key); ?>">
																<i class="elementor-toggle-icon-opened fas fa-window-minimize"></i>
															</span>
														</span>
														<p><?php echo esc_attr(($question_key + 1) . '. '); echo esc_attr($question->question) ?></p>
													</div>
													<div id="elementor-tab-content-<?php echo esc_attr($question_key); ?>"
														class="elementor-tab-content elementor-clearfix"
														data-tab="<?php echo esc_attr($question_key); ?>" role="tabpanel" aria-labelledby="elementor-tab-title-<?php echo esc_attr($question_key); ?>"
														style="display: block;">
														<p><?php echo esc_attr($question->answer);?></p>
													</div>
												<?php else :?>
													<div id="elementor-tab-title-<?php echo esc_attr($question_key); ?>" class="elementor-tab-title"
														data-tab="<?php echo esc_attr($question_key); ?>" role="tab" aria-controls="elementor-tab-content-<?php echo esc_attr($question_key); ?>">
														<span class="elementor-toggle-icon elementor-toggle-icon-right">
															<span class="elementor-toggle-icon-closed" onclick="openQuestion(<?php echo esc_attr($question_key); ?>)" id="open-icon-<?php echo esc_attr($question_key); ?>"> 
																<i class="fas fa-plus"></i>
															</span>
															<span class="elementor-toggle-icon-opened" onclick="closeQuestion(<?php echo esc_attr($question_key); ?>)" id="close-icon-<?php echo esc_attr($question_key); ?>">
																<i class="elementor-toggle-icon-opened fas fa-window-minimize"></i>
															</span>
														</span>
														<p><?php echo esc_attr(($question_key + 1) . '. '); echo esc_attr($question->question) ?></p>
													</div>
													<div id="elementor-tab-content-<?php echo esc_attr($question_key); ?>"
														class="elementor-tab-content elementor-clearfix"
														data-tab="<?php echo esc_attr($question_key); ?>" role="tabpanel" aria-labelledby="elementor-tab-title-<?php echo esc_attr($question_key); ?>">
														<p><?php echo esc_attr($question->answer);?></p>
													</div>
												<?php endif;?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
<?php endif;?>

<?php if ($products->have_posts()) : ?>
	<section class="elementor-element elementor-section-full_width product-related elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section">
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-row">
				<div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
					<div class="elementor-column-wrap  elementor-element-populated">
						<div class="elementor-widget-wrap">
							<section class="elementor-element product-listing elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
								<div class="elementor-container elementor-column-gap-default">		
									<div class="elementor-row">
										<div class="elementor-element elementor-column elementor-col-100 elementor-inner-column">
											<div class="elementor-column-wrap elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-widget elementor-widget-heading">
														<div class="elementor-widget-container">
															<p class="elementor-heading-title elementor-size-default">
																<span class="ez-toc-section"></span>Sản phẩm khác
																<span class="ez-toc-section-end"></span>
															</p>
														</div>
													</div>
													<div class="elementor-element elementor-widget elementor-widget-text-editor">
														<div class="elementor-widget-container">
															<div class="woocommerce columns-3 ">
																<div class="products_wrapper grid-view">
																	<div class="products lg-block-grid-3 md-block-grid-2 sm-block-grid-2">
																		<?php while ($products->have_posts()) : $products->the_post(); ?>
																			<?php wc_get_template_part('content', 'product'); ?>
																		<?php endwhile;?>
																	</div>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif;?>

<?php if($posts) :?>
	<section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section product-post-related">
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-row">
				<div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-widget elementor-widget-heading">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default">Bài viết liên quan</p>
								</div>
							</div>
							<div class="gva-element-gva-posts gva-element">  
								<div class="gva-posts-grid clearfix gva-posts">
									<div class="gva-content-items"> 
										<div class="lg-block-grid-3 md-block-grid-3 sm-block-grid-2 xs-block-grid-1">
											<?php while ($posts->have_posts()) : $posts->the_post(); ?>
												<?php echo '<div class="item-columns margin-bottom-30">';?>
                  									<?php get_template_part( 'templates/content/item', 'post-style-2' );?>
                								<?php echo '</div>';?>
											<?php endwhile;?>
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
<?php endif;
wp_reset_postdata();
