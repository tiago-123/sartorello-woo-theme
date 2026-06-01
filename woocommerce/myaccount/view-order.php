<?php

/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.6.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$actions = wc_get_account_orders_actions($order);
if (isset($actions['view'])) {
    unset($actions['view']);
}

$notes = $order->get_customer_order_notes();

// We make sure the order belongs to the user. This will also be true if the user is a guest, and the order belongs to a guest (userID === 0).
$show_customer_details = $order->get_user_id() === get_current_user_id();
?>

<div class="flex flex-col items-start sm:flex-row sm:items-center gap-4 mb-8 pb-4 border-b border-neutral-200">
    <h2 class="text-2xl font-semibold">Pedido #<?php echo esc_html($order->get_order_number()); ?></h2>
    <div class="flex flex-1 flex-col items-start sm:flex-row sm:items-center justify-between gap-4">
        <?php
        $status = $order->get_status();
        $status_class = match ($status) {
            'processing'            => 'bg-green-50 text-green-700 border-green-600/20',
            'pending', 'on-hold'    => 'bg-yellow-50 text-yellow-800 border-yellow-600/20',
            'completed', 'refunded' => 'bg-blue-50 text-blue-700 border-blue-700/20',
            'cancelled', 'failed'   => 'bg-red-50 text-red-700 border-red-600/15',
            default                 => 'bg-neutral-50 text-neutral-600 border-neutral-500/15',
        };
        ?>
        <span class="order-2 sm:order-1 flex items-center justify-center px-2 py-1 text-xs font-medium text-center whitespace-nowrap border rounded-sm <?php echo esc_attr($status_class) ?>"><?php echo esc_html(wc_get_order_status_name($status)); ?></span>
        <p class="order-1 sm:order-2 text-sm text-neutral-600">Pedido realizado em <time class="font-semibold" datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time></p>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-10 lg:gap-10">

    <div class="order-2 lg:order-1 lg:col-span-5 1360px:col-span-6">
        <?php wc_get_template('order/order-details.php', ['order' => $order]); ?>
    </div>

    <div class="order-1 space-y-6 lg:order-2 lg:col-span-5 1360px:col-span-4">

        <?php
        if (!empty($actions)) {
            wc_get_template('order/order-actions.php', ['order' => $order, 'actions' => $actions]);
        }

        if ($show_customer_details) {
            wc_get_template('order/order-details-customer.php', ['order' => $order]);
        }

        if ($notes) {
            wc_get_template('order/order-notes.php', ['notes' => $notes]);
        }

        remove_action('woocommerce_view_order', 'woocommerce_order_details_table');
        do_action('woocommerce_view_order', $order_id);
        ?>
    </div>
</div>