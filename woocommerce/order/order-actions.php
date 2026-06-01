<?php

/**
 * Custom Template: My Account Order Actions
 */

declare(strict_types=1);
defined('ABSPATH') || exit;
?>

<div x-data="{ open: false }" class="rounded-md border border-neutral-300 bg-neutral-50 p-4">

    <div x-on:click="open = !open" class="relative flex items-center justify-between cursor-pointer">
        <h3 class="text-base font-semibold"><?php esc_html_e('Actions', 'woocommerce'); ?></h3>
        <span x-bind:class="open ? 'rotate-180' : ''" class="transition-transform duration-200">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
            </svg>
        </span>
        <span class="absolute -inset-2"></span>
    </div>

    <div x-cloak x-transition x-show="open" class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
        <?php
        foreach ($actions as $key => $action) :
            if (empty($action['aria-label'])) :
                $action_aria_label = sprintf(__('%1$s order number %2$s', 'woocommerce'), $action['name'], $order->get_order_number());
            else :
                $action_aria_label = $action['aria-label'];
            endif;
            $action_class = match ($key) {
                'pay'   => 'text-white border-neutral-900 bg-neutral-900 hover:bg-neutral-700',
                default => 'text-neutral-700 border-neutral-300 bg-white hover:bg-neutral-50',
            };
        ?>
            <a
                href="<?php echo esc_url($action['url']); ?>"
                class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium border rounded-md <?php echo esc_attr($action_class); ?>"
                aria-label="<?php echo esc_attr($action_aria_label) ?>"
                role="menuitem">
                <?php echo esc_html($action['name']); ?>
            </a>
        <?php endforeach; ?>
    </div>

</div>