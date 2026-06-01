<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

global $product;

$main_image_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
// Add the main image ID to the beginning of the gallery image IDs array
array_unshift($gallery_image_ids, $main_image_id);
// Filter out any empty values
$gallery_image_ids = array_filter($gallery_image_ids);
?>

<div
	id="product-image-gallery"
	class="lg:sticky lg:top-8 flex flex-col sm:flex-row-reverse select-none"
	x-data="{
		imagesCount: <?php echo esc_js(count($gallery_image_ids)); ?>,
		index: 0,
		prev() { this.index = this.index === 0 ? this.imagesCount - 1 : this.index - 1 },
		next() { this.index = this.index === this.imagesCount - 1 ? 0 : this.index + 1 },		
	}"
	x-on:keydown.left.prevent=""
	x-on:keydown.right.prevent=""
	x-on:keyup.left="prev()"
	x-on:keyup.right="next()">

	<!-- Featured Image -->
	<div class="relative flex flex-1 items-start sm:min-w-4/5">
		<div
			id="featured-image"
			class="relative w-full aspect-square sm:rounded-lg overflow-clip"
			<?php if (!empty($gallery_image_ids) && count($gallery_image_ids) > 1) : ?>
			x-data="{
					startX: 0,
					startY: 0,
					endX: 0,
					isDragging: false,
					threshold: 40,
					handleStart(e) {
						this.isDragging = true;
						this.startX = e.touches ? e.touches[0].clientX : e.clientX;
						this.startY = e.touches ? e.touches[0].clientY : e.clientY;
					},
					handleMove(e) {
						if (!this.isDragging) return;
						const currentX = e.touches ? e.touches[0].clientX : e.clientX;
						const currentY = e.touches ? e.touches[0].clientY : e.clientY;
						const diffX = Math.abs(currentX - this.startX);
						const diffY = Math.abs(currentY - this.startY);
						// Block scrolling if movement is predominantly horizontal
						if (diffX > diffY) {
							e.preventDefault();
						}
					},
					handleEnd(e) {
						if (!this.isDragging) return;
						this.endX = e.changedTouches ? e.changedTouches[0].clientX : e.clientX;
						if (this.endX < (this.startX - this.threshold)) next();
						if (this.endX > (this.startX + this.threshold)) prev();
						this.isDragging = false;
						this.startX = 0;
						this.startY = 0;
						this.endX = 0;
					},
				}"
			x-on:touchstart="handleStart($event)"
			x-on:touchmove="handleMove($event)"
			x-on:touchend="handleEnd($event)"
			x-on:mousedown.prevent="handleStart($event)"
			x-on:mouseup.prevent="handleEnd($event)"
			x-on:mouseleave="handleEnd($event)"
			<?php endif; ?>>

			<?php if (!empty($gallery_image_ids)) : ?>
				<?php foreach ($gallery_image_ids as $index => $image_id) : ?>
					<img
						<?php if ($index === 0) echo 'fetchpriority="high"'; ?>
						<?php if ($index > 0) echo 'x-cloak decoding="async"'; ?>
						x-show="index === <?php echo esc_js($index); ?>"
						x-transition.opacity.duration.500ms
						class="absolute size-full object-cover pointer-events-none"
						src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')) ?>"
						srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($image_id, 'full')); ?>"
						sizes="<?php echo esc_attr(wp_get_attachment_image_sizes($image_id, 'full')); ?>"
						alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>">
				<?php endforeach; ?>
			<?php else : ?>
				<img
					class="absolute size-full object-cover pointer-events-none"
					src="<?php echo esc_url(wc_placeholder_img_src('full')); ?>"
					alt="<?php echo esc_attr__('Placeholder', 'woocommerce'); ?>">
			<?php endif; ?>

		</div>
		<?php if (!empty($gallery_image_ids) && count($gallery_image_ids) > 1) : ?>
			<button x-on:click="prev()" class="absolute inset-y-0 left-0 flex items-center justify-center" type="button">
				<svg class="size-10" viewBox="0 -960 960 960" fill="inherit">
					<path d="M560-267.69 347.69-480 560-692.31 588.31-664l-184 184 184 184L560-267.69Z" />
				</svg>
			</button>
			<button x-on:click="next()" class="absolute inset-y-0 right-0 flex items-center justify-center" type="button">
				<svg class="size-10" viewBox="0 -960 960 960" fill="inherit">
					<path d="m531.69-480-184-184L376-692.31 588.31-480 376-267.69 347.69-296l184-184Z" />
				</svg>
			</button>
		<?php endif; ?>
	</div>
	<!-- End Featured Image -->

	<!-- Thumbnails -->
	<?php if (!empty($gallery_image_ids) && count($gallery_image_ids) > 1) : ?>

		<div
			x-cloak
			x-data="{
				slider: document.getElementById('thumbnail-slider'),
				showPrevBtn: false,
				showNextBtn: true,
				offset: 0,
				direction() { return window.innerWidth >= 640 ? { 'top': this.offset , 'left': 0 } : { 'top': 0, 'left': this.offset }; },
				slideBack() {
					let direction = this.direction();
					this.slider.scrollBy({ top: -(direction.top), left: -(direction.left), behavior: 'smooth' });
				},
				slideForw() {
					let direction = this.direction();
					this.slider.scrollBy({ top: direction.top, left: direction.left, behavior: 'smooth' });
				},
			}"
			id="thumbnail-slider-container"
			class="relative flex flex-row flex-nowrap sm:flex-col sm:max-w-1/5">

			<div id="thumbnail-slider" class="relative overflow-auto flex flex-row flex-nowrap justify-start size-full snap-x snap-mandatory sm:flex-col sm:snap-y hide-scrollbar">

				<?php foreach ($gallery_image_ids as $index => $image_id) : ?>
					<div
						x-on:click="index = <?php echo esc_js($index); ?>"
						x-effect="if (index === <?= esc_js($index); ?>) $el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' })"
						class="thumbnail-slide cursor-pointer aspect-square rounded-md overflow-clip snap-start transition-opacity ease-in-out duration-500"
						:class="index === <?php echo esc_js($index); ?> ? 'opacity-100' : 'opacity-45 hover:opacity-100'"
						<?php if ($index === 0) echo 'x-resize="offset = $width" x-intersect:enter="showPrevBtn = false" x-intersect:leave="showPrevBtn = true"'; ?>
						<?php if ($index === count($gallery_image_ids) - 1) echo 'x-intersect:enter="showNextBtn = false" x-intersect:leave="showNextBtn = true"'; ?>
						role="button">
						<img
							class="size-full object-cover pointer-events-none"
							src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'thumbnail')); ?>"
							srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($image_id, 'thumbnail')); ?>"
							sizes="<?php echo esc_attr(wp_get_attachment_image_sizes($image_id, 'thumbnail')); ?>"
							alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
							decoding="<?php echo $index === 0 ? 'sync' : 'async'; ?>">
					</div>
				<?php endforeach; ?>

			</div>
			<button x-on:click="slideBack()" x-show="showPrevBtn" class="absolute inset-y-0 left-0 flex items-center justify-center bg-white/30 backdrop-blur-[2px] sm:inset-y-auto sm:right-0 sm:top-0" type="button">
				<svg class="size-5.5 sm:size-6 sm:rotate-90" viewBox="0 -960 960 960" fill="inherit">
					<path d="M560-267.69 347.69-480 560-692.31 588.31-664l-184 184 184 184L560-267.69Z" />
				</svg>
			</button>
			<button x-on:click="slideForw()" x-show="showNextBtn" class="absolute inset-y-0 right-0 flex items-center justify-center bg-white/30 backdrop-blur-[2px] sm:inset-y-auto sm:left-0 sm:bottom-0" type="button">
				<svg class="size-5.5 sm:size-6 sm:rotate-90" viewBox="0 -960 960 960" fill="inherit">
					<path d="m531.69-480-184-184L376-692.31 588.31-480 376-267.69 347.69-296l184-184Z" />
				</svg>
			</button>
		</div>

	<?php endif; ?>
	<!-- End Thumbnails -->

</div>