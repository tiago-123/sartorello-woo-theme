<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (! empty($product_tabs)) : ?>

	<div
		x-data="{
			selected: null,			
			select(id) { this.selected = id },
			isSelected(id) { return this.selected === id },
			init() {
				$nextTick(() => { this.selected = 'tab-title-description' })
			}
		}"
		class="woocommerce-tabs wc-tabs-wrapper my-10 rounded-md border border-neutral-200 bg-neutral-50 p-4 sm:p-6 sm:pt-4 lg:my-12">
		<ul class="flex flex-nowrap items-stretch justify-start gap-6" role="tablist">
			<?php foreach ($product_tabs as $key => $product_tab) : ?>
				<li
					id="tab-title-<?php echo esc_attr($key); ?>"
					x-bind:class="isSelected($el.id) ? 'text-neutral-800 border-neutral-900' : 'text-neutral-500 border-transparent'"
					class="border-b-2 py-3 text-sm font-medium text-nowrap whitespace-nowrap">
					<a
						x-on:click="select($el.parentElement.id)"
						href="#tab-<?php echo esc_attr($key); ?>"
						role="tab"
						aria-controls="tab-<?php echo esc_attr($key); ?>">
						<?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ($product_tabs as $key => $product_tab) : ?>
			<div
				x-show="isSelected('tab-title-<?php echo esc_attr($key); ?>')"
				id="tab-<?php echo esc_attr($key); ?>"
				class="pt-6 lg:pt-8 text-sm text-neutral-700 space-y-2"
				role="tabpanel"
				aria-labelledby="tab-title-<?php echo esc_attr($key); ?>">
				<?php
				if (isset($product_tab['callback'])) {
					call_user_func($product_tab['callback'], $key, $product_tab);
				}
				?>
			</div>
		<?php endforeach; ?>

	</div>

<?php endif; ?>