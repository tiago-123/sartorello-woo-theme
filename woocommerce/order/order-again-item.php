<?php

/** 
 * Custom template for displaying the "Add To Cart" button for a specific order item.
 * This allows users to quickly reorder individual items from their past orders.
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$_product = $item->get_product();

if ($order->get_status() === 'completed' && $_product->is_purchasable() && $_product->is_in_stock()) :

    $attributes = array();
    foreach ($item->get_all_formatted_meta_data() as $meta_id => $meta) {
        if (strpos($meta->key, 'pa_') === 0) {
            $key = 'attribute_' . sanitize_title($meta->key);
            $attributes[$key] = $meta->value;
        }
    }

    $query_args = array_merge(
        [
            'add-to-cart' => $_product->get_id(),
            'quantity' => $item->get_quantity(),
        ],
        $attributes
    );

    $current_url = is_order_received_page()
        ? $order->get_checkout_order_received_url()
        : wc_get_endpoint_url('view-order', $order->get_id());

    $url = add_query_arg($query_args, $current_url);
?>

    <a
        href="<?php echo esc_url($url); ?>"
        class="flex items-center justify-center mt-4 px-2 py-1 text-xs font-medium text-center border border-neutral-200 rounded-sm bg-white hover:bg-neutral-50">
        <?php echo esc_html($_product->add_to_cart_text()); ?>
    </a>

<?php
endif;
