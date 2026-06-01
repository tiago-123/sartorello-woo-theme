<?php

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$customer = WC()->customer;
$first_name = $customer->get_first_name();
?>

<div id="my-account-header" class="mt-10 mb-8 flex flex-col items-start justify-center gap-4 sm:mb-10">
    <h1 class="text-4xl sm:text-5xl capitalize"><?php the_title(); ?></h1>
    <p class="text-base sm:text-lg font-light">Olá<span><?php if ($first_name) echo esc_html(' ' . $first_name); ?></span>, estamos felizes em ter você aqui!</p>
</div>

<div class="flex gap-16">
    <!-- My Account Nav for mobile devices is rendered inside the Mobile Menu -->
    <!-- Desktop Nav -->
    <div class="hidden lg:flex w-1/4">
        <?php do_action('woocommerce_account_navigation'); ?>
    </div>

    <div class="flex flex-1 flex-col woocommerce-MyAccount-content">
        <?php
        /**
         * My Account content.
         *
         * @since 2.6.0
         */
        do_action('woocommerce_account_content');
        ?>
    </div>

</div>