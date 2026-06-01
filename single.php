<?php

declare(strict_types=1);
defined('ABSPATH') || exit;


get_header();
?>
<main class="max-w-1440px mx-auto px-4 sm:px-6 lg:px-8">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();

            echo '<div class="border-b border-neutral-200 py-10">';
            echo '<h1 class="text-3xl font-bold tracking-tight">';
            the_title();
            echo '</h1>';
            echo '</div>';

            echo '<section class="my-4">';
            the_post_thumbnail('full', ['class' => 'size-full aspect-video object-cover pointer-events-none rounded-md']);
            echo '</section>';

            echo '<section class="my-8 text-sm space-y-3">';
            the_content();
            echo '</section>';
        }
    }
    ?>
    <div class="mt-8">
        <a
            class="text-sm font-medium underline underline-offset-6 hover:text-gold-600"
            href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
            role="button">
            <span aria-hidden="true">← </span>
            Retornar ao início
        </a>
    </div>
</main>

<?php
get_footer();
