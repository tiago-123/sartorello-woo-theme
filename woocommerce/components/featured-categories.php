<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

$featured_categories = get_terms([
    'taxonomy'  => 'product_cat',
    'slug'      => [
        'aparadores',
        'bancos-e-recamiers',
        'banquetas',
        'cadeiras',
        'mesas-de-jantar',
        'poltronas',
    ],
    'orderby' => 'name',
    'order'   => 'ASC',
]);

if (is_wp_error($featured_categories)) {
    $featured_categories = [];
}
?>

<div>
    <ul x-data="{}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        <?php
        foreach ($featured_categories as $category) {
            if (!$category) continue;
        ?>

            <li class="relative group opacity-0 transition-opacity duration-1000 ease-in-out" x-intersect:enter="$el.classList.remove('opacity-0')">
                <a href="<?php echo get_term_link($category); ?>" class="flex flex-col rounded-xs overflow-clip">
                    <div class="relative aspect-square overflow-clip">
                        <?php
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        echo wp_get_attachment_image($thumbnail_id, 'medium', false, [
                            'class' => 'absolute size-full aspect-square object-cover pointer-events-none transition ease-in-out duration-6000 group-hover:scale-120',
                            'loading' => 'lazy',
                            'decoding' => 'async',
                        ]);
                        ?>
                    </div>
                    <p class="p-2 uppercase font-medium text-xs w-full tracking-wide text-center bg-gold-100 group-hover:underline group-hover:text-gold-600"><?php echo $category->name; ?></p>
                </a>
            </li>

        <?php } ?>

    </ul>
</div>