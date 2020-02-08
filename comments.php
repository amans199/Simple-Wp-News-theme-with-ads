<?php if($comments) : ?>
	<ol>
  	<?php foreach($comments as $comment) : ?>
		<li id="comment-<?php comment_ID(); ?>" class="mt-4">
			<?php if ($comment->comment_approved == '0') : ?>
				<p><?php _e('Your comment is awaiting approval' , 'corsorr') ?></p>
			<?php endif; ?>
			<?php comment_text(); ?>
			<cite><?php comment_type(); ?> by <?php the_author() ?> on <?php comment_date(); ?> at <?php comment_time(); ?></cite>
		</li>
		  <hr class="comment-separator">

	<?php endforeach; ?>
	</ol>
<?php else : ?>
	<p><?php _e('No comments yet' , 'corsorr') ?></p>
<?php endif; ?>
   
   
   <?php
    if (comments_open()) { ?>
        
        <h3 class="comments-count"> <?php comments_number('0 comments' , '1 comment' , '% comments') ?> </h3>
        <?php
        

        echo '<hr class="comment-separator">';
                          

$commentform_arguments = array(
    'fields' => apply_filters(
        'comment_form_default_fields', array(
            'author' =>'<p class="comment-form-author">' . '<input class="form-control" id="author" placeholder="Your Name (No Keywords)" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
                '<label for="author">' . __( 'Your Name' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' )  .
                '</p>'
                ,
            'email'  => '<p class="comment-form-email">' . '<input id="email" class="form-control" placeholder="your-real-email@example.com" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' />'  .
                '<label for="email">' . __( 'Your Email' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) 
                 .
                '</p>',
            'url'    => '<p class="comment-form-url">' .
             '<input id="url" class="form-control" name="url" placeholder="http://your-site-name.com" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
            '<label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
               '</p>'
        )
    ),
    'comment_field' => '<p class="comment-form-comment">' .
        '<label for="comment">' . __( 'Feel free to comment below:' ) . '</label>' .
        '<textarea id="comment" class="form-control" name="comment" placeholder="Express your thoughts, idea or write a feedback by clicking here & start an awesome comment" cols="45" rows="8" aria-required="true"></textarea>' .
        '</p>',
    'comment_notes_after' => '',
    'class_submit' => 'btn btn-primary'
);

        comment_form($commentform_arguments);
                          
    } else {
        echo 'sorry comments are disabled';
    }