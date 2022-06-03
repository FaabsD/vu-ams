<?php wp_footer(); ?>
<footer class="footer">
    <div class="footer__top">
        <?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'footer_address' ); ?>
            <?php dynamic_sidebar( 'footer_sitemap' ); ?>
        <?php endif; ?>

        <div class="footer__heart-rate">
            <svg version="1.1" id="Laag_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 0 326.9 118.8">
                <g id="a">
                    <path d="M248.9,70h-12.6l-2.7-10.4c-0.4-1.3-1.2-1.3-1.4-1.3c-0.2,0-1,0.1-1.4,1.3l-0.1,0.2l-4.7,12.2h-4.6l-2.7,30.9
		l-3.2-0.2c-0.2-4.7-0.4-9.9-0.6-15.3c0,0,0,0,0,0c0-0.5-0.1-1.1-0.1-1.6c-0.1-2.9-0.3-6-0.4-9c-0.6-14.4-1.4-29.1-2-39.9l-4.9,48.3
		l-2.2-8.3c-0.8-3-2.1-6.2-2.6-6.9H190l-2.7-10.4c-0.4-1.3-1.2-1.3-1.4-1.3c-0.2,0-1,0.1-1.4,1.3l-0.1,0.2l-4.7,12.2h-4.6l-2.7,30.9
		l-3.2-0.2c-0.2-4.7-0.4-9.9-0.6-15.3c0,0,0,0,0,0c0-0.5-0.1-1.1-0.1-1.6c-0.1-2.9-0.3-6-0.4-9c-0.6-14.4-1.4-29.1-2-39.9l-4.9,48.3
		l-2.2-8.3c-0.8-3-2-6.2-2.6-6.9h-14.7l-2.7-9.4c-0.4-1.3-1.2-1.3-1.4-1.3c-0.2,0-1,0.1-1.4,1.3l-0.1,0.2L131.4,73h-4.7l-2.7,30.9
		l-3.2-0.2c-0.2-4.7-0.4-9.9-0.6-15.3c0,0,0,0,0,0c0-0.5-0.1-1.1-0.1-1.6c-0.1-2.9-0.3-6-0.4-9c-0.7-14.4-1.4-29.1-2-39.9l-4.9,50.3
		l-2.2-8.3c-0.8-3-2.1-6.2-2.7-6.9h-0.5c-3.4-0.2-4.5-0.4-5.1-0.8c-1.8-1.3-2.9-3.8-3.8-6c-0.5-1.2-1.3-3.1-1.7-3.1
		c-0.8-0.1-1.1,0.5-2.1,2.6c-0.4,0.8-0.8,1.7-1.3,2.5C92.2,70,90.1,72,88.2,72H77.9v-4.6h10.3c0.8,0,2.1-1.1,2.9-2.4
		c0.3-0.6,0.7-1.2,1-2c0.9-2,2.2-4.8,4.8-4.6c2.2,0.1,3.3,2.9,4.3,5.3c0.7,1.7,1.5,3.6,2.5,4.2c0.4,0.2,2.9,0.3,3.9,0.4l0.7,0.1
		c1,0.1,2,1.1,2.9,3l5.4-55.5l2.3,3.1c0.5,0.7,1.5,2.1,3.8,51.9l0,0v0c0.1,2.5,0.2,5.1,0.3,7.8V79l0-0.3l0.7-7.4
		c0.1-1.6,1.1-2.8,2.2-2.8h3.6l3.7-9.8c0.8-2.5,2.4-4,4.3-4h0c1.9,0,3.6,1.6,4.3,4.2l1.9,6.6h12.4c1,0.1,2.4,1.1,3.4,3.1L165,15
		l2.3,3.1c0.5,0.7,1.5,2.1,3.8,51.9v0l0,0c0.1,2.5,0.2,5.1,0.3,7.8V78l0-0.3l0.7-7.4c0.1-1.6,1.1-2.8,2.2-2.8h3.6l3.7-9.8
		c0.8-2.5,2.4-4,4.3-4h0c1.9,0,3.6,1.6,4.3,4.2l1.9,7.5h10c1,0.1,2.8,1.1,3.7,3.1l5.4-53.5l2.3,3.1c0.5,0.7,1.5,2.1,3.8,51.9v0l0,0
		c0.1,2.5,0.2,5.1,0.4,7.8V78l0-0.3l0.7-7.4c0.1-1.6,1.1-2.8,2.2-2.8h3.6l3.7-9.8c0.8-2.5,2.4-4,4.3-4h0c1.9,0,3.6,1.6,4.3,4.2
		l1.9,7.5h10.5"/>
                </g>
            </svg>
            <div class="fade-in"></div>
            <div class="fade-out"></div>
        </div>

        <?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'footer_call_to_action' ); ?>
        <?php endif; ?>
    </div>
    <div class="footer__bottom">
        &copy;<?php echo date( 'Y' ) ?>

        <?php
        $footer_text = dynamic_sidebar( 'footer_bottom' ); ?>
    </div>
</footer>
</body>
</html>