<?php 
if ( ! empty( $is_preview  ) ) :

    /* Render screenshot for example */
    $imgUrl = get_stylesheet_directory_uri() . '/resources/blocks/preview/news_list.png';
    echo '<img src="' . $imgUrl . '">';
else:
	$section_title 		= get_field( 'section_title' );
	$select_news 		= get_field( 'select_news' );
	$ppr  = get_field( 'total_number_of_posts' );
	

	$args = array(
        'post_type' => 'post',
        'order' => 'ASC',
        'post_status' => 'publish',
        'posts_per_page' => $ppr ? $ppr : 2 
        
    );

    $loop= new WP_Query( $args );
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xl-6">
            	<?php 
                    $loop = new WP_Query( $args );
                    
                    if($loop->have_posts() ) :        
                    ?>
                        <div class="row" id="blog-posts">
                            <?php while( $loop->have_posts() ) : $loop->the_post(); ?>
	                            <div class="col-lg-12 col-md-8 custom-tab-col">
	                                <div class="single-blog-wrapper">
	                                    <div class="content-block">
	                                        <a href="<?php the_permalink(); ?>">
	                                        	<h3><?php the_title(); ?></h3>
	                                        </a>
	                                       <?php the_excerpt(); ?>
	                                    </div>
	                                </div>
	                        	</div>
                            <?php endwhile; ?>
                        </div>
                        <?php
                        	//echo $loop->max_num_pages;
                        	if ( $loop->max_num_pages > 1 ) : ?>
                        		<div class="text-center mt-80">
                           			<button class="btn-theme  btn-loader" id="load_more">Show all</button>
                        		</div>
                    	<?php endif; ?>
        
                    	<?php wp_reset_postdata();   
                  	endif; 
                ?>
            </div>
        </div>
    </div>
    <?php 
endif;

