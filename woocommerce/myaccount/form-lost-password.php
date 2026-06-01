<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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

declare(strict_types=1);
defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>

<form method="post" class="max-w-lg mx-auto my-10 woocommerce-ResetPassword lost_reset_password">

	<p class="mb-4"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine 
																																																															?>
	<div x-data="{active: false}" class="relative flex items-center justify-start h-13 mt-6 mb-6 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
		<label
			:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
			class="absolute pointer-events-none transition-all ease-in-out duration-200"
			for="user_login">
			E-mail
		</label>
		<input @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
	</div>

	<?php do_action('woocommerce_lostpassword_form'); ?>

	<div class="mb-8">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="flex items-center justify-center w-full mt-8 p-4 rounded-sm text-sm font-semibold text-white bg-neutral-900 hover:bg-neutral-700" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>
	</div>

	<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

</form>

<?php
do_action('woocommerce_after_lost_password_form');
