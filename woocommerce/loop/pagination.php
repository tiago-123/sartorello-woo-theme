<?php

/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$total_pages = wc_get_loop_prop('total_pages') ?? 1;
$current_page = wc_get_loop_prop('current_page') ?? 1;

if ($total_pages < 2) return;

$range = 2; // Number of pages to show before and after the current page
$start = max(1, $current_page - $range); // Lower bound
$end = min($total_pages, $current_page + $range); // Upper bound
$page_list = range($start, $end);

?>

<nav class="flex items-start justify-between gap-4 mt-12 text-sm font-medium text-neutral-600 border-t border-neutral-200 woocommerce-pagination">
    <div class="previous flex flex-1 justify-start">
        <?php if ($current_page > 1) : ?>
            <a class="inline-flex items-center gap-1 pt-4 px-2 border-t-2 border-transparent whitespace-nowrap hover:text-neutral-800 hover:border-neutral-600" href="<?php echo esc_url(get_pagenum_link($current_page - 1)); ?>">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <?php echo esc_html__('Previous', 'woocommerce'); ?>
            </a>
        <?php endif; ?>
    </div>

    <ol class="flex flex-wrap justify-center">
        <?php
        // First page + leading ellipses
        if (!in_array(1, $page_list)) {
            echo '<li><a class="inline-flex items-center pt-4 px-4 border-t-2 border-transparent hover:text-neutral-800 hover:border-neutral-600" href="' . esc_url(get_pagenum_link(1)) . '">1</a></li>';
            if ($page_list[0] > 2) {
                echo '<span class="inline-flex items-center pt-4 px-4 border-t-2 border-transparent">…</span>';
            }
        }
        // Numbered page links
        foreach ($page_list as $page) {
            if ($page === $current_page) {
                echo '<li class="inline-flex items-center pt-4 px-4 text-gold-700 border-t-2 border-gold-700"><span>' . $page . '</span></li>';
            } else {
                echo '<li><a class="inline-flex items-center pt-4 px-4 border-t-2 border-transparent hover:text-neutral-800 hover:border-neutral-600" href="' . esc_url(get_pagenum_link($page)) . '">' . $page . '</a></li>';
            }
        }
        // Last page + trailing ellipses
        if (!in_array($total_pages, $page_list)) {
            if (end($page_list) < $total_pages - 1) {
                echo '<span class="inline-flex items-center pt-4 px-4 border-t-2 border-transparent">…</span>';
            }
            echo '<li><a class="inline-flex items-center pt-4 px-4 border-t-2 border-transparent hover:text-neutral-800 hover:border-neutral-600" href="' . esc_url(get_pagenum_link($total_pages)) . '">' . $total_pages . '</a></li>';
        }
        ?>
    </ol>

    <div class="next flex flex-1 justify-end">
        <?php if ($current_page < $total_pages) : ?>
            <a class="inline-flex items-center gap-1 pt-4 px-2 border-t-2 border-transparent whitespace-nowrap hover:text-neutral-800 hover:border-neutral-600" href="<?php echo esc_url(get_pagenum_link($current_page + 1)); ?>">
                <?php echo esc_html__('Next', 'woocommerce'); ?>
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </a>
        <?php endif; ?>
    </div>
</nav>