<?php

// Path: includes\class-newsfeed-database.php
// Class Newsfeed_Database
// {
class Newsfeed_Database
{


    //constructor
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $this->wpdb->prefix . 'newsfeed';
    }

    //create a table for the newsfeed plugin
    public function create_table()
    {
        $charset_collate = $this->wpdb->get_charset_collate();
        $sql = "CREATE TABLE $this->table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            post_id mediumint(9) NOT NULL,
            latitude float(9,6) NOT NULL,
            longitude float(9,6) NOT NULL,
            zoom int(2) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    //insert data into the table
    public function insert_data($post_id, $latitude, $longitude, $zoom)
    {
        $this->wpdb->insert(
            $this->table_name,
            array(
                'post_id' => $post_id,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'zoom' => $zoom
            ),
            array(
                '%d',
                '%f',
                '%f',
                '%d'
            )
        );
    }
    //update data into the table
    public function update_data($post_id, $latitude, $longitude, $zoom)
    {
        $this->wpdb->update(
            $this->table_name,
            array(
                'post_id' => $post_id,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'zoom' => $zoom
            ),
            array(
                'post_id' => $post_id
            ),
            array(
                '%d',
                '%f',
                '%f',
                '%d'
            ),
            array(
                '%d'
            )
        );
    }

    //get data from the table
    public function get_data()
    {
        $data = $this->wpdb->get_results("SELECT * FROM $this->table_name");
        return $data;
    }
    //get data from the table by post id
    public function get_data_by_post_id($post_id)
    {
        $data = $this->wpdb->get_results("SELECT * FROM $this->table_name WHERE post_id = $post_id");
        return $data;
    }
    //select where in post_id
    public function getDatafromwherein($array)
    {
        $data = $this->wpdb->get_results("SELECT * FROM $this->table_name WHERE post_id in (" . $array . ")");
        // $data = $this->wpdb->get_results("SELECT * FROM $this->table_name WHERE FIND_IN_SET(post_id, ".$array.")");
        return $data;
    }
}
