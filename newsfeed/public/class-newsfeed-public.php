<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       hashson786
 * @since      1.0.0
 *
 * @package    Newsfeed
 * @subpackage Newsfeed/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Newsfeed
 * @subpackage Newsfeed/public
 * @author     hashsons <hashsons786@gmail.com>
 */
class Newsfeed_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Newsfeed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Newsfeed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//crousel slider
		wp_register_style("carousel_css", plugin_dir_url(__FILE__) . 'css/owl.carousel.min.css', array(), $this->version, 'all');
		wp_register_style("carousel_css_2", plugin_dir_url(__FILE__) . 'css/owl.theme.default.min.css', array(), $this->version, 'all');
		
		
		wp_register_style("esri_css", plugin_dir_url(__FILE__) .'css/esri-leaflet-geocoder.css', array(), $this->version, 'all');

        wp_register_style('geocoder_css', plugins_url('css/Geocoder.css', __FILE__), array(), NEWSFEED_VERSION);

		wp_register_style('single_page', plugins_url('css/single_page.css', __FILE__), array(), NEWSFEED_VERSION);
		//css for archive_page
		wp_register_style('archive_page', plugins_url('css/archive_page.css', __FILE__), array(), NEWSFEED_VERSION);
		wp_register_style('leaflet_css', plugins_url('leaflet/leaflet.css', __FILE__), array(), NEWSFEED_VERSION);
		
		wp_register_style('routing_css', plugins_url('css/leaflet-routing-machine.css', __FILE__), array(), NEWSFEED_VERSION);

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/newsfeed-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Newsfeed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Newsfeed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script('carosuel_js', plugin_dir_url(__FILE__) . 'js/owl.carousel.min.js', array('jquery'), NEWSFEED_VERSION, false);

		wp_register_script('esri_js', plugin_dir_url(__FILE__) . "js/esri-leaflet.js", array('jquery'), NEWSFEED_VERSION, false);
		
		wp_register_script('geocoder_esri',plugin_dir_url(__FILE__) . "js/esri-leaflet-geocoder.js", array('jquery'), NEWSFEED_VERSION, false);
		
        wp_register_script('routing_js', plugin_dir_url(__FILE__) . 'js/leaflet-routing-machine.js', array('jquery'), NEWSFEED_VERSION, false);
        
        wp_register_script('controller_js', plugin_dir_url(__FILE__) . 'js/Control.Geocoder.js', array('jquery'), NEWSFEED_VERSION, false);

		wp_register_script('leaflet_js', plugin_dir_url(__FILE__) . 'leaflet/leaflet.js', array('jquery'), NEWSFEED_VERSION, false);
		wp_register_script('single_page_js', plugin_dir_url(__FILE__) . 'js/single_page.js', array('jquery'), NEWSFEED_VERSION, true);
		wp_register_script('archive_page_js', plugin_dir_url(__FILE__) . 'js/archive_page.js', array('jquery'), NEWSFEED_VERSION, false);
		
		wp_register_script('geocoder_js', plugin_dir_url(__FILE__) . 'js/Geocoder.js', array('jquery'), NEWSFEED_VERSION, false);
		
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/newsfeed-public.js', array('jquery'), $this->version, false);
	}
}
