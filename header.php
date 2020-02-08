<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
    <meta charset=" <?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vv-HU5V3LSFj24xnryUuTYElF6vEQVvFcuQeJopc46w" />
    
    <title>
    <?php wp_title('|' , 'true' , 'right') ?>
    <?php bloginfo('name') ?>
    </title>
    <link rel="pingback" href=" <?php bloginfo('pingback_url'); ?> " />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php 
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}
    if(wp_count_posts()->publish < 1 ){
        echo '<div style="height: 100vh; width: 100vw; z-index: 999999;" class="bg-dark text-white d-flex align-items-center justify-content-center position-fixed flex-column">';
        echo '<div>Welcome to the simplest WP-News-theme and the simplest WP-ads-system ever created .. Start adding some new articles to show the website</div><br>';
            if(current_user_can('administrator')){ 
                echo '<a rel="noreferrer" target="_blank" href="' . site_url() . '/wp-admin' . '"><br><div class="text-white">Click here to add more articles , MR.Admin</div><a>';
            }
        echo '</div>';
    }
    
    
    ?>


    <?php
        if (is_active_sidebar('hz-sidebar')) { ?>
             <div class="en_hz_ads w-100 bg-dark lead text-white d-flex align-items-center justify-content-center mb-2">
                 <?php dynamic_sidebar('hz-sidebar'); ?>
             </div>
        <?php } ?>
  <nav style="height: 60px;" class=" py-0 navbar navbar-expand-lg navbar-dark d-flex align-items-center justify-content-center mb-1 w-100">
<!--        <a class="navbar-brand" href="<?php // bloginfo('url')?> ">-->
            <?php// bloginfo ('name') ?>
<!--         </a>-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <?php amans199_bootstrap_menu(); ?>

    <?php //echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
    <?php get_search_form(); ?>
<!--    <a href="<?php// echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><span class="dashicons dashicons-code-standards"></span></a>-->
  </div>
</nav>
  
  
  
<!--  end new menu-->

