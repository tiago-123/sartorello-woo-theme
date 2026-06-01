<?php

/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>
	<h2 class="mb-8 pb-4 text-2xl font-semibold border-b border-neutral-200">Meus Pedidos</h2>

	<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-8 xl:grid-cols-3 woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<?php
		foreach ($customer_orders->orders as $customer_order) :
			$order = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		?>
			<div class="flex text-sm border border-neutral-200 rounded-lg bg-white overflow-hidden woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr($order->get_status()); ?> order">
				<h3 class="sr-only">Pedido número <?php echo esc_html($order->get_order_number()); ?></h3>
				<dl class="flex flex-col w-full font-medium">
					<div class="flex items-center justify-between gap-3 pl-6 pr-4 py-4 border-b border-neutral-200 bg-neutral-50">
						<a class="flex items-center justify-start border-b-2 border-transparent hover:border-neutral-600" href="<?php echo esc_url($order->get_view_order_url()); ?>" aria-label="<?php echo esc_attr(sprintf(__('View order number %s', 'woocommerce'), $order->get_order_number())); ?>">
							<dt>Pedido #</dt>
							<dd class="font-bold text-neutral-700"><?php echo esc_html($order->get_order_number()); ?></dd>
						</a>
						<?php
						$actions = wc_get_account_orders_actions($order);
						if (!empty($actions)) :
						?>
							<div x-data="{open: false}" class="actions relative">
								<span class="sr-only">Ações do pedido <?php echo esc_html($order->get_order_number()); ?></span>
								<button x-on:click="open = !open" class="flex items-center justify-center hover:text-neutral-800" type="button">
									<svg class="size-6.5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
									</svg>
								</button>
								<div x-cloak x-transition x-show="open" x-on:click.outside="open = false" class="absolute right-0 z-10 w-35 mt-1 p-2 border border-neutral-300 rounded-md shadow-lg bg-white" role="menu">
									<?php
									foreach ($actions as $key => $action) :
										if (empty($action['aria-label'])) : $action_aria_label = sprintf(__('%1$s order number %2$s', 'woocommerce'), $action['name'], $order->get_order_number());
										else : $action_aria_label = $action['aria-label'];
										endif;
									?>
										<a
											href="<?php echo esc_url($action['url']); ?>"
											class="block px-3 py-1 font-medium text-neutral-700 rounded-md hover:text-neutral-800 hover:bg-neutral-50 focus:bg-neutral-50 focus:outline-none"
											aria-label="<?php echo esc_attr($action_aria_label) ?>"
											role="menuitem">
											<?php echo esc_html($action['name']); ?>
										</a>
									<?php
										unset($action_aria_label);
									endforeach;
									?>
								</div>
							</div>
						<?php endif; ?>

					</div>
					<div class="px-6 py-4 space-y-4">
						<div class="flex items-center justify-between gap-3">
							<dt>Data</dt>
							<dd class="text-neutral-600"><time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created(), 'd/m/Y')); ?></time></dd>
						</div>
						<div class="flex items-center justify-between gap-3">
							<dt>Total</dt>
							<dd class="text-neutral-600"><?php echo wp_kses_post($order->get_formatted_order_total()); ?></dd>
						</div>
						<div class="flex items-center justify-between gap-3">
							<dt>Status</dt>
							<?php
							$status = $order->get_status();
							$status_class = match ($status) {
								'processing' 			=> 'bg-green-50 text-green-700 border-green-600/20',
								'pending', 'on-hold'    => 'bg-yellow-50 text-yellow-800 border-yellow-600/20',
								'completed', 'refunded' => 'bg-blue-50 text-blue-700 border-blue-700/20',
								'cancelled', 'failed'   => 'bg-red-50 text-red-700 border-red-600/15',
								default 				=> 'bg-neutral-50 text-neutral-600 border-neutral-500/15',
							};
							?>
							<dd class="flex items-center justify-center px-2 py-1 text-xs font-medium text-center border rounded-sm <?php echo esc_attr($status_class) ?>"><?php echo esc_html(wc_get_order_status_name($status)); ?></dd>
						</div>
					</div>
				</dl>
			</div>
		<?php endforeach; ?>
	</div>

	<?php do_action('woocommerce_before_account_orders_pagination'); ?>

	<?php if (1 < $customer_orders->max_num_pages) : ?>
		<nav class="flex items-center justify-between mt-8 text-sm text-neutral-600 border-t border-neutral-200 woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<div class="hidden sm:block">
				<p class="pt-4">Página <span class="font-medium"><?php echo esc_html($current_page); ?></span> de <span class="font-medium"><?php echo esc_html($customer_orders->max_num_pages); ?></span></p>
			</div>
			<div class="flex flex-1 items-center justify-between gap-4 sm:justify-end">
				<div class="previous flex">
					<?php if (1 !== $current_page) : ?>
						<a class="pt-4 pr-1 font-medium hover:text-neutral-800 border-t-2 border-transparent hover:border-neutral-600 woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button<?php echo esc_attr($wp_button_class); ?>" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>">
							<?php echo '← ' . esc_html__('Previous', 'woocommerce'); ?>
						</a>
					<?php endif; ?>
				</div>
				<div class="next flex">
					<?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
						<a class="pt-4 pl-1 font-medium hover:text-neutral-800 border-t-2 border-transparent hover:border-neutral-600 woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button<?php echo esc_attr($wp_button_class); ?>" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>">
							<?php echo esc_html__('Next', 'woocommerce') . ' →'; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</nav>
	<?php endif; ?>

<?php else : ?>

	<?php wc_print_notice(esc_html__('No order has been made yet.', 'woocommerce') . ' <a class="woocommerce-Button wc-forward button' . esc_attr($wp_button_class) . '" href="' . esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) . '">' . esc_html__('Browse products', 'woocommerce') . '</a>', 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment 
	?>

<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>