<?php
// Register post type
function landmark_custom_post_type()
{
    //register post type for team
    register_post_type(
        'our-team',
        array(
            'labels' => array(
                'name' => __('Our Teams', 'landmark'),
                'singular_name' => __('Our Team', 'landmark'),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'has_archive' => false,
            'show_ui' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'menu_icon' => 'dashicons-groups',
            'rewrite' => array( 'slug' => 'our-team' ),
            'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt' )
        )
    );

    
    // register taxonomy for team
    $labels = array(
        'name' => _x('Categories', 'Category', 'landmark'),
        'singular_name' => _x('Category', 'Category', 'landmark'),
        'search_items' => __('Search Categories', 'landmark'),
        'all_items' => __('All Categories', 'landmark'),
        'view_item' => __('View Category', 'landmark'),
        'parent_item' => __('Parent Category', 'landmark'),
        'parent_item_colon' => __('Parent Category:', 'landmark'),
        'edit_item' => __('Edit Category', 'landmark'),
        'update_item' => __('Update Category', 'landmark'),
        'add_new_item' => __('Add New Category', 'landmark'),
        'new_item_name' => __('New Category Name', 'landmark'),
        'not_found' => __('No Categories Found', 'landmark'),
        'back_to_items' => __('Back to Categories', 'landmark'),
        'menu_name' => __('Categories', 'landmark'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'our-team-category'),
        'show_in_rest' => true,
    );
    register_taxonomy('our-team-category', 'our-team', $args);

}
add_action('init', 'landmark_custom_post_type');
