<form role="search" method="get" class="search-form d-flex" action="<?php echo home_url( '/' ); ?>">
<!--    <label class="my-0"></label>-->
<!--        <span class="screen-reader-text"><?php //echo _x( 'Search for:', 'label' ) ?></span>-->
        <input type="search" class="search-field form-control mr-1"
            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    
    <button type="submit" class="search-submit btn">
        <span class="dashicons dashicons-search"></span>
    </button>
</form>