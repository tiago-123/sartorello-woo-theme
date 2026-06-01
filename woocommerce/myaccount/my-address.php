<?php

/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$addresses = [
	'billing'  => __('Billing address', 'woocommerce'),
	'shipping' => __('Shipping address', 'woocommerce'),
];

if (wc_ship_to_billing_address_only() || !wc_shipping_enabled()) {
	unset($addresses['shipping']);
}
?>

<div class="mb-8 pb-4 border-b border-neutral-200">
	<h2 class="text-2xl font-semibold">Meus Endereços</h2>
	<p class="mt-3 text-sm text-neutral-600"><?php esc_html_e('The following addresses will be used on the checkout page by default.', 'woocommerce'); ?></p>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-10">
	<?php foreach ($addresses as $address_type => $address_title) : ?>

		<?php $address = wc_get_account_formatted_address($address_type); ?>

		<div class="woocommerce-address">
			<header class="address-title flex items-center justify-between gap-4 mb-4">
				<h3 class="font-semibold"><?php echo esc_html($address_title); ?></h3>
				<a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $address_type)); ?>" class="text-sm font-medium text-neutral-600 underline hover:text-neutral-800">
					<?php $address ? esc_html_e('Edit', 'woocommerce') : printf(esc_html__('Add %s', 'woocommerce'), esc_html(strtolower($address_title))); ?>
				</a>
			</header>
			<address class="p-4 text-sm not-italic! border border-neutral-200 rounded-lg bg-neutral-50">
				<?php
				echo $address ? wp_kses_post($address) : esc_html_e('You have not set up this type of address yet.', 'woocommerce');

				/**
				 * Used to output content after core address fields.
				 *
				 * @param string $address_type Address type.
				 * @since 8.7.0
				 */
				do_action('woocommerce_my_account_after_my_address', $address_type);
				?>
			</address>
		</div>

	<?php endforeach; ?>
</div>