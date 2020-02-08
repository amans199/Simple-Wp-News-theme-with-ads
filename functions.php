<?php

require_once get_template_directory() . '/class-tgm-plugin-activation.php';

//just to organize the process of theme installation  (added by amans199)
add_action( 'tgmpa_register', 'amans199_register_required_plugins' );
function amans199_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
            'force_activation'   => true,
			'required'  => true,
		),
        array(
			'name'      => 'WordPress Importer',
			'slug'      => 'wordpress-importer',
			'required'  => false,
		)
	);

	$config = array(
		'id'           => 'amans199',  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}

//adding acf fields (added by amans199)
add_filter('acf/settings/save_json', function() {
	return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
	$paths = array(get_template_directory() . '/acf-json');

	if(is_child_theme())
	{
		$paths[] = get_stylesheet_directory() . '/acf-json';
	}

	return $paths;
});


/**
 * Function that will update ACF fields via JSON file update
 * using it comes with a risk of updating the ACF automatically ... but i do think of it as not an issue at most cases (added by amans199)
 */
function jp_sync_acf_fields() {

	// vars
	$groups = acf_get_field_groups();
	$sync 	= array();

	// bail early if no field groups
	if( empty( $groups ) )
		return;

	// find JSON field groups which have not yet been imported
	foreach( $groups as $group ) {
		
		// vars
		$local 		= acf_maybe_get( $group, 'local', false );
		$modified 	= acf_maybe_get( $group, 'modified', 0 );
		$private 	= acf_maybe_get( $group, 'private', false );
		
		// ignore DB / PHP / private field groups
		if( $local !== 'json' || $private ) {
			
			// do nothing
			
		} elseif( ! $group[ 'ID' ] ) {
			
			$sync[ $group[ 'key' ] ] = $group;
			
		} elseif( $modified && $modified > get_post_modified_time( 'U', true, $group[ 'ID' ], true ) ) {
			
			$sync[ $group[ 'key' ] ]  = $group;
		}
	}

	// bail if no sync needed
	if( empty( $sync ) )
		return;

	if( ! empty( $sync ) ) { //if( ! empty( $keys ) ) {
		
		// vars
		$new_ids = array();
		
		foreach( $sync as $key => $v ) { //foreach( $keys as $key ) {
			
			// append fields
			if( acf_have_local_fields( $key ) ) {
				
				$sync[ $key ][ 'fields' ] = acf_get_local_fields( $key );
				
			}
			// import
			$field_group = acf_import_field_group( $sync[ $key ] );
		}
	}
}
add_action( 'admin_init', 'jp_sync_acf_fields' );


//register all styles files (added by amans199)
function amans199_add_styles () {
    wp_enqueue_style ('bootstrap-css' , get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style ('normalize-css' , get_template_directory_uri() . '/css/normalize.css');
    wp_enqueue_style ('main-css' , get_template_directory_uri() . '/css/main.css');
}
add_action('wp_enqueue_scripts' , 'amans199_add_styles');


//register all scripts files (added by amans199)
function amans199_add_scripts() {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.2.1');
    wp_enqueue_script('jquery');
    wp_enqueue_script ('Popper-js' , get_template_directory_uri() . '/js/Popper.js');
    wp_enqueue_script ('bootstrap-js' , get_template_directory_uri() . '/js/bootstrap.min.js');
    wp_enqueue_script ('bootstrap-bundle-js' , get_template_directory_uri() . '/js/bootstrap.bundle.min.js');
    wp_enqueue_script ('html5shiv' , get_template_directory_uri() . '/js/html5shiv.js');
    wp_enqueue_script ('slickjs' , get_template_directory_uri() . '/js/slick.js');
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
    wp_enqueue_script ('respond' , get_template_directory_uri() . '/js/respond.min.js');
    wp_script_add_data('respond', 'conditional', 'lt IE 9');
    wp_enqueue_script('main-js' , get_template_directory_uri() . '/js/main.js', array() , false , true);
}
add_action('wp_enqueue_scripts' , 'amans199_add_scripts');


//register navwalker to fix bootstrap menu (added by amans199)
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );


