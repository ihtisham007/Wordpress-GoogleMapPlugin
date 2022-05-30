<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       hashson786
 * @since      1.0.0
 *
 * @package    Newsfeed
 * @subpackage Newsfeed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Newsfeed
 * @subpackage Newsfeed/admin
 * @author     hashsons <hashsons786@gmail.com>
 */
class Newsfeed_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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
		wp_register_style('leaflet_css', plugins_url('css/leaflet.css', __FILE__), array(), NEWSFEED_VERSION, 'all');

		//wp_register_style('leaflet_search_css', plugins_url('css/leaflet-search.css', __FILE__), array(), NEWSFEED_VERSION, 'all');
		//wp_enqueue_style('leaflet_search_css_admin_style2', 'https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/newsfeed-admin.css', array(), $this->version, 'all');


		wp_enqueue_style('search-css', 'https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css', array(), $this->version, 'all');

		wp_enqueue_style('leaflet_css');
		//wp_enqueue_style('leaflet_search_css');
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_register_script('leaflet', plugins_url('js/leaflet/leaflet.js', __FILE__), array(), NEWSFEED_VERSION);
		wp_register_script('leaflet_search', plugins_url('js/leaflet/leaflet-search.js', __FILE__), array('leaflet'), NEWSFEED_VERSION);



		wp_enqueue_script('leaflet');

		wp_enqueue_script("search_leaflet", 'https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js');
		wp_enqueue_script("leat-decode", 'https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js');

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/newsfeed-admin.js', array('jquery'), $this->version, false);

		//wp_enqueue_script('leaflet_search');
	}
}
