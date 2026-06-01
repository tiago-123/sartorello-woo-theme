<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.5.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

/**
 * Hook - woocommerce_before_edit_account_form.
 *
 * @since 2.6.0
 */
do_action('woocommerce_before_edit_account_form');
?>

<h2 class="mb-8 pb-4 text-xl font-semibold border-b border-neutral-200"><?php esc_html_e('Edit account', 'woocommerce'); ?></h2>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

    <?php do_action('woocommerce_edit_account_form_start'); ?>

    <div class="flex flex-col items-start justify-start gap-4 w-full max-w-2xl mb-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4 w-full">
            <div class="w-full">
                <label class="block w-full text-sm font-medium" for="account_first_name"><?php esc_html_e('First name', 'woocommerce'); ?>&nbsp;<span class="required text-red-700" aria-hidden="true">*</span></label>
                <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" aria-required="true" />
            </div>
            <div class="w-full">
                <label class="block w-full text-sm font-medium" for="account_last_name"><?php esc_html_e('Last name', 'woocommerce'); ?>&nbsp;<span class="required text-red-700" aria-hidden="true">*</span></label>
                <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" aria-required="true" />
            </div>
        </div>

        <div class="w-full">
            <label class="block w-full text-sm font-medium" for="account_display_name"><?php esc_html_e('Display name', 'woocommerce'); ?>&nbsp;<span class="required text-red-700" aria-hidden="true">*</span></label>
            <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="text" name="account_display_name" id="account_display_name" aria-describedby="account_display_name_description" value="<?php echo esc_attr($user->display_name); ?>" aria-required="true" />
            <div class="mt-1 text-xs text-neutral-500" id="account_display_name_description"><?php esc_html_e('This will be how your name will be displayed in the account section and in reviews', 'woocommerce'); ?></div>
        </div>

        <div class="w-full">
            <label class="block w-full text-sm font-medium" for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required text-red-700" aria-hidden="true">*</span></label>
            <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="email" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" aria-required="true" />
        </div>
    </div>

    <?php
    /**
     * Hook where additional fields should be rendered.
     *
     * @since 8.7.0
     */
    do_action('woocommerce_edit_account_form_fields');
    ?>

    <fieldset class="flex flex-col gap-4 w-full max-w-2xl p-4 border border-neutral-300 rounded-sm bg-neutral-50">
        <legend class="px-3 font-semibold"><?php esc_html_e('Password change', 'woocommerce'); ?></legend>

        <div class="w-full">
            <label class="block w-full text-sm font-medium" for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
            <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="password" name="password_current" id="password_current" autocomplete="current-password" />
        </div>
        <div class="w-full">
            <label class="block w-full text-sm font-medium" for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
            <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="password" name="password_1" id="password_1" autocomplete="new-password" />
        </div>
        <div class="w-full">
            <label class="block w-full text-sm font-medium" for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
            <input class="block w-full mt-2 px-3 py-2 border border-neutral-500 rounded-sm bg-white" type="password" name="password_2" id="password_2" autocomplete="new-password" />
        </div>
    </fieldset>

    <?php
    /**
     * My Account edit account form.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_edit_account_form');
    ?>

    <div>
        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
        <button type="submit" class="mt-6 px-4 py-3 text-sm font-medium text-white rounded-sm bg-neutral-900 hover:bg-neutral-700" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
        <input type="hidden" name="action" value="save_account_details" />
    </div>

    <?php do_action('woocommerce_edit_account_form_end'); ?>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>