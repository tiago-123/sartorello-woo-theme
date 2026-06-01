<?php

/**
 * Order again button
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-again.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;
?>

<p class="order-again">
    <a
        href="<?php echo esc_url($order_again_url); ?>"
        class="flex items-center justify-center w-full my-4 px-4 py-3 text-sm font-medium text-white border border-neutral-900 rounded-md bg-neutral-900 hover:bg-neutral-700">
        <?php esc_html_e('Order again', 'woocommerce'); ?>
    </a>
</p>