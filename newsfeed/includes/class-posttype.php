<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'add_post_type');


//add the post type newsfeed
function add_post_type()
{
    register_post_type('newsfeed', array(
        'labels' => array(
            'name' => __('Newsfeed'),
            'singular_name' => __('Newsfeed'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Newsfeed'),
            'edit_item' => __('Edit Newsfeed'),
            'new_item' => __('New Newsfeed'),
            'view_item' => __('View Newsfeed'),
            'search_items' => __('Search Newsfeed'),
            'not_found' => __('No Newsfeed found'),
            'not_found_in_trash' => __('No Newsfeed found in Trash'),
            'parent_item_colon' => __('Parent Newsfeed:')
        ),
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'comments'
        ),
        //texonomies to be added
        'taxonomies' => array(
            'category',
            'post_tag'
        ),
        'menu_position' => 5,
        'exclude_from_search' => false
    ));
}
