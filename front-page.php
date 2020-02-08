<?php get_header(); ?>

<div class="en_egypt_news">
    <div class="en_website_front_content">
        <div class="row m-0">
        <?php
            if (is_active_sidebar('vert-ad')) { ?>
                 <section class="col-md-1 vert_ad_fix d-none d-md-block h-100vh p-fixed bg-dark text-white my-1">
                     <?php dynamic_sidebar('vert-ad'); ?>
                 </section>
        <?php } ?>            
            
            <section class="<?php if (is_active_sidebar('vert-ad')) { echo ' col-md-10 '; }else{ echo ' col-md-12 '; }?> col-xs-12">
                <section class="en_first_section row d-flex justify-content-center align-items-center">
                    <div class="<?php if (is_active_sidebar('square-ad')) { echo ' col-md-9 '; }else{ echo ' col-md-12 '; }?>">
                       <div class="row">
                          
                <?php
                $en_latest_article_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 1,
                    'category__not_in' => 35
                );
                $en_latest_article = new WP_Query( $en_latest_article_args );
                if ($en_latest_article->have_posts()) {
                    while ($en_latest_article->have_posts()) { 
                        $en_latest_article->the_post(); 
                           $categories = get_the_category();
                           ?>                          
                           <article class="en_lg_front p-1 col-sm-8 pl-2">
                                <div class="card text-white h-100 rounded-0">
                                  <div class="img-gradient h-100">
<!--                                      <img src="https://www.egypttoday.com/images/larg/31738.jpg" class="card-img img-gradient rounded-0 img-fluid h-100" alt="...">-->
                                      
                                      <a href="<?php the_permalink() ?>">
                                        <?php 
                                        if(has_post_thumbnail()){
                                            the_post_thumbnail('' , ['class' => 'card-img img-gradient rounded-0 img-fluid h-100 ' , 'title' => get_the_title() , 'alt' => get_the_title()]);
                                        }else{ ?>
                                            <img src="https://corsorr.com/wp-content/uploads/2019/12/no-image.png" class="card-img img-gradient rounded-0 img-fluid h-100" alt="<?php echo get_the_title(); ?>" style="max-height:336.25px;" title="<?php echo get_the_title(); ?>" sizes="(max-width: 768px) 100vw, 768px">
                                        <?php } ?>

                                        </a>
                                      
                                  </div>
                                   <a href="<?php the_permalink() ?>" class="text-white">
                                  <div class="card-img-overlay d-flex flex-column align-items-start justify-content-end">
                                    <h5 class="card-title bg-danger d-inline p-1 px-3 my-1" data-category="<?php if(!empty($categories)){echo esc_html( $categories[0]->slug );} ?>"><?php if(!empty($categories)){echo esc_html( $categories[0]->name );} ?></h5>
                                    <h3 class="card-text"><?php echo the_title(); ?></h3>
                                       </div></a>
                                </div>
                            </article>
                        <?php }
                            wp_reset_postdata();
                                } ?>
                                
                                
                                
                                
                                
                            <div class="col-sm-4 p-0">
                               
                <?php
                $en_sec_latest_articles_args = array(
                    'post_type' => 'post',
                    'offset' => 1,
                    'posts_per_page' => 2,
                    'category__not_in' => 35
                );
                $en_sec_latest_articles = new WP_Query( $en_sec_latest_articles_args );
                if ($en_sec_latest_articles->have_posts()) {
                    while ($en_sec_latest_articles->have_posts()) { 
                        $en_sec_latest_articles->the_post();
                                 $categories_2 = get_the_category();
                                ?>                                
                               
                                <article class="en_sm_front p-1">
                                    <div class="card text-white rounded-0">
                                      <div class="img-gradient">
<!--                                          <img src="https://www.egypttoday.com/images/larg/31738.jpg" class="card-img img-gradient rounded-0 img-fluid" alt="...">-->
                                          
                                      <a href="<?php the_permalink() ?>">
                                        <?php 
                                        if(has_post_thumbnail()){
                                            the_post_thumbnail('' , ['class' => 'card-img img-gradient rounded-0 img-fluid h-100 ' , 'title' => get_the_title() , 'alt' => get_the_title()]);
                                        }else{ ?>
                                            <img src="https://corsorr.com/wp-content/uploads/2019/12/no-image.png" class="card-img img-gradient rounded-0 img-fluid h-100" alt="<?php echo get_the_title(); ?>" style="max-height:336.25px;" title="<?php echo get_the_title(); ?>" sizes="(max-width: 768px) 100vw, 768px">
                                        <?php } ?>

                                        </a>                                          
                                          
                                          
                                          
                                      </div>
                                      <a href="<?php the_permalink() ?>" class="text-white">
                                      <div class="card-img-overlay d-flex flex-column align-items-start justify-content-end">
                                        <h5 class="card-title bg-danger d-inline p-1 px-3 my-1" data-category="<?php if(!empty($categories_2)){echo esc_html( $categories_2[0]->slug );} ?>"><?php if(!empty($categories_2)){echo esc_html( $categories_2[0]->name );} ?></h5>
                                        <h3 class="card-text"><?php echo the_title(); ?></h3>
                                          </div></a>
                                    </div>
                                </article>
                            <?php }
                            wp_reset_postdata();
                                } ?>
                            </div>
                        </div>
                    </div>
                    
                <?php
                    if (is_active_sidebar('square-ad')) { ?>
                         <div class="col-md-3 sq_ad_fix overflow-hidden p-1 pr-2 d-none d-md-block">
                             <?php dynamic_sidebar('square-ad'); ?>
                         </div>
                <?php } ?>                        

                </section>

                

                <?php
                    $term_args = array( 'taxonomy' => 'category' );
                    $terms = get_terms( $term_args );
                    $term_ids = array();

                    foreach( $terms as $term ) {
                        $key = get_term_meta( $term->term_id, 'Categories_in_front_slider', true );
                        if( $key == true ) {
                            $term_ids[] = $term->term_id;
                        }
                    }

                    // Loop Args
                   
                $en_egypt_news_args = array(
                    'post_type' => 'post',
//                    'category_name' => 'egypt-news',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'terms'    => $term_ids,
                            )
                        ),
                    'posts_per_page' => 10
                ); 
                $en_egypt_news = new WP_Query( $en_egypt_news_args );
                
                if(current_user_can('administrator') && $en_egypt_news->found_posts < 5 ){ ?>
                  <hr class="bg-dark my-1" style="height: 2px">
                   <section class="en_sec_section row d-flex align-items-center px-2 my-1">
                   <?php
                    echo '<a rel="noreferrer" target="_blank" href="' . site_url() . '/wp-admin/edit-tags.php?taxonomy=category' . '"><br><div class="text-dark text-center">PS:: no one can see this note except admin<br>the slider can\'t be shown if it contains less than 5 posts to make the page look more clean .. you may add more by marking more populized categories to be show within the slider by clicking here.. </div><a>'; ?>
                    </section>
                        <?php
                }                
                if ($en_egypt_news->found_posts > 5) {
                ?>     
                         <hr class="bg-dark my-1" style="height: 2px">
                <section class="en_sec_section row d-flex align-items-center px-2 my-1">
                
                <a href="<?php echo site_url() . '/category/egypt-news/'; ?>">
                    <h2 class="text-left text-uppercase py-1 m-0 text-danger">egypt news</h2>
                </a>
               <section class="en_all_news slider bg-light text-dark p-1 w-100 overflow-hidden d-flex align-items-center justify-content-center my-1 slider">

                <?php
                
                if ($en_egypt_news->have_posts() && $en_egypt_news->found_posts > 5) {
                    while ($en_egypt_news->have_posts()) {
                        $en_egypt_news->the_post(); ?>                          

                 
                  <div class="slide tile h-100">
                    <div class="card text-white h-100">
                      <div class="img-gradient h-100">
                          <a href="<?php the_permalink() ?>">
                            <?php 
                            if(has_post_thumbnail()){
                                the_post_thumbnail('' , ['class' => 'card-img img-gradient rounded-0 img-fluid h-100 ' , 'title' => get_the_title() , 'alt' => get_the_title()]);
                            }else{ ?>
                                <img src="https://corsorr.com/wp-content/uploads/2019/12/no-image.png" class="card-img img-gradient rounded-0 img-fluid h-100" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" sizes="(max-width: 768px) 100vw, 768px">
                            <?php } ?>

                            </a>   
                          
                      </div>
                      <a href="<?php the_permalink() ?>">
                      <div class="card-img-overlay d-flex flex-column align-items-start justify-content-end">
                        <h3 class="card-text"><?php echo the_title(); ?></h3>
                          </div></a>
                    </div>
                  </div>                           
                      

                    <?php } wp_reset_postdata();
                        } ?>


               </section>

                </section>
                <?php } ?>
                  
                   <?php 
                     $n_featured = new WP_Query( array( 'meta_key' => 'featured', 'meta_value' => true ) );
                     if(!$n_featured->found_posts < 1 ){ ?>       
                     <hr class="bg-dark my-1" style="height: 2px">         
                <section class="en_first_section row d-flex justify-content-center">
                    <div class="col-md-8">
                        <a href="<?php echo site_url() . '/featured'; ?>">
                            <h2 class="text-left text-uppercase py-1 m-0 text-danger">featured</h2>
                        </a>
                        <div class="row">
                          
                <?php
                $en_featured_article_args = array(
                    'post_type' => 'post',
                    'meta_key'		=> 'featured',
	                'meta_value'	=> true,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 1
                );
                $en_featured_latest_article = new WP_Query( $en_featured_article_args );
                if ($en_featured_latest_article->have_posts()) {
                    while ($en_featured_latest_article->have_posts()) { 
                        $en_featured_latest_article->the_post(); 
                          $categories_3 = get_the_category();
                                                  ?>                          
                           <article class="en_lg_front p-1 col-sm-8 pl-2">
                                <div class="card text-white h-100 rounded-0">
                                  <div class="img-gradient h-100">
<!--                                      <img src="https://www.egypttoday.com/images/larg/31738.jpg" class="card-img img-gradient rounded-0 img-fluid h-100" alt="...">-->
                                      
                                      <a href="<?php the_permalink() ?>">
                                        <?php 
                                        if(has_post_thumbnail()){
                                            the_post_thumbnail('' , ['class' => 'card-img img-gradient rounded-0 img-fluid h-100 ' , 'title' => get_the_title() , 'alt' => get_the_title()]);
                                        }else{ ?>
                                            <img src="https://corsorr.com/wp-content/uploads/2019/12/no-image.png" class="card-img img-gradient rounded-0 img-fluid h-100" alt="<?php echo get_the_title(); ?>" style="max-height:336.25px;" title="<?php echo get_the_title(); ?>" sizes="(max-width: 768px) 100vw, 768px">
                                        <?php } ?>
                                        </a>
                                      
                                  </div>
                                   <a href="<?php the_permalink() ?>" class="text-white">
                                  <div class="card-img-overlay d-flex flex-column align-items-start justify-content-end">
                                    <h5 class="card-title bg-danger d-inline p-1 px-3 my-1" data-category="<?php if(!empty($categories_3)){echo esc_html( $categories_3[0]->slug );} ?>"><?php if(!empty($categories_3)){echo esc_html( $categories_3[0]->name );} ?></h5>
                                    <h3 class="card-text"><?php echo the_title(); ?></h3>
                                       </div></a>
                                </div>
                            </article>
                        <?php }
                            wp_reset_postdata();
                                } ?>
                                
                                
                                
                                
                                
                            <div class="col-sm-4 p-0">
                               
                <?php
                $en_sec_featured_latest_articles_args = array(
                    'post_type' => 'post',
                    'offset' => 1,
                    'meta_key'		=> 'featured',
	                'meta_value'	=> true,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 2
                );
                $en_sec_featured_latest_articles = new WP_Query( $en_sec_featured_latest_articles_args );
                if ($en_sec_featured_latest_articles->have_posts()) {
                    while ($en_sec_featured_latest_articles->have_posts()) { 
                        $en_sec_featured_latest_articles->the_post(); 
                                $categories_4 = get_the_category();
                                ?>                                
                                <article class="en_sm_front p-1">
                                    <div class="card text-white rounded-0">
                                      <div class="img-gradient">
<!--                                          <img src="https://www.egypttoday.com/images/larg/31738.jpg" class="card-img img-gradient rounded-0 img-fluid" alt="...">-->
                                          
                                      <a href="<?php the_permalink() ?>">
                                        <?php 
                                        if(has_post_thumbnail()){
                                            the_post_thumbnail('' , ['class' => 'card-img img-gradient rounded-0 img-fluid h-100 ' , 'title' => get_the_title() , 'alt' => get_the_title()]);
                                        }else{ ?>
                                            <img src="https://corsorr.com/wp-content/uploads/2019/12/no-image.png" class="card-img img-gradient rounded-0 img-fluid h-100" style="max-height:336.25px;" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" sizes="(max-width: 768px) 100vw, 768px">
                                        <?php } ?>

                                        </a>                                          
                                          
                                          
                                          
                                      </div>
                                      <a href="<?php the_permalink() ?>" class="text-white">
                                      <div class="card-img-overlay d-flex flex-column align-items-start justify-content-end">
                                        <h5 class="card-title bg-danger d-inline p-1 px-3 my-1" data-category="<?php if(!empty($categories_4)){echo esc_html( $categories_4[0]->slug );} ?>"><?php if(!empty($categories_4)){echo esc_html( $categories_4[0]->name );} ?></h5>
                                        <h3 class="card-text"><?php echo the_title(); ?></h3>
                                          </div></a>
                                    </div>
                                </article>
                            <?php }
                            wp_reset_postdata();
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 overflow-hidden p-1 pr-2 d-none d-md-block">
                        <h2 class="text-left text-uppercase py-1 m-0 text-danger">top 5 stories</h2>
                        <ul class="en_top_stories list-group">
                           
                   <?php
                    $i_for_ordering = 0;
                     query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=5');
                    if (have_posts()) : while (have_posts()) : the_post();$i_for_ordering++;
                    ?>
                       <a href="<?php the_permalink() ?>" class="text-dark">
                        <li class="list-group-item font-weight-bold"><span class="p-1 bg-danger mr-2 text-white"><?php echo $i_for_ordering; ?></span><?php echo the_title(); ?></li>
                        </a>

                    <?php
                    endwhile; endif;
                    wp_reset_query();
                    ?>    
                            
                            
                        </ul>

                    </div>
                </section>
                <?php } ?>
                       <?php if(current_user_can('administrator') && $n_featured->found_posts < 1){ ?>
                            <hr class="bg-dark my-1" style="height: 2px">
                            <?php echo '<a rel="noreferrer" target="_blank" href="' . site_url() . '/wp-admin' . '"><br><div class="text-dark text-center">Click here to feature more articles , MR.Admin .... after that the section of featured articles and the section of the most viewed articles will be shown up here .... <br> PS. no one can see this notice except you</div><a>'; ?>               
                        <?php } ?>
                    

            </section>

                    <?php
            if (is_active_sidebar('vert-ad')) { ?>
                 <section class="col-md-1 vert_ad_fix d-none d-md-block h-100vh p-fixed bg-dark text-white my-1">
                     <?php dynamic_sidebar('vert-ad'); ?>
                 </section>
        <?php } ?>  
        </div>
    </div>
</div>   

   
   

<?php get_footer(); ?>