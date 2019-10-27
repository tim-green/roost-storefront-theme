<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Declaring WooCommerce support in Roost
 */

function roost_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_theme_setup', 'roost_add_woocommerce_support' );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}


/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

//Roost Footer Credit is here
if ( ! function_exists( 'storefront_credit' ) ) {
    /**
     * Display the theme credit
     *
     * @since  1.0.0
     * @return void
     */
    function storefront_credit() {
        $links_output = '';

        if ( apply_filters( 'storefront_credit_link', true ) ) {
            $links_output .= '<a href="https://timgreen.ws" target="_blank" title="' . esc_attr__( 'WooCommerce - The Best eCommerce Platform for WordPress', 'storefront' ) . '" rel="author">' . esc_html__( 'Built with Roost &amp; WooCommerce', 'storefront' ) . '</a>.';
        }

        if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
            $separator = '<span role="separator" aria-hidden="true"></span>';
            $links_output = get_the_privacy_policy_link( '', ( ! empty( $links_output ) ? $separator : '' ) ) . $links_output;
        }
        
        $links_output = apply_filters( 'storefront_credit_links_output', $links_output );
        ?>
        <div class="site-info">
            <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>

            <?php if ( ! empty( $links_output ) ) { ?>
                <br />
                <?php echo wp_kses_post( $links_output ); ?>
            <?php } ?>
        </div><!-- .site-info -->
        <?php
    }
}

