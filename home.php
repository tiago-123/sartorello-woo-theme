<?php

/**
 * Wordpress default template for displaying the blog posts index page.
 */

declare(strict_types=1);
defined('ABSPATH') || exit;


get_header();
?>

<main class="mx-auto max-w-1440px px-4 sm:px-6 lg:px-8">

    <div class="border-b border-neutral-200 py-10">
        <h1 class="text-4xl sm:text-6xl font-serif font-medium italic text-center">Blog Sartorello® Móveis</h1>
        <p class="mt-4 text-lg text-neutral-600 tracking-wider italic text-center">Design & Inspiração</p>
    </div>

    <section class="pt-10 pb-24" aria-label="Blog Posts">
        <ul x-data class="grid grid-cols-1 gap-x-4 gap-y-6 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-12">

            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
            ?>
                    <li class="group relative flex flex-col rounded-md border border-transparent p-2 opacity-0 transition-opacity duration-1000 ease-in-out hover:border-neutral-500 sm:p-2.75" x-intersect:enter="$el.classList.remove('opacity-0')">

                        <div class="relative rounded-sm overflow-clip">
                            <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', ['class' => 'size-full aspect-3/2 object-cover pointer-events-none transition ease-in-out duration-500 group-hover:scale-104']); ?>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="mt-4 flex flex-col items-start gap-3">
                            <?php $category = !empty(get_the_category()) ? get_the_category()[0] : null; ?>
                            <?php if ($category) : ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="text-xs tracking-wider uppercase font-medium hover:underline"><?php echo esc_html($category->name); ?></a>
                            <?php endif; ?>
                            <h2 class="font-serif text-2xl italic transition-colors duration-300 hover:text-gold-600">
                                <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                            </h2>
                            <p class="text-sm text-justify"><?php echo esc_html(get_the_excerpt()); ?></p>
                        </div>
                    </li>
            <?php
                }
            }
            ?>

        </ul>
        <style>
            .navigation {
                border-top: 1px solid #e5e7eb;
                margin-top: 3rem;
            }

            .navigation .nav-links {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }

            .navigation .page-numbers {
                display: inline-flex;
                align-items: center;
                border-top: 2px solid transparent;
                padding: 1rem 1rem 0;
                font-size: 0.875rem;
                font-weight: 500;
                color: oklch(44.6% 0.03 256.802);
                text-decoration: none;
                transition: color 0.3s, border-color 0.3s;
            }

            .navigation .page-numbers:hover {
                border-color: oklch(44.6% 0.03 256.802);
                color: oklch(27.8% 0.033 256.848);
            }

            .navigation .page-numbers.current {
                border-color: #7f1d1d;
                color: #7f1d1d;
            }

            .navigation .prev.page-numbers,
            .navigation .next.page-numbers {
                border-top: 2px solid transparent;
                padding-top: 1rem;
                padding-inline: 0.25rem;
                font-size: 0.875rem;
                font-weight: 500;
                color: oklch(44.6% 0.03 256.802);
            }

            .navigation .prev.page-numbers:hover,
            .navigation .next.page-numbers:hover {
                border-color: oklch(44.6% 0.03 256.802);
                color: oklch(27.8% 0.033 256.848);
            }

            .navigation .dots {
                border-color: transparent;
                color: oklch(44.6% 0.03 256.802);
            }
        </style>
        <?php
        the_posts_pagination([
            'mid_size' => 3,
            'prev_text' => '← Anterior',
            'next_text' => 'Próximo →',
            'screen_reader_text' => 'Navegação de posts',
        ]);
        ?>
    </section>
</main>

<?php
get_footer();
