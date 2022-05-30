<?php get_header(); ?>

<?php echo apply_filters("the_content", "[short_code_single]"); ?>

<?php $post_id = get_the_ID(); 
$obj =  new Newsfeed_Database();
$data = $obj->get_data_by_post_id($post_id);

?>

<div class="box offset-bottom-right-shadow">
    <!--post title -->
    <h1 class="post-title"><?php the_title(); ?></h1>
    <!--post content -->
    <div class="post-content" lat="<?php echo $data[0]->latitude; ?>" lng="<?php echo $data[0]->longitude; ?>"><?php the_content(); ?></div>

    <!---carousel slider for images grallery-->

    
    <!--Grallery Slider end -->
    <br>

    <!---comments box-->
    <div class="wmnf-single-comment">
        <?php //echo comments_template();

        //get comments one by one
        $comments = get_comments(array('post_id' => $post->ID));
        foreach ($comments as $comment) {
            //get comment status 
            $comment_status = $comment->comment_approved;
            //print status
            if ($comment_status == 1) {
                echo '<div class="wmnf-single-comment-content">';
                echo '<div class="wmnf-single-comment-author">';
                echo '<div class="wmnf-single-comment-author-image">';
                echo get_avatar($comment->comment_author_email, '50');
                echo '</div>';
                echo '<div class="wmnf-single-comment-author-name">';
                echo '<p>' . $comment->comment_author . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="wmnf-single-comment-content">';
                echo '<p>' . $comment->comment_content . '</p>';
                echo '</div>';
                echo '</div>';
            }

            //add public comment 

        }
        ?>
    </div>

    <!---comments box end-->
    <?php
    
    if (comments_open()) {
         Comment_Allow();
    }
    
    function Comment_Allow(){
    echo '<div class="wmnf-single-comment-form">';
    echo '<h3>Add Comment</h3>';
    echo '<form action="' . get_permalink() . '" method="post">';
    echo '<div class="wmnf-single-comment-form-name">';
    
    echo '<input placeholder="Full Name" type="text" name="name" id="name" required>';
    echo '</div>';
    echo '<div class="wmnf-single-comment-form-email">';
   
    echo '<input placeholder="Email" type="email" name="email" id="email" required>';
    echo '</div>';
    echo '<div class="wmnf-single-comment-form-content">';
    
    echo '<textarea placeholder="Comments" name="content" id="content" required></textarea>';
    echo '</div>';
    echo '<div class="wmnf-single-comment-form-submit">';
    echo '<input type="submit" value="Submit">';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    }

    //save post comment
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['content'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $content = $_POST['content'];
        $comment_data = array(
            'comment_post_ID' => $post->ID,
            'comment_author' => $name,
            'comment_author_email' => $email,
            'comment_content' => $content,
            'comment_approved' => 1,
            'comment_parent' => 0,
        );
        wp_insert_comment($comment_data);
    }

    ?>
</div>

<?php get_footer(); ?>