<?php
//short code for archive page
add_shortcode('newsfeed-map', 'map_shortcode');
function map_shortcode()
{
        
     
    
    wp_enqueue_style('leaflet_css');
    wp_enqueue_script('leaflet_js');
    
    //esri_css
    wp_enqueue_style('esri_css');
        //'esri_js
    wp_enqueue_script('esri_js');
    //geocoder_esri
    wp_enqueue_script('geocoder_esri');

    wp_enqueue_style('archive_page');
    wp_enqueue_script('archive_page_js');
    
    wp_enqueue_style('carousel_css');
    wp_enqueue_style('carousel_css_2');

    wp_enqueue_script('carosuel_js');
    
    wp_enqueue_style('geocoder_css');
    wp_enqueue_script('geocoder_js');
    
    wp_enqueue_style('routing_css');
    wp_enqueue_script('routing_js');
    
     wp_enqueue_script('controller_js');

    //hjghj

?>
    <div style="position:relative;">
    <div id="mapid" style="width: 100%; height: 100vh;"></div>
    <div><br /></div>

    <div class="post-type-archive-newsfeed">
    <div class="search-filters">
 <div class="search-by-category">
                <select  id="category">
                    <option value="">Select Category</option>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="search-by-date">
                <!---Sort by select --->
                <select name="sort" id="sort">
                    <option value="">Sort</option>
                    <option value="ASC">Old </option>
                    <option value="DESC">NEw</option>
                </select>
            </div>
            <div class="shortst-location">
                <div class="location-gps">
                    <img src="https://map.hashsons.com/wp-content/uploads/2022/03/route.png" alt="loading..." width="50" />
                </div>
            </div>
            </div>
<div class="wmnf_container_archive wmnf_container_contents">
    <div class="wmnf_container_archive">
    <!--Search by title-->
    <div class="search-by-title">
        
            <input type="text" name="search" placeholder="Search">
            <span id="search" class="fa fa-search"></span> 
    </div>
            <div id="loader01" class="hidden">
            <div class="wrapper">
                <div class="image"></div>
  <div class="wrapper-cell">
   
    
    <div class="text">
      <div class="text-line"> </div>
      <div class="text-line-2"></div>
    </div>
    
  </div>
  
  <div class="image"></div>
  <div class="wrapper-cell">
   
    
    <div class="text">
      <div class="text-line"> </div>
      <div class="text-line-2"></div>
    </div>
    
  </div>
  
  <div class="image"></div>
  <div class="wrapper-cell">
   
    
    <div class="text">
      <div class="text-line"> </div>
      <div class="text-line-2"></div>
    </div>
    
  </div>
  
  <div class="image"></div>
  <div class="wrapper-cell">
   
    
    <div class="text">
      <div class="text-line"> </div>
      <div class="text-line-2"></div>
    </div>
    
  </div>
  

  
  
  
  </div>
  </div>
 

    <div class='post-result'>
    </div>
</div>
</div>
</div>
</div>
<?php

}


//shortcode for single page
add_shortcode('short_code_single', 'mnof_short');

function mnof_short()
{
    wp_enqueue_style('leaflet_css');
    wp_enqueue_script('leaflet_js');

    wp_enqueue_style('single_page');
    wp_enqueue_script('single_page_js');

    wp_enqueue_style('carousel_css');
    wp_enqueue_style('carousel_css_2');

    wp_enqueue_script('carosuel_js');
?>
    <div id="mapid" style="width: 100%; height: 400px;"></div>
    <div><br /></div>
<?php
}
