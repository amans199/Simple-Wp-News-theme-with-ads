<?php get_header();

      $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        if(strpos($host, '/ar') !== false){ 
            $ar = '/ar';
        }

?>

<style>.footer { display: block;}</style>
<div class="materials_page">
    <div class="container">
<?php 
//        function isJson($thecontent) {
//         return (json_last_error() == JSON_ERROR_NONE);
//        }  
        ?>

 <h2 class="text-center text-white m-5"><?php _e('ALL Articles' , 'corsorr') ?></h2>
   
    <div class="row">

        <div class="col-md-9">
                     
           <div class="all_tags_above d-flex flex-wrap mt-0 mb-4">
                <a href="#">
                    <span onclick="$('.mpost').show();$('.hz_matslength').show();" style="width:fit-content" class="ml-2 mb-2 reset btn d-flex align-items-center justify-content-center">
                        <div style="font-size: 18px;" class="dashicons dashicons-tag mr-1"></div> 
                        Reset Filters
                    </span>
                </a>
                <?php
                $args_4tags = array(
                'post_type'        =>  array('post', 'units'),
                'posts_per_page' => -1
                );
                $all_tags = new WP_Query( $args_4tags );
                if ($all_tags->have_posts()) {
                    $allall_tags = [];
                    while ($all_tags->have_posts()) { 
                        $all_tags->the_post();
                        
                        
                        $thecontent = get_the_content();
                        $thecontent_decoded = json_decode($thecontent, true) ;
               
                    if(is_array($thecontent_decoded)){
                        $material_content = get_post_field('post_content', $thecontent_decoded[8]);
                        $material_content_decoded = json_decode($material_content, true) ;
                        $s_tag = $material_content_decoded[2];
                        
                    }else{

                        $postTags = get_the_tags();
                        if (is_array($postTags) || is_object($postTags)){
                            foreach( $postTags as $post_tag ) {
                                $s_tag = $post_tag->name;
                            }                
                        }
                    }                        
                        
                ?>
                
                <a href="#<?php echo $s_tag;?>"><span style="width:fit-content" class="mx-2 mb-2 d-flex btn align-items-center justify-content-center" onclick="filterallqs(event)" value="<?php echo $s_tag;?>"><div style="font-size: 18px;" class="dashicons dashicons-tag mr-1"></div><?php echo $s_tag;?></span></a>                

                <?php }
                wp_reset_postdata();
                } ?>

              </div>                                    
                     
                     
                      
             <?php 

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $wp_query_art = new WP_Query(array(
                'post_type'        =>  array('post', 'units'),
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_status'      => 'publish',
                'posts_per_page'   => 10,
                'paged' => $paged
            ));
            while($wp_query_art->have_posts()) {
            $wp_query_art->the_post(); 
             if ($wp_query_art->current_post % 3 === 0) { ?>
                <div class="materials-sidebar hz_matslength sidebar text-white my-4">
                        <?php dynamic_sidebar('hz-sidebar');?>
                </div>
            <?php  } ?>



            <?php //the_excerpt()
            $thecontent = get_the_content();
            $thecontent_decoded = json_decode($thecontent, true) ;

//                            if (json_last_error() === JSON_ERROR_NONE) {
                if(is_array($thecontent_decoded)){
//                                $thecontent_decoded = json_decode($thecontent, true) ;
                    $title = $thecontent_decoded[1];
                    $contents = $thecontent_decoded[3];
                    $material_content = get_post_field('post_content', $thecontent_decoded[8]);
                    $material_content_decoded = json_decode($material_content, true) ;
                    $language = $material_content_decoded[4];
                    $s_tag = $material_content_decoded[2];
                }else{
                    $title = get_the_title();
                    $contents = wp_strip_all_tags( get_the_excerpt(), true );
                    $language = 'Arabic - English';
                    $tags = get_the_tags();
            if (is_array($tags) || is_object($tags)){
                    foreach( $tags as $post_tag ) {
                       $s_tag = $post_tag->name;
                    }}}

$author_id = get_the_author_meta( 'ID' );
?>

<div style="cursor: auto;" class="card mb-5 mt-1 text-white border-0  justify-content-center mpost btn text-left" data-id="<?php echo $i; ?>">
<div class="row no-gutters d-flex align-items-center">
<div class="col-md-2 col-xs-12">
<a href="<?php the_permalink() ?>">
<?php 
if(has_post_thumbnail()){
    the_post_thumbnail('' , ['class' => 'mimg img-thumbnail border-0 bg-transparent float-left rounded ' , 'title' => $title , 'alt' => $title]);
}else{ ?>
    <img src="https://corsorr.com/wp-content/uploads/2019/12/no-image.png" class="mimg img-thumbnail border-0 bg-transparent float-left rounded  wp-post-image" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" sizes="(max-width: 768px) 100vw, 768px">
<?php } ?>

</a>
</div>
<div class="col-md-7  col-xs-12 overflow-hidden">
<div class="card-body">
<h5 class="card-title"><a href="<?php the_permalink() ?>"><?php echo $title ?></a></h5>
<p class="card-text"><?php echo '<div style="white-space:normal" class=" text-break">' . $contents . '</div>'; ?></p>

</div>
</div>
<div class="col-md-3 col-xs-12 overflow-hidden">
<p class="card-text d-flex align-items-center justify-content-center">
<small class="text-muted">
    <span style="font-size: 18px;" class="dashicons dashicons-calendar-alt mr-1"></span>
    <?php the_time ('F j, Y') ?><br>
    <span class="text-capitalize">
       <span style="font-size: 18px;" class="dashicons dashicons-businessman mr-1"></span>
        <a><?php the_author_posts_link() ?></a>
    </span><br>
    <span class="text-capitalize">
        <span style="font-size: 18px;" class="dashicons dashicons-admin-site-alt mr-1"></span>
        <?php echo $language; ?>
    </span><br>
    <span class="text-capitalize post-tags">
        <span style="font-size: 18px;" class="dashicons dashicons-tag mr-1"></span>
                   <?php 
                    if ( ! empty( $s_tag ) ) { ?>
    <a onclick="filterallqs(event)" href="#<?php echo $s_tag; ?>"><?php echo $s_tag; ?></a>                                    
                    <?php } ?>                    
    </span><br>
    <span class="post-date text-capitalize">
        <span style="font-size: 18px;" class="dashicons dashicons-visibility mr-1"></span>
        <?php echo getPostViews(get_the_ID());?>
    </span>
</small>
</p>        
</div>
</div>
</div>                                   
                <?php $i++;
            }?>  

    
            <?php
