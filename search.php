<?php 
get_header(); 
//pageBanner(array(
//    'title' => 'Search Results',
//    'subtitle' => 'You Searched For &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
//));

?>



<div class="container container--narrow page-section">
   <div class="m-4 p-2">
       <?php get_search_form(); ?>
   </div>
    <?php
        if (have_posts()) {
            while (have_posts()) {
            the_post();
                    ?>
            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="metabox">
                    <p>posted by <?php the_author(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                </div>
                <div class="generic-content">
                    <?php the_excerpt(); ?>
                    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">continue reading &raquo;</a></p>
                </div>
            </div>                 
                <?php
                        echo '<hr class="comment-separator">';

            }
            echo '<div class="pagination d-flex align-items-center justify-content-center display-2">' . paginate_links() . '</div>';
        }else{
            echo '<h2 class="headline headline--small-plus">No results match that search</h2>';
        }
    
        
    
        ?>
    
</div>





<?php get_footer(); ?>