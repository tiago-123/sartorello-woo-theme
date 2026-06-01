<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
    return;
}

$main_image_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
?>

<li class="card relative group snap-start opacity-0 transition-opacity duration-1000 ease-in-out" x-intersect:enter="$el.classList.remove('opacity-0')">
    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="flex flex-col text-sm p-2 sm:p-2.75 border border-transparent hover:border-neutral-500 rounded-md">
        <div class="relative aspect-square rounded-sm overflow-clip">
            <?php if ($main_image_id && count($gallery_image_ids) > 0) : ?>
                <img
                    class="absolute size-full aspect-square object-cover pointer-events-none transition ease-in-out duration-500 opacity-100 group-hover:opacity-0 group-hover:scale-104"
                    src="<?php echo esc_url(wp_get_attachment_image_url($main_image_id, 'medium')); ?>"
                    srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($main_image_id, 'medium')); ?>"
                    sizes="<?php echo esc_attr(wp_get_attachment_image_sizes($main_image_id, 'medium')); ?>"
                    alt="<?php echo esc_attr(get_post_meta($main_image_id, '_wp_attachment_image_alt', true)); ?>"
                    loading="lazy"
                    decoding="async">
                <img
                    class="absolute size-full aspect-square object-cover pointer-events-none transition ease-in-out duration-500 opacity-0 group-hover:opacity-100 group-hover:scale-104"
                    src="<?php echo esc_url(wp_get_attachment_image_url($gallery_image_ids[0], 'medium')); ?>"
                    srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($gallery_image_ids[0], 'medium')); ?>"
                    sizes="<?php echo esc_attr(wp_get_attachment_image_sizes($gallery_image_ids[0], 'medium')); ?>"
                    alt="<?php echo esc_attr(get_post_meta($gallery_image_ids[0], '_wp_attachment_image_alt', true)); ?>"
                    loading="lazy"
                    decoding="async">
            <?php else : ?>
                <img
                    class="size-full aspect-square object-cover pointer-events-none transition ease-in-out duration-500 group-hover:scale-104"
                    <?php if ($main_image_id) : ?>
                    src="<?php echo esc_url(wp_get_attachment_image_url($main_image_id, 'medium')); ?>"
                    srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($main_image_id, 'medium')); ?>"
                    sizes="<?php echo esc_attr(wp_get_attachment_image_sizes($main_image_id, 'medium')); ?>"
                    alt="<?php echo esc_attr(get_post_meta($main_image_id, '_wp_attachment_image_alt', true)); ?>"
                    <?php else : ?>
                    src="<?php echo esc_url(wc_placeholder_img_src('medium')); ?>"
                    alt="<?php echo esc_attr__('Placeholder', 'woocommerce'); ?>"
                    <?php endif; ?>
                    loading="lazy"
                    decoding="async">
            <?php endif; ?>
        </div>
        <div class="mt-3 flex flex-col gap-1.5">
            <h2 class="text-sm transition-colors duration-300 hover:text-gold-600 md:text-base"><?php echo esc_html($product->get_name()); ?></h2>
            <?php wc_get_template('loop/price.php'); ?>
            <?php wc_get_template('components/product-discount-and-installments.php'); ?>
            <?php wc_get_template('loop/sale-badge.php'); ?>
        </div>
    </a>
</li>