<?php
if ( ! empty( $is_preview  ) ) :

    /* Render screenshot for example */
    $imgUrl = get_stylesheet_directory_uri() . '/resources/blocks/preview/post-filter-people.png';
    $imgUrl1 = get_stylesheet_directory_uri() . '/resources/blocks/preview/post-filter-news.png';
    echo '<img src="' . $imgUrl . '"><img src="' . $imgUrl1 . '">';
else:
    $content = get_field( 'post_filter' );
    $ppr = $content['posts_per_page'] ?? false;
    $filter_title = $content['filter_title'] ?? false;
    //$spacingClass = getSpacingClass( $content );

    $args = array(
        'posts_per_page' => $ppr ? $ppr : 6,
        'post_type' => 'our-team',
        'post_status' => 'publish',
        'order'   => 'DESC',
        'orderby' => 'date'
    );

    $p_service = isset( $_GET['p-service'] ) ? $_GET['p-service'] : '';    
    if ( $p_service ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'our-team-category',
                'field'    => 'slug',
                'terms'    => $p_service,
            ),
        );
    }

    $filter_query = new WP_Query( $args );

    if ( empty( $filter_title ) && empty( $filter_query ) && ! is_array( $filter_query ) ) {
        return false;
    }
    if ( $filter_query->have_posts() ) :


        $taxonomies = get_terms( array(
            'taxonomy' => 'our-team-category',
            'hide_empty' => true,
            'fields' => 'all',
        ) );
        $p_service = isset( $_GET['p-service'] ) ? $_GET['p-service'] : '';
    ?>
    <section id="ourteamfilter"  class="post-filter position-relative pt-6 pt-md-12 pb-12 pb-md-16 pb-xl-20">
        <input type="hidden" class="postfilter__val" data-ppr="<?php echo $ppr; ?>" data-post-type="our-team" data-cat-id="<?php echo $p_service; ?>" data-page-num="1">
        <div class="position-absolute pt-10 pt-md-6 pt-lg-8 position-l-0 position-b-0 bg-offWhite w-100"></div>
        <div class="container position-relative pb-md-20 pb-lg-0">
            <div class="post-filter__filter-wrap">
                <div class="post-filter__controls d-md-none">
                    <a  class="d-flex align-items-center" data-bs-toggle="collapse" href="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                        <h6 class="link-2 mb-0">Filter</h6><i class="ms-1 icon-chevron-down body-2 text-secondary"></i>
                    </a>
                </div>
                <div class="post-filer__filter collapse d-md-block" id="filterCollapse">
                    <div class="row ">
                        <?php if ( $taxonomies && is_array( $taxonomies ) ) : ?>
                            <div class="col-md-7 col-lg-9 pt-6 pt-md-0">
                                <div class="filter-nav post-filter__nav_js">
                                    <h6 class="eyebrow mb-0"><?php echo $filter_title; ?></h6>
                                    <ul class="nav mb-3 d-block d-md-flex">
                                        <li class="filter-item mt-3" data-cat-id="">
                                            <a href="<?php echo get_the_permalink(); ?>" class="filter-link btn btn-primary border-0<?php echo ( empty( $p_service ) ) ? ' active' : ''; ?>">All</a>
                                        </li>
                                        <?php
                                            foreach ( $taxonomies as $key => $value ) {
                                                //var_dump($taxonomies);
                                                $activeClass = ( $p_service == $value->slug ) ? ' active' : '';
                                                echo '
                                                <li class="filter-item mt-3" data-cat-id="' . ( int ) $value->term_id . '">
                                                    <a href="' . get_the_permalink() . '?p-service=' . $value->slug . '" class="filter-link btn btn-primary border-0' . $activeClass . '">' . esc_html( $value->name ) . '</a>
                                                </li>
                                                ';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-5 col-lg-3 ps-md-0 ps-lg-2 pt-6 pt-md-0">
                            <div class="filter-search">
                                <h6 class="eyebrow mb-0">Search</h6>
                                <div class="filter-group position-relative mt-3 w-100">
                                    <input type="text" id="filter-form" class="filter-input d-block w-100 search-filter__js"/>
                                    <button type="submit" class="btn position-absolute position-r-0 py-0 px-1 filter-btn">
                                        <i class="icon-search text-secondary"></i>
                                    </button>
                                </div>
                                <div class="search-data__js"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-filter__content pt-4 pt-md-0">
                <div class="row">
                    <?php while ( $filter_query->have_posts() ) : $filter_query->the_post(); ?>
                    <div class="col-6 col-md-4 col-lg-3 pt-6 pt-md-10 pt-lg-14">
                        <article class="card-team">
                            <a href="<?php the_permalink(); ?>">
                                <div class="card-team__img-wrap position-relative">
                                    <?php
                                        if ( get_post_thumbnail_id( get_the_ID() ) ) :
                                            $imageId = get_post_thumbnail_id( get_the_ID() );
                                            $imageurl = wp_get_attachment_url( $imageId );
                                            $alt = get_post_meta( $imageId, '_wp_attachment_image_alt', TRUE );
                                            $altText = $alt ? $alt : get_the_title( get_the_ID() );
                                            if ( $imageurl ) {
                                        ?>
                                            <figure class="thumbnail-img">
                                                <?php echo wp_get_attachment_image( $imageId, 'full', false, array( "class" => "img-fluid w-100", "alt" => $altText ) ); ?>
                                            </figure>
                                        <?php
                                            }
                                        endif;
                                    ?>  
                                </div>
                                <div class="card-team__content pt-4 pt-md-6">
                                    <h5 class="mb-0"><?php the_title(); ?></h5>
                                    <div class="card-team__designation-list">
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                    <?php 
                        endwhile; 
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    endif;
endif;
