<?php 
/**
 * Plugin Name: Vizeon Themer
 * Description: Open Setting, Post Type, Shortcode ... for theme 
 * Version: 1.0.0
 * Author: Gaviasthemes Team
 */

define( 'GAVIAS_VIZEON_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GAVIAS_VIZEON_PLUGIN_DIR', plugin_dir_path( __FILE__ )  );

class Gavias_Vizeon_Themer{

	function __construct(){
		$this->include_files();
		$this->include_post_types();
      add_action('wp_head', array($this, 'gaviasthemer_ajax_url'));
      add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
      load_plugin_textdomain('vizeon-themer', false, 'vizeon-themer/languages/');
	}
   
   function gaviasthemer_ajax_url(){
     echo '<script> var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
   }
 
	function include_files(){
      require_once('redux/admin-init.php');
      require_once('includes/functions.php');
		require_once('includes/hook.php');
      require_once('elementor/init.php');   
	}

	function include_post_types(){
      require_once('posttypes/footer.php');
      require_once('posttypes/header.php');				
		require_once('posttypes/portfolio.php');            
	}

   function register_scripts(){
      $js_dir = plugin_dir_url( __FILE__ ).'assets/js';
      wp_register_script('gavias-themer', $js_dir.'/main.js', array('jquery'), null, true);
      wp_enqueue_script('gavias-themer');
   }
}

new Gavias_Vizeon_Themer();
