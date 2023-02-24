<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly
get_header();

$page_id = vizeon_id();

$sidebar_layout_config = vizeon_get_option('woo_sidebar_config', '');
$left_sidebar = vizeon_get_option('woo_left_sidebar', '');
$right_sidebar = vizeon_get_option('woo_right_sidebar', '');

if (is_shop()) {
  $sidebar_layout_config = get_post_meta($page_id, 'vizeon_sidebar_config', true);
  $left_sidebar = get_post_meta($page_id, 'vizeon_left_sidebar', true);
  $right_sidebar = get_post_meta($page_id, 'vizeon_right_sidebar', true);
  if ($sidebar_layout_config == "") {
    $sidebar_layout_config = vizeon_get_option('woo_sidebar_config', '');
  }
  if ($left_sidebar == "") {
    $left_sidebar = vizeon_get_option('woo_left_sidebar', '');
  }
  if ($right_sidebar == "") {
    $right_sidebar = vizeon_get_option('woo_right_sidebar', '');
  }
}

$left_sidebar_config  = array('active' => false);
$right_sidebar_config = array('active' => false);
$main_content_config  = array('class' => 'col-lg-12 col-xs-12');

if (isset($_GET['sb']) && $_GET['sb']) {
  $sidebar_layout_config = $_GET['sb'];
}

$sidebar_config = vizeon_sidebar_global($sidebar_layout_config, $left_sidebar, $right_sidebar);

extract($sidebar_config);

$woo_display = vizeon_display_modes_value();
?>

