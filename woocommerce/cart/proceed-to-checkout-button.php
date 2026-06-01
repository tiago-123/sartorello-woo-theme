<?php

/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

declare(strict_types=1);
defined('ABSPATH') || exit;
?>

<a
	href="<?php echo esc_url(wc_get_checkout_url()); ?>"
	role="button"
	class="checkout-button flex items-center justify-center w-full mt-4 px-8 py-3 text-base font-medium tracking-wider uppercase text-white border border-transparent rounded-sm bg-neutral-900 hover:bg-neutral-700">
	Finalizar a compra
</a>