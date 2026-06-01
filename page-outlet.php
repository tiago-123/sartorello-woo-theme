<?php

declare(strict_types=1);
defined('ABSPATH') || exit;


get_header();
?>

<main class="mx-auto max-w-1440px px-4 sm:px-6 lg:px-8">

    <?php
    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    do_action('woocommerce_before_main_content');
    ?>

    <!-- Page Title -->
    <div class="border-b border-neutral-200 py-10">
        <h1 class="text-5xl font-serif font-medium italic"><?php echo get_the_title(); ?></h1>
    </div>

    <?php
    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    do_action('woocommerce_before_shop_loop');
    ?>

    <!-- The Loop -->
    <section class="pt-10 pb-24" aria-label="Product List">

        <?php
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post__in' => wc_get_product_ids_on_sale(),
            'orderby' => [
                'popularity' => 'DESC',
            ],
        ];

        $_products = new WP_Query($args);

        if ($_products->have_posts()) {
        ?>

            <ul x-data class="grid grid-cols-2 gap-x-4 gap-y-6 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-12">

                <?php
                while ($_products->have_posts()) {
                    $_products->the_post();

                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
                ?>

            </ul>

        <?php
            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>

    </section>

    <?php
    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    do_action('woocommerce_after_main_content');
    ?>

</main>

<?php
get_footer();
