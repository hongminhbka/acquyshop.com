<?php
/**
 * $Desc
 *
 * @version    1.0
 * @package    basetheme
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2019 Gaviasthemess. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */

define( 'VIZEON_THEMER_DIR', get_template_directory() );
define( 'VIZEON_THEME_URL', get_template_directory_uri() );

/*
 * Include list of files from Gavias Framework.
 */
require_once(VIZEON_THEMER_DIR . '/includes/theme-functions.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/template.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/theme-hook.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/theme-layout.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/metaboxes.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/custom-styles.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/menu/megamenu.php'); 
require_once(VIZEON_THEMER_DIR . '/includes/sample/init.php');

//Load Woocommerce
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
  add_theme_support( "woocommerce" );
  require_once(VIZEON_THEMER_DIR . '/includes/woocommerce/functions.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/woocommerce/hooks.php'); 
}

// Load Redux - Theme options framework
if( class_exists( 'Redux' ) ){
  require( VIZEON_THEMER_DIR . '/includes/options/init.php' );
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-general.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-header.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-breadcrumb.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-footer.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-styling.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-typography.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-blog.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-page.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-woo.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-portfolio.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-service.php'); 
  require_once(VIZEON_THEMER_DIR . '/includes/options/opts-socials.php'); 
} 
// TGM plugin activation
if ( is_admin() ) {
  require_once( VIZEON_THEMER_DIR . '/includes/tgmpa/class-tgm-plugin-activation.php' );
  require( VIZEON_THEMER_DIR . '/includes/tgmpa/config.php' );
}
load_theme_textdomain( 'vizeon', get_template_directory() . '/languages' );

