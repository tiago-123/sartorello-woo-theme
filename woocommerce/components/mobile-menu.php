<?php

/**
 * Mobile Off-Canvas Menu for WooCommerce
 *
 * This component provides a mobile menu that can be triggered by clicking the menu icon.
 * It includes navigation links for product categories and other important pages.
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

$user_id = get_current_user_id();
$user_first_name = get_user_meta($user_id, 'billing_first_name', true) ?: wp_get_current_user()->display_name;

$facebook_link = get_option('sartorello_woo_theme_facebook');
$instagram_link = get_option('sartorello_woo_theme_instagram');
$pinterest_link = get_option('sartorello_woo_theme_pinterest');
$youtube_link = get_option('sartorello_woo_theme_youtube');
?>

<div x-data="{ open: false }" x-on:keyup.escape.window="open = false">

    <!-- Menu Icon -->
    <button
        x-on:click="open = !open"
        type="button"
        class="-ml-2 bg-white p-2 text-neutral-800 hover:text-neutral-600 lg:hidden">
        <span class="sr-only">Abrir menu</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Background Overlay -->
    <div
        x-cloak
        x-show="open"
        x-transition.opacity.duration.500ms
        class="fixed inset-0 overflow-hidden bg-black/75 backdrop-blur-[2px] z-999"
        aria-hidden="true">
    </div>

    <!-- Mobile Menu (Off-canvas menu for mobile) -->
    <div
        x-cloak
        x-show="open"
        x-on:click.outside="open = false"
        x-transition:enter="transition transform ease-in-out duration-500"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform ease-in-out duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="flex flex-col w-screen max-w-xs h-full fixed top-0 left-0 overflow-y-auto bg-white shadow-xl z-999999">

        <div class="flex items-center justify-between px-4 pt-5 pb-2">
            <h3 class="text-base font-medium"><?php if (is_user_logged_in() && $user_first_name) echo 'Olá, ' . esc_html($user_first_name) . '!'; ?></h3>
            <button x-on:click="open = false" class="relative flex items-center justify-center ml-3 text-neutral-400 hover:text-neutral-600" type="button">
                <span class="sr-only">Fechar menu</span>
                <svg class="size-6.5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Links -->
        <div
            x-init="$nextTick(() => { selected = location.pathname.split('/')[1] ? location.pathname.split('/')[1] : 'produtos' })"
            x-data="{ selected: null }"
            class="mt-2">
            <div class="border-b border-neutral-200">
                <div class="-mb-px flex space-x-8 px-4">
                    <button
                        id="produtos"
                        x-on:click="selected = $el.id"
                        class="flex-1 border-b-2 px-1 py-4 text-base font-medium whitespace-nowrap"
                        x-bind:class="selected === $el.id ? 'border-red-950 text-red-950' : 'border-transparent text-neutral-600'"
                        type="button">
                        Categorias
                    </button>
                    <button
                        id="minha-conta"
                        x-on:click="selected = $el.id"
                        class="flex-1 border-b-2 px-1 py-4 text-base font-medium whitespace-nowrap"
                        x-bind:class="selected === $el.id ? 'border-red-950 text-red-950' : 'border-transparent text-neutral-600'"
                        type="button">
                        Minha conta
                    </button>
                </div>
            </div>

            <!-- 'Categories' tab panel -->
            <div
                x-show="selected === 'produtos'"
                id="categories-panel"
                class="space-y-6 py-8 px-4">

                <?php $menu_locations = get_nav_menu_locations(); ?>

                <div class="flex flex-col divide-y divide-neutral-200">
                    <a href="<?php echo home_url(); ?>/produtos" class="flex items-center justify-between py-3 text-neutral-700 font-medium">
                        Ver todos os produtos
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                    <h3 class="flex items-center justify-between py-3">
                        <a href="<?php echo esc_url(home_url('outlet')); ?>" class="rounded-full border border-neutral-900 px-4 py-1 font-semibold tracking-wide hover:bg-neutral-900 hover:text-white" role="button">
                            OUTLET
                        </a>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </h3>
                </div>
                <div>
                    <h3 class="mb-4 font-medium text-neutral-800">Móveis</h3>
                    <ul class="flex flex-col divide-y divide-neutral-200">
                        <?php
                        $furniture_menu = wp_get_nav_menu_items($menu_locations['sartorello-woo-theme_furniture'] ?? '');
                        if ($furniture_menu) {
                            foreach ($furniture_menu as $item) {
                        ?>
                                <li>
                                    <a href="<?php echo esc_url($item->url); ?>" class="flex items-center justify-between py-3 text-neutral-500">
                                        <?php echo esc_html($item->title); ?>
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 font-medium text-neutral-800">Decoração</h3>
                    <ul class="flex flex-col divide-y divide-neutral-200">
                        <?php
                        $decoration_menu = wp_get_nav_menu_items($menu_locations['sartorello-woo-theme_decoration'] ?? '');
                        if ($decoration_menu) {
                            foreach ($decoration_menu as $item) {
                        ?>
                                <li>
                                    <a href="<?php echo esc_url($item->url); ?>" class="flex items-center justify-between py-3 text-neutral-500">
                                        <?php echo esc_html($item->title); ?>
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 font-medium text-neutral-800">Iluminação</h3>
                    <ul class="flex flex-col divide-y divide-neutral-200">
                        <?php
                        $lighting_menu = wp_get_nav_menu_items($menu_locations['sartorello-woo-theme_lighting'] ?? '');
                        if ($lighting_menu) {
                            foreach ($lighting_menu as $item) {
                        ?>
                                <li>
                                    <a href="<?php echo esc_url($item->url); ?>" class="flex items-center justify-between py-3 text-neutral-500">
                                        <?php echo esc_html($item->title); ?>
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- 'My Account' tab panel -->
            <div
                x-show="selected === 'minha-conta'"
                id="my-account-panel"
                class="space-y-8 py-8 px-4">
                <?php if (is_user_logged_in()) : ?>
                    <nav class="w-full woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">
                        <ul class="flex flex-col gap-1 flex-nowrap p-4 border border-neutral-300 rounded-lg">
                            <?php foreach (wc_get_account_menu_items() as $endpoint => $label) :
                                $is_selected = wc_is_current_account_menu_item($endpoint);
                            ?>
                                <li class="rounded-md overflow-clip <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                    <a
                                        href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"
                                        class="flex items-center justify-start p-3 text-sm font-medium <?php echo $is_selected ? 'text-gold-600 bg-neutral-50' : 'text-neutral-800' ?> hover:text-gold-500 hover:bg-neutral-50"
                                        <?php echo $is_selected ? 'aria-current="page"' : ''; ?>>
                                        <?php echo esc_html($label); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php else : ?>
                    <div class="space-y-6 p-4">
                        <div>
                            <a
                                href="<?php echo esc_url(wc_get_page_permalink('myaccount') . '#login'); ?>"
                                class="flex items-center justify-center whitespace-nowrap w-full p-4 font-semibold border rounded-sm"
                                role="button">
                                <?php esc_html_e('Login', 'woocommerce'); ?>
                            </a>
                        </div>
                        <div class="relative flex items-center justify-center my-4">
                            <span class="absolute w-full border-b border-neutral-300"></span>
                            <span class="flex items-center justify-center px-3 bg-white z-10">ou</span>
                        </div>
                        <div>
                            <a
                                href="<?php echo esc_url(wc_get_page_permalink('myaccount') . '#cadastro'); ?>"
                                class="flex items-center justify-center whitespace-nowrap w-full p-4 font-semibold border rounded-sm"
                                role="button">
                                <?php esc_html_e('Register', 'woocommerce'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex flex-col gap-6 divide-y divide-neutral-200 border-t border-neutral-200 px-4 py-6">
            <a href="<?php echo esc_url(home_url('contato')); ?>" class="flex items-center justify-between font-medium text-neutral-700">
                FALE CONOSCO
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        <div class="flex flex-col gap-6 divide-y divide-neutral-200 border-t border-neutral-200 px-4 py-6">
            <a href="<?php echo esc_url(home_url('sobre')); ?>" class="flex items-center justify-between font-medium text-neutral-700">
                SOBRE NÓS
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        <div class="border-t border-neutral-200 px-4 py-6">
            <div class="mb-4 flex max-h-7 w-full justify-center overflow-clip">
                <?php if ($logo = get_option('sartorello_woo_theme_logo')) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_url($logo)); ?>" class="h-7 w-auto" />
                <?php else : ?>
                    <h1><?php echo get_bloginfo('name') ?></h1>
                <?php endif; ?>
            </div>
            <div class="flex justify-center gap-4">
                <a href="<?php echo esc_url($instagram_link); ?>" target="_blank" role="button" class="text-neutral-600 hover:text-neutral-800">
                    <span class="sr-only">Instagram</span>
                    <svg class="size-6" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                        <path d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205zM319.7 245.4C360.9 245.2 394.4 278.5 394.6 319.7C394.8 360.9 361.5 394.4 320.3 394.6C279.1 394.8 245.6 361.5 245.4 320.3C245.2 279.1 278.5 245.6 319.7 245.4zM413.1 200.3C413.1 185.5 425.1 173.5 439.9 173.5C454.7 173.5 466.7 185.5 466.7 200.3C466.7 215.1 454.7 227.1 439.9 227.1C425.1 227.1 413.1 215.1 413.1 200.3zM542.8 227.5C541.1 191.6 532.9 159.8 506.6 133.6C480.4 107.4 448.6 99.2 412.7 97.4C375.7 95.3 264.8 95.3 227.8 97.4C192 99.1 160.2 107.3 133.9 133.5C107.6 159.7 99.5 191.5 97.7 227.4C95.6 264.4 95.6 375.3 97.7 412.3C99.4 448.2 107.6 480 133.9 506.2C160.2 532.4 191.9 540.6 227.8 542.4C264.8 544.5 375.7 544.5 412.7 542.4C448.6 540.7 480.4 532.5 506.6 506.2C532.8 480 541 448.2 542.8 412.3C544.9 375.3 544.9 264.5 542.8 227.5zM495 452C487.2 471.6 472.1 486.7 452.4 494.6C422.9 506.3 352.9 503.6 320.3 503.6C287.7 503.6 217.6 506.2 188.2 494.6C168.6 486.8 153.5 471.7 145.6 452C133.9 422.5 136.6 352.5 136.6 319.9C136.6 287.3 134 217.2 145.6 187.8C153.4 168.2 168.5 153.1 188.2 145.2C217.7 133.5 287.7 136.2 320.3 136.2C352.9 136.2 423 133.6 452.4 145.2C472 153 487.1 168.1 495 187.8C506.7 217.3 504 287.3 504 319.9C504 352.5 506.7 422.6 495 452z" />
                    </svg>
                </a>
                <a href="<?php echo esc_url($pinterest_link); ?>" target="_blank" role="button" class="text-neutral-600 hover:text-neutral-800">
                    <span class="sr-only">Pinterest</span>
                    <svg class="size-6" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                        <path d="M332 70.5C229.4 70.5 128 138.9 128 249.6C128 320 167.6 360 191.6 360C201.5 360 207.2 332.4 207.2 324.6C207.2 315.3 183.5 295.5 183.5 256.8C183.5 176.4 244.7 119.4 323.9 119.4C392 119.4 442.4 158.1 442.4 229.2C442.4 282.3 421.1 381.9 352.1 381.9C327.2 381.9 305.9 363.9 305.9 338.1C305.9 300.3 332.3 263.7 332.3 224.7C332.3 158.5 238.4 170.5 238.4 250.5C238.4 267.3 240.5 285.9 248 301.2C234.2 360.6 206 449.1 206 510.3C206 529.2 208.7 547.8 210.5 566.7C213.9 570.5 212.2 570.1 217.4 568.2C267.8 499.2 266 485.7 288.8 395.4C301.1 418.8 332.9 431.4 358.1 431.4C464.3 431.4 512 327.9 512 234.6C512 135.3 426.2 70.5 332 70.5z" />
                    </svg>
                </a>
                <a href="<?php echo esc_url($facebook_link); ?>" target="_blank" role="button" class="text-neutral-600 hover:text-neutral-800">
                    <span class="sr-only">Facebook</span>
                    <svg class="size-6" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                        <path d="M240 363.3L240 576L356 576L356 363.3L442.5 363.3L460.5 265.5L356 265.5L356 230.9C356 179.2 376.3 159.4 428.7 159.4C445 159.4 458.1 159.8 465.7 160.6L465.7 71.9C451.4 68 416.4 64 396.2 64C289.3 64 240 114.5 240 223.4L240 265.5L174 265.5L174 363.3L240 363.3z" />
                    </svg>
                </a>
                <a href="<?php echo esc_url($youtube_link); ?>" role="button" target="_blank" class="text-neutral-600 hover:text-neutral-800">
                    <span class="sr-only">YouTube</span>
                    <svg class="size-6" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                        <path d="M581.7 188.1C575.5 164.4 556.9 145.8 533.4 139.5C490.9 128 320.1 128 320.1 128C320.1 128 149.3 128 106.7 139.5C83.2 145.8 64.7 164.4 58.4 188.1C47 231 47 320.4 47 320.4C47 320.4 47 409.8 58.4 452.7C64.7 476.3 83.2 494.2 106.7 500.5C149.3 512 320.1 512 320.1 512C320.1 512 490.9 512 533.5 500.5C557 494.2 575.5 476.3 581.8 452.7C593.2 409.8 593.2 320.4 593.2 320.4C593.2 320.4 593.2 231 581.8 188.1zM264.2 401.6L264.2 239.2L406.9 320.4L264.2 401.6z" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
</div>