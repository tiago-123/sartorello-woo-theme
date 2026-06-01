<?php

/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_reset_password_form');
?>

<form method="post" class="max-w-lg mx-auto my-10 woocommerce-ResetPassword lost_reset_password">

	<p class="mb-4"><?php echo apply_filters('woocommerce_reset_password_message', esc_html__('Enter a new password below.', 'woocommerce')); ?></p>

	<div x-data="{active: false}" class="relative flex items-center justify-start h-13 mb-3 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
		<label
			:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
			class="absolute pointer-events-none transition-all ease-in-out duration-200"
			for="password_1">
			<?php esc_html_e('New password', 'woocommerce'); ?>
		</label>
		<input @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="password" name="password_1" id="password_1" autocomplete="new-password" required aria-required="true" />
	</div>
	<div x-data="{active: false}" class="relative flex items-center justify-start h-13 mb-3 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
		<label
			:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
			class="absolute pointer-events-none transition-all ease-in-out duration-200"
			for="password_2">
			<?php esc_html_e('Re-enter new password', 'woocommerce'); ?>
		</label>
		<input @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="password" name="password_2" id="password_2" autocomplete="new-password" required aria-required="true" />
	</div>

	<input type="hidden" name="reset_key" value="<?php echo esc_attr($args['key']); ?>" />
	<input type="hidden" name="reset_login" value="<?php echo esc_attr($args['login']); ?>" />

	<?php do_action('woocommerce_resetpassword_form'); ?>

	<div class="mb-8">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="flex items-center justify-center w-full mt-8 p-4 rounded-sm text-sm font-semibold text-white bg-neutral-900 hover:bg-neutral-700" value="<?php esc_attr_e('Save', 'woocommerce'); ?>"><?php esc_html_e('Save', 'woocommerce'); ?></button>
	</div>

	<?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

</form>
<?php
do_action('woocommerce_after_reset_password_form');
