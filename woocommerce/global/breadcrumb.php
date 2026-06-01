<?php

/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

declare(strict_types=1);
defined('ABSPATH') || exit;

if (!empty($breadcrumb)) {

	echo $wrap_before;
?>

	<ol class="flex items-center flex-wrap gap-y-1 space-x-2 py-6 text-xs font-medium">

		<?php
		foreach ($breadcrumb as $key => $crumb) {

			echo '<li class="inline-flex">';

			if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1) {
				echo '<a href="' . esc_url($crumb[1]) . '" class="mr-2 hover:text-gold-500" role="button">' . esc_html($crumb[0]) . '</a>';
				echo '<span aria-hidden="true" class="text-neutral-300">\</span>';
			} else {
				echo '<span aria-current="page" class="text-neutral-500">' . esc_html($crumb[0]) . '</span>';
			}

			echo '</li>';
		}
		?>

	</ol>

<?php
	echo $wrap_after;
}