//-------- Register sidebar default in theme -----------
//------------------------------------------------------
function vizeon_widgets_init() {
    
    register_sidebar( array(
        'name' => esc_html__( 'Default Sidebar', 'vizeon' ),
        'id' => 'default_sidebar',
        'description' => esc_html__( 'Appears in the Default Sidebar section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Plugin| WooCommerce Sidebar', 'vizeon' ),
        'id' => 'woocommerce_sidebar',
        'description' => esc_html__( 'Appears in the Plugin WooCommerce section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Plugin| WooCommerce Single', 'vizeon' ),
        'id' => 'woocommerce_single_summary',
        'description' => esc_html__( 'Appears in the WooCommerce Single Page like social, description text ...', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Catalogue Sidebar', 'vizeon' ),
        'id' => 'portfolio_sidebar',
        'description' => esc_html__( 'Appears in the Catalogue Page section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'After Offcanvas Mobile', 'vizeon' ),
        'id' => 'offcanvas_sidebar_mobile',
        'description' => esc_html__( 'Appears in the Offcanvas section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Service Sidebar', 'vizeon' ),
        'id' => 'service_sidebar',
        'description' => esc_html__( 'Appears in the Sidebar section of the Service Page.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Blog Sidebar', 'vizeon' ),
        'id' => 'blog_sidebar',
        'description' => esc_html__( 'Appears in the Blog sidebar section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Page Sidebar', 'vizeon' ),
        'id' => 'other_sidebar',
        'description' => esc_html__( 'Appears in the Page Sidebar section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer first', 'vizeon' ),
        'id' => 'footer-sidebar-1',
        'description' => esc_html__( 'Appears in the Footer first section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer second', 'vizeon' ),
        'id' => 'footer-sidebar-2',
        'description' => esc_html__( 'Appears in the Footer second section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer third', 'vizeon' ),
        'id' => 'footer-sidebar-3',
        'description' => esc_html__( 'Appears in the Footer third section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer four', 'vizeon' ),
        'id' => 'footer-sidebar-4',
        'description' => esc_html__( 'Appears in the Footer four section of the site.', 'vizeon' ),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'vizeon_widgets_init' );


if ( ! function_exists( 'vizeon_fonts_url' ) ) :
/**
 *
 * @return string Google fonts URL for the theme.
 */
function vizeon_fonts_url() {
  $fonts_url = '';
  $fonts     = array();
  $subsets   = '';
  $protocol = is_ssl() ? 'https' : 'http';
  /*
   * Translators: If there are characters in your language that are not supported
   * by Noto Sans, translate this to 'off'. Do not translate into your own language.
   */
  if ( 'off' !== _x( 'on', 'Covered By Your Grace font: on or off', 'vizeon' ) ) {
    $fonts[] = 'Covered+By+Your+Grace';
  }

   if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'vizeon' ) ) {
    $fonts[] = 'Poppins:400,500,600,700';
  }
  
  /*
   * Translators: To add an additional character subset specific to your language,
   * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
   */
  $subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'vizeon' );

  if ( 'cyrillic' == $subset ) {
    $subsets .= ',cyrillic,cyrillic-ext';
  } elseif ( 'greek' == $subset ) {
    $subsets .= ',greek,greek-ext';
  } elseif ( 'devanagari' == $subset ) {
    $subsets .= ',devanagari';
  } elseif ( 'vietnamese' == $subset ) {
    $subsets .= ',vietnamese';
  }

  if ( $fonts ) {
    $fonts_url = add_query_arg( array(
      'family' => ( implode( '%7C', $fonts ) ),
      'subset' => ( $subsets ),
    ),  $protocol.'://fonts.googleapis.com/css' );
  }

  return $fonts_url;
}
endif;

function vizeon_custom_styles() {
  $custom_css = get_option( 'vizeon_theme_custom_styles' );
  if($custom_css){
    wp_enqueue_style(
      'vizeon-custom-style',
      get_template_directory_uri() . '/css/custom_script.css'
    );
    wp_add_inline_style( 'vizeon-custom-style', $custom_css );
  }
}

function vizeon_init_scripts(){
  global $post;
  $protocol = is_ssl() ? 'https' : 'http';
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
    wp_enqueue_script( 'comment-reply' );
  }

  wp_enqueue_style( 'vizeon-fonts', vizeon_fonts_url(), array(), null );
  wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.js', array('jquery') );
  wp_enqueue_script('scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js');
  wp_enqueue_script('magnific', get_template_directory_uri() .'/js/magnific/jquery.magnific-popup.min.js');
  wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'));
  wp_enqueue_script('lightgallery', get_template_directory_uri() . '/js/lightgallery/js/lightgallery.min.js' );
  wp_enqueue_script('sticky', get_template_directory_uri() . '/js/sticky.js', array('elementor-waypoints'));
  wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js');
  wp_enqueue_script('vizeon-main', get_template_directory_uri() . '/js/main.js', array('imagesloaded', 'jquery-masonry'));
  wp_enqueue_script('vizeon-woocommerce', get_template_directory_uri() . '/js/woocommerce.js');

  if(vizeon_woocommerce_activated() ){
    wp_dequeue_script('wc-add-to-cart');
    wp_register_script( 'wc-add-to-cart', VIZEON_THEME_URL . '/js/add-to-cart.js' , array( 'jquery' ) );
    wp_enqueue_script('wc-add-to-cart');
  }

  wp_enqueue_style('lightgallery', get_template_directory_uri() . '/js/lightgallery/css/lightgallery.min.css');
  wp_enqueue_style('lightgallery', get_template_directory_uri() . '/js/lightgallery/css/lg-transitions.min.css');
  wp_enqueue_style('owl-carousel', get_template_directory_uri() .'/js/owl-carousel/assets/owl.carousel.css');
  wp_enqueue_style('magnific', get_template_directory_uri() .'/js/magnific/magnific-popup.css');
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.css');
  wp_enqueue_style('vizeon-icons', get_template_directory_uri() . '/css/icon-custom.css');
  wp_enqueue_style('vizeon-style', get_template_directory_uri() . '/style.css');

  $skin = vizeon_get_option('skin_color', '');
  if(isset($_GET['gskin']) && $_GET['gskin']){
      $skin = $_GET['gskin'];
  }
  if(!empty($skin)){
      $skin = 'skins/' . $skin . '/'; 
  }
  wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/' . $skin . 'bootstrap.css', array(), '1.0.5' , 'all'); 
  wp_enqueue_style('vizeon-woocoomerce', get_template_directory_uri(). '/css/' . $skin . 'woocommerce.css', array(), '1.0.5' , 'all'); 
  wp_enqueue_style('vizeon-template', get_template_directory_uri().'/css/' . $skin . 'template.css', array(), '1.0.5' , 'all');
}
add_action('wp_enqueue_scripts', 'vizeon_init_scripts', 99);


add_action( 'woocommerce_no_products_found', 'show_products_per_category' );
 
