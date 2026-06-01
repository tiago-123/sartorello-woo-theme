<?php

/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<div
    x-data="{ open: false, isMobile: window.innerWidth < 1024 }"
    x-init="if (!isMobile) open = true">

    <div
        x-on:click="isMobile ? open = !open : null"
        x-bind:class="isMobile ? 'mb-2 rounded-md border border-neutral-300 bg-neutral-50 p-4' : 'mb-4'"
        class="relative flex items-center justify-between">

        <h2 class="text-base font-semibold">Dados do pedido</h2>        
        <span x-show="isMobile" x-bind:class="open ? 'rotate-180' : ''" class="transition-transform duration-200">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
            </svg>
        </span>
    </div>

    <div x-cloak x-transition x-show="open" class="divide-y divide-neutral-300 rounded-md border border-neutral-300 text-sm">
        <div class="flex items-start justify-start gap-6 p-4">
            <span class="min-w-20 font-medium">E-mail</span>
            <span><?php echo esc_html($order->get_billing_email()); ?></span>
        </div>
        <div class="flex items-start justify-start gap-6 p-4">
            <span class="min-w-20 font-medium">Celular</span>
            <span><?php echo esc_html($order->get_billing_phone()); ?></span>
        </div>
        <div class="flex items-start justify-start gap-6 p-4">
            <span class="min-w-20 font-medium">Entrega</span>
            <address class="not-italic!">
                <?php
                if ($show_shipping) :

                    echo wp_kses_post($order->get_formatted_shipping_address(esc_html__('N/A', 'woocommerce')));

                    do_action('woocommerce_order_details_after_customer_address', 'shipping', $order);

                else :

                    echo wp_kses_post($order->get_formatted_billing_address(esc_html__('N/A', 'woocommerce')));

                    do_action('woocommerce_order_details_after_customer_address', 'billing', $order);

                endif;
                ?>
            </address>
        </div>
        <?php if ($customer_note = $order->get_customer_note()) : ?>
            <div class="flex items-start justify-start gap-6 p-4">
                <span class="min-w-20 font-medium">Observação</span>
                <span><?php echo wp_kses_post($customer_note); ?></span>
            </div>
        <?php endif; ?>
        <div class="flex items-start justify-start gap-6 p-4">
            <span class="min-w-20 font-medium">Pagamento</span>
            <span><?php echo wp_kses_post($order->get_payment_method_title()); ?></span>
        </div>
    </div>

    <?php do_action('woocommerce_order_details_after_customer_details', $order); ?>
</div>