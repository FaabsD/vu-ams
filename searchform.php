<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label class="screen-reader-text">
        <?php echo _x( 'Search for:', 'label' ) ?>
    </label>

    <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    
    <button type="submit" class="search-btn" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
    </button>
</form>
 