function show_products_per_category() {
   $args = array(
      'parent' => 0,
      'hide_empty' => true,
      'taxonomy' => 'product_cat',
      'fields' => 'slugs',
      'order' => 'order'           
   );
   $categories = get_categories( $args );

   echo   '<section class="elementor-element elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section">
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
                        </div>
                      </section>
                      <section class="elementor-element elementor-element-bcad63e elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section product-filter">
                        <div class="elementor-container elementor-column-gap-default">
                          <div class="elementor-row">';
                            foreach ( $categories as $key => $category_slug ) {
                              $term_object = get_term_by( 'slug', $category_slug , 'product_cat' );
                              echo '<div class="elementor-element elementor-column elementor-col-25 elementor-inner-column">
                                      <div class="elementor-column-wrap elementor-element-populated">
                                        <div class="elementor-widget-wrap">
                                          <div class="elementor-element elementor-align-center elementor-widget elementor-widget-button">
                                            <div class="elementor-widget-container">
                                              <div class="elementor-button-wrapper">
                                                <a href="#'. $category_slug .'" class="elementor-button-link elementor-button elementor-size-md full-width" title="'.$term_object->description.'">
                                                  <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">'.$term_object->name.'</span>
                                                  </span>
                                                </a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';                              
                            }
                    echo '</div>';
                  echo '</div>';
                echo '</section>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
  echo '</section>';


   foreach ( $categories as $key => $category_slug ) {
      $term_object = get_term_by( 'slug', $category_slug , 'product_cat' );
      if($key > 0){
        echo '<hr class="break-line">';
      }
      echo '<h2 class="elementor-heading-title elementor-size-default" id="'. $category_slug .'">' . $term_object->name . '</h2>';
      echo do_shortcode( '[products limit="3" columns="3" category="' . $category_slug . '"]' );
      if($term_object->name != 'Sản phẩm khác'){
        echo '<p><a href="' . get_term_link( $category_slug, 'product_cat' ) . '">Xem các sản phẩm ' . $term_object->name . ' khác &rarr;</a>';
      }    
      else{
        echo '<p><a href="' . get_term_link( $category_slug, 'product_cat' ) . '">Xem các sản phẩm khác &rarr;</a>';
      }  
   }
}

/**
 *
 * Fix pagging post
 */
function custom_pre_get_posts( $query ) {
  if( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_category()) {
    $query->set( 'paged', str_replace( '/', '', get_query_var( 'paged' ) ) );  }  
  }

add_action('pre_get_posts','custom_pre_get_posts');

function help_custom_request($query_string ) {
       if( isset( $query_string['page'] ) ) {
           if( ''!=$query_string['page'] ) {
               if( isset( $query_string['name'] ) ) { unset( $query_string['name'] ); } } } return $query_string; 
}

add_filter('request', 'help_custom_request');

function wp_add_post_ids_to_columns($columns){
  $columns['wp_post_ids'] = 'ID';
  return $columns;
}

add_filter('manage_post_posts_columns','wp_add_post_ids_to_columns');
  
function wp_render_post_columns($column_name,$id){
  switch( $column_name ){
    case 'wp_post_ids':
      echo $id;
      break;
    }
}
  
add_action('manage_posts_custom_column','wp_render_post_columns', 10, 2);


if( !function_exists( 'plugin_prefix_unregister_post_type' ) ) {
	function plugin_prefix_unregister_post_type(){    	
      unregister_post_type( 'event' );
      unregister_post_type( 'service' );
      unregister_post_type( 'team' );
      unregister_post_type( 'gallery' );
	}
}
add_action('init','plugin_prefix_unregister_post_type');

