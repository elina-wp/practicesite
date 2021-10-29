<?php 
// Action
add_action('wp_ajax_blog_post', 'blog_post');
add_action('wp_ajax_nopriv_blog_post', 'blog_post');

function blog_post()
{    
    $posts_per_page = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => false,
        'paged' => $page,
        'posts_per_page' => $posts_per_page,
    
    );
    
    // The Query
    $the_query = new WP_Query($args);
    
    $args['posts_per_page'] = -1;
    $args['paged'] = 1;

    $posts = get_posts( $args );
    $total_posts = count( $posts );
    $total_pages = $total_posts ? ceil( $total_posts / $posts_per_page ) : 1;
    $has_next =  $page == $total_pages ? false : true;
    
    $response = '';
    ob_start();

    if($the_query->have_posts() ) : 
        while( $the_query->have_posts() ) : $the_query->the_post();?>
            <div class="col-lg-4 col-md-8 custom-tab-col">
                <div class="single-blog-wrapper">
                    
                    <div class="content-block">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                        </a>
                       <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        <?php 
        endwhile; 
    endif;  
    
    $response = ob_get_clean();
    
    echo json_encode(
        [
            'content' => $response,
            'has_next'  => $has_next
            
        ]
    );
    wp_reset_postdata();

    exit;
}
