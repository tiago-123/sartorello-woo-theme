<?php

declare(strict_types=1);
defined('ABSPATH') || exit;
?>

<div
	x-data="{
		min: item.quantity_limits.minimum,
		max: item.quantity_limits.maximum,
		step: item.quantity_limits.multiple_of
	}"
	class="flex flex-row flex-nowrap gap-0 items-center border border-neutral-300 rounded-sm">

	<button x-on:click="if (item.quantity > min) $nextTick(() => { $refs.inputField.dispatchEvent(new Event('input')) }); item.quantity = Math.max(min, (item.quantity - step));" type="button" class="size-9 flex items-center justify-center">
		<svg viewBox="0 -960 960 960" width="22px" height="22px" fill="currentColor">
			<path d="M240-460v-40h480v40H240Z" />
		</svg>
	</button>

	<input
		x-ref="inputField"
		x-model.number="item.quantity"
		x-on:input.debounce.900ms="updateItem(item.key, item.quantity)"
		x-bind:min="min"
		x-bind:max="max"
		x-bind:step="step"
		class="flex-1 size-9 text-base font-semibold text-center align-middle"
		name="quantity"
		type="number"
		inputmode="numeric"
		autocomplete="off">

	<button x-on:click="if (item.quantity < max) $nextTick(() => { $refs.inputField.dispatchEvent(new Event('input')) }); item.quantity = Math.min(max, (item.quantity + step));" type="button" class="size-9 flex items-center justify-center">
		<svg viewBox="0 -960 960 960" width="22px" height="22px" fill="currentColor">
			<path d="M460-460H240v-40h220v-220h40v220h220v40H500v220h-40v-220Z" />
		</svg>
	</button>

</div>