"use strict";

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import intersect from '@alpinejs/intersect';
import resize from '@alpinejs/resize';

// Search module
import search from './modules/search.js';
Alpine.data('search', search);

// Cart module
import cart from './modules/cart.js';
Alpine.data('cart', cart);

// Checkout modules
import fieldValidation from './modules/checkout-validate-fields.js';
import couponHandler from './modules/checkout-coupon-handler.js';
Alpine.data('fieldValidation', fieldValidation);
Alpine.data('couponHandler', couponHandler);

// Carousel module
import carousel from './modules/carousel-slider.js';
Alpine.data('carousel', carousel);

// Countdown module
import countdown from './modules/countdown.js';
Alpine.data('countdown', countdown);

// Register Alpine Plugins
Alpine.plugin(collapse);
Alpine.plugin(intersect);
Alpine.plugin(resize);

// Initialize Alpine.js
Alpine.start();