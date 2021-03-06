<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\asset;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('sage/vendor.js', asset('scripts/vendor.js')->uri(), ['jquery'], null, true);
    wp_enqueue_script('sage/app.js', asset('scripts/app.js')->uri(), ['sage/vendor.js'], null, true);

    wp_add_inline_script('sage/vendor.js', asset('scripts/manifest.js')->contents(), 'before');

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_style('sage/app.css', asset('styles/app.css')->uri(), false, null);

    $landMarkModules = landmarkVenturesACfBlockModules();
    $id = get_the_ID();
    foreach ($landMarkModules as $nMod => $val) {
        $fileName = str_replace( '_', '-', $nMod );
        if ( has_block('acf/'.$fileName , $id) ) {
            $cssFilePath = $_SERVER['DOCUMENT_ROOT'].parse_url(asset('styles/modules/'.$fileName.'.css')->uri(),PHP_URL_PATH);
            if ( file_exists( $cssFilePath ) ) {
                wp_enqueue_style($fileName . '.css', asset('styles/modules/' . $fileName . '.css')->uri(), false, null);

            }
        }
    }

}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    if ($manifest = asset('scripts/manifest.asset.php')->load()) {
        wp_enqueue_script('sage/vendor.js', asset('scripts/vendor.js')->uri(), ...array_values($manifest));
        wp_enqueue_script('sage/editor.js', asset('scripts/editor.js')->uri(), ['sage/vendor.js'], null, true);

        wp_add_inline_script('sage/vendor.js', asset('scripts/manifest.js')->contents(), 'before');
    }

    wp_enqueue_style('sage/editor.css', asset('styles/editor.css')->uri(), false, null);
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls'
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Register the editor color palette.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
     */
    add_theme_support('editor-color-palette', []);

    /**
     * Register the editor color gradient presets.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-gradient-presets
     */
    add_theme_support('editor-gradient-presets', []);

    /**
     * Register the editor font sizes.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
     */
    add_theme_support('editor-font-sizes', []);

    /**
     * Register relative length units in the editor.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#support-custom-units
     */
    add_theme_support('custom-units');

    /**
     * Enable support for custom line heights in the editor.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#supporting-custom-line-heights
     */
    add_theme_support('custom-line-height');

    /**
     * Enable support for custom block spacing control in the editor.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#spacing-control
     */
    add_theme_support('custom-spacing');

    /**
     * Disable custom colors in the editor.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-colors-in-block-color-palettes
     */
    add_theme_support('disable-custom-colors');

    /**
     * Disable custom color gradients in the editor.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-gradients
     */
    add_theme_support('disable-custom-gradients');

    /**
     * Disable custom font sizes in the editor.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-font-sizes
     */
    add_theme_support('disable-custom-font-sizes');

    /**
     * Disable the default block patterns.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable wide alignment support.
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#wide-alignment
     */
    add_theme_support('align-wide');

    /**
     * Enable responsive embed support.
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style'
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary'
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer'
    ] + $config);
});


// Gutenberg name/categories
if( function_exists('acf_register_block_type') ) {
    add_filter( 'block_categories_all', function( $categories ){
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'landmark-ventures',
                    'title' => __( 'Landmark Ventures', 'landmark-venture' ),
                    'icon'  => 'wordpress',
                ),
            ),
        );
    } );

    function landmarkVenturesACfBlockModules() {
        $landmarkVenturesModules = [
            'leadspace_home' => 'Leadspace Home',
            'news_listing'  => 'News Listing',
            'post_filter' => 'Our Team Filter',
        ];
        return $landmarkVenturesModules;
    }

    add_action('acf/init', function() {
        if( function_exists('acf_register_block_type') ) {

            // register a leadspace block.
            // landmarkVentures modules in array
            // Note: key = filename/acf Name & Value = Name that shows in preview in backend
            $landmarkVenturesModules = landmarkVenturesACfBlockModules();
            foreach($landmarkVenturesModules as $key => $mModule) {
                $mName = $mModule;
                $fileName = str_replace( '_', '-', $key );

                acf_register_block_type(array(
                    'name'              => $key,
                    'fileName'          => $fileName,
                    'title'             => __( $mName ),
                    'description'       => __('A custom '. $mName.' block.'),
                    'render_template'   => 'resources/blocks/landmark-ventures/'.$fileName.'.php',
                    'category'          => 'landmark-ventures',
                    'icon'              => 'block-default',
                    'keywords'          => array( $mModule, 'landmark-venture' ),
                    'mode'              => 'auto',
                    // 'enqueue_style'     => asset('styles/'.$mModule.'.css')->uri(),
                    'example'           => array(
                        'attributes' => array(
                            'mode' => 'preview','full_height' => true,
                            'data' => []
                        )
                    ),
                    'enqueue_assets' => function($data){
                        $fileName = str_replace( '_', '-', $data['fileName'] );
                        $cssFilePath = $_SERVER['DOCUMENT_ROOT'].parse_url(asset('styles/modules/'.$fileName.'.css')->uri(),PHP_URL_PATH);
                        $jsFilePath = $_SERVER['DOCUMENT_ROOT'].parse_url(asset('scripts/'.$fileName.'.js')->uri(),PHP_URL_PATH);

                        if ( file_exists( $jsFilePath ) ) {
                            wp_enqueue_script( $fileName.'js', asset('scripts/'.$fileName.'.js')->uri(), array('jquery'), '', true );
                        }

                        if ( 'news-listing' == $fileName ) {
                            wp_localize_script( $fileName.'js', 'landmark_object', array(
                                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                                )
                            );
                        }

                    },
                ));
            }
        }
    });
}
