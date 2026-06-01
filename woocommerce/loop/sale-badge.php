<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

global $product;

if ($product->is_on_sale()) {

	$max_percentage = 0;

	if ($product->is_type('simple')) {
		$regular_price = $product->get_regular_price();
		$sale_price = $product->get_sale_price();
		if ($regular_price > 0) {
			$max_percentage = (($regular_price - $sale_price) / $regular_price) * 100;
		}
	} elseif ($product->is_type('variable')) {
		foreach ($product->get_children() as $child_id) {
			$variation = wc_get_product($child_id);
			$price = $variation->get_regular_price();
			$sale = $variation->get_sale_price();
			if ($price > 0 && !empty($sale)) {
				$percentage = (($price - $sale) / $price) * 100;
				if ($percentage > $max_percentage) {
					$max_percentage = $percentage;
				}
			}
		}
	}

	if ($max_percentage > 0) {
		echo '<span class="absolute top-2 left-2 flex items-center justify-center text-xs text-white bg-neutral-900 size-10 rounded-full" aria-label="Etiqueta de desconto em porcentagem">-' . esc_html(round($max_percentage)) . '%</span>';
	}
}