//register Display locations for menus (added by amans199)
function amans199_register_menu() {
  register_nav_menus(array(
        'header-menu' => 'Header Menu' ,
        'footer-menu' => 'footer Menu'
  ));
}
add_action( 'init', 'amans199_register_menu' );


//add function for bootstrap_menu for header .. to be called in the header (added by amans199)
function amans199_bootstrap_menu() {
    wp_nav_menu(array(
        'theme_location' => 'header-menu' ,
        'menu_class'     => 'navbar-nav mr-auto' , 
        'container'      =>  false,
        'depth'          =>  2,
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker()
    ));
}


//add support for post thumbnails (added by amans199)
add_theme_support( 'post-thumbnails' ); 


//edit the words count in excerpt for posts .. (added by amans199)
function amans199_extend_excerpt_length($length) {
        return 35;
}
add_filter('excerpt_length' , 'amans199_extend_excerpt_length');


//edit the excerpt extend .. normally it is [...] but here we remove the brackets to be just 3 dots (added by amans199)
function amans199_extend_change_dots($more) {
    return '...';
}
add_filter('excerpt_more' , 'amans199_extend_change_dots');


//registering sidebars for ads and widgets (added by amans199)
function amans199_sidebars() {
    register_sidebar(array(
        'name' => __( 'Main Sidebar', 'amans199' ),
        'id' => 'main-sidebar',
        'description' => __( 'Widgets on the Categories paged', 'amans199' ),
        'class' => 'main-sidebar',
        'before_widget' => '<div class="widget-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __( 'Horizontal ads', 'amans199' ),
        'id' => 'hz-sidebar',
        'description' => __( 'just ONE Horizontal ad to get 100% width', 'amans199' ),
        'class' => 'hz-sidebar',
        'before_widget' => '<div class="widget-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __( 'square-ad', 'amans199' ),
        'id' => 'square-ad',
        'description' => __( 'Just put one ad squared', 'amans199' ),
        'class' => 'square-ad',
        'before_widget' => '<div class="widget-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));    
    register_sidebar(array(
        'name' => __( 'Vertical Ad', 'amans199' ),
        'id' => 'vert-ad',
        'description' => __( 'just ONE Vertical Ad to get 100% height', 'amans199' ),
        'class' => 'vert-ad',
        'before_widget' => '<div class="widget-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));    
}
add_action('widgets_init' , 'amans199_sidebars');


//remove paragraph element from posts  (added by amans199)
function amans199_remove_paragraph($content) {
    remove_filter('the_content', 'wpautop');
    return $content;
}
add_filter('the_content', 'amans199_remove_paragraph', 0);


//remove the admin bar from top of the front of website ... only for normal user .. but those who have more than a role definitely will need it (added by amans199)
function amans199_noSubsAdminbar() {
    $ourCurrentUser = wp_get_current_user();
    if(count($ourCurrentUser->roles) == 1) {
        show_admin_bar(false);
    }
}
add_action('wp_loaded', 'amans199_noSubsAdminbar');


//adding a function for pagination .. can be called under the page if there will be alot of posts (added by amans199)
function amans199_numbering_pagenation() {
    global $wp_query;
    $all_pages = $wp_query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));
    if ($all_pages > 1) {
        return paginate_links(array(
        'base' => get_pagenum_link() . '%_%',
        'format' => 'page/%#%',
        'current' => $current_page,
        'total' => $all_pages
        ));
    }
    
}


// customize login screen  (added by amans199)
add_filter('login_headerurl', 'amans199_login_headerurl');
function amans199_login_headerurl(){
    return esc_url(site_url('/'));
}


// customize login screen  (added by amans199)
function ww_load_dashicons(){
   wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons', 999);


// redirect subscriber account to the homepage (added by amans199)
function amans199_redirectToFrontEnd() {
    $ourCurrentUser = wp_get_current_user();
    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if(!current_user_can('administrator') && strpos($host, 'admin-ajax.php') === false) { 
        wp_redirect(site_url('/'));
        exit;
    }
}
add_action('admin_init', 'amans199_redirectToFrontEnd');


//get and set a number of views for any post (added by amans199)
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }else if ( $count == '1' ) {
        return "1 view";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Remove issues with prefetching adding extra views (added by amans199)
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


//disable emoji to make the website load faster (added by amans199)
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );


/**
 * Filter function used to remove the tinymce emoji plugin. (added by amans199)
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints. (added by amans199)
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}


/*
 * Add acf columns to post list (added by amans199)
 */
 function amans199_add_acf_columns ( $columns ) {
   return array_merge ( $columns, array ( 
     'featured' => __ ( 'Featured' , 'amans199'),
   ) );
 }
 add_filter ( 'manage_post_posts_columns', 'amans199_add_acf_columns' );

/*
 * Add columns to exhibition post list  (added by amans199)
 */
 function amans199_custom_column ( $column, $post_id ) {
   switch ( $column ) {
     case 'featured':
       $featured = get_post_meta( $post_id, 'featured', true );
       echo esc_html( $featured );
       break;
   }
 }
 add_action ( 'manage_post_posts_custom_column', 'amans199_custom_column', 10, 2 );


// Print checkbox in Quick Edit for each custom column. (added by amans199)
add_action( 'quick_edit_custom_box', 'quick_edit_add', 10, 2 );
function quick_edit_add( $column_name, $post_type ) {
    switch ( $column_name ) {
        case 'featured' :
            printf( '<input type="checkbox" name="featured" class="featured"> %s',
                    __( 'Featured', 'en_task' )
            );
        break;
    }
}


// Save checkbox value (added by amans199)
add_action( 'save_post', 'qedit_save_post', 10, 2 );
function qedit_save_post( $post_id, $post ) {
    if ( empty( $_POST ) ) {
        return $post_id;
    }
    // Verify quick edit nonce
    if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) ) {
        return $post_id;
    }
    // Don't save for autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // dont save for revisions
    if ( isset( $post->post_type ) && 'revision' === $post->post_type ) {
        return $post_id;
    }
// the value is checked the value is yes , if unchecked it will be no… these two values are stored in DB also
    if ( isset( $_POST[ '_inline_edit' ] ) && wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) ) {
        if ( isset( $_POST['featured'] ) ) {
            update_post_meta( $post_id, 'featured', '1' );
        } else {
            update_post_meta( $post_id, 'featured' ,'0');
        }
      }
}



// JavaScript functions to set/update checkbox (added by amans199)
add_action( 'admin_footer', 'quick_edit_javascript' );
function quick_edit_javascript() {
    global $current_screen;
    if ( 'post' !== $current_screen->post_type ) {
        return;
    } ?>
    <script>
        function checked_headline_news( fieldValue ) {
            inlineEditPost.revert();
            jQuery( '.featured' ).attr( 'checked', 0 == fieldValue ? false : true );
        }
    </script><?php
}


add_filter( 'post_row_actions', 'quick_edit_link', 10, 2 );
function quick_edit_link( $actions, $post ) {
    global $current_screen;
    $data = get_post_meta( $post->ID, 'featured', true );
    $data = empty( $data ) ? 0 : 1;
    $actions['inline hide-if-no-js']  = '<a href="#" class="editinline"';
    $actions['inline hide-if-no-js'] .=    ' title="' . esc_attr( __( 'Edit this item inline', 'text-domain' ) ) . '"';
    $actions['inline hide-if-no-js'] .=    " onclick=\"checked_headline_news('{$data}')\" >";
    $actions['inline hide-if-no-js'] .=   __( 'Quick Edit', 'text-domain' );
    $actions['inline hide-if-no-js'] .= '</a>';
    return $actions;
}



