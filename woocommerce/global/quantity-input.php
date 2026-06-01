<?php

/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

/* translators: %s: Quantity. */
$label = ! empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'woocommerce'), wp_strip_all_tags($args['product_name'])) : esc_html__('Quantity', 'woocommerce');

$min_value = isset($min_value) && $min_value >= 0 ? $min_value : 1;
$max_value = isset($max_value) && $max_value > 0 ? $max_value : 99;
$step = isset($step) && $step > 0 ? $step : 1;

$size = is_cart() ? 'size-9' : 'size-10';
?>

<div
	x-data="{
		qty: <?php echo esc_js($input_value); ?>,
		min: <?php echo esc_js($min_value); ?>,
		max: <?php echo esc_js($max_value); ?>,
		step: <?php echo esc_js($step); ?>,
		<?php if (is_cart()) : ?>
		updateCartButton: document.querySelector('button[name=\'update_cart\']'),
		updateCart() { if (this.updateCartButton) this.updateCartButton.click(); },
		<?php endif; ?>
	}"
	class="quantity flex flex-row flex-nowrap gap-0 items-center mr-auto border border-neutral-300 rounded-sm">

	<button x-on:click="qty = Math.max(min, (qty - step)); $refs.input.dispatchEvent(new Event('change', { bubbles: true }));" type="button" class="<?php echo esc_attr($size); ?> flex items-center justify-center">
		<svg viewBox="0 -960 960 960" width="23px" height="23px" fill="inherit">
			<path d="M240-460v-40h480v40H240Z" />
		</svg>
	</button>

	<label class="sr-only" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>
	<input
		x-ref="input"
		<?php if (is_cart()) : ?>
		x-on:change.debounce.900ms="updateCart()"
		<?php endif; ?>
		x-model.number="qty"
		type="<?php echo esc_attr($type); ?>"
		id="<?php echo esc_attr($input_id); ?>"
		class="<?php echo esc_attr($size); ?> qty flex-1 text-base font-semibold text-center align-middle"
		name="<?php echo esc_attr($input_name); ?>"
		value="<?php echo esc_attr($input_value); ?>"
		aria-label="<?php esc_attr_e('Product quantity', 'woocommerce'); ?>"
		min="<?php echo esc_attr($min_value); ?>"
		max="<?php echo esc_attr($max_value); ?>"
		<?php echo $readonly ? 'readonly="readonly"' : ''; ?>
		<?php if (!$readonly) : ?>
		step="<?php echo esc_attr($step); ?>"
		inputmode="numeric"
		autocomplete="off"
		<?php endif; ?>>

	<button x-on:click="qty = Math.min(max, (qty + step)); $refs.input.dispatchEvent(new Event('change', { bubbles: true }));" type="button" class="<?php echo esc_attr($size); ?> flex items-center justify-center">
		<svg viewBox="0 -960 960 960" width="23px" height="23px" fill="inherit">
			<path d="M460-460H240v-40h220v-220h40v220h220v40H500v220h-40v-220Z" />
		</svg>
	</button>

</div>
<?php
