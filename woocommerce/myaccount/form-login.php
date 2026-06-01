<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$registration_enabled = 'yes' === get_option('woocommerce_enable_myaccount_registration');

do_action('woocommerce_before_customer_login_form');
?>

<div
	x-init="$nextTick(() => { selected = location.hash ? location.hash.substring(1) : 'login' })"
	x-data="{
		selected: null,
		select(id) { this.selected = id },
		isSelected(id) { return this.selected === id },
	}"
	class="max-w-lg mx-auto my-10">

	<ul class="flex items-center justify-between gap-6 mb-8">
		<li class="flex flex-1">
			<button
				id="login"
				x-on:click="select($el.id)"
				x-bind:class="isSelected($el.id) ? 'text-white border-neutral-900 bg-neutral-900' : 'border-neutral-300 bg-white'"
				class="flex items-center justify-center whitespace-nowrap w-full p-4 font-semibold border rounded-sm"
				type="button"><?php esc_html_e('Login', 'woocommerce'); ?>
			</button>
		</li>
		<?php if ($registration_enabled) : ?>
			<li class="flex flex-1">
				<button
					id="cadastro"
					x-on:click="select($el.id)"
					x-bind:class="isSelected($el.id) ? 'text-white border-neutral-900 bg-neutral-900' : 'border-neutral-300 bg-white'"
					class="flex items-center justify-center whitespace-nowrap w-full p-4 font-semibold border rounded-sm"
					type="button"><?php esc_html_e('Register', 'woocommerce'); ?>
				</button>
			</li>
		<?php endif; ?>
	</ul>

	<div>

		<form x-show="isSelected('login')" class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
			<h2 class="mb-6 text-lg font-semibold">Login</h2>

			<?php do_action('woocommerce_login_form_start'); ?>

			<div
				x-init="if ($refs.username.value !== '') active = true" x-data="{active: false}"
				class="relative flex items-center justify-start h-13 mt-6 mb-6 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
				<label
					:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
					class="absolute pointer-events-none transition-all ease-in-out duration-200"
					for="username">
					E-mail
				</label>
				<input x-ref="username" @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required aria-required="true" />
			</div>
			<div
				x-init="if ($refs.password.value !== '') active = true" x-data="{active: false}"
				class="relative flex items-center justify-start h-13 mb-3 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
				<label
					:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
					class="absolute pointer-events-none transition-all ease-in-out duration-200"
					for="password">
					<?php esc_html_e('Password', 'woocommerce'); ?>
				</label>
				<input x-ref="password" @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
			</div>

			<?php do_action('woocommerce_login_form'); ?>

			<div class="mb-8">
				<label class="flex items-center justify-start gap-2 cursor-pointer woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="cursor-pointer woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					<span class="flex-1 text-sm text-left"><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
				</label>
				<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
				<button class="woocommerce-form-login__submit flex items-center justify-center w-full h-13 mt-8 p-4 rounded-sm text-base font-semibold text-white bg-neutral-900 hover:bg-neutral-700 focus:outline-none" type="submit" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
			</div>

			<div class="woocommerce-LostPassword lost_password flex items-center">
				<a class="text-sm font-medium underline hover:text-gold-500" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
			</div>

			<?php do_action('woocommerce_login_form_end'); ?>

		</form>

		<?php if ($registration_enabled) : ?>

			<form x-show="isSelected('cadastro')" method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
				<h2 class="mb-6 text-lg font-semibold"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

				<?php do_action('woocommerce_register_form_start'); ?>

				<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
					<div
						x-init="if ($refs.reg_username.value !== '') active = true" x-data="{active: false}"
						class="relative flex items-center justify-start h-13 mt-6 mb-6 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
						<label
							:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
							class="absolute pointer-events-none transition-all ease-in-out duration-200"
							for="reg_username">
							<?php esc_html_e('Username', 'woocommerce'); ?>
						</label>
						<input x-ref="reg_username" @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required aria-required="true" />
					</div>
				<?php endif; ?>

				<div
					x-init="if ($refs.reg_email.value !== '') active = true" x-data="{active: false}"
					class="relative flex items-center justify-start h-13 mt-6 mb-6 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
					<label
						:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
						class="absolute pointer-events-none transition-all ease-in-out duration-200"
						for="reg_email">
						<?php esc_html_e('Email address', 'woocommerce'); ?>
					</label>
					<input x-ref="reg_email" @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="email" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" required aria-required="true" />
				</div>

				<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

					<div
						x-init="if ($refs.reg_password.value !== '') active = true" x-data="{active: false}"
						class="relative flex items-center justify-start h-13 mb-3 px-3 py-1 border border-neutral-500 rounded-sm bg-white">
						<label
							:class="active ? 'top-1 text-xs text-neutral-800' : 'text-sm text-neutral-500'"
							class="absolute pointer-events-none transition-all ease-in-out duration-200"
							for="reg_password">
							<?php esc_html_e('Password', 'woocommerce'); ?>
						</label>
						<input x-ref="reg_password" @focus="active = true" @blur="active = $el.value !== ''" :class="active ? 'pt-4.5' : ''" class="size-full focus:outline-none" type="password" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
					</div>

				<?php else : ?>

					<p class="mb-3 text-xs text-neutral-500"><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

				<?php endif; ?>

				<div class="text-xs text-neutral-500">
					<?php do_action('woocommerce_register_form'); ?>
				</div>

				<div class="mb-8">
					<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
					<button type="submit" class="woocommerce-form-register__submit flex items-center justify-center w-full h-13 mt-8 p-4 rounded-sm text-base font-semibold text-white bg-neutral-900 hover:bg-neutral-700" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
				</div>

				<?php do_action('woocommerce_register_form_end'); ?>

			</form>

		<?php endif; ?>

	</div>

</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>