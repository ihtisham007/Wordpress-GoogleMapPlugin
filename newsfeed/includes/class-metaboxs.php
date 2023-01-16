<?php

/**
 * Metaboxes for the admin area.
 * Location meta box for leftlet map and searching google location.
 * Image Gallery meta box for the post.
 * Save_post action for saving the data to the database.
 * 
 */

add_action('add_meta_boxes', 'wporg_add_locatin_metabox');
function wporg_add_locatin_metabox()
{

    add_meta_box('wporg_box_id', 'Add location', 'wporg_location_meta', 'newsfeed', 'normal', 'high');
}

add_action('add_meta_boxes', 'wporg_image_gallery_metabox');
function wporg_image_gallery_metabox()
{
    add_meta_box('wporg_box_id2', 'Add gallery image', 'newsfeed_image_gallery', 'newsfeed', 'normal', 'high');
}


function wporg_location_meta($post)
{


    global $wpdb;
    $table_name = $wpdb->prefix . 'newsfeed';
    //get langitude and longitude from table map_meta_data
    $latlng = $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $post->ID");
    
    if ($latlng) {
        $lat = $latlng->latitude;
        $lng = $latlng->longitude;
    } else {
        $lat = '38.363735';
        $lng = '-98.964844';
    }
    // Add an nonce field so we can check for it later.
    //add google map
    echo '<div id="locationid" style="width: 100%; height: 400px;"></div>';
?>

    <div class="lat_long" style="margin: 10px 40px;">
        <!--Create div for lat and long-->
        <div class="lat">
            <label for="lat">Latitude</label>
            <input type="text" id="lat" name="latitude" value="<?php echo $lat; ?>" size="25" />
            <label for="long">Longitude</label>
            <input type="text" id="long" name="longitude" value="<?php echo $lng; ?>" size="25" />
        </div>
    <?php

}


function newsfeed_image_gallery($post)
{?>
        <p>Images</p>
    <?php
    //gallery image upload
    $image_gallery = get_post_meta($post->ID, 'image_gallery', true);
    $attachments = array_filter(explode(',', $image_gallery));
    //upload image to gallery
    echo '<div class="gallery_image">';
    echo "<div id='img'></div>";
    echo '<input type="hidden" name="image_gallery" id="image_gallery" value="' . $image_gallery . '">';
    if (count($attachments) > 0) {
        echo '<ul class="ulappend">';
        foreach ($attachments as $key => $attachment_id) {
            echo '<li class="image" data-attachment_id="' . $attachment_id . '">';
            echo '<img src="' . wp_get_attachment_image_url($attachment_id, 'thumbnail') . '" />';
            echo '<ul class="actions">';
            echo '<li><a href="#" class="delete" title="Delete image" data-value="' . ($key + 1) . '">Delete</a></li>';
            echo '</ul>';
            echo '</li>';
        }
        echo '</ul>';
    }
    echo '<div class="add_gallery">';
    echo '<a href="#" class="add_gallery_images" data-uploader_title="Add gallery images" data-uploader_button_text="Add gallery images">Add gallery images</a>';
    echo '</div>';
    echo '</div>';

    //add script for upload image




}

add_action('save_post', 'wporg_save_postdata_image_gallery');
function wporg_save_postdata_image_gallery($post_id)
{

    //get gallery image
    $image_gallery = $_POST['image_gallery'];
    update_post_meta($post_id, 'image_gallery', $image_gallery);


    //database obj 
    $bd_obj = new Newsfeed_Database;

    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        //check if the post is already in the database
        $check = $bd_obj->get_data_by_post_id($post_id);
        if ($check) {
            //update the post
            $bd_obj->update_data($post_id, $latitude, $longitude, '0');
        } else {
            //insert the post
            $bd_obj->insert_data($post_id, $latitude, $longitude, '0');
        }
    }
}


add_action('admin_print_footer_scripts', 'check_textarea_length');

    function check_textarea_length()
    {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var editor_char_limit = 150;

                $('.mceStatusbar').append('<span class="word-count-message">Reduce word count!</span>');

                tinyMCE.activeEditor.onKeyUp.add(function() {
                    
                    // Strip HTML tags, WordPress shortcodes and white space
                    editor_content = this.getContent().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig, '');
                    $('.word-count').text(editor_content.split(' ').length);
                    if (editor_content.split(' ').length > editor_char_limit) {

                        $("#post-status-info tbody tr").addClass('colorred');
                        //button disabled
                        $('#publish').attr('disabled', 'disabled');

                    } else {
                        $("#post-status-info tbody tr").removeClass('colorred');
                        $('#publish').removeAttr('disabled');
                    }
                });
            });
        </script>

        <style type="text/css">
            .colorred {
                background: red;
                color: white;
            }
        </style>
    <?php
    }

