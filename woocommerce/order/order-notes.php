<?php

/**
 * Custom Template: My Account Order Notes
 * 
 * This template is used to display system or admin-generated order notes for a specific order in the My Account section.
 * Not to be confused with the customer-provided note, which is displayed inside the order-details-customer.php
 */

declare(strict_types=1);
defined('ABSPATH') || exit;
?>

<div x-data="{ open: false }">

    <div x-on:click="open = !open" class="relative flex cursor-pointer items-center justify-between rounded-md border border-neutral-300 bg-neutral-50 p-4">
        <h3 class="text-base font-semibold"><?php esc_html_e('Order updates', 'woocommerce'); ?></h3>
        <span x-bind:class="open ? 'rotate-180' : ''" class="transition-transform duration-200">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
            </svg>
        </span>
    </div>

    <ol x-cloak x-collapse x-show="open" class="mt-4 space-y-2">
        <?php foreach ($notes as $index => $note) : ?>
            <li class="relative flex items-start justify-start gap-4">
                <div class="w-6 flex shrink-0 flex-col items-center justify-start gap-2">
                    <span class="size-2 overflow-clip border border-neutral-300 rounded-full bg-neutral-100"></span>
                    <span class="absolute top-4 bottom-0 w-px bg-neutral-200"></span>
                </div>
                <?php $margin = count($notes) === $index + 1 ? '' : 'mb-4'; ?>
                <div class="<?php echo esc_attr($margin); ?> p-3 border border-neutral-200 rounded-md">
                    <p class="text-xs text-neutral-500"><time datetime="<?php echo esc_attr(date('c', strtotime($note->comment_date))); ?>"><?php echo esc_html(date_i18n('l, d \d\e F \d\e Y, H:i', strtotime($note->comment_date))); ?></time></p>
                    <div class="mt-2 text-sm text-neutral-600">
                        <?php echo wp_kses_post(wpautop(wptexturize($note->comment_content))); ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>

</div>