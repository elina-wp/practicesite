<?php

if( class_exists('ACF') ) :
    function landmark_allowed_block_types( $allowed_blocks, $post ) {
        $allowed_blocks = array(
            'core/image',
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/freeform',
            'core/html',
            'core/quote',
            'core/shortcode',
            'acf/leadspace-home',
            'acf/news-listing',
            
        );


        return $allowed_blocks;
    }
    add_filter('allowed_block_types_all', 'landmark_allowed_block_types', 10, 2);

    

    // ACF Theme Option
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Theme General Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => true
        ));

        
    }

    
endif;
