//ajax for search  Archieve Page
add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');
function filter_projects(){
    
    $per_post = 10;
    if(isset($_POST['page']))
        $paged=$_POST['page'];
    
    $order= "desc";
    if (isset($_POST['search'])) {
		$args = array("post_type" => "newsfeed", "s" => $_POST['search'],'posts_per_page' => $per_post,'paged' => $paged);
	} else if (isset($_POST['category'])) {
		$args = array("post_type" => "newsfeed", "category_name" => $_POST['category'],'posts_per_page' => $per_post,'paged' => $paged);
	} else if ($_POST['sort']) {
		//sort post by date
		$args = array("post_type" => "newsfeed", "orderby" => "date", "order" => $_POST['sort'],'posts_per_page' => $per_post,'paged' => $paged);
		$order = $_POST['sort'];
		//latest added
	} else {
		$args = array("post_type" => "newsfeed", "orderby" => "date", "order" => "DESC",'posts_per_page' => $per_post,'paged' => $paged);
	}
	
	
	
	
	$loop = new WP_Query($args);
	
	?>
    <!--Search by title-->

<?php
$bdObj =  new Newsfeed_Database();
while ($loop->have_posts()) {
    $loop->the_post();
    $post_id = get_the_ID();
        $status=get_post_status($post_id);
        
        if($status=='publish'){
?>
    <div class="entry-content">
        <!--get feature image-->
        <?php //get post id and save to array
        
        ?>
        <?php
        if (has_post_thumbnail()) {
        ?>
        
        <div class='main-div' style="display: flex;
    flex-wrap: wrap;
    flex-direction: row;">
             <div class='div-2' style="">
             <!---Carasuel Slider---->
        
        <?php
    $image_gallery = get_post_meta($post_id, 'image_gallery', true);
    $attachments = array_filter(explode(',', $image_gallery));
    //upload image to gallery
    //javascript for image gallery slider
    ?>
    <?php if(count($attachments)>0): ?>
    <div style="
    transform: rotate(270deg);
margin-top:60px">
    <div class="slider" >
    <!--Grallery Slider start -->
    <div class="owl-carousel owl-theme">
        <?php foreach ($attachments as $key => $attachment_id) { ?>
            <div class="item">
                <img src="<?php echo wp_get_attachment_image_url($attachment_id, 'thumbnail'); ?>" onclick="getImg(this)" style="transform:rotate(90deg)">
            </div>
        <?php } ?>
    </div>
    </div>
    </div>
    <?php endif; ?>
        
         <!---end Carasuel Slider---->

        <?php } else {
            //avatar if no image
            echo get_avatar(get_the_author_meta('ID'), 50);
        ?>
        <?php } ?>
                    </div>
        <div class="div-10"> 
            <div class="thumbnail" > <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" width="50px" height="50px">
            </div>
            </div>
            
           
        </div>
		<div class="wmnf_content_archive">
		    
    <!--Grallery Slider end -->
   
    <br>
			 <div class="wmnf-single-title">
				<!--paralink for post-->
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			
			<!---carousel slider for images grallery-->

    
			
			
			<?php 
			//getting lat and lng regarding post_id
			$obj=$bdObj->get_data_by_post_id($post_id);?>
			<div class="wmnf-single-content" lat="<?php echo $obj[0]->latitude; ?>"  lng="<?php echo $obj[0]->longitude; ?>">
				<p class="content"><?php the_content(); ?></p>
			</div>
			<div class="author">
			    <div class='author-info'><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
			    			    <p><?php echo get_the_author_meta('display_name'); ?></p> 

			    </div> 
			   <p class="location"></p>
			</div>
			<div class="location-div">
			    <div class="location-info">
			           
			    </div>
			</div>
		</div>
    </div>
<?php
   
        }  
}
if($loop->have_posts()){
    //post_pagination();
?>
<nav class="pagination">
     <?php
     $big = 999999999;
     echo paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, $paged ),
          'total' => $loop->max_num_pages,
          'prev_text' => '&laquo;',
          'next_text' => '&raquo;'
     ) );
?>
</nav>
<?php wp_reset_postdata();

}
else
 echo "<div style='padding:15px;'>No record found!</div>";
?>


<div class="row">
    <div class="col-md-12">
    </div>
  </div>
</div><!-- .properties-wrapper -->
<?php
echo "<script> map_function()</script>";
}