// Add custom order
add_action('product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);
//Product Cat Create page
function wh_taxonomy_add_new_meta_field() {
    
    echo '<div class="form-field">
        <label for="order">Thứ tự</label>
        <input type="number" name="order" id="order" value="1" min="1">
        <p class="description">Nhập thứ tự sắp xếp</p>
    </div>';
}
//Product Cat Edit page
function wh_taxonomy_edit_meta_field($term) {
    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $order = get_term_meta($term_id, 'order', true);
    
    echo '<tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_title">Thứ tự</label></th>
        <td>
            <input type="number" name="order" id="order" value="' . esc_attr($order) . '">
            <p class="description">Nhập thứ tự sắp xếp</p>
        </td>
    </tr>';
}

add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta($term_id) {
    $order = filter_input(INPUT_POST, 'order');   
    update_term_meta($term_id, 'order', $order);    
}

add_filter( 'manage_edit-product_cat_columns', 'wh_customFieldsListTitle' ); //Register Function
add_action( 'manage_product_cat_custom_column', 'wh_customFieldsListDisplay' , 10, 3); //Populating the Columns
/**
 * Meta Title and Description column added to category admin screen.
 *
 * @param mixed $columns
 * @return array
 */
function wh_customFieldsListTitle( $columns ) {
    $columns['pro_meta_order'] = 'Sắp xếp';    
    return $columns;
}
/**
 * Meta Title and Description column value added to product category admin screen.
 *
 * @param string $columns
 * @param string $column
 * @param int $id term ID
 *
 * @return string
 */
function wh_customFieldsListDisplay( $columns, $column, $id ) {
    if ( 'pro_meta_order' == $column ) {
        $columns = esc_html( get_term_meta($id, 'order', true) );
    }    
    return $columns;
}

add_shortcode ('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
  $cart_count = WC()->cart->cart_contents_count;
  $cart_url = wc_get_cart_url();  
  ?>
    <div class="cart-button"><a class="cart-contents" href="<?php echo $cart_url; ?>" title="Xem giỏ hàng">GIỎ HÀNG&nbsp;
  <?php
  if ( $cart_count > 0 ) {
    ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
    <?php
  }
  ?>
  </a></div>
  <?php
  return ob_get_clean();
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents" href="<?php echo $cart_url; ?>" title="<?php _e( 'Xem giỏ hàng' ); ?>">GIỎ HÀNG&nbsp;
	  <?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}


add_action( 'init', 'wpm_product_cat_register_meta' );
/**
 * Register details product_cat meta.
 *
 * Register the details metabox for WooCommerce product categories.
 *
 */
function wpm_product_cat_register_meta() {
    register_meta( 'term', 'details', 'wpm_sanitize_details' );
}
/**
 * Sanitize the details custom meta field.
 *
 * @param  string $details The existing details field.
 * @return string          The sanitized details field
 */
function wpm_sanitize_details( $details ) {
    return wp_kses_post( $details );
}


add_action( 'product_cat_add_form_fields', 'wpm_product_cat_add_details_meta' );
/**
 * Add a details metabox to the Add New Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * creating new product categories in WooCommerce.
 *
 */
function wpm_product_cat_add_details_meta() {
    wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' );
    ?>
    <div class="form-field">
        <label for="wpm-product-cat-details">Content</label>
        <textarea name="wpm-product-cat-details" id="wpm-product-cat-details" rows="5" cols="40"></textarea>
        <p class="description">Thông tin chi tiết danh mục, hiện bên dưới danh sách sản phẩm</p>
    </div>
    <?php
}


add_action( 'product_cat_edit_form_fields', 'wpm_product_cat_edit_details_meta' );
/**
 * Add a details metabox to the Edit Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * editing an existing product category in WooCommerce.
 *
 * @param  object $term The existing term object.
 */
function wpm_product_cat_edit_details_meta( $term ) {
    $product_cat_details = get_term_meta( $term->term_id, 'details', true );
    if ( ! $product_cat_details ) {
        $product_cat_details = '';
    }
    $settings = array( 'textarea_name' => 'wpm-product-cat-details' );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="wpm-product-cat-details">Content</label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' ); ?>
            <?php wp_editor( wpm_sanitize_details( $product_cat_details ), 'product_cat_details', $settings ); ?>
            <p class="description">Thông tin chi tiết danh mục, hiện bên dưới danh sách sản phẩm</p>
        </td>
    </tr>
    <?php
}

add_action( 'create_product_cat', 'wpm_product_cat_details_meta_save' );
add_action( 'edit_product_cat', 'wpm_product_cat_details_meta_save' );
/**
 * Save Product Category details meta.
 *
 * Save the product_cat details meta POSTed from the
 * edit product_cat page or the add product_cat page.
 *
 * @param  int $term_id The term ID of the term to update.
 */
function wpm_product_cat_details_meta_save( $term_id ) {
    if ( ! isset( $_POST['wpm_product_cat_details_nonce'] ) || ! wp_verify_nonce( $_POST['wpm_product_cat_details_nonce'], basename( __FILE__ ) ) ) {
        return;
    }
    $old_details = get_term_meta( $term_id, 'details', true );
    $new_details = isset( $_POST['wpm-product-cat-details'] ) ? $_POST['wpm-product-cat-details'] : '';
    if ( $old_details && '' === $new_details ) {
        delete_term_meta( $term_id, 'details' );
    } else if ( $old_details !== $new_details ) {
        update_term_meta(
            $term_id,
            'details',
            wpm_sanitize_details( $new_details )
        );
    }
}

add_action( 'woocommerce_after_shop_loop', 'wpm_product_cat_display_details_meta' );
/**
 * Display details meta on Product Category archives.
 *
 */
function wpm_product_cat_display_details_meta() {
    if ( ! is_tax( 'product_cat' ) ) {
        return;
    }
    $t_id = get_queried_object()->term_id;
    $details = get_term_meta( $t_id, 'details', true );
    if ( '' !== $details ) {
        ?>
        <div class="product-cat-details">
            <?php echo apply_filters( 'the_content', wp_kses_post( $details ) ); ?>
        </div>
        <?php
    }
}

function themeslug_query_vars( $qvars ) {
	$qvars[] = 'hang-xe';
  $qvars[] = 'dong-xe';
  $qvars[] = 'dung-luong';
	return $qvars;
}
add_filter( 'query_vars', 'themeslug_query_vars' );
