<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

get_header();
?>

<div class="max-w-3xl mx-auto my-12 px-4 sm:px-6 lg:px-8 space-y-4">
    <h1 class="text-3xl font-medium text-center tracking-wide uppercase">Página não encontrada</h1>
    <h3 class="text-7xl font-thin text-center">404</h3>
    <p class="text-sm font-light text-center">Uma situação inesperada resultou no código de erro 404. Por favor, utilize o menu principal para navegar em nosso site ou clique no botão abaixo para retornar para a página inicial.</p>
    <div class="mt-8 text-center">
        <a
            class="text-sm font-medium border-b hover:text-gold-600 hover:border-gold-600"
            href="<?php echo esc_url(home_url()); ?>"
            role="button">
            <span aria-hidden="true">← </span>
            Retornar ao início
        </a>
    </div>
</div>

<?php
get_footer();
