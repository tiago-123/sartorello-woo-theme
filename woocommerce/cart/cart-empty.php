<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
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

do_action( 'woocommerce_cart_is_empty' );
?>

<div class="relative w-full h-dvh bg-cover bg-center" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/frontend/img/empty_cart_bg.jpg' ?>');">
	<div class="relative flex flex-col items-center justify-center size-full px-4 sm:px-6 lg:px-8">
		<h1 class="text-4xl font-semibold tracking-tight"><?php esc_html_e('Your cart is currently empty.', 'woocommerce'); ?></h1>
		<p class="mt-4 text-sm md:text-base">Adicione produtos ao carrinho para visualizar aqui.</p>
		<?php if (wc_get_page_id('shop') > 0) : ?>
			<p class="return-to-shop">
				<a role="button" class="flex items-center justify-center mt-6 px-6 py-3 text-base font-medium text-white bg-red-950 rounded-md hover:bg-red-900" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
					<?php
					/**
					 * Filter "Return To Shop" text.
					 *
					 * @since 4.6.0
					 * @param string $default_text Default text.
					 */
					echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce')));
					?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</div>