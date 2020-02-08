<?php get_header(); ?>

       <div class="row mx-0">
        <?php
            if (is_active_sidebar('vert-ad')) { ?>
                 <section class="col-md-1 vert_ad_fix d-none d-md-block h-100vh p-fixed bg-dark text-white my-1">
                     <?php dynamic_sidebar('vert-ad'); ?>
                 </section>
        <?php } ?> 
<div class="container en_single_art col-md-10 col-sm-12">
   
<div class="en_s_article">
   
    <?php 
        if (have_posts()) {
            while (have_posts()) {
                the_post(); setPostViews(get_the_ID());
 ?>

    <div class="main-post">
        <div class="d-flex justify-content-center"><?php edit_post_link('Edit <i class="fa fa-pencil"></i> ') ?></div>
        <h3 class="en_post_title p-3">
            <a class="display-4 text-center d-block">
                <?php the_title();?>
            </a>
        </h3>
        <div class="post-info  mt-1  mb-3 d-flex align-items-center justify-content-center">
            <span class="post-auther mx-2 d-flex align-items-center"><span style="font-size: 18px;" class="dashicons dashicons-admin-users mr-1"></span><?php the_author(); ?> </span>
            <span class="post-date mx-2 d-flex align-items-center"><span style="font-size: 18px;" class="dashicons dashicons-calendar-alt mr-1"></span><?php the_time ('f j, y') ?> </span>
            <span class="post-views mx-2 d-flex align-items-center"><span style="font-size: 18px;" class="dashicons dashicons-visibility mr-1"></span><?php echo getPostViews(get_the_ID()); ?> </span>
        </div>       

        <div class="row_row">
            

            <?php //the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail post-img' , 'title' => 'post image']) ?> 
            <div class="row">
               <?php if(has_post_thumbnail()){ ?>
                <div class="col-md-6 mt-1"><?php echo get_the_post_thumbnail( get_the_ID(),'img-responsive img-thumbnail rounded ' ); ?>
                </div><?php } ?>
                <div class="subs <?php if(has_post_thumbnail()){ echo 'col-md-6'; }else{ echo 'col-md-12 text-center'; }?> text-left mt-3  mb-3">
                    <p class="post_content">

                        <?php the_content(); ?>
          
                    </p>
                    <br>
                </div>
            </div>

        </div>
        

       <?php if(has_tag()) { 
        echo '<hr>';
        $post_tags = get_the_tags(); ?>
        <p class="post-tags">
            <span style="font-size: 18px;" class="dashicons dashicons-tag mr-1"></span><a class="text-dark"><?php foreach( $post_tags as $tag ) { echo $tag->name . ' ,  '; } ?></a>
        </p>
 
        <?php } ?>
        
    </div>
    <?php } } ?></div>
    <div class="clear-fix"></div>
    
    
        <hr class="comment-separator">

        <div class="col-sm-12 post-pagination d-flex justify-content-between align-items-center text-dark">
<?php  
        if (get_previous_post_link()) {
            previous_post_link('%link' , '<span class="dashicons dashicons-arrow-left-alt2 p-0"></span> %title');
        } else {
            echo '<span class="prev-span" >prev</span>';
        }
       if (get_next_post_link()) {
            next_post_link('%link' , '%title <span class="dashicons dashicons-arrow-right-alt2 p-0"></span>');
        } else {
            echo '<span class="next-span">next</span>';
        } ?>

        </div>
    
        <div class="clear-fix"></div>
       
        <hr class="comment-separator">
<?php comments_template(); ?>
 
</div>
        <?php
            if (is_active_sidebar('vert-ad')) { ?>
                 <section class="col-md-1 d-none vert_ad_fix d-md-block h-100vh p-fixed bg-dark text-white my-1">
                     <?php dynamic_sidebar('vert-ad'); ?>
                 </section>
        <?php } ?> 
</div>

<?php get_footer();