<section id="wp-main-content" class="clearfix main-page">
  <?php
  /**
   * woocommerce_before_main_content hook
   *
   * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
   * @hooked woocommerce_breadcrumb - 20
   */
  do_action('woocommerce_before_main_content');
  ?>

  <div class="container">
    <div class="main-page-content row">
      <div class="content-page <?php echo esc_attr($main_content_config['class']); ?>">

        <div id="wp-content" class="wp-content">                                        

          <?php if (have_posts()) : ?>                                      
            <?php if (is_shop()) : ?>              
              <?php show_products_per_category(); ?>            
            <?php else: ?>
              <!-- hien thi trang danh muc xe may -->
              <?php if (is_product_category('xe-may') ): ?>
                
                <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section">
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
                                        <div class="elementor-element elementor-widget elementor-widget-gva-heading-block">
                                          <div class="elementor-widget-container">
                                            <div class="gva-element-gva-heading-block gva-element">
                                              <div class="align-left style-1 widget gsc-heading">
                                                <div class="content-inner">
                                                  <div class="title">Bạn đang tìm sản phẩm cho xe gì</div>
                                                  <div class="title-desc">Raijin có đủ sản phẩm cho tất cả các dòng xe máy</div>                                                 
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
                            <section class="elementor-element elementor-element-bcad63e elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section product-filter">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <?php
                                    $term_id_ac_quy_xe_may = 80;
                                    $args_query_honda = array(
                                      'taxonomy' => 'product_cat', 
                                      'hide_empty' => false, 
                                      'name' => 'HONDA',
                                      'child_of' => $term_id_ac_quy_xe_may,                                     
                                    );
                                    $hondaCategory = get_terms($args_query_honda);
                                    
                                    $childrentOfHonda = [];
                                    if(is_array($hondaCategory) && count($hondaCategory)>0){
                                      $args_query_childrent_of_honda = array(
                                        'taxonomy' => 'product_cat', 
                                        'hide_empty' => false, 
                                        'child_of' => $hondaCategory[0]->term_id,
                                        'order' => 'order'
                                      );
                                      $childrentOfHonda = get_terms($args_query_childrent_of_honda);
                                      echo '<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
                                              <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                  <div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
                                                    <div class="elementor-widget-container">
                                                      <div class="dropdown">
                                                        <a class="dropbtn" href="">'.$hondaCategory[0]->name.'</a>
                                                        <div class="dropdown-content">';
                                                          foreach ( $childrentOfHonda as $key => $term ){
                                                            echo '<a href="'. get_term_link( $term->term_id, 'product_cat' ) .'">'.$term->name.'</a>';
                                                          }                                                                                                                    
                                                  echo '</div>
                                                      </div>                                                      
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>';
                                    }

                                    $args_query_yamaha = array(
                                      'taxonomy' => 'product_cat', 
                                      'hide_empty' => false, 
                                      'name' => 'YAMAHA',
                                      'child_of' => $term_id_ac_quy_xe_may,                                     
                                    );
                                    $yamahaCategory = get_terms($args_query_yamaha);
                                    $childrentOfYamaha = [];
                                    if(is_array($yamahaCategory) && count($yamahaCategory) > 0){
                                      $args_query_childrent_of_yamaha = array(
                                        'taxonomy' => 'product_cat', 
                                        'hide_empty' => false, 
                                        'child_of' => $yamahaCategory[0]->term_id,
                                        'order' => 'order'
                                      );
                                      $childrentOfYamaha = get_terms($args_query_childrent_of_yamaha);
                                      echo '<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
                                              <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                  <div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
                                                    <div class="elementor-widget-container">
                                                      <div class="dropdown">
                                                        <a class="dropbtn" href="">'.$yamahaCategory[0]->name.'</a>
                                                        <div class="dropdown-content">';
                                                          foreach ( $childrentOfYamaha as $key => $term ){
                                                            echo '<a href="'. get_term_link( $term->term_id, 'product_cat' ) .'">'.$term->name.'</a>';
                                                          }                                                                                                                    
                                                  echo '</div>
                                                      </div>                                                      
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>';
                                    }
                                    $args_query_piaggio = array(
                                      'taxonomy' => 'product_cat', 
                                      'hide_empty' => false, 
                                      'name' => 'PIAGGIO',
                                      'child_of' => $term_id_ac_quy_xe_may,                                     
                                    );
                                    $piaggioCategory = get_terms($args_query_piaggio);

                                    $childrentOfPiaggio = [];
                                    if(is_array($piaggioCategory) && count($piaggioCategory) > 0){
                                      $args_query_childrent_of_piaggio = array(
                                        'taxonomy' => 'product_cat', 
                                        'hide_empty' => false, 
                                        'child_of' => $piaggioCategory[0]->term_id,
                                        'order' => 'order'
                                      );
                                      $childrentOfPiaggio = get_terms($args_query_childrent_of_piaggio);
                                      echo '<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
                                              <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                  <div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
                                                    <div class="elementor-widget-container">
                                                      <div class="dropdown">
                                                        <a class="dropbtn" href="">'.$piaggioCategory[0]->name.'</a>
                                                        <div class="dropdown-content">';
                                                          foreach ( $childrentOfPiaggio as $key => $term ){
                                                            echo '<a href="'. get_term_link( $term->term_id, 'product_cat' ) .'">'.$term->name.'</a>';
                                                          }                                                                                                                    
                                                  echo '</div>
                                                      </div>                                                      
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>';
                                    }
                                    
                                    $args_query_other = array(
                                      'taxonomy' => 'product_cat', 
                                      'hide_empty' => false,                                    
                                      'child_of' => $term_id_ac_quy_xe_may,
                                      'order' => 'order'                                                                           
                                    );

                                    $allCategoryChildrentOfAcQuyXeMay = get_terms($args_query_other);
                                    $otherCategory = [];
                                    foreach($allCategoryChildrentOfAcQuyXeMay as $key => $term ){
                                      if($term->parent == $term_id_ac_quy_xe_may && !in_array($term->term_id,[$hondaCategory[0]->term_id, $yamahaCategory[0]->term_id, $piaggioCategory[0]->term_id])){
                                        array_push($otherCategory, $term);
                                      }                                     
                                    }
                                    if(count($otherCategory) > 0){
                                      echo '<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
                                            <div class="elementor-column-wrap elementor-element-populated">
                                              <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
                                                  <div class="elementor-widget-container">
                                                    <div class="dropdown">
                                                      <a class="dropbtn" href="">XE HÃNG KHÁC</a>
                                                      <div class="dropdown-content">';                                                      
                                                        foreach ( $otherCategory as $key => $term ){
                                                          echo '<a href="'. get_term_link( $term->term_id, 'product_cat' ) .'">'.$term->name.'</a>';
                                                        }                                                                                                                                                                                                                       
                                              echo    '</div>                                            
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>';
                                          '</div>';
                                    }                                    
                                    ?>                                                             
                                </div>
                              </div>
                            </section>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              
              <?php elseif(is_product_category('ac-quy-pkl')) :?>
                <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section">
                  <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                      <div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
                        <div class="elementor-column-wrap elementor-element-populated">
                          <div class="elementor-widget-wrap">
                          <form method="get" action="<?php echo get_term_link('ac-quy-pkl', 'product_cat' );?>">
                            <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-100 elementor-inner-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-gva-heading-block">
                                          <div class="elementor-widget-container">
                                            <div class="gva-element-gva-heading-block gva-element">
                                              <div class="align-left style-1 widget gsc-heading">
                                                <div class="content-inner">
                                                  <div class="title">Bạn đang tìm ắc quy cho xe mô tô nào</div>
                                                  <div class="title-desc">Hãy chọn hãng xe, sau đó chọn dòng xe</div>                                                 
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
                            <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section product-filter">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                                    <div class="elementor-column-wrap  elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-da4516b elementor-widget elementor-widget-html">
                                          <div class="elementor-widget-container">
                                            <select class="wpcf7-form-control wpcf7-select full-width" onchange="layDanhSachDongXePKL(this.value)" name="hang-xe">
                                              <option value="" selected="">Chọn hãng xe</option>                                              
                                              <?php
                                                $term_id_ac_quy_pkl = 111;
                                                $args_query = array(
                                                  'taxonomy' => 'product_cat', 
                                                  'hide_empty' => false,                                                 
                                                  'child_of' => $term_id_ac_quy_pkl,
                                                  'orderby' => 'order',
                                                  'parent' => $term_id_ac_quy_pkl                                    
                                                );
                                                $categoriesChildrentOfAcQuyXePKL = get_terms($args_query);
                                                $hangXeSelected = get_query_var( 'hang-xe', '');
                                                foreach ( $categoriesChildrent as $key => $term ){ 
                                                  if($hangXeSelected == $term->term_id){
                                                    echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                  }
                                                  else{
                                                    echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                  }
                                                }
                                              ?>
                                            </select>
                                            <script>
                                              function layDanhSachDongXePKL(val) {    
                                                  var consumerKey = 'ck_09275593145b2c019ce56220a0d56c3538fee867';
                                                  var consumerSecret = 'cs_7ffb4ed80e0ed21ca1c7aa0434a2623050b5cc11';
                                                  var url = window.location.origin + "/wp-json/wc/v3/products/categories?parent=" + val
                                                          + '&consumer_key=' + consumerKey
                                                          + '&consumer_secret=' + consumerSecret;
                                                  var xhr = new XMLHttpRequest();
                                                  xhr.open("GET", url, true);
                                                  xhr.setRequestHeader('Content-type','charset=utf-8');
                                                  xhr.setRequestHeader("Access-Control-Allow-Headers", "Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With");
                                                  xhr.setRequestHeader("Access-Control-Allow-Methods", "GET");
                                                  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
                                                  xhr.onload = function () {                                               
                                                      if (xhr.readyState == 4 && xhr.status == "200") {                
                                                          var response = JSON.parse(xhr.responseText);
                                                          var i = 0;
                                                          var innerHTML = '<option value="" disabled selected hidden>Chọn dòng xe</option>';
                                                          for (i = 0; i < response.length; i++) {
                                                              innerHTML += '<option value="' + response[i].id + '">' + response[i].name + '</option>';   
                                                          }
                                                          document.getElementById("dong-xe-pkl").innerHTML = innerHTML; 
                                                      }
                                                  }
                                                  xhr.send();
                                              }
                                            </script>                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-html">
                                          <div class="elementor-widget-container">
                                              <select class="wpcf7-form-control wpcf7-select full-width" id="dong-xe-pkl" name="dong-xe" onchange="this.form.submit();">
                                              <?php
                                                  $hangXeSelected = get_query_var( 'hang-xe', '');
                                                  $dongXeSelected = get_query_var( 'dong-xe', '');
                                                  if($dongXeSelected != '' && $hangXeSelected != ''){
                                                    echo '<option value="">Chọn dòng xe</option>';
                                                    $args_query = array(
                                                      'taxonomy' => 'product_cat', 
                                                      'hide_empty' => false,                                                 
                                                      'child_of' => $hangXeSelected,
                                                      'orderby' => 'order',
                                                      'parent' => $hangXeSelected                                    
                                                    );
                                                    $categoriesChildrent = get_terms($args_query);
                                                    foreach ( $categoriesChildrent as $key => $term ){ 
                                                      if($dongXeSelected == $term->term_id){
                                                        echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                      }
                                                      else{
                                                        echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                      }
                                                    }
                                                  }
                                                  else{
                                                    echo '<option value="" disabled="" selected="">Chọn dòng xe</option>';
                                                  }
                                                ?>                                              
                                              </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                            <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section element-product-filter-by-dung-tich">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <section class="elementor-element elementor-element-33a207e elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
                                          <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                              <div class="elementor-element elementor-column elementor-col-50 elementor-inner-column">
                                                <div class="elementor-column-wrap  elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-element-17c7abc elementor-widget elementor-widget-heading">
                                                      <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default"><span
                                                            class="ez-toc-section"
                                                            id="Tim_ac_quy_theo_dung_tich_binh"></span>Tìm ắc quy
                                                          theo dung tích bình<span class="ez-toc-section-end"></span>
                                                        </h2>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="elementor-element elementor-column elementor-col-50 elementor-inner-column">
                                                <div class="elementor-column-wrap  elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-widget elementor-widget-html">
                                                      <div class="elementor-widget-container">
                                                          <select class="wpcf7-form-control wpcf7-select full-width" name="dung-luong" onchange="this.form.submit();">
                                                            <option value="" selected="">Chọn dung lượng bình</option>
                                                            <?php 
                                                              $attribute_terms = get_terms(array(
                                                                'taxonomy' => 'pa_dung-tich-xe-pkl',
                                                                'hide_empty' => false,
                                                              ));
                                                              $dungLuongSelected = get_query_var( 'dung-luong', '');
                                                              foreach ( $attribute_terms as $key => $term ){
                                                                if($dungLuongSelected == $term->term_id){
                                                                  echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                                } 
                                                                else{                                                 
                                                                  echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                                }
                                                              }
                                                            ?>
                                                          </select>
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
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              <?php elseif(is_product_category('o-to')) :?>
                <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section">
                  <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                      <div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
                        <div class="elementor-column-wrap elementor-element-populated">
                          <div class="elementor-widget-wrap">
                          <form method="get" action="<?php echo get_term_link('o-to', 'product_cat' );?>">
                            <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-100 elementor-inner-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-gva-heading-block">
                                          <div class="elementor-widget-container">
                                            <div class="gva-element-gva-heading-block gva-element">
                                              <div class="align-left style-1 widget gsc-heading">
                                                <div class="content-inner">
                                                  <div class="title">Bạn đang tìm ắc quy cho xe ô tô nào</div>
                                                  <div class="title-desc">Hãy chọn hãng xe, sau đó chọn dòng xe</div>                                                 
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
                            <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section product-filter">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                                    <div class="elementor-column-wrap  elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-html">
                                          <div class="elementor-widget-container">
                                            <select class="wpcf7-form-control wpcf7-select full-width" onchange="layDanhSachDongXeOTo(this.value)" name="hang-xe">                                             
                                              <option value="" selected="">Chọn hãng xe</option>                                              
                                              <?php
                                                $term_id = 79;
                                                $args_query = array(
                                                  'taxonomy' => 'product_cat', 
                                                  'hide_empty' => false,                                                 
                                                  'child_of' => $term_id,
                                                  'orderby' => 'order',
                                                  'parent' => $term_id                                    
                                                );
                                                $categoriesChildrent = get_terms($args_query);
                                                $hangXeSelected = get_query_var( 'hang-xe', '');
                                                
                                                foreach ( $categoriesChildrent as $key => $term ){ 
                                                  if($hangXeSelected == $term->term_id){
                                                    echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                  }
                                                  else{
                                                    echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                  }
                                                }
                                              ?>
                                            </select>
                                            <script>
                                              function layDanhSachDongXeOTo(val) {    
                                                  var consumerKey = 'ck_09275593145b2c019ce56220a0d56c3538fee867';
                                                  var consumerSecret = 'cs_7ffb4ed80e0ed21ca1c7aa0434a2623050b5cc11';
                                                  var url = window.location.origin + "/wp-json/wc/v3/products/categories?parent=" + val
                                                          + '&consumer_key=' + consumerKey
                                                          + '&consumer_secret=' + consumerSecret;
                                                  var xhr = new XMLHttpRequest();
                                                  xhr.open("GET", url, true);
                                                  xhr.setRequestHeader('Content-type','charset=utf-8');
                                                  xhr.setRequestHeader("Access-Control-Allow-Headers", "Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With");
                                                  xhr.setRequestHeader("Access-Control-Allow-Methods", "GET");
                                                  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
                                                  xhr.onload = function () {                                               
                                                      if (xhr.readyState == 4 && xhr.status == "200") {                
                                                          var response = JSON.parse(xhr.responseText);
                                                          var i = 0;
                                                          var innerHTML = '<option value="" disabled selected hidden>Chọn dòng xe</option>';
                                                          for (i = 0; i < response.length; i++) {
                                                              innerHTML += '<option value="' + response[i].id + '">' + response[i].name + '</option>';   
                                                          }
                                                          document.getElementById("dong-xe-oto").innerHTML = innerHTML; 
                                                      }
                                                  }
                                                  xhr.send();
                                              }
                                            </script>                                              
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-html">
                                          <div class="elementor-widget-container">
                                              <select class="wpcf7-form-control wpcf7-select full-width" id="dong-xe-oto" name="dong-xe" onchange="this.form.submit();"> 
                                                <?php
                                                  $hangXeSelected = get_query_var( 'hang-xe', '');
                                                  $dongXeSelected = get_query_var( 'dong-xe', '');
                                                  if($dongXeSelected != '' && $hangXeSelected != ''){
                                                    echo '<option value="">Chọn dòng xe</option>';
                                                    $args_query = array(
                                                      'taxonomy' => 'product_cat', 
                                                      'hide_empty' => false,                                                 
                                                      'child_of' => $hangXeSelected,
                                                      'orderby' => 'order',
                                                      'parent' => $hangXeSelected                                    
                                                    );
                                                    $categoriesChildrent = get_terms($args_query);
                                                    foreach ( $categoriesChildrent as $key => $term ){ 
                                                      if($dongXeSelected == $term->term_id){
                                                        echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                      }
                                                      else{
                                                        echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                      }
                                                    }
                                                  }
                                                  else{
                                                    echo '<option value="" disabled="" selected="">Chọn dòng xe</option>';
                                                  }
                                                  
                                                ?>                                             
                                              </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                            <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section element-product-filter-by-dung-tich">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
                                          <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                              <div class="elementor-element elementor-column elementor-col-50 elementor-inner-column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-widget elementor-widget-heading">
                                                      <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                          <span class="ez-toc-section"></span>Tìm ắc quy theo dung tích bình<span class="ez-toc-section-end"></span>
                                                        </h2>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="elementor-element elementor-column elementor-col-50 elementor-inner-column">
                                                <div class="elementor-column-wrap  elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-widget elementor-widget-html">
                                                      <div class="elementor-widget-container">
                                                        <select class="wpcf7-form-control wpcf7-select full-width" name="dung-luong" onchange="this.form.submit();">
                                                          <option value="" disabled="" selected="" hidden="">Chọn dung lượng bình</option>
                                                          <?php 
                                                            $attribute_terms = get_terms(array(
                                                              'taxonomy' => 'pa_dung-luong-dien-o-to',
                                                              'hide_empty' => false,
                                                            ));
                                                            $dungLuongSelected = get_query_var( 'dung-luong', '');
                                                            foreach ( $attribute_terms as $key => $term ){
                                                              if($dungLuongSelected == $term->term_id){
                                                                echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                              } 
                                                              else{                                                 
                                                                echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                              }
                                                            }
                                                          ?>                                                          
                                                        </select>
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
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              <?php elseif(is_product_category('xe-may-dien')) :?>
                <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section">
                  <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                      <div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
                        <div class="elementor-column-wrap elementor-element-populated">
                          <div class="elementor-widget-wrap">
                          <form method="get" action="<?php echo get_term_link('xe-may-dien', 'product_cat' );?>">
                            <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-100 elementor-inner-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-gva-heading-block">
                                          <div class="elementor-widget-container">
                                            <div class="gva-element-gva-heading-block gva-element">
                                              <div class="align-left style-1 widget gsc-heading">
                                                <div class="content-inner">
                                                  <div class="title">Bạn đang tìm ắc quy cho xe máy điện nào</div>
                                                  <div class="title-desc">Hãy chọn hãng xe, sau đó chọn dòng xe</div>                                                 
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
                            <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section product-filter">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-html">
                                          <div class="elementor-widget-container">
                                            <select class="wpcf7-form-control wpcf7-select full-width" onchange="layDanhSachDongXeMayDien(this.value)" name="hang-xe">
                                              <option value="" selected="">Chọn hãng xe</option>
                                              <?php
                                                $term_id = 109;
                                                $args_query = array(
                                                  'taxonomy' => 'product_cat', 
                                                  'hide_empty' => false,                                                 
                                                  'child_of' => $term_id,
                                                  'orderby' => 'order',
                                                  'parent' => $term_id                                    
                                                );
                                                $categoriesChildrent = get_terms($args_query);
                                                $hangXeSelected = get_query_var( 'hang-xe', '');
                                                foreach ( $categoriesChildrent as $key => $term ){ 
                                                  if($hangXeSelected == $term->term_id){
                                                    echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                  }
                                                  else{
                                                    echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                  }
                                                }
                                              ?>
                                            </select>
                                            <script>
                                              function layDanhSachDongXeMayDien(val) {    
                                                  var consumerKey = 'ck_09275593145b2c019ce56220a0d56c3538fee867';
                                                  var consumerSecret = 'cs_7ffb4ed80e0ed21ca1c7aa0434a2623050b5cc11';
                                                  var url = window.location.origin + "/wp-json/wc/v3/products/categories?parent=" + val
                                                          + '&consumer_key=' + consumerKey
                                                          + '&consumer_secret=' + consumerSecret;
                                                  var xhr = new XMLHttpRequest();
                                                  xhr.open("GET", url, true);
                                                  xhr.setRequestHeader('Content-type','charset=utf-8');
                                                  xhr.setRequestHeader("Access-Control-Allow-Headers", "Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With");
                                                  xhr.setRequestHeader("Access-Control-Allow-Methods", "GET");
                                                  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
                                                  xhr.onload = function () {                                               
                                                      if (xhr.readyState == 4 && xhr.status == "200") {                
                                                          var response = JSON.parse(xhr.responseText);
                                                          var i = 0;
                                                          var innerHTML = '<option value="" disabled selected hidden>Chọn dòng xe</option>';
                                                          for (i = 0; i < response.length; i++) {
                                                              innerHTML += '<option value="' + response[i].id + '">' + response[i].name + '</option>';   
                                                          }
                                                          document.getElementById("dong-xe-may-dien").innerHTML = innerHTML; 
                                                      }
                                                  }
                                                  xhr.send();
                                              }
                                            </script>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-widget elementor-widget-html">
                                          <div class="elementor-widget-container">
                                              <select class="wpcf7-form-control wpcf7-select full-width" id="dong-xe-may-dien" name="dong-xe" onchange="this.form.submit();">
                                                <?php
                                                  $hangXeSelected = get_query_var( 'hang-xe', '');
                                                  $dongXeSelected = get_query_var( 'dong-xe', '');
                                                  if($dongXeSelected != '' && $hangXeSelected != ''){
                                                    echo '<option value="">Chọn dòng xe</option>';
                                                    $args_query = array(
                                                      'taxonomy' => 'product_cat', 
                                                      'hide_empty' => false,                                                 
                                                      'child_of' => $hangXeSelected,
                                                      'orderby' => 'order',
                                                      'parent' => $hangXeSelected                                    
                                                    );
                                                    $categoriesChildrent = get_terms($args_query);
                                                    foreach ( $categoriesChildrent as $key => $term ){ 
                                                      if($dongXeSelected == $term->term_id){
                                                        echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                      }
                                                      else{
                                                        echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                      }
                                                    }
                                                  }
                                                  else{
                                                    echo '<option value="" disabled="" selected="">Chọn dòng xe</option>';
                                                  }
                                                  
                                                ?>                                              
                                              </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                            <section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section element-product-filter-by-dung-tich">
                              <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                  <div class="elementor-element elementor-column elementor-col-100 elementor-top-column">
                                    <div class="elementor-column-wrap elementor-element-populated">
                                      <div class="elementor-widget-wrap">
                                        <section class="elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section">
                                          <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                              <div class="elementor-element elementor-column elementor-col-50 elementor-inner-column">
                                                <div class="elementor-column-wrap  elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-widget elementor-widget-heading">
                                                      <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default"><span
                                                            class="ez-toc-section"></span>Tìm ắc quy
                                                          theo dung tích bình<span class="ez-toc-section-end"></span>
                                                        </h2>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="elementor-element elementor-column elementor-col-50 elementor-inner-column">
                                                <div class="elementor-column-wrap elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-widget elementor-widget-html">
                                                      <div class="elementor-widget-container">
                                                          <select class="wpcf7-form-control wpcf7-select full-width" name="dung-luong" onchange="this.form.submit();">
                                                            <option value="" selected="">Chọn dung lượng bình</option>
                                                            <?php 
                                                              $attribute_terms = get_terms(array(
                                                                'taxonomy' => 'pa_dung-luong-dien-xe-dien',
                                                                'hide_empty' => false,
                                                              ));
                                                              
                                                              $dungLuongSelected = get_query_var( 'dung-luong', '');
                                                              foreach ( $attribute_terms as $key => $term ){
                                                                if($dungLuongSelected == $term->term_id){
                                                                  echo '<option value="'.  $term->term_id .'" selected>'.$term->name.'</option>';
                                                                } 
                                                                else{                                                 
                                                                  echo '<option value="'.  $term->term_id .'">'.$term->name.'</option>';
                                                                }
                                                              }
                                                            ?>
                                                          </select>
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
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>              
              <?php else: ?>
                <?php do_action('woocommerce_archive_description'); ?>
              <?php endif; ?>
              
              <div class="shop-loop-container">
                <div class="gvawooaf-before-products layout-<?php echo esc_attr($woo_display) ?>">
                  
                  <?php do_action('vizeon_woocommerce_active_filter');  ?>

                  <?php if(is_product_category('xe-may')):?>
                    <?php 
                        $terms = get_terms("pa_phan-khuc");
                        foreach ( $terms as $key => $term ) {
                          $shortcode = '[products category="xe-may" attribute="phan-khuc" terms="'. $term->slug .'"]';
                          $output = do_shortcode($shortcode);
                          if($output != '<div class="woocommerce columns-3 "></div>') {
                            if($key > 0){
                              echo '<hr class="break-line">';
                            }
                            echo '<p class="elementor-heading-title elementor-size-default text-center">Ắc quy Lithium xe máy ' . $term->name . '</p>';
                            echo $output;
                          }
                      }  
                    ?>
                  <?php elseif(is_product_category('ac-quy-pkl')):?>
                    <?php 
                        $hangXeSelected = get_query_var('hang-xe', '');
                        $dongXeSelected = get_query_var('dong-xe', '');
                        $dungLuongSelected = get_query_var('dung-luong', '');
                        $category = 'ac-quy-pkl';
                        if($hangXeSelected != ''){
                          $termsHangXe = get_term_by('term_id', $hangXeSelected, 'product_cat');
                          if($termsHangXe && $termsHangXe->slug){
                            $category = $termsHangXe->slug;
                          }
                        }
                        if($dongXeSelected != ''){
                          $termsDongXe = get_term_by('term_id', $dongXeSelected, 'product_cat');
                          if($termsDongXe && $termsDongXe->slug){
                            $category = $termsDongXe->slug;
                          }
                        }
                        $terms = get_terms("pa_phan-khuc");
                        foreach ( $terms as $key => $term ) {
                          $shortcode = '[products category="'. $category .'" attribute="phan-khuc" terms="'. $term->slug .'"]';
                          $output = do_shortcode($shortcode);
                          if($output != '<div class="woocommerce columns-3 "></div>') {
                            if($key > 0){
                              echo '<hr class="break-line">';
                            }
                            echo '<p class="elementor-heading-title elementor-size-default text-center">Ắc quy Lithium xe mô tô ' . $term->name . '</p>';
                            echo $output;
                          }
                        }  
                    ?>
                  <?php elseif(is_product_category('o-to')):?>
                    <?php 
                        $hangXeSelected = get_query_var('hang-xe', '');
                        $dongXeSelected = get_query_var('dong-xe', '');
                        $dungLuongSelected = get_query_var('dung-luong', '');
                        $category = 'o-to';
                        if($hangXeSelected != ''){
                          $termsHangXe = get_term_by('term_id', $hangXeSelected, 'product_cat');
                          if($termsHangXe && $termsHangXe->slug){
                            $category = $termsHangXe->slug;
                          }
                        }
                        if($dongXeSelected != ''){
                          $termsDongXe = get_term_by('term_id', $dongXeSelected, 'product_cat');
                          if($termsDongXe && $termsDongXe->slug){
                            $category = $termsDongXe->slug;
                          }
                        }
                        $terms = get_terms("pa_phan-khuc");
                        foreach ( $terms as $key => $term ) {
                          $shortcode = '[products category="'. $category .'" attribute="phan-khuc" terms="'. $term->slug .'"]';
                          $output = do_shortcode($shortcode);
                          if($output != '<div class="woocommerce columns-3 "></div>') {
                            if($key > 0){
                              echo '<hr class="break-line">';
                            }
                            echo '<p class="elementor-heading-title elementor-size-default text-center">Ắc quy Lithium xe ô tô ' . $term->name . '</p>';
                            echo $output;
                          }
                      }  
                    ?>
                  <?php elseif(is_product_category('xe-may-dien')):?>
                    <?php
                        $hangXeSelected = get_query_var('hang-xe', '');
                        $dongXeSelected = get_query_var('dong-xe', '');
                        $dungLuongSelected = get_query_var('dung-luong', '');
                        $category = 'xe-may-dien';
                        if($hangXeSelected != ''){
                          $termsHangXe = get_term_by('term_id', $hangXeSelected, 'product_cat');
                          if($termsHangXe && $termsHangXe->slug){
                            $category = $termsHangXe->slug;
                          }
                        }
                        if($dongXeSelected != ''){
                          $termsDongXe = get_term_by('term_id', $dongXeSelected, 'product_cat');
                          if($termsDongXe && $termsDongXe->slug){
                            $category = $termsDongXe->slug;
                          }
                        } 
                        $terms = get_terms("pa_phan-khuc");
                        foreach ( $terms as $key => $term ) {
                          $shortcode = '[products category="'. $category .'" attribute="phan-khuc" terms="'. $term->slug .'"]' ;
                          $output = do_shortcode($shortcode);
                          if($output != '<div class="woocommerce columns-3 "></div>') {
                            if($key > 0){
                              echo '<hr class="break-line">';
                            }
                            echo '<p class="elementor-heading-title elementor-size-default text-center">Ắc quy Lithium xe máy điện ' . $term->name . '</p>';
                            echo $output;
                          }
                      }  
                    ?>
                  <?php else:?>
                    <?php woocommerce_product_loop_start(); ?>

                    <?php while (have_posts()) : the_post(); ?>

                      <?php wc_get_template_part('content', 'product'); ?>

                    <?php endwhile; // end of the loop. 
                    ?>

                    <?php woocommerce_product_loop_end(); ?>
                  <?php endif;?>                  

                  <?php
                  /**
                   * woocommerce_after_shop_loop hook
                   *
                   * @hooked woocommerce_pagination - 10
                   */
                  do_action('woocommerce_after_shop_loop');
                  ?>
                </div>
              </div>
            <?php endif; ?>            
            
          <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

            <?php wc_get_template('loop/no-products-found.php'); ?>

          <?php endif; ?>

        </div>
      </div>

      <!-- Left sidebar -->
      <?php if ($left_sidebar_config['active']) : ?>
        <div class="sidebar wp-sidebar sidebar-left <?php echo esc_attr($left_sidebar_config['class']); ?>">
          <?php do_action('vizeon_before_sidebar'); ?>
          <div class="sidebar-inner">
            <?php dynamic_sidebar($left_sidebar_config['name']); ?>
          </div>
          <?php do_action('vizeon_after_sidebar'); ?>
        </div>
      <?php endif ?>

      <!-- Right Sidebar -->
      <?php if ($right_sidebar_config['active']) : ?>
        <div class="sidebar wp-sidebar sidebar-right <?php echo esc_attr($right_sidebar_config['class']); ?>">
          <?php do_action('vizeon_before_sidebar'); ?>
          <div class="sidebar-inner">
            <?php dynamic_sidebar($right_sidebar_config['name']); ?>
          </div>
          <?php do_action('vizeon_after_sidebar'); ?>
        </div>
      <?php endif ?>
    </div>
  </div>

  <?php
  /**
   * woocommerce_after_main_content hook
   *
   * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
   */
  do_action('woocommerce_after_main_content');
  ?>
</section>

<?php get_footer(); ?>