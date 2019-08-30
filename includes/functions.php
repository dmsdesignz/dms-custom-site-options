<?
function register_acf_options_pages() {

    // Check function exists.
    if( !function_exists('acf_add_options_page') )
        return;

    // register options page.
    $option_page = acf_add_options_page(array(
        'page_title'    => __('Site Settings'),
        'menu_title'    => __('Site Settings'),
        'menu_slug'     => 'custom-site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Hook into acf initialization.
add_action('acf/init', 'register_acf_options_pages');

function dms_enqueue_files( $field, $front_field, $callback ){
    if ( get_field( $field, 'option') ) {
        if ( get_field( $front_field, 'option') ) {
            if ( is_front_page() ) {
                return $callback();
            }
        } else {
            return $callback();
        }
    }
}
function dms_beer_slider(){
    wp_enqueue_style(
        'beerSlidercss',
        plugin_dir_url( __FILE__ ) . '../assets/css/BeerSlider.css',
        '', 
        true
    );
    wp_enqueue_script(
        'beersliderjs',
        plugin_dir_url( __FILE__ ) . '../assets/js/BeerSlider.js',
        array( 'jquery' )
    );
}
function dms_featherlight(){
    wp_enqueue_style(
        'featherlightcss',
        plugin_dir_url( __FILE__ ) . '../assets/css/featherlight.min.css',
        array(),
        '2.3.4'
    );
    wp_enqueue_script(
        'featherlightjs',
        plugin_dir_url( __FILE__ ) . '../assets/js/featherlight.min.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );
}
function dms_flickity(){
    wp_enqueue_style(
        'flickity-css',
        plugin_dir_url( __FILE__ ) . '../assets/css/flickity.min.css',
        '', 
        true
    );
    wp_enqueue_script( 
        'flickityjs', 
        plugin_dir_url( __FILE__ ) . '../assets/js/flickity.pkgd.min.js', 
        '', 
        true 
    );
}
function dms_data_attributes(){
    wp_enqueue_script(
        'data-attributes',
        plugin_dir_url( __FILE__ ) . '../assets/js/data-attributes.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );
}
function dms_typed_js(){
    wp_enqueue_script(
        'typed',
        plugin_dir_url( __FILE__ ) . '../assets/js/typed/typed.min.js',
        array( 'jquery' )
    );
}
function dms_owl_carousel(){
    wp_enqueue_style(
        'owl-main',
        plugin_dir_url( __FILE__ ) . '../assets/css/owl.carousel.min.css',
        array(),
        '2.3.4'
    );
    wp_enqueue_script(
        'owl-js',
        plugin_dir_url( __FILE__ ) . '../assets/js/owl.carousel.min.js',
        array(),
        '2.3.4'
    );
}
function dms_owl_theme_css(){
    wp_enqueue_style(
        'owl-theme',
        plugin_dir_url( __FILE__ ) . '../assets/css/owl.theme.default.css',
        array(),
        '2.3.4'
    );
}
function custom_enqueue_files() {
            
    dms_enqueue_files( 'beer_slider', 'beer_slider_front', 'dms_beer_slider' );
    dms_enqueue_files( 'featherlight', 'featherlight_front', 'dms_featherlight' );
    dms_enqueue_files( 'flickity', 'flickity_front', 'dms_flickity' );
    dms_enqueue_files( 'typed_js', 'typed_js_front', 'dms_typed_js' );
    dms_enqueue_files( 'owl_carousel_', 'owl_carousel_front', 'dms_owl_carousel' );
    dms_enqueue_files( 'owl_theme_css', 'owl_theme_css_front', 'dms_owl_theme_css' );
    
    if ( get_field('data_attributes', 'option') ) {
        dms_data_attributes();
    }
}