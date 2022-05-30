<?php

/**
 * Fired during plugin activation
 *
 * @link       hashson786
 * @since      1.0.0
 *
 * @package    Newsfeed
 * @subpackage Newsfeed/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Newsfeed
 * @subpackage Newsfeed/includes
 * @author     hashsons <hashsons786@gmail.com>
 */
class Newsfeed_Activator
{

	/**
	 * Activation function for the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @static
	 * @uses     Newsfeed_Database::create_table()
	 * @uses     Newsfeed_Database::insert_data()
	 * @uses     Newsfeed_Database::get_data()
	 * @uses     Newsfeed_Database::get_data_by_post_id()
	 * @uses     Newsfeed_Database::get_charset_collate()
	 * @uses     Newsfeed_Database::get_wpdb()
	 * @uses     Newsfeed_Database::get_table_name()
	 * @uses     Newsfeed_Database::get_post_id()
	 *
	 * @return void
	 */
	public function __construct()
	{
		//require the class metabox and the class database
	}

	public static function activate()
	{
		require_once plugin_dir_path(__FILE__) . 'class-newsfeed-database.php';

		$newsfeed_database = new Newsfeed_Database();
		$newsfeed_database->create_table();
	}
}
