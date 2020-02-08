<?php get_header(); ?>


 <div class="row <?php if (!is_active_sidebar('vert-ad')) { echo ' container mx-auto '; }else{ echo '  mx-0 ';} ?>">
            <?php
            if (is_active_sidebar('vert-ad')) { ?>
                 <section class="col-md-1 vert_ad_fix d-none d-md-block h-100vh p-fixed bg-dark text-white my-1">
                     <?php dynamic_sidebar('vert-ad'); ?>
                 </section>
        <?php } ?>


<div class="container cat-page home-page  <?php if (is_active_sidebar('vert-ad')) { echo ' col-md-10 '; }else{ echo ' col-md-12 '; }?>">
     <div class="cat-info text-center my-2">
           <h1 class="single-cat"><?php single_cat_title(); ?></h1>
           <div class="cat-description"><?php echo category_description(); ?></div>
     </div>
 
    <div class="row">


       <div class="col-md-8 col-sm-12">
        <?php 
            if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    
                        <div class="main-post">
                           <h3 class="post-title">
                               <a href="<?php the_permalink() ?>">
                                   <?php the_title() ?>
                               </a>
                           </h3>
                           <div class="post-info">
                                <span class="post-auther"><i class="fa fa-user fa-fw"></i><?php the_author_posts_link() ?> </span>
                                <span class="post-date"><i class="fa fa-calendar fa-fw"></i><?php the_time ('f j, y') ?> </span>
                                <span class="post-comments"><i class="fa fa-comments fa-fw"></i><?php comments_popup_link('0 comments' ,  '1 comment' , '% comments' , 'comment-url' , 'comments disabled' ) ?> </span>
                            </div><a href="<?php the_permalink() ?>">
                            <?php the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail post-img' , 'title' => get_the_title() , 'alt' => get_the_title()]) ?></a>
                            <p class="post-content">
                                <?php the_excerpt() ?>
                            </p>
                            <hr>
                            <p class="post-categories">
                            <span style="font-size: 18px;" class="dashicons dashicons-tag mr-1"></span>
                            <?php the_category( ' , ' ); ?> </p>   
                            <p class="post-tags">
                               <?php if (has_tag()) { the_tags(); } else {  echo 'tags: there\'s no tags'; } ?>
                            </p>
                        </div>

                <?php }} ?>
            </div>
            
            <div class="col-md-4 d-none d-md-block">
               <div class="js-main-sidebar">
                    <?php
                        if (is_active_sidebar('main-sidebar')) {
                            dynamic_sidebar('main-sidebar');   
                        }
                    ?>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="new-pagination">
                <?php echo amans199_numbering_pagenation(); ?>
            </div>

    </div>
</div>
            <?php
            if (is_active_sidebar('vert-ad')) { ?>
                 <section class="col-md-1 vert_ad_fix d-none d-md-block h-100vh p-fixed bg-dark text-white my-1">
                     <?php dynamic_sidebar('vert-ad'); ?>
                 </section>
        <?php } ?>
</div>


<?php get_footer();