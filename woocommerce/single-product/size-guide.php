<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

global $product;

if (!$product || !$product->is_visible()) {
    return;
}

if (!has_term('mesas-de-jantar', 'product_cat', $product->get_id())) {
    return;
}

$link = 'https://www.sartorello.com.br/guia-de-tamanhos-mesas-de-jantar.pdf';
?>

<div class="mt-4">
    <a href="<?php echo esc_url($link); ?>" role="button" class="text-sm font-medium capitalize border-b hover:text-gold-500" target="_blank">Guia de tamanhos para mesas de jantar</a>
</div>