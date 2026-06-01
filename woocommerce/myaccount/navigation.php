<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

do_action('woocommerce_before_account_navigation');
?>

<nav class="w-full woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">
	<ul class="flex flex-col gap-1 flex-nowrap p-4 border border-neutral-300 rounded-lg">
		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) :
			$is_selected = wc_is_current_account_menu_item($endpoint);
		?>
			<li class="rounded-md overflow-clip <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<a
					href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"
					class="flex items-center justify-start p-3 text-sm font-medium <?php echo $is_selected ? 'text-gold-600 bg-neutral-50' : 'text-neutral-800' ?> hover:text-gold-500 hover:bg-neutral-50"
					<?php echo $is_selected ? 'aria-current="page"' : ''; ?>>
					<?php echo esc_html($label); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>