global $wp_query_art; 
 
       
   
?>
 <?php echo do_shortcode( '[ajax_load_more post_type="post, units" placeholder="true" placeholder="true"]' ); ?>
        </div>
        <div style="background: var(--btn); text-align: center;" class="col-md-3">
            <div class="materials-sidebar sidebar text-white">
                <div class="mat_static">
                    <?php get_sidebar();?>
                </div>
                <div class="mat_dynamic">
                    <?php dynamic_sidebar('mat-sidebar');?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    
function filterallqs(t){var o=window.location.href,e=window.location.hostname+window.location.pathname,n=o.split(e).pop().replace(/#|<(del)(?=[\s>])[\w\W]*?<\/\1\s*>/gi,""),s=$(t.target).text(),i=$(".mpost");$(".mpost").find(".post-tags a").text();if($(".hz_matslength").show(),s!=n){var a=$(".mpost").show().find(".post-tags a:not(:contains("+s+")) ").parents(".mpost").hide();i.length-a.length<3&&$(".hz_matslength").hide(),console.log(i.length-a.length)}}$(document).ready(function(){var t=window.location.href,o=window.location.hostname+window.location.pathname,e=t.split(o).pop().replace(/#|<(del)(?=[\s>])[\w\W]*?<\/\1\s*>/gi,"");$(".mpost").find(".post-tags a").text();$(".mpost .post-tags a:not(:contains("+e+")) ").parents(".mpost").hide("fast")});var seen={};$(".all_tags_above span").each(function(){var t=$(this).text();seen[t]||""==t?$(this).remove():seen[t]=!0}),$(function(){var t=$(".mat_dynamic").offset().top,o=$(".footer").height(),e=$(window).height();$(window).scroll(function(){var n=$(window).scrollTop(),s=$(".mat_dynamic").offset().top-80,i=document.body,a=document.documentElement,h=(Math.max(i.scrollHeight,i.offsetHeight,a.clientHeight,a.scrollHeight,a.offsetHeight),$(".sider_height_detect").height()),c=$(document).height(),l=$(".mpost"),d=$(".mpost:hidden");console.log("sider_height_detect "+h),console.log("document_h "+c),l.length-d.length>=3&&(n>=s&&$(".mat_dynamic").css({position:"fixed",top:"0",width:"min-content"}),n<t&&$(".mat_dynamic").css({position:"unset"}),n-o-e>=t&&$(".mat_dynamic").css({top:"unset",bottom:e-o}),n-o-e<t&&$(".mat_dynamic").css({top:"0",bottom:"unset"}))})});
    
</script>
<?php get_footer();?>