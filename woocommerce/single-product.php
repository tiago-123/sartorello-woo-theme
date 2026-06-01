<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

declare(strict_types=1);
defined('ABSPATH') || exit;


get_header();

echo '<main class="mx-auto max-w-1440px px-4 sm:px-6 lg:px-8">';

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
do_action('woocommerce_before_main_content');


while (have_posts()) {
	the_post();
	wc_get_template_part('content', 'single-product');
}

/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end');
do_action('woocommerce_after_main_content');

echo '</main>';

get_footer();
