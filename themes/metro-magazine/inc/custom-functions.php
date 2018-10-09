<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Metro_Magazine
 */
 
 if ( ! function_exists( 'metro_magazine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function metro_magazine_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Metro Magazine, use a find and replace
	 * to change 'metro-magazine' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'metro-magazine', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'metro-magazine' ),
		'secondary' => esc_html__( 'Top Menu', 'metro-magazine' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
        'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'metro_magazine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	// Custom Image Size
    add_image_size( 'metro-magazine-banner-post', 285, 307, true );
    add_image_size( 'metro-magazine-with-sidebar', 833, 474, true );
    add_image_size( 'metro-magazine-without-sidebar', 1110, 474, true );
    add_image_size( 'metro-magazine-featured-post', 285, 307, true );
    add_image_size( 'metro-magazine-promotional-post',322, 209, true);
    add_image_size( 'metro-magazine-recent-post', 78, 78, true );
    add_image_size( 'metro-magazine-search-thumbnail',230, 158, true );
    add_image_size( 'metro-magazine-promotional-block', 230, 230, true ); 
    
    add_image_size( 'metro-magazine-featured-big', 752 , 365, true );
    add_image_size( 'metro-magazine-featured-mid', 384 , 365, true );
    add_image_size( 'metro-magazine-featured-small', 282 , 245, true );
    add_image_size( 'metro-magazine-three-row', 251 , 250, true );
    add_image_size( 'metro-magazine-three-col', 360 , 246, true );
    add_image_size( 'metro-magazine-more-news', 321 , 206, true );
    
    /** Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Woocommerce support
    add_theme_support( 'woocommerce' );
    global $woocommerce;
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function metro_magazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'metro_magazine_content_width', 640 );
}

/**
* Adjust content_width value according to template.
*
* @return void
*/
function metro_magazine_template_redirect_content_width() {
	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = metro_magazine_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1140;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}
}

/**
 * Enqueue scripts and styles.
 */
function metro_magazine_scripts() {

	$metro_magazine_query_args = array(
		'family' => 'Ubuntu:400,400italic,700,300|Playfair+Display',
	);
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    wp_enqueue_style( 'metro-magazine-google-fonts', add_query_arg( $metro_magazine_query_args, "//fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'jquery-sidr-light', get_template_directory_uri() . '/css' . $build . '/jquery.sidr.light' . $suffix . '.css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css' . $build . '/font-awesome' . $suffix . '.css' );
	wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/css' . $build . '/slicknav' . $suffix . '.css' );
    wp_enqueue_style( 'metro-magazine-style', get_stylesheet_uri(), METRO_MAGAZINE_THEME_VERSION );


    wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/js' . $build . '/jquery.sidr' . $suffix . '.js', array('jquery'), '2.2.1', true );
	wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/js' . $build . '/jquery.slicknav' . $suffix . '.js', array('jquery'), '1.0.10', true );
    wp_enqueue_script( 'equal-height', get_template_directory_uri() . '/js' . $build . '/equal-height' . $suffix . '.js', array('jquery'), '0.7.0', true );
    wp_enqueue_script( 'metro-magazine-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), METRO_MAGAZINE_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function metro_magazine_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

  // Adds a class of custom-background-image to sites with a custom background image.
  if ( get_background_image() ) {
    $classes[] = 'custom-background-image';
  }
    
  // Adds a class of custom-background-color to sites with a custom background color.
  if ( get_background_color() != 'ffffff' ) {
    $classes[] = 'custom-background-color';
  }

  if(is_page()){
    $metro_magazine_post_class = metro_magazine_sidebar_layout(); 
    if( $metro_magazine_post_class == 'no-sidebar' )
    $classes[] = 'full-width';
  }

  if( !( is_active_sidebar( 'right-sidebar' )) || is_page_template( 'template-home.php' ) || is_404() ) {
      $classes[] = 'full-width'; 
  }

  return $classes;
}
add_filter( 'body_class', 'metro_magazine_body_classes' );

/**
 * Flush out the transients used in metro_magazine_categorized_blog.
 */
function metro_magazine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'metro_magazine_categories' );
}

if ( ! function_exists( 'metro_magazine_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function metro_magazine_excerpt_more() {
	return ' &hellip; ';
}
endif;

if ( ! function_exists( 'metro_magazine_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function metro_magazine_excerpt_length( $length ) {
    return 20;
}
endif;

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'metro_magazine_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'metro_magazine_custom_css' );
        }
    }
} else {
    function metro_magazine_custom_css(){
        $custom_css = get_theme_mod( 'metro_magazine_custom_css' );
        if( ! empty( $custom_css ) ){
    		echo '<style type="text/css">';
    		echo wp_strip_all_tags( $custom_css );
    		echo '</style>';
    	}
    }
    add_action( 'wp_head', 'metro_magazine_custom_css', 100 );
}

if( ! function_exists( 'metro_magazine_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function metro_magazine_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'metro-magazine-pro-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = metro_magazine_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( metro_magazine_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "http://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => get_permalink( $post->ID )
            ),
            "headline"  => get_the_title( $post->ID ),
            "image"     => array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            ),
            "datePublished" => get_the_time( DATE_ISO8601, $post->ID ),
            "dateModified"  => get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => metro_magazine_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "publisher" => array(
                "@type"       => "Organization",
                "name"        => get_bloginfo( 'name' ),
                "description" => get_bloginfo( 'description' ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => get_bloginfo( 'name' ),
                "description" => get_bloginfo( 'description' ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'metro_magazine_single_post_schema' );